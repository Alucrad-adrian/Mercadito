<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Puesto extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Puesto_model'); // Cargar el modelo
    }

    // Función para mostrar el formulario de creación de puesto
    public function crear($idUsuario) {
        $data['idUsuario'] = $idUsuario; // Pasar el ID del usuario
        $this->load->view('inc/vistaproject/head');
		$this->load->view('inc/vistaproject/sibermenu');
        $this->load->view('crear_puesto', $data); // Cargar la vista
        $this->load->view('inc/vistaproject/footer');
    }

    // Función para procesar la inserción del puesto
    public function crear_puesto() {
        // Recoger los datos del formulario
        $data = array(
            'nombre_puesto' => $this->input->post('nombre_puesto'),
            'propietario' => $this->input->post('idUsuario'), // ID del usuario recién creado
            'descripcion' => $this->input->post('descripcion'),
            'fechaCreacion' => date('Y-m-d H:i:s')
        );

        // Insertar los datos en la tabla `puesto`
        if ($this->Puesto_model->insertar_puesto($data)) {
            redirect('usuarios/socios'); // Redirigir después de la inserción exitosa
        } else {
            echo "Error al crear el puesto.";
        }
    }
}
