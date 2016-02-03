<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 function __construct()
	 {
	   parent::__construct();
	   $this->load->model('mprofessor','',TRUE);
	 }

	public function index()
	{
		if($this->session->userdata('logged_in')) 
	    { 
		 	 redirect('home', 'refresh');
	    }
	    else
	    {
			$this->load->helper(array('form'));

			$data['register_tab'] = 'inactive';
	   		$data['login_tab'] = 'active';
	      	$this->load->view('login/login.php', $data);
      	}
	}

	public function verifyLogin()
	{
		//This method will have the credentials validation
	   	$this->load->library('form_validation');
	   	$this->load->helper('security');
	   	$this->form_validation->set_rules('siapel', 'SiapeLogin','trim|required|xss_clean|max_length[8]');
	   	$this->form_validation->set_rules('senhal', 'PasswordLogin', 'trim|required|xss_clean|callback_check_login');

	   	if($this->form_validation->run() == FALSE)
	   	{  
	   		$data['register_tab'] = 'inactive';
	   		$data['login_tab'] = 'active';
	      	$this->load->view('login/login.php', $data);
	   	}
	   	else
	   	{  
	     	//Go to private area
	     	redirect('home', 'refresh');
	   	}
	}

	public function register()
	{
		//This method will have the credentials validation
	   	$this->load->library('form_validation');
	   	$this->load->helper('security');
	   	$this->form_validation->set_rules('siape', 'Siape', 
	   		'trim|required|xss_clean|max_length[8]|is_unique[tb_professor.siape]',
	   		array('is_unique' => 'Siape já cadastrado'));
	   	$this->form_validation->set_rules('nome', 'Nome', 'trim|required|xss_clean');//call_back_checar repetição
	   	$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|is_unique[tb_professor.email]',
	   		array('is_unique' => 'E-mail já cadastrado'));
	   	$this->form_validation->set_rules('senha', 'Password', 'trim|required|xss_clean|matches[confirmasenha]',
	   		array('matches' => 'Confirmação de senha inválida' ));
	   	$this->form_validation->set_rules('confirmasenha', 'CPassword', 'trim|required|xss_clean');

	   	if($this->form_validation->run() == FALSE)
	   	{  
	   		$data['register_tab'] = 'active';
	   		$data['login_tab'] = 'inactive';
	      	$this->load->view('login/login.php', $data);
	   	}
	   	else
	   	{  
	      	$this->insert_professor();
	     	redirect('login', 'refresh');
	   	}
	}

	function insert_professor()
	{
		$user = array(
			'siape'=>$this->input->post('siape'),
			'nome'=>$this->input->post('nome'),
			'email' => $this->input->post('email'), 
			'senha' => $this->input->post('senha')
		);
		$this->mprofessor->insert_professor($user);
	}

	function check_login($senhal)
	{
		$siape = $this->input->post('siapel');
		
		$result = $this->mprofessor->login($siape, $senhal);
		
		if ($result)
		{
			$admin = $this->mprofessor->check_admin($result['siape']);
			$sess_array = array('id' => $result['siape'], 'admin' => $admin);
			$this->session->set_userdata('logged_in', $sess_array);
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_login', 'Siape ou senha inválida');
     		return FALSE;
		}
	}
}