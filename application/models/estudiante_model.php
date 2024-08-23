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
}

