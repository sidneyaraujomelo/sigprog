<?php
Class MProgressaoProducao extends CI_Model
{
	public function insert($data)
	{
		if ($this->db->insert('tb_progressao_producao',$data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}
}