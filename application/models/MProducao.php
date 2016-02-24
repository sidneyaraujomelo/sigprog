<?php
Class MProducao extends CI_Model
{

	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('view_producao');
		$this->db->where('fk_professor', $id);

		$query = $this->db->get();

		return $query->result_array();
	}

  	public function insert($data)
  	{
    	if ($this->db->insert('tb_producao',$data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
  	}
}