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
				$this->load->view('usuario/view.php', $data);
			}
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
			$progressoesData = $this->mprogressaocorrente->getBy('fk_professor', $siape);

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

				$prog_real = $this->mprogressaocorrente->insert($data);

				echo $prog_real;
			}
			else
			{
				echo 'Siape inválido!';
			}
		}
	}
}