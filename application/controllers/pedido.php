<?php
class Pedido extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pedido_model');
        $this->load->model('Estudiante_model'); // Asegúrate de cargar este modelo si lo usas
    }

    public function vistapedido() {
       

        // Obtener los datos enviados desde el formulario
        $productoId = $this->input->post('productoId');
        $nombreProducto = $this->input->post('nombre_producto');
        $precioProducto = $this->input->post('precio_unitario');
        $propietarioProducto = $this->input->post('propietario');
    
        // Cargar el modelo del pedido
        $this->load->model('pedido_model');
    
        // Cargar el modelo de puesto
        $this->load->model('Puesto_model');
    
        // Obtener el ID del usuario actual desde la sesión
        
        
       $idUsuario=$this->session->userdata('idUsuario');
        $nombrePuesto = $this->input->post('nombre_Puesto'); // Obtener el nombre del puesto
        $puestoProducto = $this->input->post('puestoProducto');
        
        
        // Armar el array de datos a enviar a la vista
        $data = [
            'productoId' => $productoId,
            'idUsuario' => $idUsuario,
            'nombreProducto' => $nombreProducto,
            'precioProducto' => $precioProducto,
            'propietarioProducto' => $propietarioProducto,
            'puestoProducto' => $puestoProducto 
            
        ];
    
        // Verificar si el producto existe en la base de datos
        $this->load->model('producto_model');
        $producto = $this->producto_model->obtenerProductoPorId($productoId);
    
        if ($producto) {
            // Producto encontrado, cargar la vista con los datos
            $data['producto'] = $producto;
          
            $this->load->view('inc/vistaproject/head');
            $this->load->view('inc/vistaproject/sibermenuCliente');
            $this->load->view('pedido', $data); // Pasar los datos a la vista de reserva
            $this->load->view('inc/vistaproject/footer');
        } else {
            // Producto no encontrado, mostrar un mensaje de error
            $this->session->set_flashdata('error', 'El producto no fue encontrado en la base de datos.');
            redirect('usuarios/ventanaCliente');
        }
    }
    
    
    public function confirmarReserva() {
        // Cargar el modelo
        $this->load->model('estudiante_model');
    
        // Obtener el idUsuario del cliente desde la sesión
        $idUsuario = $this->session->userdata('idUsuario'); // Cambiar set_userdata a userdata para obtener el valor
    
        // Obtener el puestoProducto del formulario
        $puestoProducto = $this->input->post('puestoProducto'); // Obtener el puestoProducto
    
        // Validar que se haya proporcionado puestoProducto
        if (empty($puestoProducto)) {
            echo "Error: No se proporcionó el puestoProducto.";
            return;
        }
    
        // Obtener datos del formulario
        $productoId = $this->input->post('productoId');
        $precio_unitario = $this->input->post('precio_unitario');
        $cantidad = $this->input->post('cantidadSeleccionada');
    
        // Calcular el monto total
        $monto_total = $precio_unitario * $cantidad;
        $fecha = date('Y-m-d H:i:s');
        $estado = 'reservado';
        
    
        // Crear array de datos para transacción
        $transaccionData = array(
            'cliente_id' => $idUsuario, // Usar idUsuario del cliente
            'fecha' => $fecha,
            'monto_total' => $monto_total,
            'puesto' => $puestoProducto, // Guardar el puestoProducto
            'estado' => $estado
        );
    
        // Insertar la transacción y obtener el ID generado
        $transaccionId = $this->pedido_model->insertTransaccion($transaccionData);
    
        // Crear array de datos para detalle de transacción
        $detalleTransaccionData = array(
            'transaccion_id' => $transaccionId,
            'producto_id' => $productoId,
            'cantidad' => $cantidad,
            'precio_unitario' => $precio_unitario
        );
    
        // Insertar el detalle de la transacción
        $this->pedido_model->insertDetalleTransaccion($detalleTransaccionData);
    
        $this->session->set_flashdata('success', '¡Reserva confirmada exitosamente!');
        redirect('usuarios/ventanaCliente');
    }
    public function listapedido(){
        $this->load->model('Pedido_model');
        $data['pedidos'] = $this->Pedido_model->obtener_pedidos_reservados();
        $this->load->view('inc/vistaproject/head');
		$this->load->view('inc/vistaproject/sibermenuVendedor');
		$this->load->view('lista_pedido',$data);
		$this->load->view('inc/vistaproject/footer');
		
    }

    public function listaventa(){
        $this->load->model('Pedido_model');
        $data['pedidos'] = $this->Pedido_model->obtener_ventas_realizadas();
        $this->load->view('inc/vistaproject/head');
		$this->load->view('inc/vistaproject/sibermenuVendedor');
		$this->load->view('lista_venta',$data);
		$this->load->view('inc/vistaproject/footer');
		
    }
///ventanareservas
    public function crear_reserva()
{
    // Obtener el ID del cliente (puede ser de la sesión)
    $idCliente = $this->session->userdata('idUsuario');
    
    // Obtener los productos seleccionados y las cantidades
    $productos_seleccionados = $this->input->post('productos_seleccionados');
    $cantidades = $this->input->post('cantidad');
    $idPuesto = $this->input->post('idPuesto');

    // Verificar que se seleccionó al menos un producto
    if (empty($productos_seleccionados)) {
        // Si no se seleccionaron productos, redirigir con un mensaje de error
        $this->session->set_flashdata('error', 'No seleccionaste ningún producto.');
        redirect('ruta_a_la_vista_de_reserva');
        return;
    }

    // Inicializar total de la reserva
    $total = 0;

    // Validar el stock de cada producto y calcular el total
    foreach ($productos_seleccionados as $idProducto) {
        // Obtener el producto desde la base de datos
        $producto = $this->db->get_where('producto', ['idProducto' => $idProducto])->row();

        // Verificar la cantidad disponible (stock)
        if ($cantidades[$idProducto] > $producto->stock) {
            $this->session->set_flashdata('error', "No hay suficiente stock para el producto: {$producto->nombre_producto}");
            redirect('ruta_a_la_vista_de_reserva');
            return;
        }

        // Calcular el total para la reserva
        $total += $producto->precio_unitario * $cantidades[$idProducto];
    }

    // Crear la reserva en la tabla `reserva`
    $data_reserva = [
        'idCliente' => $idCliente,
        'idPuesto' => $idPuesto,
        'fechaReserva' => date('Y-m-d H:i:s'),
        'total' => $total,
        'estado' => 'Pendiente'
    ];
    $this->db->insert('reserva', $data_reserva);

    // Obtener el ID de la reserva recién creada
    $idReserva = $this->db->insert_id();

    // Insertar los productos en la tabla `detalle_reserva`
    foreach ($productos_seleccionados as $idProducto) {
        $producto = $this->db->get_where('producto', ['idProducto' => $idProducto])->row();

        // Insertar en `detalle_reserva`
        $data_detalle_reserva = [
            'idReserva' => $idReserva,
            'idProducto' => $idProducto,
            'cantidad' => $cantidades[$idProducto],
            'precio_unitario' => $producto->precio_unitario
        ];
        $this->db->insert('detalle_reserva', $data_detalle_reserva);

        // Actualizar el stock del producto
        $nuevo_stock = $producto->stock - $cantidades[$idProducto];
        $this->db->where('idProducto', $idProducto);
        $this->db->update('producto', ['stock' => $nuevo_stock]);
    }

    // Redirigir con un mensaje de éxito
    $this->session->set_flashdata('success', 'Reserva creada exitosamente.');
    redirect('ruta_a_la_vista_de_reserva');
}


    public function venta_realizada()
    {
        // Obtenemos el idTransaccion desde el formulario
        $idTransaccion = $this->input->post('idTransaccion');

        // Datos que se van a actualizar en la tabla transaccion
        $data = array(
            'estado' => 'vendido',
            'tipo' => 'comprado'
        );

        // Llamamos al modelo para actualizar los datos
        $this->Pedido_model->actualizar_transaccion($idTransaccion, $data);

        // Redirigimos a la lista de pedidos una vez que se actualice la venta
        redirect('pedido/listaventa');
    }
    
    public function cancelar()
    {
        // Obtenemos el idTransaccion desde el formulario
        $idTransaccion = $this->input->post('idTransaccion');

        // Llamamos al modelo para eliminar los datos de las tablas transaccion y detalle_transaccion
        $this->Pedido_model->eliminar_transaccion($idTransaccion);

        // Redirigimos a la lista de pedidos una vez que se elimine la transacción
        redirect('pedido/lista_pedido');
    }

}
