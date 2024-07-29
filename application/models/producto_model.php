<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto_model extends CI_Model {

    public function listaproductos()
    {
        $this->db->select('*');
        $this->db->from('producto');
        return $this->db->get(); // Devuelve el resultado
    }

    public function productoPorId($idProducto)
    {
        $this->db->select('*');
        $this->db->from('producto');
        $this->db->where('idProducto', $idProducto);
        return $this->db->get(); // Devuelve el resultado
    }

    public function agregarProducto($data)
    {
        $this->db->insert('producto', $data);
    }

    public function eliminarProducto($idProducto)
    {
        $this->db->where('idProducto', $idProducto);
        $this->db->delete('producto');
    }

    public function modificarProducto($idProducto, $data)
    {
        $this->db->where('idProducto', $idProducto);
        $this->db->update('producto', $data);
    }

    public function deshabilitarProducto($idProducto)
    {
        $data = array('habilitado' => 0);
        $this->db->where('idProducto', $idProducto);
        $this->db->update('producto', $data);
    }

    public function habilitarProducto($idProducto)
    {
        $data = array('habilitado' => 1);
        $this->db->where('idProducto', $idProducto);
        $this->db->update('producto', $data);
    }
}
