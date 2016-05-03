<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
	function __construct()
	{
   		parent::__construct();
		if(!isset($_SESSION)) 
	    { 
	        session_start();  //we need to call PHP's session object to access it through CI
	    } 
		$this->load->model('mprofessor','',TRUE);
		$this->load->model('mtitulo','', TRUE);
		$this->load->model('mnivel','', TRUE);
		$this->load->model('mprogressao','', TRUE);
		$this->load->model('mprogressaocorrente','', TRUE);
		$this->load->model('mproducao','', TRUE);
		$this->load->model('meixo','',TRUE);
		$this->load->model('msubeixo','',TRUE);
		$this->load->model('mitem','', TRUE);
		$this->load->model('mprogressaoproducao','', TRUE);
		$this->load->model('mregra','',TRUE);
		$this->load->model('mclassificacao','',TRUE);
		$this->load->model('mregraclassificacao','',TRUE);
		$this->load->model('mdepartamento','',TRUE);
		$this->load->model('munidadeacademica','',TRUE);
		$this->load->model('mregime','',TRUE);
		$this->load->library('pdf');
		$this->load->library('pdf_mc_table');
	}

	function index()
	{

		if ($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$siape = $session_data['id'];
			
			$professorData = $this->mprofessor->getRaw($siape);
			$tituloData = $this->mtitulo->getAll();
			$nivelData = $this->mnivel->get();
			$deptoData = $this->mdepartamento->getAll();
			$unidAcademicaData = $this->munidadeacademica->getAll();
			$regimeData = $this->mregime->getAll();
			$progressoesCorrentesData = $this->mprogressaocorrente->getBy('fk_professor', $siape);
			
			$incompleteData = false;

			if (isset($professorData['fk_titulo']) && $professorData['fk_titulo'] != 0)
			{
				foreach ($tituloData as $titulo) {
					if ($professorData['fk_titulo'] == $titulo['id_titulo'])	$professorData['titulo'] = $titulo;
				}
			}
			else
			{
				$incompleteData = true;
			}

			if (isset($professorData['fk_nivel']) && $professorData['fk_nivel'] != 0)
			{
				foreach ($nivelData as $nivel) {
					if ($professorData['fk_nivel'] == $nivel['id_nivel'])
					{
						$professorData['nivel'] = $nivel;
					}
				}
			}
			else
			{
				$incompleteData = true;
			}

			if (isset($professorData['fk_depto']) && $professorData['fk_depto'] != 0)
			{
				foreach ($deptoData as $depto) {
					if ($professorData['fk_depto'] == $depto['id_depto'])
					{
						$professorData['depto'] = $depto;
					}
				}
			}
			else
			{
				$incompleteData = true;
			}

			if (isset($professorData['fk_unid_academica']) && $professorData['fk_unid_academica'] != 0)
			{
				foreach ($unidAcademicaData as $unidAcad) {
					if ($professorData['fk_unid_academica'] == $unidAcad['id_unid_academica'])
					{
						$professorData['unidAcad'] = $unidAcad;
					}
				}
			}
			else
			{
				$incompleteData = true;
			}

			if (isset($professorData['fk_regime_trabalho']) && $professorData['fk_regime_trabalho'] != 0)
			{
				foreach ($regimeData as $regime) {
					if ($professorData['fk_regime_trabalho'] == $regime['id_regime'])
					{
						$professorData['regime'] = $regime;
					}
				}
			}
			else
			{
				$incompleteData = true;
			}

			$data['professor'] = $professorData;
			$data['admin'] = $session_data['admin'];
			$data['niveis'] = $nivelData;
			$data['titulos'] = $tituloData;
			$data['unidadesAcademicas'] = $unidAcademicaData;
			$data['departamentos'] = $deptoData;
			$data['regimes'] = $regimeData;
			$data['incomplete'] = $incompleteData;
			$this->load->view('template/header.php', $data);
			if ($incompleteData)
			{
				$this->load->view('usuario/update.php', $data);
			}
			else
			{
				$mult = 1;
				$progressaoAtual = $this->mprogressaocorrente->getComplete($siape)[0];
				$progressaoData = $this->mprogressao->get($progressaoAtual['fk_progressao']);
				if ($progressaoData['fk_nivel_seguinte']==17)	$mult = 3;
				$subeixosData = $this->msubeixo->getAll();
				$subeixos = array();
				foreach ($subeixosData as $subeixo) {
					$subeixos[$subeixo['id_subeixo']]=$subeixo;
					$subeixos[$subeixo['id_subeixo']]['pontmax_subeixo']*=$mult;
					$itensData = $this->mitem->getFromParent($subeixo['id_subeixo']);
					$itens = array();
					foreach ($itensData as $item) {
						$itens[$item['id_item']]=$item;
						$itens[$item['id_item']]['producoes'] = array();
					}
					$subeixos[$subeixo['id_subeixo']]['itens']=$itens;
				}

				$producoes = $this->mproducao->getFromInterval($siape, $progressaoAtual['data_inicio'], $progressaoAtual['data_fim']);
				foreach ($producoes as $prod) {
					$fksubeixo = $prod['id_subeixo'];
					$fkitem = $prod['id_item'];
					array_push($subeixos[$fksubeixo]['itens'][$fkitem]['producoes'], $prod);
				}	

				$totalPoints = 0;
				foreach ($subeixos as $key => $subeixo) {
					$subeixos[$key]['subeixoPoints'] = 0;
					$maxPointSubeixo = $subeixo['pontmax_subeixo'];
					foreach ($subeixos[$key]['itens'] as $key2 => $item) {
						$subeixos[$key]['itens'][$key2]['producoes']['itemPoints'] = 0;
						$maxQuant = $item['quantmax_item'];
						$maxPoint = $item['pontmax_item'];
						$i = 0;
						foreach ($subeixos[$key]['itens'][$key2]['producoes'] as $key3 => $prod) {
							if (isset($maxQuant))
							{
								if ($i < $maxQuant)
								{
									$subeixos[$key]['itens'][$key2]['producoes']['itemPoints'] += $prod['pontuacao_producao'];
									$i++;
								}
							}
							else
							{
								$subeixos[$key]['itens'][$key2]['producoes']['itemPoints'] += $prod['pontuacao_producao'];
							}
							if (isset($maxPoint))
							{
								if ($subeixos[$key]['itens'][$key2]['producoes']['itemPoints'] > $maxPoint)
								{
									$subeixos[$key]['itens'][$key2]['producoes']['itemPoints'] = $maxPoint;
								}
							}
						}
						$subeixos[$key]['subeixoPoints']+=$subeixos[$key]['itens'][$key2]['producoes']['itemPoints'];
						if ($subeixos[$key]['subeixoPoints'] > $maxPointSubeixo)
						{
							$subeixos[$key]['subeixoPoints'] = $maxPointSubeixo;
						}
					}
					$totalPoints+=$subeixos[$key]['subeixoPoints'];
				}			
				$subeixos['totalPoints']=$totalPoints;

				$data['progressaoAtual'] = $progressaoAtual;
				$data['dadosProgressao'] = $this->mprogressao->get($progressaoAtual['fk_progressao']);
				$data['subeixos'] = $subeixos;

				$data['producoes'] = $producoes;

				$this->load->view('usuario/view.php', $data);
			}
		}
		else
		{
			redirect('login', 'refresh');
		}
	}

	function profile()
	{
		if ($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$siape = $session_data['id'];
			
			$professorData = $this->mprofessor->getRaw($siape);
			$tituloData = $this->mtitulo->getAll();
			$nivelData = $this->mnivel->get();
			$deptoData = $this->mdepartamento->getAll();
			$unidAcademicaData = $this->munidadeacademica->getAll();
			$regimeData = $this->mregime->getAll();
			$progressoesCorrentesData = $this->mprogressaocorrente->getBy('fk_professor', $siape);

			
			$incompleteData = false;

			if (isset($professorData['fk_titulo']) && $professorData['fk_titulo'] != 0)
			{
				foreach ($tituloData as $titulo) {
					if ($professorData['fk_titulo'] == $titulo['id_titulo'])	$professorData['titulo'] = $titulo;
				}
			}
			else
			{
				$incompleteData = true;
			}

			if (isset($professorData['fk_nivel']) && $professorData['fk_nivel'] != 0)
			{
				foreach ($nivelData as $nivel) {
					if ($professorData['fk_nivel'] == $nivel['id_nivel'])
					{
						$professorData['nivel'] = $nivel;
					}
				}
			}
			else
			{
				$incompleteData = true;
			}

			if (isset($professorData['fk_depto']) && $professorData['fk_depto'] != 0)
			{
				foreach ($deptoData as $depto) {
					if ($professorData['fk_depto'] == $depto['id_depto'])
					{
						$professorData['depto'] = $depto;
					}
				}
			}
			else
			{
				$incompleteData = true;
			}

			if (isset($professorData['fk_unid_academica']) && $professorData['fk_unid_academica'] != 0)
			{
				foreach ($unidAcademicaData as $unidAcad) {
					if ($professorData['fk_unid_academica'] == $unidAcad['id_unid_academica'])
					{
						$professorData['unidAcad'] = $unidAcad;
					}
				}
			}
			else
			{
				$incompleteData = true;
			}

			if (isset($professorData['fk_regime_trabalho']) && $professorData['fk_regime_trabalho'] != 0)
			{
				foreach ($regimeData as $regime) {
					if ($professorData['fk_regime_trabalho'] == $regime['id_regime'])
					{
						$professorData['regime'] = $regime;
					}
				}
			}
			else
			{
				$incompleteData = true;
			}

			$data['professor'] = $professorData;
			$data['admin'] = $session_data['admin'];
			$data['niveis'] = $nivelData;
			$data['titulos'] = $tituloData;
			$data['incomplete'] = $incompleteData;
			$this->load->view('template/header.php', $data);
			$this->load->view('usuario/update.php', $data);
		}
		else
		{
			redirect('login', 'refresh');
		}
	}

	function progress()
	{
		if ($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$siape = $session_data['id'];
			
			$professorData = $this->mprofessor->getRaw($siape);
			$tituloData = $this->mtitulo->getAll();
			$nivelData = $this->mnivel->get();
			$deptoData = $this->mdepartamento->getAll();
			$unidAcademicaData = $this->munidadeacademica->getAll();
			$regimeData = $this->mregime->getAll();
			$progressoesData = $this->mprogressaocorrente->getComplete($siape);
			for ($i = 0; $i < count($progressoesData); $i++) {
				$progressoesData[$i]['producoes'] = array();
				if ($i != 0){
					$progProds = $this->mprogressaocorrente->getProducoes($progressoesData[$i]['id_prog_corrente']);
					//var_dump(count($progProds));
					for($j = 0; $j < count($progProds); $j++)
					{
						$progressoesData[$i]['producoes'][$j] = $this->mproducao->get($progProds[$j]['fk_producao']);
					}
				}
				else
				{
					$progProds = $this->mproducao->getFromInterval($siape, $progressoesData[$i]['data_inicio'], $progressoesData[$i]['data_fim']);
					$progressoesData[$i]['producoes'] = $progProds;
				}
			}

			$incompleteData = false;

			if (isset($professorData['fk_titulo']) && $professorData['fk_titulo'] != 0)
			{
				foreach ($tituloData as $titulo) {
					if ($professorData['fk_titulo'] == $titulo['id_titulo'])	$professorData['titulo'] = $titulo;
				}
			}
			else
			{
				$incompleteData = true;
			}

			if (isset($professorData['fk_nivel']) && $professorData['fk_nivel'] != 0)
			{
				foreach ($nivelData as $nivel) {
					if ($professorData['fk_nivel'] == $nivel['id_nivel'])
					{
						$professorData['nivel'] = $nivel;
					}
				}
			}
			else
			{
				$incompleteData = true;
			}

			if (isset($professorData['fk_depto']) && $professorData['fk_depto'] != 0)
			{
				foreach ($deptoData as $depto) {
					if ($professorData['fk_depto'] == $depto['id_depto'])
					{
						$professorData['depto'] = $depto;
					}
				}
			}
			else
			{
				$incompleteData = true;
			}

			if (isset($professorData['fk_unid_academica']) && $professorData['fk_unid_academica'] != 0)
			{
				foreach ($unidAcademicaData as $unidAcad) {
					if ($professorData['fk_unid_academica'] == $unidAcad['id_unid_academica'])
					{
						$professorData['unidAcad'] = $unidAcad;
					}
				}
			}
			else
			{
				$incompleteData = true;
			}

			if (isset($professorData['fk_regime_trabalho']) && $professorData['fk_regime_trabalho'] != 0)
			{
				foreach ($regimeData as $regime) {
					if ($professorData['fk_regime_trabalho'] == $regime['id_regime'])
					{
						$professorData['regime'] = $regime;
					}
				}
			}
			else
			{
				$incompleteData = true;
			}

			$data['professor'] = $professorData;
			$data['admin'] = $session_data['admin'];
			$data['niveis'] = $nivelData;
			$data['titulos'] = $tituloData;
			$data['minhasprogressoes'] = $progressoesData;
			$this->load->view('template/header.php', $data);
			if ($incompleteData)
			{
				$this->load->view('usuario/update.php', $data);
			}
			else
			{
				$this->load->view('usuario/progress.php', $data);
			}
		}
		else
		{
			redirect('login', 'refresh');
		}
	}

	function show()
	{

	}

	function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('home', 'refresh');
	}

	function startprogressao()
	{
		if ($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$siape = $session_data['id'];

			if ($siape == $_POST['siape'])
			{
				$titulo = $_POST['titulo'];
				$nivel = $_POST['nivel'];
				$date = $_POST['data'];
				$unidade = $_POST['unidade'];
				$depto = $_POST['depto'];
				$regime = $_POST['regime'];

				$this->mprofessor->updatefield($siape, 'fk_titulo', $titulo);
				$this->mprofessor->updatefield($siape, 'fk_nivel', $nivel);
				$this->mprofessor->updatefield($siape, 'fk_unid_academica', $unidade);
				$this->mprofessor->updatefield($siape, 'fk_depto', $depto);
				$this->mprofessor->updatefield($siape, 'fk_regime_trabalho', $regime);

				$data = array();
				$data['fk_professor'] = $siape;
				$data['data_inicio']=$date;

				//Agora, vou pegar os dados da progressao baseado no nível anterior do cara!
				$prog = $this->mprogressao->getBy('fk_nivel_anterior', $nivel);
				$data['fk_progressao'] = $prog['id_progressao'];

				$data['data_fim'] = date("Y-m-d", strtotime($date."+".($prog['duracao_intersticio']*6)." months"));

				$this->mprogressaocorrente->deleteMostRecent($siape);
				$prog_real = $this->mprogressaocorrente->insert($data);

				echo $prog_real;
			}
			else
			{
				echo 'Siape inválido!';
			}
		}
	}

	function finishprogressao()
	{
		if ($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$siape = $session_data['id'];
			
			$professorData = $this->mprofessor->get($siape);
			$tituloData = $this->mtitulo->getAll();
			$nivelData = $this->mnivel->get();

			$incompleteData = false;

			if ($professorData['fk_titulo'] != 0)
			{
				foreach ($tituloData as $titulo) {
					if ($professorData['fk_titulo'] == $titulo['id_titulo'])	$professorData['titulo'] = $titulo;
				}
			}
			else
			{
				$incompleteData = true;
			}

			if ($professorData['fk_nivel'] != 0)
			{
				foreach ($nivelData as $nivel) {
					if ($professorData['fk_nivel'] == $nivel['id_nivel'])
					{
						$professorData['nivel'] = $nivel;
					}
				}
			}
			else
			{
				$incompleteData = true;
			}

			$data['professor'] = $professorData;
			$data['admin'] = $session_data['admin'];
			$data['niveis'] = $nivelData;
			$data['titulos'] = $tituloData;
			$pendentDocument = false;
			//$this->load->view('template/header.php', $data);
			if ($incompleteData)
			{
				$this->load->view('usuario/update.php', $data);
			}
			else
			{
				$progressaoAtual = $this->mprogressaocorrente->getComplete($siape)[0];
				$subeixosData = $this->msubeixo->getAll();
				$subeixos = array();
				foreach ($subeixosData as $subeixo) {
					$subeixos[$subeixo['id_subeixo']]=$subeixo;
					$itensData = $this->mitem->getFromParent($subeixo['id_subeixo']);
					$itens = array();
					foreach ($itensData as $item) {
						$itens[$item['id_item']]=$item;
						$itens[$item['id_item']]['producoes'] = array();
					}
					$subeixos[$subeixo['id_subeixo']]['itens']=$itens;
				}

				$producoes = $this->mproducao->getFromInterval($siape, $progressaoAtual['data_inicio'], $progressaoAtual['data_fim']);
				
				foreach ($producoes as $prod) {
					if (!isset($prod['documento_producao']))
					{
				        /*if($prod['documento_producao'] == '' || $prod['documento_producao']==null)
                        {
                            
                        }*/
						//break;
                        $prod['documento_producao']='pendente';
					}
					$fksubeixo = $prod['id_subeixo'];
					$fkitem = $prod['id_item'];
					array_push($subeixos[$fksubeixo]['itens'][$fkitem]['producoes'], $prod);
				}	

				if (!$pendentDocument)
				{
					$totalPoints = 0;
					foreach ($subeixos as $key => $subeixo) {
						$subeixos[$key]['subeixoPoints'] = 0;
						$maxPointSubeixo = $subeixo['pontmax_subeixo'];
						foreach ($subeixos[$key]['itens'] as $key2 => $item) {
							$subeixos[$key]['itens'][$key2]['producoes']['itemPoints'] = 0;
							$maxQuant = $item['quantmax_item'];
							$maxPoint = $item['pontmax_item'];
							$i = 0;
							foreach ($subeixos[$key]['itens'][$key2]['producoes'] as $key3 => $prod) {
								if (isset($maxQuant))
								{
									if ($i < $maxQuant)
									{
										$subeixos[$key]['itens'][$key2]['producoes']['itemPoints'] += $prod['pontuacao_producao'];
										$i++;
									}
								}
								else
								{
									$subeixos[$key]['itens'][$key2]['producoes']['itemPoints'] += $prod['pontuacao_producao'];
								}
								if (isset($maxPoint))
								{
									if ($subeixos[$key]['itens'][$key2]['producoes']['itemPoints'] > $maxPoint)
									{
										$subeixos[$key]['itens'][$key2]['producoes']['itemPoints'] = $maxPoint;
									}
								}
							}
							$subeixos[$key]['subeixoPoints']+=$subeixos[$key]['itens'][$key2]['producoes']['itemPoints'];
							if ($subeixos[$key]['subeixoPoints'] > $maxPointSubeixo)
							{
								$subeixos[$key]['subeixoPoints'] = $maxPointSubeixo;
							}
						}
						$totalPoints+=$subeixos[$key]['subeixoPoints'];
					}
				
					$subeixos['totalPoints']=$totalPoints;
					$dadosProgressao = $this->mprogressao->get($progressaoAtual['fk_progressao']);
					if ($totalPoints >= $dadosProgressao['pontuacao'])
					{
						$nomeArquivo = $this->testPdf();
						//var_dump($nomeArquivo);
						$this->mprogressaocorrente->updatefield($progressaoAtual['id_prog_corrente'],'documento_prog_corrente',$nomeArquivo);
						$pathArquivo = docs_url().'\\'.$nomeArquivo;

						if(file_exists($pathArquivo)) {
					        $fileName = basename($pathArquivo);
					        $fileSize = filesize($pathArquivo);
                
					    }
					}
					redirect('usuario/progress', 'refresh');
				}
				else
				{
					redirect('producao/pendent','refresh');
				}
			}
		}
		else
		{
			redirect('login', 'refresh');
		}
	}

	function realizeprogressao()
	{
		if ($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$siape = $session_data['id'];
			
			$professorData = $this->mprofessor->get($siape);
			$tituloData = $this->mtitulo->getAll();
			$nivelData = $this->mnivel->get();

			$incompleteData = false;

			if ($professorData['fk_titulo'] != 0)
			{
				foreach ($tituloData as $titulo) {
					if ($professorData['fk_titulo'] == $titulo['id_titulo'])	$professorData['titulo'] = $titulo;
				}
			}
			else
			{
				$incompleteData = true;
			}

			if ($professorData['fk_nivel'] != 0)
			{
				foreach ($nivelData as $nivel) {
					if ($professorData['fk_nivel'] == $nivel['id_nivel'])
					{
						$professorData['nivel'] = $nivel;
					}
				}
			}
			else
			{
				$incompleteData = true;
			}

			$pendentDocument = false;

			//echo "Vamos progredir<br>";
			$progressaoAtual = $this->mprogressaocorrente->getComplete($siape)[0];
			$dadosProgressao = $this->mprogressao->get($progressaoAtual['fk_progressao']);
			$prazoFinal = $progressaoAtual['data_fim'];
			$prazoInicial = date("Y-m-d", strtotime($progressaoAtual['data_fim']."-6 months"));
			$agora = date("Y-m-d");

			$this->mprofessor->updatefield($siape, 'fk_nivel', $dadosProgressao['fk_nivel_seguinte']);

			$data = array();
			$data['fk_professor'] = $siape;

			if ($agora < $prazoInicial)
			{
				$data['data_inicio']=$prazoInicial;
			}
			else
			{
				$data['data_inicio']=$agora;
			}
			//Agora, vou pegar os dados da progressao baseado no nível anterior do cara!
			$prog = $this->mprogressao->getBy('fk_nivel_anterior', $dadosProgressao['fk_nivel_seguinte']);
			$data['fk_progressao'] = $prog['id_progressao'];

			$data['data_fim'] = date("Y-m-d", strtotime($data['data_inicio']."+".($prog['duracao_intersticio']*6)." months"));

			$prog_real = $this->mprogressaocorrente->insert($data);

			//echo $prog_real;
			$subeixosData = $this->msubeixo->getAll();
			$subeixos = array();
			foreach ($subeixosData as $subeixo) {
				$subeixos[$subeixo['id_subeixo']]=$subeixo;
				$itensData = $this->mitem->getFromParent($subeixo['id_subeixo']);
				$itens = array();
				foreach ($itensData as $item) {
					$itens[$item['id_item']]=$item;
					$itens[$item['id_item']]['producoes'] = array();
				}
				$subeixos[$subeixo['id_subeixo']]['itens']=$itens;
			}

			$producoes = $this->mproducao->getFromInterval($siape, $progressaoAtual['data_inicio'], $progressaoAtual['data_fim']);
			
			foreach ($producoes as $prod) {
				if (!isset($prod['documento_producao']) || $prod['documento_producao'] == '' || $prod['documento_producao']==null)
				{
					/*$pendentDocument = true;
					break;*/
				}
				$fksubeixo = $prod['id_subeixo'];
				$fkitem = $prod['id_item'];
				array_push($subeixos[$fksubeixo]['itens'][$fkitem]['producoes'], $prod);
			}	

			$dadosProgressao = $this->mprogressao->get($progressaoAtual['fk_progressao']);
			foreach ($subeixos as $subeixo) {
				if (!is_array($subeixo))	continue;
				foreach ($subeixo['itens'] as $item) {
					if (!is_array($item))	continue;
					foreach ($item['producoes'] as $producao) {
						if (!is_array($producao))	continue;
						$this->mprogressaoproducao->insert(array('fk_prog_finalizada' => $progressaoAtual['id_prog_corrente'] ,
																'fk_producao'=> $producao['id_producao'] ));
					}
				}
			}
			redirect('usuario', 'refresh');
		}
		else
		{
			redirect('login', 'refresh');
		}
		
	}

	function update()
	{
		$tabela = "tb_".$_POST["tabela"];
		$id = $_POST["id"];
		$col = $_POST["col"];
		$val = $_POST["val"];

		$this->mprofessor->updatefield($id, $col, $val);
	}

	function testPdf()
	{
		if ($this->session->userdata('logged_in'))
		{
			$pdfData = array();
			$session_data = $this->session->userdata('logged_in');
			$siape = $session_data['id'];
			
			$professorData = $this->mprofessor->get($siape);
			$tituloData = $this->mtitulo->getAll();
			$nivelData = $this->mnivel->get();
			$progressoesCorrentesData = $this->mprogressaocorrente->getBy('fk_professor', $siape);
			
			$incompleteData = false;

			

			if ($professorData['fk_titulo'] != 0)
			{
				foreach ($tituloData as $titulo) {
					if ($professorData['fk_titulo'] == $titulo['id_titulo'])	$professorData['titulo'] = $titulo;
				}
			}
			else
			{
				$incompleteData = true;
			}

			if ($professorData['fk_nivel'] != 0)
			{
				foreach ($nivelData as $nivel) {
					if ($professorData['fk_nivel'] == $nivel['id_nivel'])
					{
						$professorData['nivel'] = $nivel;
					}
				}
			}
			else
			{
				$incompleteData = true;
			}

			$pdfData['professor'] = $professorData;

			

			$mult = 1;
			$progressaoAtual = $this->mprogressaocorrente->getComplete($siape)[0];
			$progressaoData = $this->mprogressao->get($progressaoAtual['fk_progressao']);
			if ($progressaoData['fk_nivel_seguinte']==17)	$mult = 3;
			$eixosData = $this->meixo->getAll();
			$eixos = array();
			foreach ($eixosData as $eixo) {
				$id_eixo = $eixo['id_eixo'];
				$eixos[$id_eixo] = $eixo;
				$subeixosData = $this->msubeixo->getFromParent($id_eixo);
				$subeixos = array();
				foreach ($subeixosData as $subeixo) {
					$subeixos[$subeixo['id_subeixo']]=$subeixo;
					$subeixos[$subeixo['id_subeixo']]['pontmax_subeixo']*=$mult;
					$itensData = $this->mitem->getFromParent($subeixo['id_subeixo']);
					$itens = array();
					foreach ($itensData as $item) {
						$itens[$item['id_item']]=$item;
						$itens[$item['id_item']]['producoes'] = array();
						$itens[$item['id_item']]['regra'] = $this->mregra->get($item['id_item']);
						if ($itens[$item['id_item']]['regra']['fk_tipoclass'] != 1)
						{
							$itens[$item['id_item']]['regra']['classificacao'] = $this->mclassificacao->getAllFrom($itens[$item['id_item']]['regra']['fk_tipoclass']);
							foreach ($itens[$item['id_item']]['regra']['classificacao'] as $keyClass => $class) {
								$itens[$item['id_item']]['regra']['classificacao'][$keyClass]['regraclass'] = $this->mregraclassificacao->getValor($item['id_item'],$itens[$item['id_item']]['regra']['classificacao'][$keyClass]['id_classificacao']);
							}

						}
					}
					$subeixos[$subeixo['id_subeixo']]['itens']=$itens;
				}
				$eixos[$id_eixo]['subeixos'] = $subeixos;
			}

			$producoes = $this->mproducao->getFromInterval($siape, $progressaoAtual['data_inicio'], $progressaoAtual['data_fim']);
			foreach ($producoes as $prod) {
				$fkeixo = $prod['id_eixo'];
				$fksubeixo = $prod['id_subeixo'];
				$fkitem = $prod['id_item'];
				if (isset($eixos[$fkeixo]['subeixos'][$fksubeixo]['itens'][$fkitem]['producoes']))
				{
					array_push($eixos[$fkeixo]['subeixos'][$fksubeixo]['itens'][$fkitem]['producoes'], $prod);
				}
			}	

			$totalPoints = 0;
			foreach ($eixos as $keye => $eixo) {
				foreach ($eixos[$keye]['subeixos'] as $key => $subeixo) {
					$eixos[$keye]['subeixos'][$key]['subeixoPoints'] = 0;
					$maxPointSubeixo = $eixos[$keye]['subeixos'][$key]['pontmax_subeixo'];
					foreach ($eixos[$keye]['subeixos'][$key]['itens'] as $key2 => $item) {
						$eixos[$keye]['subeixos'][$key]['itens'][$key2]['producoes']['itemPoints'] = 0;
						$maxQuant = $item['quantmax_item'];
						$maxPoint = $item['pontmax_item'];
						$i = 0;
						foreach ($eixos[$keye]['subeixos'][$key]['itens'][$key2]['producoes'] as $key3 => $prod) {
							if (isset($maxQuant))
							{
								if ($i < $maxQuant)
								{
									$eixos[$keye]['subeixos'][$key]['itens'][$key2]['producoes']['itemPoints'] += $prod['pontuacao_producao'];
									$i++;
								}
							}
							else
							{
								$eixos[$keye]['subeixos'][$key]['itens'][$key2]['producoes']['itemPoints'] += $prod['pontuacao_producao'];
							}
							if (isset($maxPoint))
							{
								if ($eixos[$keye]['subeixos'][$key]['itens'][$key2]['producoes']['itemPoints'] > $maxPoint)
								{
									$eixos[$keye]['subeixos'][$key]['itens'][$key2]['producoes']['itemPoints'] = $maxPoint;
								}
							}
						}
						$eixos[$keye]['subeixos'][$key]['subeixoPoints']+=$eixos[$keye]['subeixos'][$key]['itens'][$key2]['producoes']['itemPoints'];
						if ($eixos[$keye]['subeixos'][$key]['subeixoPoints'] > $maxPointSubeixo)
						{
							$eixos[$keye]['subeixos'][$key]['subeixoPoints'] = $maxPointSubeixo;
						}
					}
					$totalPoints+=$eixos[$keye]['subeixos'][$key]['subeixoPoints'];
				}
			}
			$eixos['totalPoints']=$totalPoints;

			$pdfData['estruturaProducoes'] = $eixos;
			$data['progressaoAtual'] = $progressaoAtual;
			$data['dadosProgressao'] = $this->mprogressao->get($progressaoAtual['fk_progressao']);
			$data['subeixos'] = $subeixos;

			$data['producoes'] = $producoes;

			$pdfData['progressao'] = $progressaoAtual;
			//var_dump($pdfData['estruturaProducoes']);
			return $this->makePdf($pdfData);
			
		}
		else
		{
			redirect('login', 'refresh');
		}
	}

	function makePdf($data)
	{
		setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
		date_default_timezone_set('America/Sao_Paulo');

		$files = array();
		$this->pdf = new PDF_mc_table();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages();
		
		$isPromo = (substr($data['professor']['nivel']['nome_nivel'], -1) > substr($data['progressao']['nome_nivel_seguinte'], -1)) ?
   			'[ X ] Promoção [ ] Progressão' : '[  ] Promoção [ X ] Progressão';
        $isPromo2 = (substr($data['professor']['nivel']['nome_nivel'], -1) > substr($data['progressao']['nome_nivel_seguinte'], -1)) ?
   			'Promoção' : 'Progressão';

        $this->pdf->SetFill(false);
		//Primeira pagina
        //HEADER
        $this->pdf->SetHeader();
        
        //TITLE
        $this->pdf->SetTitleDoc(specialChars('ANEXO IV DA RESOLUÇÃO Nº 175-CONSAD, de 09 de novembro de 2015.'));
        $this->pdf->SetTitleDoc(specialChars('REQUERIMENTO'));
		$this->pdf->SetFont('Arial', '', 11);
		$this->pdf->Ln(28);
		$this->pdf->SetWidths(array(180));
		$this->pdf->BorderlessRow(array(specialChars("Ilustríssimo/a Senhor/a
Chefia imediata



".$data['professor']['nome'].", matrícula SIAPE nº ".$data['professor']['siape'].", requeiro a Vossa Senhoria, concessão de ".$isPromo2.", conforme Resolução 175-CONSAD, de 09 de novembro de 2015   que regulamenta os procedimentos do processo de avaliação de desempenho acadêmico da Carreira de Magistério Superior na Universidade Federal do Maranhão (UFMA), anexando ao presente Requerimento:")));
		$this->pdf->SetWidths(array(10,20,150));
		$this->pdf->BorderlessRow(array("","I.",specialChars("Declaração do tempo de serviço expedida pelo SIstema Integrado de Gestão de Recursos Humanos (SIGRH);")));
		$this->pdf->BorderlessRow(array("","II.",specialChars("Declaração de última progressão funcional expedida pelo SIGRH, quando houver;")));
		$this->pdf->BorderlessRow(array("","III.",specialChars("Relatório Individual de Trabalho Docente no interstício, com a documentação comprobatória anexada;")));
		$this->pdf->BorderlessRow(array("","IV.",specialChars("Relatório de Avaliação De Desempenho Didático gerado pelo SIGAA;")));
		$this->pdf->BorderlessRow(array("","V.",specialChars("Memorial, quando for o caso;")));
		$this->pdf->BorderlessRow(array("","VI.",specialChars("Tese Acadêmica, quando for o caso;")));
		$this->pdf->Ln();
		$this->pdf->Cell(0,7,specialChars("Termos em que,"),0,0,'R');
		$this->pdf->Ln();
		$this->pdf->Cell(0,7,specialChars("Solicito Deferimento,"),0,0,'R');
		$this->pdf->Ln(14);
		$this->pdf->Cell(0,7,specialChars("São Luís, ".strftime('%d de %B de %Y', strtotime(date('m/d/y')))),0,0,'R');
		$this->pdf->Ln(28);
		$this->pdf->Cell(0,7,specialChars('_____________________________________'),0,0,'C');
		$this->pdf->Ln();
		$this->pdf->Cell(0,7,specialChars('Assinatura do Docente'),0,0,'C');
		$this->pdf->Ln();

		$this->pdf->AddPage('L');
		$this->pdf->SetTitle("Relatorio Progressao");
    	$this->pdf->SetLeftMargin(15);
    	$this->pdf->SetRightMargin(15);
   		$this->pdf->SetFillColor(200,200,200);

   		//HEADER
   		$this->pdf->SetHeader();
   		$this->pdf->SetTitleDoc(specialChars('ANEXO V DA RESOLUÇÃO Nº 175-CONSAD, de 09 de novembro de 2015.'));
        $this->pdf->SetTitleDoc(specialChars('RELATÓRIO INDIVIDUAL DE TRABALHO DOCENTE'));
        $this->pdf->SetWidths(array(267));
        $this->pdf->SetAligns(array('C'));
        $this->pdf->BorderlessRow(array(specialChars('Para pontuação autodeclarada do docente (com menção da página do processo composto pelos documentos comprobatórios, com coluna de validação pela CAD ou CIT')));
        $this->pdf->Ln(7);
   		$this->pdf->SetFont('Arial', '', 11);   		

   		//demais campos
   		$initFormArray = array( 
   			array('campo' => 'Processo Nº' , 'valor' => ''),
            array('campo' => 'Nome do docente', 'valor' => $data['professor']['nome']),
            array('campo' => 'Subunidade Academica' , 'valor' => $data['professor']['nome_depto'] ),
   			array('campo' => 'Unidade Academica' , 'valor' => $data['professor']['nome_unid_academica'] ),
            array('campo' => 'Matrícula SIAPE', 'valor' => $data['professor']['siape']),
   			array('campo' => 'Classe e Nível atual' , 'valor' => $data['professor']['nivel']['nome_nivel'] ),
   			array('campo' => 'Classe e Nível requerido' , 'valor' => $data['progressao']['nome_nivel_seguinte']),
            array('campo' => 'Objetivo do processo' , 'valor' => $isPromo));
   		
   		foreach ($initFormArray as $linha) {
   			$this->pdf->SetFont('Arial', '', 11);
   			$this->pdf->Cell(60,7,specialChars($linha['campo']),1,0,'L');
   			$this->pdf->SetFont('Arial', 'B', 11);
   			$this->pdf->Cell(0,7,specialChars($linha['valor']),1,0,'L');
   			$this->pdf->Ln();
   		}

		//Hora de preencher!
		$totalPoints = 0;
		$numAnexos = 0;
        $possuiPendente = false;
        $itensPendentes = array();
   		foreach ($data['estruturaProducoes'] as $eixo) {
   			if (!is_array($eixo['subeixos']))	continue;
            $this->pdf->SetFont('Arial','B',11);
            $nomeEixo =  str_replace('.', ')',$eixo['nome_eixo']);
            $this->pdf->SetWidths(array(267));
            $this->pdf->SetAligns(array('L'));
            $this->pdf->BorderlessRow(array(specialChars($nomeEixo)));
            $this->pdf->Ln(7);
   			foreach ($eixo['subeixos'] as $subeixo) {
   				//SUBEIXO
	   			$this->pdf->SetWidths(array(147,40,40,40));
                $this->pdf->SetFont('Arial', 'B', 11);
                $this->pdf->SetAligns(array('C','C','C','C'));
                $this->pdf->SetFill(true);
   				$this->pdf->Row(array(specialChars($subeixo['nome_subeixo']), specialChars("Pontuação Autodeclarada"), specialChars("Documentação Anexada"), specialChars("Contagem da Comissão (CAD ou CIT)")));
                $this->pdf->SetFill(false);
                $this->pdf->SetFont('Arial', '', 11);
                $this->pdf->SetAligns(array('L','C','C','C'));
   				$totalSubeixoPoints = 0;
   				if (!is_array($subeixo['itens']))	continue;
   				foreach ($subeixo['itens'] as $item) {
   					$explodeNome = explode(' ', $item['nome_item'],2);
   					$categoria = $explodeNome[0];
   					$descricao = $explodeNome[1];

   					if ($item['regra']['fk_tipoclass'] == 1)
   					{
	   					$pontos = $item['regra']['formula_regra'];
	   					$pontos = str_replace('=', '', $pontos);
	   					$pontos = str_replace('(', '', $pontos);
	   					$pontos = str_replace(')', '', $pontos);
	   					$pontos = str_replace('valor_informado', '', $pontos);
	   					$pontos = str_replace('qualis_informado', '', $pontos);
	   					$pontos = str_replace('classif_informado', '', $pontos);
	   					if (isset($pontos[0]) && $pontos[0] == '*')
	   					{
	   						$pontos = explode('*', $pontos,2)[1];
	   					}else if (isset($pontos[0]) && $pontos[0] == '/'){
	   						$pontos = explode('/', $pontos,2)[1];
	   					}

	   					$pontuacao = 0;
	   					$quantidade = 0;
	   					if ($item['producoes']['itemPoints'] > 0)
	   					{
	   						$arquivos = '';

	   						$pontuacao = $item['producoes']['itemPoints'];
	   						$totalSubeixoPoints += $pontuacao;
		   					foreach ($item['producoes'] as $prod) {
								$quantidade+=$prod['quantidade_producao'];
								if (isset($prod['documento_producao'])){
                                    array_push($files, array('item'=>$item['nome_item'],
                                                             'path'=>uploads_path().'\\'.$prod['documento_producao'],
                                                             'alias'=>$prod['nome_producao']));
                                    $numAnexos++;
                                    $arquivos .= "Anexo ".$numAnexos."\n";
								}
                                else
                                {
                                    if (isset($prod['quantidade_producao']))
                                    {
                                        array_push($files, array('item'=>$item['nome_item'],
                                                             'path'=>'pendente',
                                                             'alias'=>$prod['nome_producao']));
                                        $possuiPendente = true;
                                        $numAnexos++;
                                        $arquivos .= "Anexo ".$numAnexos."\n";
                                    }
                                }
                                
		   					}

		   					$this->pdf->Row(array(specialChars($item['nome_item']),$pontuacao,$arquivos,''));
	   					}
	   					else
	   					{
	   						$this->pdf->Row(array(specialChars($item['nome_item']),'','',''));
	   					}
   					}
   					else
   					{
   						//Descrição do item somente
   						$this->pdf->SetWidths(array(267));
   						$this->pdf->Row(array(specialChars($item['nome_item'])));

   						//Pontuação para cada classificacação
   						foreach ($item['regra']['classificacao'] as $keyclass => $class) {
   							if ($class['regraclass']['valor'] <= 0)	continue;
   							$limit = '';
   							if (isset($class['regraclass']['pontuacao_maxima'])){
   								$limit = '	(limitado a '.$class['regraclass']['pontuacao_maxima'].' pontos)';
   							}
   							
   							//Agora preciso contar quantas produções existem com exatamente esta classificação
   							$quantidade = 0;
   							$pontuacao = 0;
   							$arquivos = '';
   							$regraId = $item['regra']['id_item'];
   							foreach ($item['producoes'] as $prod) {
   								if ($prod['id_item']==$regraId && $prod['id_classificacao']==$class['id_classificacao'])
   								{

   									$quantidade++;
   									if (isset($prod['documento_producao']))
   									{
   										array_push($files, array('item'=>$item['nome_item'].' '.$class['nome_classificacao'],
                                                             'path'=>uploads_path().'\\'.$prod['documento_producao'],
                                                             'alias'=>$prod['nome_producao']));
                                        $numAnexos++;
                                        $arquivos .= "Anexo ".$numAnexos."\n";
   									}
                                    else
                                    {
                                        array_push($files, array('item'=>$item['nome_item'].' '.$class['nome_classificacao'],
                                                                'path'=>'pendente',
                                                                'alias'=>$prod['nome_producao']));
                                        $numAnexos++;
                                        $possuiPendente = true;
                                        $arquivos .= "Anexo ".$numAnexos."\n";
                                    }
   								}
   							}

   							if ($quantidade == 0)
   							{
   								$this->pdf->SetWidths(array(147,40,40,40));
								$this->pdf->Row(array(specialChars($class['nome_classificacao'].$limit), '','',''));
								continue;
   							}

   							$pontuacao = $quantidade*$class['regraclass']['valor'];
   							if (isset($class['regraclass']['pontuacao_maxima']) && $pontuacao > $class['regraclass']['pontuacao_maxima'])
   							{
   								$pontuacao = $class['regraclass']['pontuacao_maxima'];
   							}

   							$totalSubeixoPoints += $pontuacao;
							$this->pdf->SetWidths(array(147,40,40,40));
							$this->pdf->Row(array(specialChars($class['nome_classificacao'].$limit), $pontuacao, $arquivos,''));
   						}
   						$this->pdf->SetWidths(array(147,40,40,40));	
   					}
   				}
   				if ($totalSubeixoPoints > $subeixo['pontmax_subeixo'])
   				{
   					$totalSubeixoPoints = $subeixo['pontmax_subeixo'];
   				}
   				$totalPoints += $totalSubeixoPoints;
                $codSubeixo = explode(' ',$subeixo['nome_subeixo'],2);
   				$this->pdf->SetWidths(array(147,40,40,40));
                $this->pdf->SetFill(true);
   				$this->pdf->Row(array(specialChars('PONTUAÇÃO TOTAL EIXO '.$codSubeixo[0]), $totalSubeixoPoints,'',''));
                $this->pdf->SetFill(false);
   				$this->pdf->Ln(7);
   			}
   			$this->pdf->Ln(7);
   		}
        $this->pdf->Row(array(specialChars('PONTUAÇÃO TOTAL '), $totalPoints,'',''));

   		$this->pdf->Ln(7);
		$this->pdf->SetFont('Arial', '', 12);
   		$this->pdf->SetWidths(array(267));
        $this->pdf->SetAligns('L');
        $this->pdf->BorderlessRow(array(specialChars('Data e Local : '.date('d/m/y').', São Luís')));
        $this->pdf->Ln(7);
        $this->pdf->SetAligns('C');
        $this->pdf->BorderlessRow(array(specialChars('____________________________________________')));
        $this->pdf->Ln(4);
        $this->pdf->BorderlessRow(array(specialChars('Assinatura do Docente')));
        $this->pdf->Ln(7);
        
        
        //Lista de Anexos
        if ($possuiPendente)
        {
            $this->pdf->AddPage();
            $this->pdf->SetHeader();
            $this->pdf->SetTitleDoc(specialChars('LISTA DE ANEXOS'));
            $this->pdf->SetFont('Arial', 'B', 12);
            $this->pdf->SetWidths(array(15,45,110,20));
            $this->pdf->SetAligns('L','L','L','L');
            $this->pdf->Row(array(specialChars("Num"),specialChars("Nome"),specialChars("Item"),specialChars("Status")));
            $this->pdf->SetFont('Arial', '', 12);
            $this->pdf->SetAligns('L','L','L','L');
            for ($i = 0; $i < count($files); $i++)
            {
                $status =  ($files[$i]['path']=="pendente") ? "pendente" : "anexado";
                $this->pdf->Row(array(($i+1),specialChars($files[$i]['alias']), specialChars($files[$i]['item']), specialChars($status)));
            }
        }
   		//var_dump(count($files));
   		for ($i = 0; $i < count($files); $i++)
   		{
            if ($files[$i]['path']=='pendente') continue;
   			$pagecount = $this->pdf->setSourceFile($files[$i]['path']);
   			//var_dump($files[$i]);
		    for($j=0; $j<$pagecount; $j++){
		        $this->pdf->AddPage();  
		        $tplidx = $this->pdf->importPage($j+1, '/MediaBox');
		        $this->pdf->useTemplate($tplidx, 10, 10, 200); 
		        $this->pdf->SetFont('Arial','',13);
		        $this->pdf->SetXY(160,10);
		        $this->pdf->Write(0, 'Anexo '.($i+1));
		    }
   		}
   		//var_dump($files);
   		//phpinfo();
	    ob_end_clean();
	    $nomeArquivo = docs_url().'\\'.$data['professor']['siape'].$data['progressao']['id_prog_corrente'].date('d-m-Y-h-i-s',time()).'.pdf';
	    $download = $data['professor']['siape'].$data['progressao']['id_prog_corrente'].date('d-m-Y-h-i-s',time()).'.pdf';
	    $this->pdf->Output('F',$nomeArquivo);
	    //$this->pdf->Output('D',$download);
	    return $download;
	}
}