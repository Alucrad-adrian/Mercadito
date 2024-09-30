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

		$this->load->view('inc/vistaproject/head');
		$this->load->view('inc/vistaproject/sibermenu');
		$this->load->view('deshabilitados',$data);
		$this->load->view('inc/vistaproject/footer');
	}

	public function agregar()
	{
		$this->load->view('inc/vistaproject/head');
		$this->load->view('inc/vistaproject/sibermenu');
		$this->load->view('formulario');
		$this->load->view('inc/vistaproject/footer');
	}

	public function agregarbd()
{
    // Cargar la librería de validación de formularios
    $this->load->library('form_validation');

    // Establecer reglas de validación para cada campo
    $this->form_validation->set_rules('usuario', 'Nombre de usuario', 'required|min_length[4]|max_length[12]', 
        array(
            'required' => 'Se requiere el nombre de usuario',
            'min_length' => 'El nombre de usuario debe tener al menos 5 caracteres',
            'max_length' => 'El nombre de usuario no puede exceder los 12 caracteres'
        )
    );

    $this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[5]', 
        array(
            'required' => 'Se requiere la contraseña',
            'min_length' => 'La contraseña debe tener al menos 5 caracteres'
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

    // Eliminar la validación 'required' para el apellido materno
    $this->form_validation->set_rules('apellido2', 'Apellido materno', 'max_length[12]', 
        array(
            'max_length' => 'El apellido materno no puede exceder los 12 caracteres'
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
        $this->load->view('inc/vistaproject/head');
        $this->load->view('inc/vistaproject/sibermenu');
        $this->load->view('formulario');
        $this->load->view('inc/vistaproject/footer');
    } else {
        // Si la validación es exitosa, proceder a guardar los datos
		$data['usuario'] = $this->input->post('usuario');
		$data['password'] = md5($this->input->post('password'));
		$data['nombre'] = strtoupper($this->input->post('nombre'));
		$data['Apellido1'] = strtoupper($this->input->post('apellido1'));

		// Guardar el apellido materno solo si se ha proporcionado
		$apellido_materno = $this->input->post('apellido2');
		if (!empty($apellido_materno)) {
			$data['Apellido2'] = strtoupper($apellido_materno);
		} else {
			$data['Apellido2'] = NULL;
		}

		$data['rol'] = $this->input->post('rol');
		$data['correo'] = $this->input->post('correo');
		$data['carnet'] = $this->input->post('carnet');
		$data['celular'] = $this->input->post('celular');
		$data['fechaCreacion'] = date('Y-m-d H:i:s');

        // Crear un token de verificación
        $token = md5(uniqid(mt_rand(), true));
        $data['token'] = $token; // Guardar el token junto con el usuario

        // Guardar los datos en la base de datos
        $this->estudiante_model->agregarsocio($data);

        // Obtener el ID del usuario recién creado
        $usuario_id = $this->db->insert_id();

        // Cargar la librería de correo con la configuración
        $this->load->library('email');
        $configuraciones['mailtype'] = 'html';
        $this->email->initialize($configuraciones);

        // Configurar los detalles del correo
        $this->email->from('rivera.adrian.9445@gmail.com', 'Mercadito Friki');
        $this->email->to($data['correo']);
        $this->email->cc('alexmerce2011@gmail.com');

        $this->email->subject('Verifica tu cuenta');
        $this->email->message('<p> Hola ' . $data['nombre'] . ',<br><br>Gracias por registrarte. Por favor, verifica tu correo electrónico haciendo clic en el enlace siguiente:<br><br></p>' . 
            '<a href="' . base_url() . 'index.php/usuarios/verificar/' . $token . '">Verificar cuenta</a>');

        // Enviar el correo
        if ($this->email->send()) {
            echo 'Correo de verificación enviado.';
        } else {
            echo 'Error al enviar el correo de verificación.';
            echo $this->email->print_debugger(); // Para depuración
        }

		// Aquí rediriges dependiendo del rol del usuario
		if ($data['rol'] == 'Vendedor') {
			// Redirigir a la creación de puesto para vendedores
			redirect('puesto/crear/' . $usuario_id);
		} else if ($data['rol'] == 'Cliente' || $data['rol'] == 'Administrador') {
			// Redirigir a una ventana diferente para Cliente o Administrador
			redirect('usuarios/socios', 'refresh');
		} else {
			// Manejo opcional para otros roles, si es necesario
			redirect('usuarios/lista', 'refresh');
		}
	}
}

	public function eliminarbd()
	{
		if (isset($_POST['idUsuario'])) {
			$idUsuario = $_POST['idUsuario'];
			$this->estudiante_model->eliminarusuario($idUsuario);
		}
		redirect('usuarios/socios','refresh');
	}

	public function modificar()
	{
		if (isset($_POST['idUsuario'])) {
			$idUsuario = $_POST['idUsuario'];
			$data['infousuario']=$this->estudiante_model->recuperarusuario($idUsuario);

			$this->load->view('inc/vistaproject/head');
			$this->load->view('inc/vistaproject/sibermenu');
			$this->load->view('formmodificar',$data);
			$this->load->view('inc/vistaproject/footer');
		} else {
			redirect('usuarios/socios','refresh');
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
		redirect('usuarios/socios','refresh');
	}

	public function deshabilitarbd()
	{
		if (isset($_POST['idUsuario'])) {
			$idUsuario = $_POST['idUsuario'];
			$data['habilitado']='0';

			$this->estudiante_model->modificarusuario($idUsuario,$data);
		}
		redirect('usuarios/socios','refresh');
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
		$this->load->view('inc/vistaproject/head');
		$this->load->view('inc/vistaproject/sibermenu');
		$this->load->view('subirform', $data);
		$this->load->view('inc/vistaproject/footer');

		}
	}
	public function subir()
{
    if (isset($_POST['idUsuario'])) {
        $idUsuario = $_POST['idUsuario'];
        $this->load->library('upload');

        // Configura los parámetros de subida de la imagen
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['file_name'] = uniqid(); // Genera un nombre único
        $config['overwrite'] = TRUE; // Sobrescribe archivos existentes
        $this->upload->initialize($config);

        // Verifica si se ha seleccionado un archivo para subir
        if ($this->upload->do_upload('imagen')) {
            $file_data = $this->upload->data();
            $data['foto'] = $file_data['file_name'];

            // Eliminar la imagen anterior si existe
            $imagen_actual = $this->input->post('imagen_actual');
            if ($imagen_actual && file_exists('./uploads/' . $imagen_actual)) {
                unlink('./uploads/' . $imagen_actual);
            }

        } else {
            // Si no se subió una nueva imagen, mantener la imagen existente
            $data['foto'] = $this->input->post('imagen_actual'); // Utiliza la imagen existente
        }

        // Actualizar la base de datos con el nombre del archivo
        $this->estudiante_model->actualizar_foto($idUsuario, $data);
    }
    redirect('usuarios/socios', 'refresh');
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
					redirect('usuarios/socios', 'refresh');
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