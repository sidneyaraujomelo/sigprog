<?php
Class MProducaoDecorrente extends CI_Model
{
	public function insert($data)
	{
		if ($this->db->insert('tb_producao_decorrente',$data))
		{
			return $this->db->insert_id();
		}
		else
		{
			return false;
		}
	}	

	public function get($id)
	{
		$this->db->select('*');
		$this->db->from('tb_producao_decorrente');
		$this->db->where('id_decorrencia', $id);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function getDecorrente($id)
	{
		$sql = "
		SELECT id_decorrencia, fk_producao_principal, id_producao, nome_producao, pontuacao_producao
		FROM tb_producao_decorrente
		INNER JOIN tb_producao
		ON id_producao = fk_producao_decorrente
		WHERE id_decorrencia=".$id;

		$query = $this->db->query($sql);

		return $query->row_array();
	}

	public function getDecorrentes($id)
	{
		$sql = "
		SELECT id_decorrencia, fk_producao_principal, id_producao, nome_producao, pontuacao_producao
		FROM tb_producao_decorrente
		INNER JOIN tb_producao
		ON id_producao = fk_producao_decorrente
		WHERE fk_producao_principal=".$id;

		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function getPrincipais($id_decorrente)
	{
		$this->db->select('*');
		$this->db->from('tb_producao_decorrente');
		$this->db->where('fk_producao_decorrente', $id_decorrente);
		$query = $this->db->get();

		return $query->result_array();
	}

	public function deleteDecorrencia($key)
	{
		if ($this->db->delete('tb_producao_decorrente', $key)) return true;
		else return false;
	}

  	public function updatefield($key, $col, $val)
	{
		$this->db->set($col, $val);
		$this->db->where('id_decorrencia', $key);
		$this->db->update('tb_producao_decorrente');
	}
}
?>