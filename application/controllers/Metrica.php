<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metrica extends CI_Controller {
	function __construct()
	{
   		parent::__construct();
		if(!isset($_SESSION)) 
	    { 
	        session_start();  //we need to call PHP's session object to access it through CI
	    } 
		$this->load->model('mmetrica','',TRUE);
	}

	function index()
	{
		if ($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$siape = $session_data['id'];

			$metricasData = $this->mmetrica->getAll();

			$itensMenu = array(array( "url" => "", "nome" => "Voltar"));
			//var_dump($itensMenu);

			$data['metricas'] = $metricasData;
			$data['itensMenu'] = $itensMenu;
			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/metricas.php', $data);
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

		$result = $this->meixo->insert($novoEixo);

		echo $result;
	}

	public function delete()
	{
		$id = $_POST["id"];

		$key = array(
			'id_eixo' => $id);

		$result = $this->meixo->delete($key);

		echo json_encode($result);
	}

	public function generateForm($id)
	{
		$prog = $this->meixo->get($id);
		$tabela = "eixo";
		$formid = $tabela."-".$id;
		$form='

<div class="col s12">
	<form id="'.$formid.'" class="editRegra'.$tabela.'">

<!--  INICIO DO INPUT FIELD NOME DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE EIXO !-->
			<div class="input-field col s10">
	            <input class="autoupdate-input" name="nome_eixo" value="'.$prog['nome_eixo'].'" type="text" class="validate">
			</div>
<!--  INICIO DO FIM FIELD NOME DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE EIXO !-->

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