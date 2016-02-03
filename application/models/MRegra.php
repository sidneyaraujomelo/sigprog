<?php
Class MRegra extends CI_Model
{
	public function getAll()
	{
		$this->db->select('*');
		$this->db->from('tb_regra');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tb_regra');
		$this->db->where('id_regra', $id);
		$query = $this->db->get();

		return $query->row_array();
	}

	public function getRegraFromItem($id)
	{
		$this->db->select('*');
		$this->db->from('tb_regra');
		$this->db->where('id_item', $id);
		$query = $this->db->get();

		return $query->row_array();
	}

	public function getFromParent($id)
	{
		$this->db->select('*');
		$this->db->from('tb_regra');
		$this->db->where('fk_subeixo', $id);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function insert($data)
	{
		$regra = array(
			'nome_regra' => $data['nome'],
			'pontmax_regra' => $data['pontuacao_maxima'],
			'quantmax_regra' => $data['quantidade_maxima'],
			'fk_subeixo' => $data['idsubeixo'] );
		if ($this->db->insert('tb_regra',$regra))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}	

public function start($data)
	{
		$regra = array(
			'id_item' => $data['id']);
		if ($this->db->insert('tb_regra',$regra))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}	

	public function updatefield($key, $col, $val)
	{
		$this->db->set($col, $val);
		$this->db->where("id_item", $key);
		$this->db->update("tb_regra");
	}

	public function delete($key)
	{
		if ($this->db->delete('tb_regra', $key)) return true;
		else return false;
	}
}
?>