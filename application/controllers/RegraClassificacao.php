<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegraClassificacao extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if(!isset($_SESSION)) 
	    { 
	        session_start();  //we need to call PHP's session object to access it through CI
	    } 

		$this->load->model('mregraclassificacao', '', TRUE);
	}

	function updateRegraClasse()
	{
		$regra = $_POST['regra'];
		$classe = $_POST['classe'];
		$val = $_POST['val'];
		$col = $_POST['col'];

		if ($col=='pontuacao_maxima' && $val==0) $val=NULL;

		$this->mregraclassificacao->setRegraToClasse($regra, $classe, $col, $val);
	}
}
?>
