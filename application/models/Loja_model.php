<?php
defined('BASEPATH') OR exit('Ação não permitida');

class Loja_model extends CI_Model
{
	public function get_grandes_marcas()
	{
		$this->db->select('marcas.*');
		$this->db->from('marcas');
		$this->db->join('produtos', 'produtos.produto_marca_id = marcas.marca_id', 'inner'); // Certifique-se de usar 'inner' ou outro tipo de join se necessário
		$this->db->where('marcas.marca_ativa', 1);
		$this->db->group_by('marcas.marca_id');

		return $this->db->get()->result();
	}
}
