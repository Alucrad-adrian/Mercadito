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

    public function obtenerIdPuestos() {
        // Consulta para obtener todos los idPuesto de la tabla puesto
        $this->db->select('idPuesto'); // Seleccionamos solo la columna idPuesto
        $this->db->from('puesto'); // De la tabla puesto
        $query = $this->db->get();

        // Retornamos los resultados como un array
        if ($query->num_rows() > 0) {
            return $query->result_array(); // Retorna un array con todos los idPuesto
        } else {
            return null; // Retorna null si no se encontraron puestos
        }
    }
    
     

    public function obtenerIdPuestoPorPropietario($idUsuario) {
        // Seleccionamos el idPuesto de la tabla puesto donde propietario es igual a idUsuario
        $this->db->select('idPuesto'); 
        $this->db->from('puesto'); 
        $this->db->where('propietario', $idUsuario); // Condición para que propietario sea igual a idUsuario
        $query = $this->db->get();
        
        // Verificamos si se encontró un puesto con ese propietario
        if ($query->num_rows() > 0) {
            // Si se encontró, retornamos el idPuesto
            return $query->row()->idPuesto;
        } else {
            // Si no se encontró, retornamos null
            return null;
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
