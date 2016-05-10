<?php
Class MUnidadeAcademica extends CI_Model
{
	public function getAll()
	{
		$this->db->select('*');
		$this->db->from('tb_unid_academica');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tb_unid_academica');
		$this->db->where('id_unid_academica', $id);
		$query = $this->db->get();

		return $query->row_array();
	}
}