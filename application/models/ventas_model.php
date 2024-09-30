<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Venta_model extends CI_Model {

    // Crear una nueva venta
    public function crear_venta($data) {
        $this->db->insert('venta', $data);
        return $this->db->insert_id();  // Retorna el ID de la venta insertada
    }

    // Añadir detalles de productos a la venta
    public function agregar_detalle_venta($data) {
        return $this->db->insert_batch('detalle_venta', $data);  // Inserta múltiples productos a la vez
    }

    // Obtener información de una venta
    public function obtener_venta($idventa) {
        $this->db->select('*');
        $this->db->from('venta');
        $this->db->where('idventa', $idventa);
        return $this->db->get()->row();  // Retorna una fila con los datos de la venta
    }

    // Obtener los detalles de una venta
    public function obtener_detalle_venta($idventa) {
        $this->db->select('detalle_venta.*, producto.nombre_producto, producto.precio_unitario');
        $this->db->from('detalle_venta');
        $this->db->join('producto', 'producto.idproducto = detalle_venta.producto_id');
        $this->db->where('venta_id', $idventa);
        return $this->db->get()->result();  // Retorna todos los detalles de la venta
    }
}
