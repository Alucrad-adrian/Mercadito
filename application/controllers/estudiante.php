<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudiante extends CI_Controller {

	public function demo(){
		$this->load->view('inc/vistaslte/head');
		$this->load->view('inc/vistaslte/menu');
		$this->load->view('inc/vistaslte/test');
		$this->load->view('inc/vistaslte/footer');
	}

	public function curso()
	{
		if($this->session->userdata('usuario'))
		{
			$lista=$this->estudiante_model->listausuarios();
			$data['usuarios']=$lista;

			$this->load->view('inc/head');
			$this->load->view('inc/menu');
			$this->load->view('lista',$data);
			$this->load->view('inc/footer');
			$this->load->view('inc/pie');		
		}
		else
		{
			redirect('usuarios/index','refresh');
		}
	}

	public function deshabilitados()
	{
		$lista=$this->estudiante_model->listadeshabilitados();
		$data['usuarios']=$lista;

		$this->load->view('inc/head');
		$this->load->view('inc/menu');
		$this->load->view('deshabilitados',$data);
		$this->load->view('inc/footer');
		$this->load->view('inc/pie');
	}

	public function agregar()
	{
		$this->load->view('inc/head');
		$this->load->view('inc/menu');
		$this->load->view('formulario');
		$this->load->view('inc/footer');
		$this->load->view('inc/pie');
	}

	public function agregarbd()
	{
		$data['usuario']=$_POST['usuario'];
		$data['password']=md5($_POST['password']);
		$data['nombre']=strtoupper($_POST['nombre']);
		$data['Apellido1']=strtoupper($_POST['apellido1']);
		$data['Apellido2']=strtoupper($_POST['apellido2']);
		$data['rol']=$_POST['rol'];
		$data['correo']=$_POST['correo'];
		$data['carnet']=$_POST['carnet'];
		$data['celular']=$_POST['celular'];
		$data['fechaCreacion'] = date('Y-m-d H:i:s');

		$this->estudiante_model->agregarusuario($data);
		redirect('estudiante/curso','refresh');
	}

	public function eliminarbd()
	{
		if (isset($_POST['idUsuario'])) {
			$idUsuario = $_POST['idUsuario'];
			$this->estudiante_model->eliminarusuario($idUsuario);
		}
		redirect('estudiante/curso','refresh');
	}

	public function modificar()
	{
		if (isset($_POST['idUsuario'])) {
			$idUsuario = $_POST['idUsuario'];
			$data['infousuario']=$this->estudiante_model->recuperarusuario($idUsuario);

			$this->load->view('inc/head');
			$this->load->view('inc/menu');
			$this->load->view('formmodificar',$data);
			$this->load->view('inc/footer');
			$this->load->view('inc/pie');
		} else {
			redirect('estudiante/curso','refresh');
		}
	}

	public function modificarbd()
	{
		if (isset($_POST['idUsuario'])) {
			$idUsuario = $_POST['idUsuario'];
			$data['nombre']=strtoupper($_POST['nombre']);
			$data['Apellido1']=strtoupper($_POST['apellido1']);
			$data['Apellido2']=strtoupper($_POST['apellido2']);
			$data['rol']=$_POST['rol'];
			$data['correo']=$_POST['correo'];
			$data['carnet']=$_POST['carnet'];
			$data['celular']=$_POST['celular'];
			$data['fechaActualizacion'] = date('Y-m-d H:i:s');

			$this->estudiante_model->modificarusuario($idUsuario,$data);
		}
		redirect('estudiante/curso','refresh');
	}

	public function deshabilitarbd()
	{
		if (isset($_POST['idUsuario'])) {
			$idUsuario = $_POST['idUsuario'];
			$data['habilitado']='0';

			$this->estudiante_model->modificarusuario($idUsuario,$data);
		}
		redirect('estudiante/curso','refresh');
	}

	public function habilitarbd()
	{
		if (isset($_POST['idUsuario'])) {
			$idUsuario = $_POST['idUsuario'];
			$data['habilitado']='1';

			$this->estudiante_model->modificarusuario($idUsuario,$data);
		}
		redirect('estudiante/deshabilitados','refresh');
	}

	public function subir()
	{
		if (isset($_POST['idUsuario'])) {
			$idUsuario = $_POST['idUsuario'];
			$nombrearchivo=$idUsuario.".jpg";
			$config['upload_path']='./uploads/';
			$config['file_name']=$nombrearchivo;
			$direccion="./uploads/".$nombrearchivo;
			if(file_exists($direccion))
			{
				unlink($direccion);
			}
			$config['allowed_types']='jpg';
			$this->load->library('upload',$config);

			if(!$this->upload->do_upload())
			{
				$data['error']=$this->upload->display_errors();
			}
			else
			{
				$data['foto']=$nombrearchivo;
			}
		}
	}
    public function modifcon()
	{
		$idUsuario = $this->session->userdata('idUsuario'); 
			if ($idUsuario) {
				$data['infousuario'] = $this->estudiante_model->recuperarusuario($idUsuario);

				$this->load->view('inc/head');
				$this->load->view('inc/menu');
				$this->load->view('modifcontra', $data);
				$this->load->view('inc/footer');
				$this->load->view('inc/pie');
			} else {
				redirect('estudiante/curso', 'refresh');
			}
	}
    public function modificarPassword()
    {
		$idUsuario = $this->input->post('idUsuario');
		if ($idUsuario) {
			$passwordActual = $this->input->post('passwordActual');
			$nuevaPassword = $this->input->post('nuevaPassword');
			$confirmarPassword = $this->input->post('confirmarPassword');

			if ($nuevaPassword === $confirmarPassword) {
				$usuario = $this->estudiante_model->recuperaruser($idUsuario);
				if (md5($passwordActual) === $usuario->password) {
					$data['password'] = md5($nuevaPassword);
					$data['fechaActualizacion'] = date('Y-m-d H:i:s'); // Añade la fecha y hora actual
					$this->estudiante_model->modificarusuario($idUsuario, $data);
					redirect('estudiante/curso', 'refresh');
				} else {
					echo "Contraseña actual incorrecta.";
				}
			} else {
				echo "Las nuevas contraseñas no coinciden.";
			}
		} else {
			echo "ID de usuario no proporcionado.";
		}

    }

}