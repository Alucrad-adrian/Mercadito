<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Puesto_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Cargar la base de datos
    }

    // Función para insertar un nuevo puesto
    public function insertar_puesto($data) {
        return $this->db->insert('puesto', $data);  // Inserta los datos en la tabla `puesto`
    }

    // Función para obtener los puestos asociados a un usuario (opcional)
    public function obtener_idpuesto_por_usuario($usuario_id)
    {
        $this->db->select('idpuesto'); // Selecciona el campo idPuesto
        $this->db->from('puesto'); // De la tabla puesto
        $this->db->where('propietario', $usuario_id); // Busca donde propietario sea igual a idUsuario
        $query = $this->db->get(); // Ejecuta la consulta
    
        if ($query->num_rows() > 0) {
            return $query->row()->idpuesto; // Si hay resultados, retorna idPuesto
        } else {
            return null; // Si no hay resultados, retorna null
        }
    }

    public function obtener_todos_los_puestos()
    {
        $this->db->select('idpuesto, nombre_puesto, propietario');
        $this->db->from('puesto');
        $query = $this->db->get();

        return $query->result();
    }
    // Otras funciones que puedas necesitar para actualizar, eliminar, listar puestos, etc.
}
