<?php
Class MItem extends CI_Model
{
	public function getAll()
	{
		$this->db->select('*');
		$this->db->from('tb_item');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tb_item');
		$this->db->where('id_item', $id);
		$query = $this->db->get();

		return $query->row_array();
	}

	public function getFromParent($id)
	{
		$this->db->select('*');
		$this->db->from('tb_item');
		$this->db->where('fk_subeixo', $id);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function insert($data)
	{
		$item = array(
			'nome_item' => $data['nome'],
			'pontmax_item' => $data['pontuacao_maxima'],
			'quantmax_item' => $data['quantidade_maxima'],
			'fk_subeixo' => $data['idsubeixo'] );
		if ($this->db->insert('tb_item',$item))
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
		$this->db->update("tb_item");
	}

	public function delete($key)
	{
		if ($this->db->delete('tb_item', $key)) return true;
		else return false;
	}
}
?>