<?php
Class MEixo extends CI_Model
{
	public function getAll()
	{
		$this->db->select('*');
		$this->db->from('tb_eixo');
		$this->db->order_by('nome_eixo', 'ASC');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getReducedAll()
	{
		$this->db->select('id_eixo, nome_eixo');
		$this->db->from('tb_eixo');
		$this->db->order_by('nome_eixo', 'ASC');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tb_eixo');
		$this->db->where('id_eixo', $id);
		$query = $this->db->get();

		return $query->row_array();
	}

	public function insert($data)
	{
		$eixo = array(
			'nome_eixo' => $data['nome'] );
		if ($this->db->insert('tb_eixo',$eixo))
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
		$this->db->where("id_eixo", $key);
		$this->db->update("tb_eixo");
	}

	public function delete($key)
	{
		if ($this->db->delete('tb_eixo', $key)) return true;
		else return false;
	}
}
?>