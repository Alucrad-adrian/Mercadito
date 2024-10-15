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
}
    

   
