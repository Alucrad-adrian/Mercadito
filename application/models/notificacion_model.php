<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Notificacion_model extends CI_Model {

    public function crear_notificacion($usuario_id, $mensaje, $imagen_producto = null,$descripcion_producto = null, $propietario = null, $precio = null) {
        $data = [
            'usuario_id' => $usuario_id,
            'mensaje' => $mensaje,
            'imagen_producto' => $imagen_producto,
            'leido' => 0,  // No leída por defecto
            'fecha_creacion' => date('Y-m-d H:i:s'),
            'descripcion_producto' => $descripcion_producto,
            'propietario' => $propietario,
            'precio' => $precio
        
        ];
        
        $this->db->insert('notificaciones', $data);
    }

    

        // Obtener notificaciones no leídas de un usuario
    public function obtener_notificaciones_no_leidas($usuario_id) {
        $this->db->where('usuario_id', $usuario_id);
        $this->db->where('leido', 0);
        $query = $this->db->get('notificaciones');
        return $query->result();
      }
    
    

    public function marcar_como_leida($notificacion_id) {
        $this->db->set('leido', 1);
        $this->db->where('id', $notificacion_id);
        $this->db->update('notificaciones');
    }

    public function obtener_todas_las_notificaciones($usuario_id) {
        $this->db->where('usuario_id', $usuario_id);
        $this->db->order_by('fecha_creacion', 'DESC');
        $query = $this->db->get('notificaciones');
        return $query->result();
    }
    public function obtener_notificaciones_por_usuario($usuario_id) {
        // Consulta para obtener las notificaciones con los datos necesarios
        $this->db->select('n.id, n.mensaje, p.imagen_producto, p.descripcion_producto, u.nombre as propietario, n.fecha_creacion');
        $this->db->from('notificaciones n');
        $this->db->join('producto p', 'n.producto_id = p.idProducto');  // Suponiendo que cada notificación tiene un producto relacionado
        $this->db->join('usuario u', 'p.propietario = u.idUsuario');  // Suponiendo que el propietario es un usuario
        $this->db->where('n.usuario_id', $usuario_id);  // Filtrar por usuario
        $this->db->order_by('n.fecha_creacion', 'DESC');
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
    
}
