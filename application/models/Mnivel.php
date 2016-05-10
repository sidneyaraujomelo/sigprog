<?php
Class MNivel extends CI_Model
{
	public function get()
	{
		$this->db->select('*');
		$this->db->from('tb_nivel');
		$query = $this->db->get();

		return $query->result_array();
	}
}
?>