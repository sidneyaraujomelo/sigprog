<?php
Class MRegime extends CI_Model
{
	public function getAll()
	{
		$this->db->select('*');
		$this->db->from('tb_regime');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tb_regime');
		$this->db->where('id_regime', $id);
		$query = $this->db->get();

		return $query->row_array();
	}
}