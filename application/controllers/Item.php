<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {
	function __construct()
	{
   		parent::__construct();
		if(!isset($_SESSION)) 
	    { 
	        session_start();  //we need to call PHP's session object to access it through CI
	    } 
		$this->load->model('meixo','',TRUE);
		$this->load->model('msubeixo','', TRUE);
		$this->load->model('mitem','', TRUE);
		$this->load->model('mregra','', TRUE);
	}

	function show($id)
	{
		if ($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$siape = $session_data['id'];

			//$eixoData = $this->meixo->get($id);
			$subeixoData = $this->msubeixo->get($id);
			$itensData = $this->mitem->getFromParent($id);

			$itensMenu = array();
			for ($i=0; $i < count($itensData) ; $i++) { 
				$itensMenu[$i] = array("url" => "item/".$itensData[$i]["id_item"], "nome"=>$itensData[$i]["nome_item"]);
			}
			$itensMenu[count($itensMenu)] = array( "url" => "eixo", "nome" => "Voltar");

			//var_dump($itensMenu);

			//$data['eixo'] = $eixoData;
			$data['subeixo'] = $subeixoData;
			$data['itens'] = $itensData;
			$data['itensMenu'] = $itensMenu;
			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/itens.php', $data);
		}
		else
		{
			redirect('login', 'refresh');
		}
	}

	public function add()
	{
		$itemJson = $_POST["jsonArray"];
		$itemArray = json_decode($itemJson, true);
		$novoItem = JSONtoPHPArray($itemArray);

		if ($novoItem['pontuacao_maxima']=='') $novoItem['pontuacao_maxima'] = NULL;
		if ($novoItem['quantidade_maxima']=='') $novoItem['quantidade_maxima'] = NULL;

		$result = $this->mitem->insert($novoItem);

		$novaRegra = array('id' => $result);

		$this->mregra->start($novaRegra);

		echo $result;
	}

	public function delete()
	{
		$id = $_POST["id"];

		$key = array(
			'id_item' => $id);

		$result = $this->mitem->delete($key);

		echo json_encode($result);
	}

	public function generateForm($id)
	{
		$prog = $this->mitem->get($id);
		$tabela = "item";
		$formid = $tabela."-".$id;
		$form='

<div class="col s12">
	<form id="'.$formid.'" class="editRegra'.$tabela.'">

<!--  INICIO DO INPUT FIELD NOME DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE SUBEIXO !-->
			<div class="input-field col s6">
	            <input class="autoupdate-input" name="nome_item" value="'.$prog['nome_item'].'" type="text" class="validate">
			</div>
<!--  INICIO DO FIM FIELD NOME DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE SUBEIXO !-->

<!--  INICIO DO INPUT FIELD PONTUAÇÃO DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE SUBEIXO !-->
			<div class="input-field col s2">
	            <input class="autoupdate-input" name="pontmax_item" value="'.$prog['pontmax_item'].'" type="number" class="validate">
			</div>
<!--  INICIO DO FIM FIELD PONTUAÇÃO DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE SUBEIXO !-->

<!--  INICIO DO INPUT FIELD PONTUAÇÃO DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE SUBEIXO !-->
			<div class="input-field col s2">
	            <input class="autoupdate-input" name="quantmax_item" value="'.$prog['quantmax_item'].'" type="number" class="validate">
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