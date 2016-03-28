<?php
Class MRegraClassificacao extends CI_Model
{

	public function setRegraToClasse($idregra, $idclasse, $col, $valor)
	{
		$data = array($col => $valor);

		$this->db->where('fk_regra',  $idregra);
		$this->db->where('fk_classificacao', $idclasse);
		return($this->db->update('tb_regra_classificacao',$data));
	}

	public function getValor($fk_regra, $fk_classificacao)
	{
		$this->db->select('valor, pontuacao_maxima');
		$this->db->from('tb_regra_classificacao');
		$this->db->where('fk_regra', $fk_regra);
		$this->db->where('fk_classificacao', $fk_classificacao);

		$query = $this->db->get();
		return $query->row_array();
	}

}
?>