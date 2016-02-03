<?php
	
	function asset_url()
	{
		return base_url().'assets';
	}

	function profile_foto_url()
	{
		return asset_url().'/img/profile';
	}

	function breakLine($num = null)
	{
		if (!isset($num)) $num = 1;
		for ($i=0; $i < $num; $i++) { 
			echo '<br/>';
		}
	}

	function JSONtoPHPArray($json)
	{
		$array = array();
		for ($i=0; $i < count($json); $i++) { 
			$array[$json[$i]['name']] = $json[$i]['value'];
		}
		return $array;
	}

	function mapFormToColumn($tabela, $coluna)
	{

	}
?>