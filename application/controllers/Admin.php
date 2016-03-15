<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	function __construct()
	{
   		parent::__construct();
		if(!isset($_SESSION)) 
	    { 
	        session_start();  //we need to call PHP's session object to access it through CI
	    } 
		$this->load->model('mnivel','',TRUE);
		$this->load->model('mprogressao','',TRUE);
		$this->load->model('meixo','',TRUE);
		$this->load->model('msubeixo','',TRUE);
		$this->load->model('mitem','',TRUE);
		$this->load->model('mregra','',TRUE);
		$this->load->model('mregraclassificacao','',TRUE);
		$this->load->model('mproducao','', TRUE);
		$this->load->model('mproducaodecorrente','', TRUE);
	}

	function index()
	{
		if ($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$siape = $session_data['id'];

			$nivelData = $this->mnivel->get();
			$progressaoData = $this->mprogressao->getAll();

			$itensMenu = array(
				array( "url" => "eixo", "nome" => "Eixos" ),
				array( "url" => "progressao", "nome" => "Regras de Progressao" ),
				array( "url" => "metrica", "nome" => "Métricas"));

			$data['nivel'] = $nivelData;
			$data['progressoes'] = $progressaoData;
			$data['itensMenu'] = $itensMenu;
			$this->load->view('admin/header.php', $data);
			$this->load->view('admin/admin.php', $data);
		}
		else
		{
			redirect('login', 'refresh');
		}
	}

	function show()
	{

	}

	function update()
	{
		$tabela = "tb_".$_POST["tabela"];
		$id = $_POST["id"];
		$col = $_POST["col"];
		$val = $_POST["val"];

		if ($tabela == "tb_progressao")
		{
			$this->mprogressao->updatefield($id, $col, $val);
		}
		elseif ($tabela == "tb_eixo")
		{
			$this->meixo->updatefield($id, $col, $val);
		}
		elseif ($tabela == "tb_subeixo")
		{
			$this->msubeixo->updatefield($id, $col, $val);
		}
		elseif ($tabela == "tb_item")
		{
			if (($col == "pontmax_item" || $col == "quantmax_item") && $val <= 0)
			{
				$val = NULL;
			}
			$this->mitem->updatefield($id, $col, $val);
		}
		elseif ($tabela == "tb_regra")
		{
			$this->mregra->updatefield($id, $col, $val);
		}
		elseif ($tabela == "tb_producao") {
			$this->mproducao->updatefield($id, $col, $val);
		}
		elseif ($tabela == "tb_producaodecorrente"){
			$this->mproducaodecorrente->updatefield($id, $col, $val);
		}
	}
} ?>