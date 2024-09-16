<?php

defined('BASEPATH') or exit('Ação não permitida');

class Core_model extends CI_Model
{
	public function get_all($table = null, $condicoes = null)
	{
		if($table && $this->db->table_exists($table)){
			if(is_array($condicoes)){
				$this->db->where($condicoes);
			}
			return $this->db->get($table)->result();
		}else{
			return false;
		}
	}

	public function get_by_id($table = null, $condicoes = null)
	{
		if($table && $this->db->table_exists($table) && is_array($condicoes)){
			$this->db->where($condicoes);
			$this->db->limit(1);
			return $this->db->get($table)->row();
		}else{
			return false;
		}
	}

	public function insert($table = null, $data = null, $get_last_id = null)
	{
		if($table && $this->db->table_exists($table) && is_array($data)){
			if($get_last_id){
				$this->session->set_userdata('last_id', $this->db->insert_id());
			}

			$this->db->insert($table, $data);

			if($this->db->affected_rows() > 0){
				$this->session->set_flashdata('sucesso', 'Dados salvos com sucesso');
			}else{
				$this->session->set_flashdata('erro', 'Erro ao salvar dados');
			}
		}else{
			return false;
		}
	}

	public function update($table = null, $data = null, $condicoes = null)
	{
		if($table && $this->db->table_exists($table) && is_array($data) && is_array($condicoes)){
			if($this->db->update($table, $data, $condicoes)){
				$this->session->set_flashdata('sucesso', 'Dados salvos com sucesso');
			}else{
				$this->session->set_flashdata('erro', 'Erro ao salvar dados');
			}
		}else{
			return false;
		}
	}

	public function delete($table = null, $condicoes = null)
	{
		if($table && $this->db->table_exists($table) && is_array($condicoes)){
			if($this->db->delete($table, $condicoes)){
				$this->session->set_flashdata('sucesso', 'Registro excluído com sucesso');
			}else{
				$this->session->set_flashdata('erro', 'Erro ao excluir registro');
			}
		}else{
			return false;
		}
	}
}
