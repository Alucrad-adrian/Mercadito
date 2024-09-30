<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Venta extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Venta_model');
        $this->load->model('Producto_model');  // Para obtener los productos
    }

    // Crear una nueva venta
    public function crear() {
        $this->load->library('form_validation');

        // Validación básica del formulario
        $this->form_validation->set_rules('cliente_id', 'Cliente', 'required');
        $this->form_validation->set_rules('productos[]', 'Productos', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('ventas/crear');
        } else {
            // Datos de la venta
            $venta_data = array(
                'cliente_id' => $this->input->post('cliente_id'),
                'fecha' => date('Y-m-d H:i:s'),
                'monto_total' => $this->input->post('monto_total'),
                'estado' => 'Pendiente'  // Estado inicial
            );

            // Insertar la venta en la base de datos
            $venta_id = $this->Venta_model->crear_venta($venta_data);

            // Obtener los productos seleccionados
            $productos = $this->input->post('productos');
            $detalles = [];

            foreach ($productos as $producto) {
                $producto_data = array(
                    'venta_id' => $venta_id,
                    'producto_id' => $producto['idproducto'],
                    'cantidad' => $producto['cantidad'],
                    'precio_unitario' => $producto['precio_unitario']
                );
                $detalles[] = $producto_data;
            }

            // Insertar los detalles de la venta
            $this->Venta_model->agregar_detalle_venta($detalles);

            // Redireccionar o mostrar una vista de éxito
            redirect('venta/lista');
        }
    }

    // Mostrar lista de ventas
    public function lista() {
        $data['ventas'] = $this->Venta_model->obtener_todas_ventas();  // Este método debes crearlo en el modelo
        $this->load->view('ventas/lista', $data);
    }

    // Detalle de una venta
    public function detalle($idventa) {
        $data['venta'] = $this->Venta_model->obtener_venta($idventa);
        $data['detalles'] = $this->Venta_model->obtener_detalle_venta($idventa);
        $this->load->view('ventas/detalle', $data);
    }
}
