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
        $this->load->model('pedido_model');
        $puesto=$this->input->post('idpuesto');
        $data = [
            'productoId' => $productoId,
            'nombreProducto' => $nombreProducto,
            'precioProducto' => $precioProducto,
            'propietarioProducto' => $propietarioProducto,
            'idpuesto'=> $puesto
        ];
        $data['idpuesto'] = $this->Puesto_model->obtener_idpuesto_por_usuario();
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
        $this->load->model('pedido_model');

        // Obtener datos del formulario
        $productoId = $this->input->post('productoId');
        $precio_unitario = $this->input->post('precio_unitario');
        $cantidad = $this->input->post('cantidadSeleccionada');
        $idpuesto = $this->input->post('idpuesto'); // Recibir el propietario desde el formulario
        if (empty($idpuesto)) {
            // Obtener el puesto basado en otra lógica si no está en el POST
            $puesto = $this->pedido_model->ObtenerPuestoId($producto->propietario); // Suponiendo que propietario es el idPuesto
            $idpuesto = $puesto->idPuesto;
        }
        $clienteId = 1; // Asume que tienes un cliente registrado (puedes obtenerlo de la sesión)
        $monto_total = $precio_unitario * $cantidad;
        $fecha = date('Y-m-d H:i:s');
        $estado = 'reservado';
        $tipo = 'pedido';

        // Crear array de datos para transacción
        $transaccionData = array(
            'cliente_id' => $clienteId,
            'fecha' => $fecha,
            'monto_total' => $monto_total,
            'puesto' => $idpuesto, // Guardar el propietario como puesto
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

        // Redirigir o mostrar un mensaje de confirmación
        redirect('usuarios/ventanaCliente'); // Aquí puedes redirigir a la página de reservas del cliente
    }
    
    
    

    
}
