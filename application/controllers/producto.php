<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {

    public function lista()
    {
        $lista = $this->producto_model->listaproductos();
        $data['productos'] = $lista;

        $this->load->view('inc/vistaproject/head');
        $this->load->view('inc/vistaproject/sibermenu');
        $this->load->view('lista_producto', $data);
        
        $this->load->view('inc/vistaproject/footer');
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
        // Carga la librería de subida de archivos
        $this->load->library('upload');
        
        // Configura los parámetros de subida de la imagen
        $config['upload_path'] = './uploads/productos/'; // Cambiado a la subcarpeta 'productos'
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['file_name'] = uniqid(); // Nombre único para evitar colisiones
    
        // Asegúrate de que la carpeta existe, si no, créala
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, TRUE);
        }
    
        $this->upload->initialize($config);
    
        if (!$this->upload->do_upload('imagen')) {
            // Si hay un error, muestra el mensaje de error
            $data['error'] = $this->upload->display_errors();
            $this->load->view('inc/head');
            $this->load->view('inc/menu');
            $this->load->view('formulario_producto', $data);
            $this->load->view('inc/footer');
        } else {
            // Si la subida es exitosa, guarda los datos en la base de datos
            $file_data = $this->upload->data();
            $data['imagen'] = $file_data['file_name'];
            $data['propietario'] = $this->input->post('propietario');
            $data['nombre_producto'] = $this->input->post('nombre_producto');
            $data['descripcion'] = $this->input->post('descripcion');
            $data['precio_unitario'] = $this->input->post('precio_unitario');
            $data['categoria'] = $this->input->post('categoria');
            $data['habilitado'] = $this->input->post('habilitado');
    
            $this->producto_model->agregarProducto($data);
            redirect('producto/lista', 'refresh');
        }
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

        // Carga la librería de subida de archivos
        $this->load->library('upload');
        
        // Configura los parámetros de subida de la imagen
        $config['upload_path'] = './uploads/productos/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['file_name'] = uniqid(); // Nombre único para evitar colisiones
        $this->upload->initialize($config);

        // Verifica si se ha seleccionado un archivo para subir
        if ($this->upload->do_upload('imagen')) {
            $file_data = $this->upload->data();
            $data['imagen'] = $file_data['file_name'];
        } else {
            // Si no se subió una nueva imagen, mantener la imagen existente
            $data['imagen'] = $_POST['imagen_actual']; // Suponiendo que 'imagen_actual' es el nombre del campo oculto en el formulario
        }

        // Actualiza el producto en la base de datos
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
