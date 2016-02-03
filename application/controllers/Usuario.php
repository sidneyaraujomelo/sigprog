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
	}

	function index()
	{
		if ($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$siape = $session_data['id'];
			
			$professorData = $this->mprofessor->get($siape);

			$data['professor'] = $professorData;
			$data['admin'] = $session_data['admin'];
			$this->load->view('template/header.php', $data);
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
}