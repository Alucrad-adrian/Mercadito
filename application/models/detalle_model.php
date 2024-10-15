<?php
class Detalle_model extends CI_Model {

    public function guardarDetalleTransaccion($datosDetalle) {
        // Insertar los datos en la tabla 'detalle_transaccion'
        return $this->db->insert('detalle', $datosDetalle);
    }
}
