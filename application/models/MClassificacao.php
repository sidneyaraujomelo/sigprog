<?php
Class MClassificacao extends CI_Model
{
	public function getAllFrom($id)
	{
		$this->db->select('*');
		$this->db->from('tb_classificacao');
		$this->db->where('fk_tipoclassificacao', $id);
		$query = $this->db->get();

		return $query->result_array();
	}
}