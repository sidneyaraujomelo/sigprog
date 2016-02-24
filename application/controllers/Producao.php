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
		$this->load->model('mproducao','', TRUE);
	}

	public function index()
	{
		if ($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$siape = $session_data['id'];

			$professorData = $this->mprofessor->get($siape);
			$producaoData = $this->mproducao->get($siape);	
			$data['professor'] = $professorData;
			$data['admin'] = $session_data['admin'];
			$data['producoes'] = $producaoData;

			$this->load->view('template/header.php', $data);
			$this->load->view('producao/view.php', $data);
		}
	}

	function generateListForm($producao)
	{


		if (isset($producao['id_classificacao']))
		{
			$form=$form.'
<div class="input-field col s6">
	<input id="quantidade" name="quantidade" type="text" value="'.$producao['quantidade_producao'].'" class="autoupdate-input validate">
    <label for="quantidade">Quantidade</label>
</div>';			
		}
		return $form;
	}

	public function create()
	{
		if ($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$siape = $session_data['id'];

			$token = md5(session_id().time());
			$this->session->set_userdata('token', $token);
			
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
			$data['token'] = $token;

			$this->load->view('template/header.php', $data);
			$this->load->view('producao/create.php', $data);
		}
		else
		{
			redirect('login', 'refresh');
		}
	}

	public function addProducao()
	{
		if ($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$siape = $session_data['id'];

			$session_token = $this->session->userdata('token');
			$post_token = $_POST['token'];

			if (isset($session_token))
			{
				if (isset($post_token))
				{
					if ($session_token!=$post_token)
					{
						echo "Formulário já enviado!";
						return;
					}
					else
					{
						$token = md5(session_id().time());
						$this->session->set_userdata('token', $token);
						$infoProducao = array();

						$infoProducao['fk_professor'] = $siape;
						$infoProducao['nome_producao'] = $_POST['nome'];
						$infoProducao['data_producao'] = $_POST['data_producao_submit'];
						$eixo = $_POST['eixo'];
						$subeixo = $_POST['sub-de-'.$eixo];
						$infoProducao['fk_item'] = $_POST['item-de-'.$subeixo];

						if (isset($_POST['quantidade']))
						{
							$infoProducao['quantidade_producao'] = $_POST['quantidade'];
						}
						if (isset($_POST['classificacao']))
						{
							$infoProducao['fk_classificacao'] = $_POST['classificacao'];
						}
						if (isset($_FILES))
						{
							$config['upload_path']          = './uploads/';
			                $config['allowed_types']        = 'pdf';
			                $config['max_size']             = 100000;
			                chmod($config['upload_path'], 777);

			                $this->load->library('upload', $config);

			                if ( ! $this->upload->do_upload('fileToUpload'))
			                {
			                        $error = array('error' => $this->upload->display_errors());
			                        echo json_encode($error);
			                        return;
			                }
			                else
			                {
			                        $upload_data = $this->upload->data();
			                        $infoProducao['documento_producao'] = $upload_data['file_name'];
			                }
						}

						$idproducao = $this->mproducao->insert($infoProducao);

						$loop = true;
						$ndecorrente = 0;
						while ($loop)
						{
							if (isset($_POST['decorrente-'.$ndecorrente]))
							{
								$infoProducao['decorrente-'.$ndecorrente] = $_POST['decorrente-'.$ndecorrente];
								$ndecorrente++;
							}
							else
							{
								$loop = false;
							}
						}

						redirect('producao', 'refresh');
						//echo json_encode($_FILES)." ".$idproducao;
					}
				}
			}

			
		}
	}
}
