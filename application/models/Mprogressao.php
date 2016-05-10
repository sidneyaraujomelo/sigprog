<?php
Class MProgressao extends CI_Model
{
	public function getAll()
	{
		$this->db->select('*');
		$this->db->from('tb_progressao');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tb_progressao');
		$this->db->where('id_progressao', $id);
		$query = $this->db->get();

		return $query->row_array();
	}

	public function getBy($column, $val)
	{
		$this->db->select('*');
		$this->db->from('tb_progressao');
		$this->db->where($column, $val);
		$query = $this->db->get();

		return $query->row_array();
	}

	public function insert($data)
	{
		$progressao = array(
			'fk_nivel_anterior' => $data['nivelinicial'] ,
			'fk_nivel_seguinte' => $data['nivelfinal'],
			'duracao_intersticio' => $data['intersticio'],
			'pontuacao' => $data['pontuacao'] );
		if ($this->db->insert('tb_progressao',$progressao))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}

	public function update($data, $key)
	{
		$this->db->where($key);
		if ($this->db->update('tb_progressao', $data)) return true;
		else 	return false;
	}

	public function updateAll($data)
	{
		if ($this->db->replace('tb_progressao', $data))	return true;
		else return false;
	}

	public function delete($key)
	{
		if ($this->db->delete('tb_progressao', $key)) return true;
		else return false;
	}

	public function updatefield($key, $col, $val)
	{
		$this->db->set($col, $val);
		$this->db->where("id_progressao", $key);
		$this->db->update('tb_progressao');
	}
}
?>