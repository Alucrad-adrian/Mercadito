<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedido_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function guardarPedido($pedidoData, $detalleData) {
        // Iniciar la transacción
        $this->db->trans_start();

        // Insertar el pedido
        $this->db->insert('pedido', $pedidoData);
        // Obtener el ID del pedido recién insertado
        $pedidoId = $this->db->insert_id();

        // Insertar los detalles asociados al pedido
        foreach ($detalleData as &$detalle) {
            if (!isset($detalle['producto_idproducto']) || empty($detalle['producto_idproducto'])) {
                // Si producto_idproducto está vacío o no existe, omitir este detalle
                continue;
            }

            $detalle['idpedido'] = $pedidoId;  // Asegúrate de que 'idpedido' es el nombre correcto de la columna
            $this->db->insert('detalle', $detalle);

            // Verificar si la inserción falló
            if ($this->db->affected_rows() == 0) {
                // Si no se pudo insertar el detalle, revertir la transacción y retornar FALSE
                $this->db->trans_rollback();
                return FALSE;
            }
        }

        // Completar la transacción
        $this->db->trans_complete();

        // Verificar si la transacción se completó con éxito
        if ($this->db->trans_status() === FALSE) {
            // Ocurrió un error, lanzar excepción o manejar el error
            return FALSE;
        } else {
            // La transacción fue exitosa
            return TRUE;
        }
    }
}
