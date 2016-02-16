<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producao extends CI_Controller {
	
	function __construct()
	{
   		parent::__construct();
		if(!isset($_SESSION)) 
	    { 
	        session_start();  //we need to call PHP's session object to access it through CI
	    } 
		$this->load->model('mprofessor','',TRUE);
		$this->load->model('meixo','', TRUE);
		$this->load->model('msubeixo','', TRUE);
		$this->load->model('mitem','', TRUE);
		$this->load->model('mregra','', TRUE);
	}

	public function create()
	{
		if ($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$siape = $session_data['id'];
			
			$professorData = $this->mprofessor->get($siape);

			//recebo a informação de todos os eixos!
			$eixoData = $this->meixo->getReducedAll();

			//para cada eixo, pegarei a informação de cada subeixo!
			for ($i = 0; $i < count($eixoData); $i++)
			{
				$eixoData[$i]['subeixo'] = $this->msubeixo->getReducedFromParent($eixoData[$i]['id_eixo']);
				//para cada subeixo, pegarei informações de cada item
				for ($j = 0; $j < count($eixoData[$i]['subeixo']); $j++)
				{
					$eixoData[$i]['subeixo'][$j]['item'] = $this->mitem->getReducedFromParent($eixoData[$i]['subeixo'][$j]['id_subeixo']);
				}
			}

			//var_dump($eixoData);

			$data['professor'] = $professorData;
			$data['admin'] = $session_data['admin'];
			$data['infoproducao'] = $eixoData;

			$this->load->view('template/header.php', $data);
			$this->load->view('producao/create.php', $data);
		}
		else
		{
			redirect('login', 'refresh');
		}
	}
}
