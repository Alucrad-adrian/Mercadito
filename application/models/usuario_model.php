<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

	public function validar($login,$password)
	{
		//$this->db->select('*');
		//$this->db->from('usuarios');
		//$this->db->where('login',$login);
		//$this->db->where('password',$password);
		//return $this->db->get();

		$query="SELECT * FROM usuario WHERE usuario='$login' AND password='$password'";
		return $this->db->query($query);
	}
	public function obtenerUsuariosPorRol($rol) {
		$this->db->where('rol', $rol);
		$query = $this->db->get('usuario');  // Suponiendo que tu tabla de usuarios se llama 'usuario'
		return $query->result();
	}
	
}
