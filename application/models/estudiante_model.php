<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudiante_model extends CI_Model {

	public function listausuarios()
    {
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('habilitado', '1');
        return $this->db->get(); // Devuelve el resultado
    }

    public function listadeshabilitados()
    {
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('habilitado', '0');
        return $this->db->get(); // Devuelve el resultado
    }

    public function agregarusuario($data)
    {
        $this->db->insert('usuario', $data);
        
    }


    public function eliminarusuario($idUsuario)
    {
        $this->db->where('idUsuario', $idUsuario);
        $this->db->delete('usuario');
    }

    public function recuperarusuario($idUsuario)
    {
        $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('idUsuario', $idUsuario);
        return $this->db->get(); // Devuelve el resultado
    }

    public function modificarusuario($idUsuario, $data)
    {
        $this->db->where('idUsuario', $idUsuario);
        $this->db->update('usuario', $data);
    }

    public function recuperaruser($idUsuario)
    {
        $this->db->where('idUsuario', $idUsuario);
        $query = $this->db->get('usuario');

        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function actualizar_foto($idUsuario,$data) {
        
        $this->db->where('idUsuario', $idUsuario);
        return $this->db->update('usuario', $data);
    }

    public function obtener_usuario_por_token($token)
    {
        $this->db->where('token', $token);
        $query = $this->db->get('usuario');

        if ($query->num_rows() > 0) {
            return $query->row_array(); // Retorna los datos del usuario
        } else {
            return false; // No se encontró ningún usuario con ese token
        }
    }

    public function activar_cuenta($idUsuario)
    {
        $data = array(
            'habilitado' => 1, // Activar la cuenta
            'token' => null,   // Eliminar el token para evitar que se reutilice
            'fechaActualizacion' => date('Y-m-d H:i:s') // Actualizar la fecha de modificación
        );

        $this->db->where('idUsuario', $idUsuario);
        $this->db->update('usuario', $data);
    }
}

