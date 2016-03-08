<?php
Class MTitulo extends CI_Model
{
	public function getAll()
	{
		$this->db->select('*');
		$this->db->from('tb_titulo');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tb_titulo');
		$this->db->where('id_titulo', $id);
		$query = $this->db->get();

		return $query->row_array();
	}
}