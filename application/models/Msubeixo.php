<?php
Class MSubeixo extends CI_Model
{
	public function getAll()
	{
		$this->db->select('*');
		$this->db->from('tb_subeixo');
		$this->db->order_by('nome_subeixo', 'asc');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tb_subeixo');
		$this->db->where('id_subeixo', $id);
		$query = $this->db->get();

		return $query->row_array();
	}

	public function getFromParent($id)
	{
		$this->db->select('*');
		$this->db->from('tb_subeixo');
		$this->db->where('fk_eixo', $id);
		$this->db->order_by('nome_subeixo', 'ASC');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getReducedFromParent($id)
	{
		$this->db->select('id_subeixo, nome_subeixo');
		$this->db->from('tb_subeixo');
		$this->db->where('fk_eixo', $id);
		$this->db->order_by('nome_subeixo', 'ASC');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function insert($data)
	{
		$eixo = array(
			'nome_subeixo' => $data['nome'],
			'pontmax_subeixo' => $data['pontuacao_maxima'],
			'fk_eixo' => $data['ideixo'] );
		if ($this->db->insert('tb_subeixo',$eixo))
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
		$this->db->where("id_subeixo", $key);
		$this->db->update("tb_subeixo");
	}

	public function delete($key)
	{
		if ($this->db->delete('tb_subeixo', $key)) return true;
		else return false;
	}
}
?>