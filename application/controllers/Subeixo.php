<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subeixo extends CI_Controller {
	function __construct()
	{
   		parent::__construct();
		if(!isset($_SESSION)) 
	    { 
	        session_start();  //we need to call PHP's session object to access it through CI
	    } 
		$this->load->model('meixo','',TRUE);
		$this->load->model('msubeixo','', TRUE);
	}

	function show($id)
	{
		if ($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$siape = $session_data['id'];

			$eixoData = $this->meixo->get($id);
			$subeixosData = $this->msubeixo->getFromParent($id);

			$itensMenu = array();
			for ($i=0; $i < count($subeixosData) ; $i++) { 
				$itensMenu[$i] = array("url" => "subeixo/".$subeixosData[$i]["id_subeixo"], "nome"=>$subeixosData[$i]["nome_subeixo"]);
			}
			$itensMenu[count($itensMenu)] = array( "url" => "eixo", "nome" => "Voltar");

			//var_dump($itensMenu);

			$data['eixo'] = $eixoData;
			$data['subeixos'] = $subeixosData;
			$data['itensMenu'] = $itensMenu;
			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/subeixos.php', $data);
		}
		else
		{
			redirect('login', 'refresh');
		}
	}

	public function add()
	{
		$eixoJson = $_POST["jsonArray"];
		$eixoArray = json_decode($eixoJson, true);
		$novoEixo = JSONtoPHPArray($eixoArray);

		$result = $this->msubeixo->insert($novoEixo);

		echo $result;
	}

	public function delete()
	{
		$id = $_POST["id"];

		$key = array(
			'id_subeixo' => $id);

		$result = $this->msubeixo->delete($key);

		echo json_encode($result);
	}

	public function generateForm($id)
	{
		$prog = $this->msubeixo->get($id);
		$tabela = "subeixo";
		$formid = $tabela."-".$id;
		$form='

<div class="col s12">
	<form id="'.$formid.'" class="editRegra'.$tabela.'">

<!--  INICIO DO INPUT FIELD NOME DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE SUBEIXO !-->
			<div class="input-field col s8">
	            <input class="autoupdate-input" name="nome_subeixo" value="'.$prog['nome_subeixo'].'" type="text" class="validate">
			</div>
<!--  INICIO DO FIM FIELD NOME DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE SUBEIXO !-->

<!--  INICIO DO INPUT FIELD PONTUAÇÃO DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE SUBEIXO !-->
			<div class="input-field col s2">
	            <input class="autoupdate-input" name="pontmax_subeixo" value="'.$prog['pontmax_subeixo'].'" type="number" class="validate">
			</div>
<!--  INICIO DO FIM FIELD PONTUAÇÃO DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE SUBEIXO !-->

	<div class="col s2">
		<button form="'.$formid.'" class="btn-floating btn-medium waves-effect waves-light delete-button" type="button">
			<i class="material-icons right">remove</i>
  		</button>				
	</div>

	</form>
</div>';

		echo $form;
	}
}