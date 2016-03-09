<?php
Class MProgressaoCorrente extends CI_Model
{
	public function insert($data)
	{
		if ($this->db->insert('tb_progressao_corrente',$data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}

	public function getBy($col, $val)
	{
		$this->db->select('*');
		$this->db->from('tb_progressao_corrente');
		$this->db->join()
		$this->db->where($col,$val);
		$query = $this->db->get();

		return $query->result_array();
	}
}
?>