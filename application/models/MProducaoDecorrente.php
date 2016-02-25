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

	public function getDecorrente($id)
	{
		$sql = "
		SELECT id_decorrencia, id_producao, nome_producao
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
		SELECT id_decorrencia, id_producao, nome_producao
		FROM tb_producao_decorrente
		INNER JOIN tb_producao
		ON id_producao = fk_producao_decorrente
		WHERE fk_producao_principal=".$id;

		$query = $this->db->query($sql);

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