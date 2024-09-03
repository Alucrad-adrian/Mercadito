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
		$this->load->view('inc/vistaproject/head');
		$this->load->view('inc/vistaproject/sibermenurevacio');
		$this->load->view('formCliente');
		$this->load->view('inc/vistaproject/footer');
		
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
        $this->load->view('inc/vistaproject/head');
        $this->load->view('inc/vistaproject/sibermenu');
        $this->load->view('formCliente');
        $this->load->view('inc/vistaproject/footer');
    } else {
        // Si la validación es exitosa, proceder a guardar los datos
        $data['usuario'] = $this->input->post('usuario');
        $data['password'] = md5($this->input->post('password'));
        $data['nombre'] = strtoupper($this->input->post('nombre'));
        $data['Apellido1'] = strtoupper($this->input->post('apellido1'));
        $data['Apellido2'] = strtoupper($this->input->post('apellido2'));
    
        // Verificar si el rol está vacío y asignar "Cliente" como valor predeterminado
        $data['rol'] = empty($this->input->post('rol')) ? 'Cliente' : $this->input->post('rol');
    
        $data['correo'] = $this->input->post('correo');
        $data['carnet'] = $this->input->post('carnet');
        $data['celular'] = $this->input->post('celular');
        $data['fechaCreacion'] = date('Y-m-d H:i:s');

        // Crear un token de verificación
        $token = md5(uniqid(mt_rand(), true));
		$data['token'] = $token; // Guardar el token junto con el usuario

        // Guardar los datos en la base de datos
        $this->estudiante_model->agregarusuario($data); 
    
        // Cargar la librería de correo con la configuración
        $this->load->library('email');
        $configuraciones['mailtype']='html';
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
            redirect('usuarios/loginform', 'refresh');
        } else {
            echo 'Error al enviar el correo de verificación.';
            echo $this->email->print_debugger(); // Para depuración
        }

        // Redireccionar después de enviar el correo
        redirect('usuarios/loginform', 'refresh');
    }
}


	public function ventanaAdmin()
	{
		$lista=$this->estudiante_model->listausuarios();
			$data['usuarios']=$lista;
		$this->load->view('inc/vistaproject/head');
		$this->load->view('inc/vistaproject/sibermenu');
		$this->load->view('venAdmin', $data);
		$this->load->view('inc/vistaproject/footer');
		
	}

	public function socios(){
		$lista=$this->estudiante_model->listausuarios();
			$data['usuarios']=$lista;
			$this->load->view('inc/vistaproject/head');
			$this->load->view('inc/vistaproject/sibermenu');
			$this->load->view('listaclientes',$data);
			$this->load->view('inc/vistaproject/footer');
		
	}

	public function ventanaVendedor()
	{
		$lista = $this->producto_model->listaproductos();
        $data['productos'] = $lista;
		$this->load->view('inc/vistaproject/head');
		$this->load->view('inc/vistaproject/sibermenuVendedor');
		$this->load->view('lista_producto', $data);
		$this->load->view('inc/vistaproject/footer');
	}

	public function ventanaCliente()
	{
		$this->load->model('producto_model'); // Carga el modelo
    	$data['productos'] = $this->producto_model->obtener_productos();
		
		
		$this->load->view('inc/vistaproject/head');
		$this->load->view('inc/vistaproject/sibermenuCliente');
		$this->load->view('venCliente', $data);
		$this->load->view('inc/vistaproject/footer');
	}

	public function verificar($token)
    {
        // Buscar al usuario por el token
        $usuario = $this->estudiante_model->obtener_usuario_por_token($token);

        if ($usuario) {
            // Si el token es válido, activar la cuenta del usuario
            $this->estudiante_model->activar_cuenta($usuario['idUsuario']);

            // Mostrar un mensaje de éxito
            $data['mensaje'] = '¡Tu cuenta ha sido verificada con éxito!';
            $this->load->view('Confirmaciondetoken', $data);
        } else {
            // Si el token no es válido, mostrar un mensaje de error
            $data['mensaje'] = 'El enlace de verificación no es válido o ha expirado.';
            $this->load->view('Confirmaciondetoken', $data);
        }
    }
	public function confirmacion(){
		$this->load->view('Confirmaciondetoken');
	}

	public function guardarpedido(){
		$this->load->model('Pedido_model');
		$pedidoData = array(
			'fecha' => date('Y-m-d H:i:s'),
			'idUsuario' => $idUsuario, // Asume que tienes el ID del usuario/cliente
			'total' => $totalPedido
		);
		
		$detalleData = array(
			array(
				'producto_idproducto' => 1,
				'cantidad' => 2
			),
			array(
				'producto_idproducto' => 2,
				'cantidad' => 1
			)
		);
		
		$resultado = $this->pedido_model->guardarPedido($pedidoData, $detalleData);
		
		if ($resultado) {
			echo "Pedido y detalles guardados correctamente.";
		} else {
			echo "Ocurrió un error al guardar el pedido.";
		}
		
		

	}
}
