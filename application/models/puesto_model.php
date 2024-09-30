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
    public function obtener_puestos_por_usuario($idUsuario) {
        $this->db->where('propietario', $idUsuario);
        $query = $this->db->get('puesto'); // Suponiendo que `propietario` es el campo que enlaza el usuario con el puesto
        return $query->result();
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
