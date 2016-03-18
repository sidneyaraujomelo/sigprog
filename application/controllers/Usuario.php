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
		$this->load->library('pdf');
	}

	function index()
	{

		if ($this->session->userdata('logged_in'))
		{
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

			$data['professor'] = $professorData;
			$data['admin'] = $session_data['admin'];
			$data['niveis'] = $nivelData;
			$data['titulos'] = $tituloData;
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
			
			$professorData = $this->mprofessor->get($siape);
			$tituloData = $this->mtitulo->getAll();
			$nivelData = $this->mnivel->get();
			$progressoesCorrentesData = $this->mprogressaocorrente->getBy('fk_professor', $siape);

			
			$incompleteData = false;

			if (count($progressoesCorrentesData) <= 1)
			{
				$incompleteData=true;
				if ($progressoesCorrentesData == 1)
				{
					$professorData['ultimaProgressao'] = date("Y-m-d", $progressoesCorrentesData['data_inicio']);
				}
			}
			
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
			
			$professorData = $this->mprofessor->get($siape);
			$tituloData = $this->mtitulo->getAll();
			$nivelData = $this->mnivel->get();
			$progressoesData = $this->mprogressaocorrente->getComplete($siape);
			for ($i = 0; $i < count($progressoesData); $i++) {
				$progressoesData[$i]['producoes'] = array();
				$progProds = $this->mprogressaocorrente->getProducoes($progressoesData[$i]['id_prog_corrente']);
				for($j = 0; $j < count($progProds); $j++)
				{
					$progressoesData[$i]['producoes'][$j] = $this->mproducao->get($progProds[$j]['fk_producao']);
				}
			}

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

				$this->mprofessor->updatefield($siape, 'fk_titulo', $titulo);
				$this->mprofessor->updatefield($siape, 'fk_nivel', $nivel);

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
					if (!isset($prod['documento_producao']) || $prod['documento_producao'] == '' || $prod['documento_producao']==null)
					{
						$pendentDocument = true;
						break;
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
					if ($totalPoints > $dadosProgressao['pontuacao'])
					{
						echo "Vamos progredir<br>";
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

						echo $prog_real;

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
					}

					redirect('usuario', 'refresh');
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
					}
					$subeixos[$subeixo['id_subeixo']]['itens']=$itens;
				}
				$eixos[$id_eixo]['subeixos'] = $subeixos;
			}

			$pdfData['estruturaProducoes'] = $eixos;

			$producoes = $this->mproducao->getFromInterval($siape, $progressaoAtual['data_inicio'], $progressaoAtual['data_fim']);
			foreach ($producoes as $prod) {
				$fksubeixo = $prod['id_subeixo'];
				$fkitem = $prod['id_item'];
				array_push($subeixos[$fksubeixo]['itens'][$fkitem]['producoes'], $prod);
			}	


			$data['progressaoAtual'] = $progressaoAtual;
			$data['dadosProgressao'] = $this->mprogressao->get($progressaoAtual['fk_progressao']);
			$data['subeixos'] = $subeixos;

			$data['producoes'] = $producoes;

			$pdfData['progressao'] = $progressaoAtual;
			//var_dump($pdfData['estruturaProducoes']);
			$this->makePdf($pdfData);
			
		}
		else
		{
			redirect('login', 'refresh');
		}
	}

	function makePdf($data)
	{
		$this->pdf = new Pdf();
		$this->pdf->AddPage();
		$this->pdf->AliasNbPages();

		$this->pdf->SetTitle("Relatorio Progressao");
    	$this->pdf->SetLeftMargin(15);
    	$this->pdf->SetRightMargin(15);
   		$this->pdf->SetFillColor(200,200,200);
   		$this->pdf->SetFont('Arial', 'B', 9);
   		$this->pdf->Cell(0,7,'RELATORIO INDIVIDUAL DE TRABALHO DOCENTE',0,0,'C');
   		$this->pdf->Ln();

   		$initFormArray = array( 
   			array('campo' => 'Processo no.' , 'valor' => '' ),
   			array('campo' => 'Nome do docente' , 'valor' => $data['professor']['nome'] ),
   			array('campo' => 'Subunidade Academica' , 'valor' => '' ),
   			array('campo' => 'Unidade Academica' , 'valor' => '' ),
   			array('campo' => 'Matricula SIAPE' , 'valor' => $data['professor']['siape'] ),
   			array('campo' => 'Classe e Nivel Atual' , 'valor' => $data['professor']['nivel']['nome_nivel'] ),
   			array('campo' => 'Classe e Nivel Requerido' , 'valor' => $data['progressao']['nome_nivel_seguinte']));
   		
   		foreach ($initFormArray as $linha) {
   			$this->pdf->Cell(50,7,$linha['campo'],'TBLR',0,'L');
   			$this->pdf->Cell(0,7,$linha['valor'],'TBR',0,'L');
   			$this->pdf->Ln();
   		}
   		
   		$isPromo = (substr($data['professor']['nivel']['nome_nivel'], -1) > substr($data['progressao']['nome_nivel_seguinte'], -1)) ?
   			'[X] Promocao [] Progressao' : '[] Promocao [X] Progressao';

   		$this->pdf->Cell(50,7,'Objetivo do processo','TBLR',0,'L');
		$this->pdf->Cell(0,7,$isPromo,'TBR',0,'C');
   		$this->pdf->Ln(14);

   		foreach ($data['estruturaProducoes'] as $eixo) {
   			$this->pdf->Cell(15,7);
   			$this->pdf->Cell(0,7,specialChars($eixo['nome_eixo']),0,0,'L');
   			$this->pdf->Ln(7);
   		}

   		$this->pdf->Cell(15,7,'NUM','TBL',0,'C','1');
	    $this->pdf->Cell(25,7,'PATERNO','TB',0,'L','1');
	    $this->pdf->Cell(25,7,'MATERNO','TB',0,'L','1');
	    $this->pdf->Cell(25,7,'NOMBRE','TB',0,'L','1');
	    $this->pdf->Cell(40,7,'FECHA DE NACIMIENTO','TB',0,'C','1');
	    $this->pdf->Cell(25,7,'GRADO','TB',0,'L','1');
	    $this->pdf->Cell(25,7,'GRUPO','TBR',0,'C','1');
	    $this->pdf->Ln(7);
	    ob_end_clean();
	    $this->pdf->Output("Lista de alumnos.pdf", 'D', 'relatorio.pdf');
	}
}