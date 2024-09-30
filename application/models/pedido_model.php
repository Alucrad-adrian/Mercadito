<?php
class Pedido_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Lógica para reservar un producto
    public function reservarProducto($idProducto, $idUsuario) {
    $data = array(
        'idProducto' => $idProducto,
        'cliente' => $idUsuario,
        'fecha' => date('Y-m-d H:i:s'),
        'monto_total' => 0,  // Ajusta según sea necesario
        'fechaCreacion' => date('Y-m-d H:i:s'),
        'fechaActualizacion' => date('Y-m-d H:i:s'),
        'tipo' => 'reserva'  
    );

    return $this->db->insert('pedido', $data);
}


    // Lógica para comprar un producto
    public function comprarProducto($idProducto, $idUsuario) {
        $data = array(
            'idProducto' => $idProducto,
            'idUsuario' => $idUsuario,
            'estado' => 'comprado', // Estado del pedido
            'fecha_compra' => date('Y-m-d H:i:s')
        );

        // Inserta la compra en la tabla de pedidos
        return $this->db->insert('pedidos', $data);
    }
}
