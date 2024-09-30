<?php
class Pedido extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pedido_model');
        $this->load->model('Estudiante_model'); // Asegúrate de cargar este modelo si lo usas
    }

    public function vistaPedido() {
        $idUsuario = $this->session->userdata('idUsuario'); // Obtener el id del usuario desde la sesión
        $data['infousuario'] = $this->Estudiante_model->recuperarusuario($idUsuario); // Recuperar información del usuario
        $this->load->view('inc/vistaproject/head');
        $this->load->view('inc/vistaproject/sibermenuCliente');
        $this->load->view('pedido', $data); // Cargar la vista con los datos del usuario
        $this->load->view('inc/vistaproject/footer');
    }
   

    public function realizarPedido() {
        // Recoge los datos enviados desde el formulario
        $monto_total = $this->input->post('monto_total');
        $usuario_idusuario = $this->input->post('usuario_idusuario');

        // Verifica que los datos no sean NULL antes de proceder
        if (empty($monto_total) || empty($usuario_idusuario)) {
            $this->session->set_flashdata('error', 'Error: Algunos campos están vacíos.');
            redirect('pedido/error');
            return;
        }

        // Datos del pedido
        $pedidoData = array(
            'fecha' => date('Y-m-d H:i:s'),
            'monto_total' => $monto_total,
            'usuario_idusuario' => $usuario_idusuario
        );

        // Datos del detalle del pedido (suponiendo que haya varios productos)
        $detalleData = array();
        $productos = $this->input->post('productos'); // Supone que 'productos' es un array de productos en el formulario

        foreach ($productos as $producto) {
            if (empty($monto_total) || empty($usuario_idusuario) || empty($producto_id) || empty($Cantidad)) {
                $this->session->set_flashdata('error', 'Error: Algunos campos están vacíos.');
                redirect('pedido/error');
                return;
            }
        }

        // Llama al modelo para guardar el pedido y los detalles en una transacción
        if ($this->Pedido_model->guardarPedido($pedidoData, $detalleData)) {
            $this->session->set_flashdata('success', 'Pedido realizado con éxito.');
            redirect('pedido/success');
        } else {
            $this->session->set_flashdata('error', 'Error al realizar el pedido.');
            redirect('pedido/error');
        }
    }

    
    
        public function comprarProducto() {
            $idProducto = $this->input->post('idProducto');
            $idUsuario = $this->input->post('idUsuario');
            
            // Lógica para comprar el producto (puedes crear un modelo para manejar esta lógica)
            $this->load->model('pedido_model');
            $resultado = $this->pedido_model->comprarProducto($idProducto, $idUsuario);
            
            if ($resultado) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error']);
            }
        }
    
    
}
