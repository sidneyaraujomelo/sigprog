<?php
Class MRegraClassificacao extends CI_Model
{

public function setRegraToClasse($idregra, $idclasse, $valor)
	{
		$data = array(
			'fk_regra' => $idregra,
			'fk_classificacao' => $idclasse,
			'valor' => $valor
			);

		return($this->db->replace('tb_regra_classificacao',$data));
	}

}
?>