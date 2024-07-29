<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {

    public function lista()
    {
        $lista = $this->producto_model->listaproductos();
        $data['productos'] = $lista;

        $this->load->view('inc/head');
        $this->load->view('inc/menu');
        $this->load->view('lista_producto', $data);
        $this->load->view('inc/footer');
        $this->load->view('inc/pie');
    }

    public function agregar()
    {
        $this->load->view('inc/head');
        $this->load->view('inc/menu');
        $this->load->view('formulario_producto');
        $this->load->view('inc/footer');
        $this->load->view('inc/pie');
    }

    public function agregarbd()
    {
        $data['propietario'] = $_POST['propietario'];
        $data['nombre_producto'] = $_POST['nombre_producto'];
        $data['descripcion'] = $_POST['descripcion'];
        $data['precio_unitario'] = $_POST['precio_unitario'];
        $data['categoria'] = $_POST['categoria'];
        $data['habilitado'] = $_POST['habilitado'];
        $data['imagen'] = $_POST['imagen'];

        $this->producto_model->agregarProducto($data);
        redirect('producto/lista', 'refresh');
    }

    public function eliminarbd()
    {
        if (isset($_POST['idProducto'])) {
            $idProducto = $_POST['idProducto'];
            $this->producto_model->eliminarProducto($idProducto);
        }
        redirect('producto/lista', 'refresh');
    }

    public function modificar()
    {
        if (isset($_POST['idProducto'])) {
            $idProducto = $_POST['idProducto'];
            $data['producto'] = $this->producto_model->productoPorId($idProducto);

            $this->load->view('inc/head');
            $this->load->view('inc/menu');
            $this->load->view('formmodificar_producto', $data);
            $this->load->view('inc/footer');
            $this->load->view('inc/pie');
        } else {
            redirect('producto/lista', 'refresh');
        }
    }

    public function modificarbd()
    {
        if (isset($_POST['idProducto'])) {
            $idProducto = $_POST['idProducto'];
            $data['propietario'] = $_POST['propietario'];
            $data['nombre_producto'] = $_POST['nombre_producto'];
            $data['descripcion'] = $_POST['descripcion'];
            $data['precio_unitario'] = $_POST['precio_unitario'];
            $data['categoria'] = $_POST['categoria'];
            $data['habilitado'] = $_POST['habilitado'];
            $data['imagen'] = $_POST['imagen'];

            $this->producto_model->modificarProducto($idProducto, $data);
        }
        redirect('producto/lista', 'refresh');
    }

    public function deshabilitarbd()
    {
        if (isset($_POST['idProducto'])) {
            $idProducto = $_POST['idProducto'];
            $this->producto_model->deshabilitarProducto($idProducto);
        }
        redirect('producto/lista', 'refresh');
    }

    public function habilitarbd()
    {
        if (isset($_POST['idProducto'])) {
            $idProducto = $_POST['idProducto'];
            $this->producto_model->habilitarProducto($idProducto);
        }
        redirect('producto/lista', 'refresh');
    }
}
