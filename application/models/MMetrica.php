<?php
Class MMetrica extends CI_Model
{
	public function getAll()
	{
		$this->db->select('*');
		$this->db->from('tb_metrica');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tb_metrica');
		$this->db->where('id_metrica', $id);
		$query = $this->db->get();

		return $query->row_array();
	}
}