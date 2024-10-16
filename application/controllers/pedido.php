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
        $tipo = 'pedido';
    
        // Crear array de datos para transacción
        $transaccionData = array(
            'cliente_id' => $idUsuario, // Usar idUsuario del cliente
            'fecha' => $fecha,
            'monto_total' => $monto_total,
            'puesto' => $puestoProducto, // Guardar el puestoProducto
            'estado' => $estado,
            'tipo' => $tipo
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
    
    
    
    
    

    
}
