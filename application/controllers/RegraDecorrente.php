<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegraDecorrente extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if(!isset($_SESSION)) 
	    { 
	        session_start();  //we need to call PHP's session object to access it through CI
	    } 

		$this->load->model('mregradecorrente', '', TRUE);
	}

	public function add()
	{
		$itemJson = $_POST["jsonArray"];
		$itemArray = json_decode($itemJson, true);
		$novoItem = JSONtoPHPArray($itemArray);

		$result = $this->mregradecorrente->insert($novoItem);
		echo $result;
	}

	function delete()
	{
		$id = $_POST["id"];

		$key = array(
			'id_decorrencia' => $id);

		$result = $this->mregradecorrente->deleteDecorrencia($key);

		echo json_encode($result);
	}

	public function generateForm($id)
	{
		$prog = $this->mregradecorrente->getDecorrente($id);
		$tabela = "regradecorrente";
		$formid = $tabela."-".$id;
		$form='
<div class="col s12">
	<form id="'.$formid.'">
		<div class="col s11">
			<p>'.$prog['nome_item'].'</p>
		</div>
		<div class="col s1">
			<button class="btn-floating btn-medium waves-effect waves-light delete-button" type="submit">
				<i class="material-icons right">remove</i>
	  		</button>				
		</div>
	</form>
</div>';

		echo $form;
	}
}
?>
