<?php
Class MProducao extends CI_Model
{

	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('view_producao');
		$this->db->where('id_producao', $id);

		$query = $this->db->get();

		return $query->row_array();
	}

	public function getByProfessor($id)
	{
		$this->db->select('*');
		$this->db->from('view_producao');
		$this->db->where('fk_professor', $id);
		$this->db->order_by('data_producao','DESC');

		$query = $this->db->get();

		return $query->result_array();
	}

	public function getFromInterval($idprofessor, $iniciodata, $fimdata)
	{
		$this->db->select('*');
		$this->db->from('view_producao');
		$this->db->where('fk_professor', $idprofessor);
		$this->db->where('data_producao >', $iniciodata);
		$this->db->where('data_producao <', $fimdata);
		$this->db->order_by('pontuacao_producao','desc');
		$query = $this->db->get();

		return $query->result_array();
		
	}

	public function getAllByItem($idprofessor, $iditem)
	{
		$this->db->select('*');
		$this->db->from('view_producao');
		$this->db->where('fk_professor', $idprofessor);
		$this->db->where('id_item', $iditem);

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

  	public function updatefield($key, $col, $val)
	{
		$this->db->set($col, $val);
		$this->db->where('id_producao', $key);
		$this->db->update('tb_producao');
	}

	public function delete($id)
	{
		return $this->db->delete('tb_producao', array('id_producao' => $id ));
	}
}
?>