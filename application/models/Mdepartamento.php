<?php
Class MDepartamento extends CI_Model
{
	public function getAll()
	{
		$this->db->select('*');
		$this->db->from('tb_departamento');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tb_departamento');
		$this->db->where('id_depto', $id);
		$query = $this->db->get();

		return $query->row_array();
	}
}