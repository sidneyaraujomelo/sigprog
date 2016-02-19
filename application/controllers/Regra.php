<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regra extends CI_Controller {
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
		$this->load->model('mmetrica','', TRUE);
		$this->load->model('mtipoclass','', TRUE);
		$this->load->model('mclassificacao', '', TRUE);
		$this->load->model('mregradecorrente', '', TRUE);
	}

	function show($ideixo, $idsubeixo, $id)
	{
		if ($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$siape = $session_data['id'];

			$eixoData = $this->meixo->get($ideixo);
			$subeixoData = $this->msubeixo->get($idsubeixo);
			$itemData = $this->mitem->get($id);
			$itensData = $this->mitem->getAll();
			$itensDecorrentesData = $this->mregradecorrente->getDecorrentes($id);

			$regrasData = $this->mregra->getRegraFromItem($id);
			$metricasData = $this->mmetrica->getAll();
			$tipoClassData = $this->mtipoclass->getAll();

			$itensMenu = array();
			/*for ($i=0; $i < count($itensData) ; $i++) { 
				$itensMenu[$i] = array("url" => "item/".$itensData[$i]["id_item"], "nome"=>$itensData[$i]["nome_item"]);
			}*/
			$pieces = explode('/',uri_string());
			$backUrl = $pieces[1];
			for ($i=2; $i < count($pieces)-1; $i++) { 
				$backUrl = implode('/', array($backUrl,$pieces[$i]));
			}
			//var_dump($backUrl);
			$itensMenu[count($itensMenu)] = array( "url" => $backUrl, "nome" => "Voltar");

			//var_dump($itensMenu);
			$itensPath = array();
			$itensPath[count($itensPath)] = array( "url" => "../../", "nome" => "Eixos");
			$itensPath[count($itensPath)] = array( "url" => "..", "nome" => $eixoData['nome_eixo']);
			$itensPath[count($itensPath)] = array( "url" => ".", "nome" => $subeixoData['nome_subeixo']);
			$itensPath[count($itensPath)] = array( "url" => NULL, "nome" => $itemData['nome_item']);

			$regraClassesData = array();
			foreach ($tipoClassData as $tipoclass) {
				$regraClassesData[$tipoclass['nome_tipoclass']] = $this->mregra->getAllFromClasses($id, $tipoclass['id_tipoclass']);
			}

			//var_dump($regraClassesData);

			//$data['eixo'] = $eixoData;
			//$data['subeixo'] = $subeixoData;
			$data['item'] = $itemData;
			$data['todosItens'] = $itensData;
			$data['itensDecorrentes'] = $itensDecorrentesData;
			$data['regra'] = $regrasData;
			$data['itensMenu'] = $itensMenu;
			$data['metricas'] = $metricasData;
			$data['tipoclasses'] = $tipoClassData;
			$data['regraclasses'] = $regraClassesData;
			$data['itensPath'] = $itensPath;
			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/regras.php', $data);
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

	public function generateProdForm()
	{
		$id = $_POST["id"];
		$regra = $this->mregra->get($id);

		$regra['fk_metrica'] = $this->mmetrica->get($regra['fk_metrica']);
		$regra['fk_tipoclass'] = $this->mtipoclass->get($regra['fk_tipoclass']);
		if ($regra['fk_tipoclass']['id_tipoclass']!=1)
		{
			$regra['classificacoes'] = $this->mclassificacao->getAllFrom($regra['fk_tipoclass']['id_tipoclass']);	
		}
		if ($regra['quantidade_decorrente']>0)
		{
			$regra['decorrentes'] = $this->mregradecorrente->getDecorrentes($id);
		}

		$form='';
		if ($regra['fk_metrica']['id_metrica'] != 3)
		{
			$form=$form.'
<div class="col s12 center"><h4 class="center-align">Quantidade</h4></div>
<div class="input-field col s12">
	<input form="addProducao" name="quantidade" type="number" required>
	<label for="quantidade">'.$regra['fk_metrica']['nome_metrica'].'</label>
</div>';
		}
		if ($regra['fk_tipoclass']['id_tipoclass'] != 1)
		{
			$form=$form.'
<div class="col s12 center"><h4 class="center-align">'.$regra['fk_tipoclass']['nome_tipoclass'].'</h4></div>
<select name="classificacao" form="addProducao" required>
	<option value="0" selected>Selecione uma classificação</option>';
			foreach ($regra['classificacoes'] as $classe) {
					$form=$form.'
	<option value="'.$classe['id_classificacao'].'">'.$classe['nome_classificacao'].'</option>';
						
			}
			$form=$form.'
</select>
<label for="eixo">Classificacao</label>';
		}
		if ($regra['quantidade_decorrente'] > 0)
		{
			$form=$form.'
<div class="col s12 center"><h4 class="center-align">Produções associaveis</h4></div>';
			for ($i = 0; $i < $regra['quantidade_decorrente']; $i++)
			{
				$form=$form.'
<select name="decorrente-'.$i.'" form="addProducao">
	<option value="0" selected>Selecione uma Produção</option>';
				foreach ($regra['decorrentes'] as $decorrente) {
					$form=$form.'
	<option value="'.$decorrente['id_item'].'">'.$decorrente['nome_item'].'</option>';
						
				}
				$form=$form.'
</select>
<label for="eixo">Producao Decorrente '.$i.'</label>';
			}
		}
		echo $form;
	}
}