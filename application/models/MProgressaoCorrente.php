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
		$this->db->where($col,$val);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getComplete($siape)
	{
		$this->db->select('*');
		$this->db->from('view_progressao_corrente');
		$this->db->where('fk_professor', $siape);
		$this->db->order_by('data_fim','desc');
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getProducoes($id_prog_corrente)
	{
		$this->db->select('*');
		$this->db->from('tb_progressao_producao');
		$this->db->where('fk_prog_finalizada', $id_prog_corrente);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function deleteMostRecent($idprofessor)
	{
		$sql = "DELETE FROM tb_progressao_corrente WHERE fk_professor=".$idprofessor." ORDER BY id_prog_corrente DESC LIMIT 1";
		$this->db->query($sql);
	}

	public function updatefield($key, $col, $val)
	{
		$this->db->set($col, $val);
		$this->db->where('id_prog_corrente', $key);
		$this->db->update('tb_progressao_corrente');
	}

	/*SELECT A.id_prog_corrente, A.fk_progressao, A.fk_professor, A.data_inicio, A.data_fim, C.cod_nivel as cod_nivel_anterior, C.nome_nivel as nome_nivel_anterior, D.cod_nivel as cod_nivel_seguinte, D.nome_nivel as nome_nivel_seguinte
FROM tb_progressao_corrente as A 
	JOIN tb_progressao as B
		ON A.fk_progressao = B.id_progressao
	JOIN tb_nivel as C
		ON B.fk_nivel_anterior = C.id_nivel
	JOIN tb_nivel as D 
		ON B.fk_nivel_seguinte = D.id_nivel
where A.fk_professor = 12345678*/
}
?>