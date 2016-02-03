<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Progressao extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if(!isset($_SESSION)) 
	    { 
	        session_start();  //we need to call PHP's session object to access it through CI
	    } 
		$this->load->model('mprogressao','',TRUE);
		$this->load->model('mnivel','',TRUE);
	}

	function index()
	{
		if ($this->session->userdata('logged_in') )
		{
			$session_data = $this->session->userdata('logged_in');
			$siape = $session_data['id'];

			$nivelData = $this->mnivel->get();
			$progressaoData = $this->mprogressao->getAll();

			$itensMenu = array(array( "url" => "", "nome" => "Voltar"));

			$data['nivel'] = $nivelData;
			$data['progressoes'] = $progressaoData;
			$data['itensMenu'] = $itensMenu;
			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/progressao.php', $data);
		}
		else
		{
			redirect('login', 'refresh');
		}
	}

	public function add()
	{
		$progressaoJson = $_POST["jsonArray"];
		$progressaoArray = json_decode($progressaoJson, true);
		$novaProgressao = JSONtoPHPArray($progressaoArray);

		$result = $this->mprogressao->insert($novaProgressao);

		echo $result;
	}

	public function update()
	{
		$progressaoJson = $_POST["jsonArray"];
		$progressaoArray = json_decode($progressaoJson, true);
		$novaProgressao = JSONtoPHPArray($progressaoArray);

		$novaProgressao['nivelinicial_o'] = $_POST["ni_o"];
		$novaProgressao['nivelfinal_o'] = $_POST["nf_o"];

		$result ='';
		
		if (($novaProgressao['nivelinicial_o']==$novaProgressao['nivelinicial']) 
			&& ($novaProgressao['nivelfinal_o']==$novaProgressao['nivelfinal']))
		{
			$data = array( 
				'fk_nivel_anterior' => $novaProgressao['nivelinicial'],
				'fk_nivel_seguinte' => $novaProgressao['nivelfinal'],
				'duracao_intersticio' => $novaProgressao['intersticio'],
				'pontuacao' => $novaProgressao['pontuacao'] );
			$result = $this->mprogressao->updateAll($data);
		}
		else
		{
			$data = array( 
				'fk_nivel_anterior' => $novaProgressao['nivelinicial'],
				'fk_nivel_seguinte' => $novaProgressao['nivelfinal'],
				'duracao_intersticio' => $novaProgressao['intersticio'],
				'pontuacao' => $novaProgressao['pontuacao'] );
			$key = array(
				'fk_nivel_anterior' => $novaProgressao['nivelinicial_o'],
				'fk_nivel_seguinte' => $novaProgressao['nivelfinal_o']);
			$result = $this->mprogressao->update($data, $key);
		}

		echo $result;
	}

	public function delete()
	{
		$id = $_POST["id"];

		$key = array(
			'id_progressao' => $id);

		$result = $this->mprogressao->delete($key);

		echo json_encode($result);
	}

	public function generateForm($id)
	{
		$prog = $this->mprogressao->get($id);
		$nivel = $this->mnivel->get();
		$tabela = "progressao";
		$formid = $tabela."-".$id;
		$form='

<div class="col s12">
	<form id="'.$formid.'" class="editRegra'.$tabela.'">

<!--  INICIO DO INPUT FIELD NIVEL INICIAL DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE PROGRESSÃO !-->
	<div class="input-field col s3">
		<select name="fk_nivel_anterior" class="autoupdate-input" form="'.$formid.'">';
 
		foreach ($nivel as $niv) {
			$aux = '';
			if ($niv['id_nivel']==$prog['fk_nivel_anterior'])	$aux = 'selected';
			$form=$form.'
			<option  value="'.$niv['id_nivel'].'" '.$aux.' >'.$niv['nome_nivel'].'</option>';

		}
		$form=$form.'
		</select>
	</div>
<!--  FIM DO INPUT FIELD NIVEL INICIAL DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE PROGRESSÃO !-->

<!--  INICIO DO INPUT FIELD NIVEL FINAL DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE PROGRESSÃO !-->
	<div class="input-field col s3">
		<select name="fk_nivel_seguinte" class="autoupdate-input" form="'.$formid.'">';

		foreach ($nivel as $niv) {
			$aux = '';
			if ($niv['id_nivel']==$prog['fk_nivel_seguinte'])	$aux = 'selected';
			$form = $form.'
			<option  value="'.$niv['id_nivel'].'" '.$aux.' >'.$niv['nome_nivel'].'</option>';

		}
		$form=$form.'
		</select>
	</div>
<!--  FIM DO INPUT FIELD NIVEL INICIAL DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE PROGRESSÃO !-->

<!--  INICIO DO INPUT FIELD INTERSTICIO DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE PROGRESSÃO !-->
	<div class="input-field col s2">
        <input class="autoupdate-input" name="duracao_intersticio" value="'.$prog['duracao_intersticio'].'" type="number" class="validate">
        <label for="intersticio">Interstício em Semestres</label>
	</div>
<!--  FIM DO INPUT FIELD INTERSTICIO DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE PROGRESSÃO !-->

<!--  INICIO DO INPUT FIELD PONTUAÇÃO DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE PROGRESSÃO !-->
	<div class="input-field col s2">
        <input class="autoupdate-input" name="pontuacao" value="'.$prog['pontuacao'].'" type="number" class="validate">
        <label for="pontuacao">Pontuação</label>
	</div>
<!--  FIM DO INPUT FIELD PONTUAÇÃO DA FORMULÁRIO DE EDIÇÃO/REMOÇÃO DE REGRAS DE PROGRESSÃO !-->

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
?>
