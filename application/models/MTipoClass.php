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
}