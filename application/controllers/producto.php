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
         

    // Obtener los usuarios cuyo rol sea 'vendedor'
     $dueno['vendedores'] = $this->estudiante_model->obtener_usuarios_vendedores();

    // Obtener los puestos disponibles para esos vendedores
     $dueno['puestos'] = $this->puesto_model->obtener_todos_los_puestos();
        $this->load->view('inc/vistaproject/head');
        $this->load->view('inc/vistaproject/sibermenu');
        $this->load->view('formulario_producto',$dueno);
        $this->load->view('inc/vistaproject/footer');
    }
    public function agregarVendedor()
    {
         

    // Obtener los usuarios cuyo rol sea 'vendedor'
     $dueno['vendedores'] = $this->estudiante_model->obtener_usuarios_vendedores();

    // Obtener los puestos disponibles para esos vendedores
     $dueno['puestos'] = $this->puesto_model->obtener_todos_los_puestos();
        $this->load->view('inc/vistaproject/head');
        $this->load->view('inc/vistaproject/sibermenuVendedor');
        $this->load->view('formulario_producto_vendedor',$dueno);
        $this->load->view('inc/vistaproject/footer');
    }
    public function agregarbd()
{
    // Cargar la librería de subida de archivos
    $this->load->library('upload');
    $this->load->model('Notificacion_model'); // Modelo de notificaciones
    $this->load->model('Usuario_model'); // Modelo de usuarios para obtener clientes

    // Configuración de la subida de imagen
    $config['upload_path'] = './uploads/productos/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['file_name'] = uniqid(); // Nombre único para evitar colisiones

    // Verificar que la carpeta de uploads existe
    if (!is_dir($config['upload_path'])) {
        mkdir($config['upload_path'], 0755, TRUE);
    }

    // Inicializar la configuración de subida
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('imagen')) {
        // Si la subida falla, muestra el error
        $data['error'] = $this->upload->display_errors();
        $this->load->view('inc/vistaproject/head');
        $this->load->view('inc/vistaproject/sibermenu');
        $this->load->view('formulario_producto', $data);
        $this->load->view('inc/vistaproject/footer');
    } else {
        // Si la subida es exitosa, guardar el producto
        $file_data = $this->upload->data();
        $dataProducto = [
            'imagen' => $file_data['file_name'],
            'propietario' => $this->input->post('propietario'),
            'nombre_producto' => $this->input->post('nombre_producto'),
            'descripcion' => $this->input->post('descripcion'),
            'precio_unitario' => $this->input->post('precio_unitario'),
            'categoria' => $this->input->post('categoria'),
            'habilitado' => $this->input->post('habilitado'),
        ];

        // Iniciar la transacción
        $this->db->trans_start();

        // Guardar el producto en la tabla 'producto'
        $this->producto_model->agregarProducto($dataProducto);

        // Obtener el ID del producto recién creado
        $idProducto = $this->db->insert_id();

        // Obtener el nombre del puesto (desde el formulario)
        $nombre_puesto = $this->input->post('puesto'); 

        // Consulta el ID del puesto en la tabla 'puesto'
        $this->db->select('idpuesto');
        $this->db->where('nombre_puesto', $nombre_puesto);
        $puesto = $this->db->get('puesto')->row();

        if ($puesto) {
            // Si el puesto existe, obtenemos el ID
            $idPuesto = $puesto->idpuesto;

            // Guardar la relación en la tabla 'productos_puestos'
            $dataPuestoProducto = [
                'idPuesto' => $idPuesto,
                'idProducto' => $idProducto,
                'stock' => $this->input->post('habilitado') == 1 ? 5 : 0, // Asignar stock si está habilitado
            ];

            $this->db->insert('productos_puestos', $dataPuestoProducto);

            // Enviar notificación si el producto está habilitado
            if ($this->input->post('habilitado') == 1) {
                // Obtener todos los usuarios con rol de 'Cliente'
                $clientes = $this->Usuario_model->obtenerUsuariosPorRol('Cliente');

                foreach ($clientes as $cliente) {
                    // Crear el mensaje de notificación
                    $mensaje = "Nuevo producto " . $dataProducto['nombre_producto'] . " en la tienda " . $nombre_puesto;
                    
                    // Crear la notificación
                    $this->notificacion_model->crear_notificacion(
                        $cliente->idUsuario, 
                        $mensaje, 
                        $dataProducto['imagen'], 
                        $dataProducto['descripcion'], 
                        $dataProducto['propietario'], 
                        $dataProducto['precio_unitario']
                    );
                }
            }
        } else {
            // Si no se encuentra el puesto, revertir la transacción y mostrar un error
            $this->db->trans_rollback();
            $this->session->set_flashdata('error', 'El puesto no existe.');
            redirect('producto/agregar', 'refresh');
        }

        // Completar la transacción
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            // Si hubo un error en la transacción, revertir
            $this->db->trans_rollback();
            $this->session->set_flashdata('error', 'Hubo un error al guardar el producto.');
        } else {
            // Confirmar la transacción
            $this->db->trans_commit();
            $this->session->set_flashdata('success', 'Producto agregado exitosamente.');
        }

        // Redireccionar al administrador después de agregar el producto
        redirect('usuarios/ventanaAdmin', 'refresh');
    }
}


public function agregarbdVendedor()
{
    // Cargar las librerías y modelos necesarios
    $this->load->library('upload');
    $this->load->model('Notificacion_model');
    $this->load->model('Usuario_model');
    
    // Configuración de la subida de la imagen
    $config['upload_path'] = './uploads/productos/';
    $config['allowed_types'] = 'jpg|jpeg|png';
    $config['file_name'] = uniqid(); // Nombre único para evitar colisiones
    
    // Crear la carpeta si no existe
    if (!is_dir($config['upload_path'])) {
        mkdir($config['upload_path'], 0755, TRUE);
    }

    $this->upload->initialize($config);

    // Verificar si la imagen se subió correctamente
    if (!$this->upload->do_upload('imagen')) {
        $data['error'] = $this->upload->display_errors();
        $this->load->view('inc/vistaproject/head');
        $this->load->view('inc/vistaproject/sibermenuVendedor');
        $this->load->view('formulario_producto', $data);
        $this->load->view('inc/vistaproject/footer');
        return;
    }

    // Si la subida de imagen es exitosa
    $file_data = $this->upload->data();
    $dataProducto = [
        'imagen' => $file_data['file_name'],
        'propietario' => $this->input->post('propietario'),
        'nombre_producto' => $this->input->post('nombre_producto'),
        'descripcion' => $this->input->post('descripcion'),
        'precio_unitario' => $this->input->post('precio_unitario'),
        'categoria' => $this->input->post('categoria'),
        'habilitado' => $this->input->post('habilitado')
    ];

    // Iniciar la transacción
    $this->db->trans_start();

    // Guardar el producto en la tabla producto
    $this->producto_model->agregarProducto($dataProducto);

    // Obtener el ID del producto recién creado
    $idProducto = $this->db->insert_id();

    // Obtener el puesto seleccionado
    $nombre_puesto = $this->input->post('puesto');

    // Verificar si el puesto existe en la tabla 'puesto'
    $this->db->select('idpuesto');
    $this->db->where('nombre_puesto', $nombre_puesto);
    $puesto = $this->db->get('puesto')->row();

    if ($puesto) {
        // Si el puesto existe, obtener el ID del puesto
        $idPuesto = $puesto->idpuesto;

        // Guardar la relación entre el producto y el puesto en la tabla 'productos_puestos'
        $dataPuestoProducto = [
            'idPuesto' => $idPuesto,
            'idProducto' => $idProducto,
            'stock' => ($this->input->post('habilitado') == 1) ? 5 : 0
        ];
        $this->db->insert('productos_puestos', $dataPuestoProducto);

        // Enviar notificaciones si el producto está habilitado
        if ($this->input->post('habilitado') == 1) {
            $clientes = $this->Usuario_model->obtenerUsuariosPorRol('Cliente');
            foreach ($clientes as $cliente) {
                $mensaje = "Nuevo producto " . $dataProducto['nombre_producto'] . " en la tienda " . $nombre_puesto;
                $this->notificacion_model->crear_notificacion($cliente->idUsuario, $mensaje, $dataProducto['imagen'], $dataProducto['descripcion'], $dataProducto['propietario'], $dataProducto['precio_unitario']);
            }
        }
    } else {
        // Si el puesto no existe, revertir la transacción
        $this->db->trans_rollback();
        $this->session->set_flashdata('error', 'El puesto no existe.');
        redirect('producto/agregar', 'refresh');
        return;
    }

    // Completar la transacción
    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE) {
        // Si hay error en la transacción, hacer rollback
        $this->db->trans_rollback();
        $this->session->set_flashdata('error', 'Hubo un error al guardar el producto.');
    } else {
        // Confirmar la transacción
        $this->db->trans_commit();
        $this->session->set_flashdata('success', 'Producto agregado exitosamente.');
    }

    // Redirigir al administrador
    redirect('usuarios/ventanaVendedor', 'refresh');
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

            $this->load->view('inc/vistaproject/head');
            $this->load->view('inc/vistaproject/sibermenu');
            $this->load->view('formmodificar_producto', $data);
            $this->load->view('inc/vistaproject/footer');
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

    public function mostrar_productos() {
        // Cargar el modelo de productos
        $this->load->model('Producto_model');

        // Obtener todos los productos
        $data['productos'] = $this->Producto_model->get_all_productos();

        // Obtener todas las tiendas (propietarios) distintos
        $data['propietarios'] = $this->Producto_model->get_all_propietarios();

        // Obtener todas las categorías distintas
        $data['categorias'] = $this->Producto_model->get_all_categorias();

        // Cargar la vista y pasar los datos
        $this->load->view('nombre_de_la_vista', $data);
    }

}
