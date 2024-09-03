<?php
class Pedido extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pedido_model');
    }

    public function Pedido() {
       
        $idUsuario = $this->session->userdata('idUsuario'); // Ejemplo de inicialización desde la sesión
        $data['infousuario']=$this->estudiante_model->recuperarusuario($idUsuario);
        $this->load->view('pedido',$data);
    }
    public function realizarPedido() {
        // Recoge los datos enviados desde el formulario
        $monto_total = $this->input->post('monto_total');
        $usuario_idusuario = $this->input->post('usuario_idusuario');
    
        // Verifica que los datos no sean NULL antes de proceder
        if ($monto_total === NULL || $usuario_idusuario === NULL) {
            echo "Error: Algunos campos están vacíos.";
            return;
        }
    
        // Datos del pedido
        $pedidoData = array(
            'fecha' => date('Y-m-d H:i:s'),
            'monto_total' => $monto_total,
            'usuario_idusuario' => $usuario_idusuario
        );
    
        // Datos del detalle del pedido
        $detalleData = array(
            array(
                'cantidad' => $this->input->post('cantidad_1'),
                'producto_idproducto' => $this->input->post('producto_id_1')
            ),
            // Más detalles aquí
        );
    
        // Llama al modelo para guardar el pedido y los detalles en una transacción
        if ($this->Pedido_model->guardarPedido($pedidoData, $detalleData)) {
            echo "Pedido realizado con éxito.";
        } else {
            echo "Error al realizar el pedido.";
        }
    }
    
}
