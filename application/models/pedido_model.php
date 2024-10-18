<?php
class Pedido_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function insertTransaccion($transaccionData) {
        // Inserta los datos en la tabla 'transacciones'
        $this->db->insert('transaccion', $transaccionData);

        // Devuelve el ID de la transacción recién insertada
        return $this->db->insert_id();
    }

    // Función para insertar el detalle de una transacción en la base de datos
    public function insertDetalleTransaccion($detalleTransaccionData) {
        // Inserta los datos en la tabla 'detalle_transacciones'
        return $this->db->insert('detalle_transaccion', $detalleTransaccionData);
    }   
    public function ObtenerPuestoId($puestoid) {
        $this->db->select('*');
        $this->db->from('puesto');
        $this->db->where('idpuesto', $puestoid);
        
        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }    
    public function obtener_pedidos_reservados()
    {
        // Join entre transaccion, detalle_transaccion y producto
        $this->db->select('transaccion.idTransaccion, producto.nombre_producto, detalle_transaccion.cantidad, transaccion.monto_total');
        $this->db->from('transaccion');
        $this->db->join('detalle_transaccion', 'detalle_transaccion.transaccion_id = transaccion.idTransaccion');
        $this->db->join('producto', 'producto.idProducto = detalle_transaccion.producto_id');
        $this->db->where('transaccion.estado', 'reservado');
        
        $query = $this->db->get();

        // Retorna los resultados si hay, de lo contrario un array vacío
        return $query->num_rows() > 0 ? $query->result() : [];
    } 
    public function obtener_ventas_realizadas()
{
    $this->db->select('transaccion.idTransaccion, producto.nombre_producto, producto.propietario, detalle_transaccion.cantidad, transaccion.monto_total');
    $this->db->from('transaccion');
    $this->db->join('detalle_transaccion', 'detalle_transaccion.transaccion_id = transaccion.idTransaccion');
    $this->db->join('producto', 'producto.idProducto = detalle_transaccion.producto_id');
    $this->db->where('transaccion.estado', 'vendido');
    
    $query = $this->db->get();

    // Retorna los resultados si hay, de lo contrario un array vacío
    return $query->num_rows() > 0 ? $query->result() : [];

}
    public function actualizar_transaccion($idTransaccion, $data)
    {
        $this->db->where('idTransaccion', $idTransaccion);
        $this->db->update('transaccion', $data);
    }

    public function eliminar_transaccion($idTransaccion)
    {
        // Eliminar registros de la tabla detalle_transaccion
        $this->db->where('transaccion_id', $idTransaccion);
        $this->db->delete('detalle_transaccion');

        // Eliminar registro de la tabla transaccion
        $this->db->where('idTransaccion', $idTransaccion);
        $this->db->delete('transaccion');
    }
}
    

   
