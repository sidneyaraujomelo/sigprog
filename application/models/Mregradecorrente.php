<?php
Class MRegraDecorrente extends CI_Model
{
	public function insert($data)
	{
		$regra = array(
			'fk_item_principal' => $data['item_principal'],
			'fk_item_decorrente' => $data['select_regras_decorrentes']);
		if ($this->db->insert('tb_regra_decorrente',$regra))
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
		SELECT id_decorrencia, id_item, nome_item
		FROM tb_regra_decorrente
		INNER JOIN tb_item
		ON id_item = fk_item_decorrente
		WHERE id_decorrencia=".$id;

		$query = $this->db->query($sql);

		return $query->row_array();
	}

	public function getDecorrentes($id)
	{
		$sql = "
		SELECT id_decorrencia, id_item, nome_item
		FROM tb_regra_decorrente
		INNER JOIN tb_item
		ON id_item = fk_item_decorrente
		WHERE fk_item_principal=".$id;

		$query = $this->db->query($sql);

		return $query->result_array();
	}

	public function deleteDecorrencia($key)
	{
		if ($this->db->delete('tb_regra_decorrente', $key)) return true;
		else return false;
	}
}
?>