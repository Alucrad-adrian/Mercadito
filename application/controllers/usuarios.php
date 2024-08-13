<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function index()
	{
		$this->load->view('loginform');	
	}

	public function validarusuario()
	{
		$login = $_POST['usuario'];
		$password = md5($_POST['password']);
	
		$consulta = $this->usuario_model->validar($login, $password);
	
		if ($consulta->num_rows() > 0) {
			// usuario válido
			$row = $consulta->row(); // obtener la primera fila del resultado
	
			$this->session->set_userdata('idUsuario', $row->idUsuario);
			$this->session->set_userdata('usuario', $row->usuario);
			$this->session->set_userdata('rol', $row->rol);
	
			redirect('usuarios/panel', 'refresh');
		} else {
			// acceso incorrecto - volvemos al login
			redirect('usuarios/index', 'refresh');
		}
	}

	public function panel()
	{
		if ($this->session->userdata('rol')=='Administrador') {
			
			redirect('usuarios/ventanaAdmin','refresh');
		}
		elseif($this->session->userdata('rol')=='vendedor'){
			redirect('usuarios/ventanaVendedor','refresh');
		}
		elseif($this->session->userdata('rol')=='cliente'){
			redirect('usuarios/ventanaCliente','refresh');
		}
		else {
			redirect('usuarios/index', 'refresh');
		}
	}


	public function logout()
	{
		$this->session->sess_destroy();
		redirect('usuarios/index','refresh');
	}
	public function agregar()
	{
		$this->load->view('inc/head');
		$this->load->view('inc/menu');
		$this->load->view('formCliente');
		$this->load->view('inc/footer');
		$this->load->view('inc/pie');
	}
	public function agregarbd()
	{
		$data['usuario'] = $_POST['usuario'];
		$data['password'] = md5($_POST['password']);
		$data['nombre'] = strtoupper($_POST['nombre']);
		$data['Apellido1'] = strtoupper($_POST['apellido1']);
		$data['Apellido2'] = strtoupper($_POST['apellido2']);
	
		// Verificar si el rol está vacío y asignar "cliente" como valor predeterminado
		$data['rol'] = empty($_POST['rol']) ? 'Cliente' : $_POST['rol'];
	
		$data['correo'] = $_POST['correo'];
		$data['carnet'] = $_POST['carnet'];
		$data['celular'] = $_POST['celular'];
	
		$this->estudiante_model->agregarusuario($data);
		redirect('usuarios/index', 'refresh');
	}

	public function ventanaAdmin()
	{
		$this->load->view('inc/head');
		$this->load->view('inc/menu');
		$this->load->view('venAdmin');
		$this->load->view('inc/footer');
		$this->load->view('inc/pie');
	}

	public function ventanaVendedor()
	{
		$this->load->view('inc/head');
		$this->load->view('inc/menu');
		$this->load->view('venVendedor');
		$this->load->view('inc/footer');
		$this->load->view('inc/pie');
	}

	public function ventanaCliente()
	{
		$this->load->view('inc/head');
		$this->load->view('inc/menu');
		$this->load->view('venCliente');
		$this->load->view('inc/footer');
		$this->load->view('inc/pie');
	}
}
