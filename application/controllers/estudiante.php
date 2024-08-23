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
		if($this->session->userdata('rol')=='Administrador')
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
    // Cargar la librería de validación de formularios
    $this->load->library('form_validation');

    // Establecer reglas de validación para cada campo
    $this->form_validation->set_rules('usuario', 'Nombre de usuario', 'required|min_length[5]|max_length[12]', 
        array(
            'required' => 'Se requiere el nombre de usuario',
            'min_length' => 'El nombre de usuario debe tener al menos 5 caracteres',
            'max_length' => 'El nombre de usuario no puede exceder los 12 caracteres'
        )
    );

    $this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[6]', 
        array(
            'required' => 'Se requiere la contraseña',
            'min_length' => 'La contraseña debe tener al menos 6 caracteres'
        )
    );

    $this->form_validation->set_rules('nombre', 'Nombre', 'required', 
        array(
            'required' => 'Se requiere el nombre'
        )
    );

    $this->form_validation->set_rules('apellido1', 'Primer apellido', 'required|min_length[5]|max_length[12]', 
        array(
            'required' => 'Se requiere el primer apellido',
            'min_length' => 'El primer apellido debe tener al menos 5 caracteres',
            'max_length' => 'El primer apellido no puede exceder los 12 caracteres'
        )
    );

    $this->form_validation->set_rules('apellido2', 'Segundo apellido', 'required|min_length[5]|max_length[12]', 
        array(
            'required' => 'Se requiere el segundo apellido',
            'min_length' => 'El segundo apellido debe tener al menos 5 caracteres',
            'max_length' => 'El segundo apellido no puede exceder los 12 caracteres'
        )
    );

    $this->form_validation->set_rules('correo', 'Correo', 'required|valid_email', 
        array(
            'required' => 'Se requiere el correo electrónico',
            'valid_email' => 'Debes proporcionar un correo electrónico válido'
        )
    );

    // Verificar si la validación ha fallado
    if ($this->form_validation->run() == FALSE) {
        // Cargar la vista del formulario nuevamente si hay errores
        $this->load->view('inc/head');
        $this->load->view('inc/menu');
        $this->load->view('formulario');
        $this->load->view('inc/footer');
        $this->load->view('inc/pie');
    } else {
        // Si la validación es exitosa, proceder a guardar los datos
        $data['usuario'] = $this->input->post('usuario');
        $data['password'] = md5($this->input->post('password'));
        $data['nombre'] = strtoupper($this->input->post('nombre'));
        $data['Apellido1'] = strtoupper($this->input->post('apellido1'));
        $data['Apellido2'] = strtoupper($this->input->post('apellido2'));
        $data['rol'] = $this->input->post('rol');
        $data['correo'] = $this->input->post('correo');
        $data['carnet'] = $this->input->post('carnet');
        $data['celular'] = $this->input->post('celular');
        $data['fechaCreacion'] = date('Y-m-d H:i:s');

        // Guardar los datos en la base de datos
        $this->estudiante_model->agregarusuario($data);
        redirect('estudiante/curso', 'refresh');
    }
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

	public function subirfoto()
	{
		if (isset($_POST['idUsuario'])) {
		$idUsuario = $_POST['idUsuario'];
		$data['infousuario'] = $this->estudiante_model->recuperarusuario($idUsuario);
		$this->load->view('subirform', $data);
		}
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

		$this->estudiante_model->actualizar_foto($idUsuario,$data);
		$this->upload->data();
		}
		redirect('usuarios/socios','refresh');
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