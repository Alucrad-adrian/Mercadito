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
        return $this->db->insert_id();
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

    public function obtenerProductoPorId($productoId) {
        $this->db->where('idProducto', $productoId);
        $query = $this->db->get('producto');
    
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    
    
    
    public function obtener_productos() {
        $query = $this->db->get('producto'); // 'producto' es el nombre de la tabla en la base de datos
        return $query->result();
    }
    public function get_all_productos() {
        $query = $this->db->get('producto');
        return $query->result();
    }

    // Obtener todos los propietarios (tiendas) únicos
    public function get_all_propietarios() {
        $this->db->select('propietario');
        $this->db->distinct();
        $query = $this->db->get('producto');
        return $query->result();
    }

    // Obtener todas las categorías únicas
    public function get_all_categorias() {
        $this->db->select('categoria');
        $this->db->distinct();
        $query = $this->db->get('producto');
        return $query->result();
    }

    public function listaproductos2($propietario = null)
    {
        // Seleccionamos todos los campos
        $this->db->select('*');
        $this->db->from('producto');
    
        // Si el propietario (usuario actual) es proporcionado, aplicamos el filtro
        if (!empty($propietario)) {
            $this->db->where('propietario', $propietario);  // Donde el propietario es el usuario
        }
    
        // Ejecutamos la consulta
        $query = $this->db->get();
    
        // Verificar si se encontraron productos
        if ($query->num_rows() > 0) {
            return $query->result();  // Retornar los productos si se encontraron
        } else {
            return []; // Retornar un array vacío si no hay productos o no se encontró el propietario
        }
    }
    
        // Método para asociar el producto con el puesto
        public function agregarProductoPuesto($data) {
            return $this->db->insert('productos_puestos', $data);
        }
    
        
        
}
