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

}
?>