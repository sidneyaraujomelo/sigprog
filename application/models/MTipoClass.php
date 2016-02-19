<?php
Class MTipoClass extends CI_Model
{
	public function getAll()
	{
		$this->db->select('*');
		$this->db->from('tb_tipoclassificacao');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tb_tipoclassificacao');
		$this->db->where('id_tipoclass', $id);
		$query = $this->db->get();

		return $query->row_array();
	}
}