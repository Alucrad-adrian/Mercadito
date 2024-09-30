<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notificacion extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('notificacion_model');
        $usuario_id = $this->session->userdata('idUsuario');
        $this->data['notificaciones'] = $this->notificacion_model->obtener_notificaciones_no_leidas($usuario_id);
    }

// Crear una notificación
public function crear_notificacion($usuario_id, $mensaje) {
    $this->notificacion_model->crear_notificacion($usuario_id, $mensaje);
}

// Mostrar las notificaciones no leídas
public function mostrarnotificaciones() {
    $usuario_id = $this->session->userdata('idUsuario');
    $data['notificaciones'] = $this->notificacion_model->obtener_notificaciones_no_leidas($usuario_id);
    
    // Cargar la vista junto con las notificaciones
    $this->load->view('inc/vistaproject/head', $data);
    $this->load->view('inc/vistaproject/sibermenucliente', $data);
    $this->load->view('mostrarnotificaciones', $data);
    $this->load->view('inc/vistaproject/footer', $data);
}

// Marcar una notificación como leída
public function leer_notificacion($id) {
    $this->notificacion_model->marcar_como_leida($id);
    redirect('notificacion/mostrarnotificaciones');
}

public function obtener_notificaciones($usuario_id) {
    // Obtener notificaciones del modelo (por ejemplo, productos agregados recientemente)
    $this->load->model('notificacion_model');
    $notificaciones = $this->notificacion_model->obtener_notificaciones_por_usuario($usuario_id);
    
    // Devolver las notificaciones con imagen y datos del producto
    return $notificaciones;
}
}