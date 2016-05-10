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

	public function getTipoClassificacao($id)
	{
		$this->db->select('fk_tipoclassificacao');
		$this->db->from('tb_classificacao');
		$this->db->where('id_classificacao', $id);
		$query = $this->db->get();

		return $query->row_array();
	}
}