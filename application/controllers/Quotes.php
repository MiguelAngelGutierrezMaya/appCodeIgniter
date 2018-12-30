<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quotes extends CI_Controller {

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

	/*
		construct_method
	*/
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('getmenu','quotes/getcreaterules','quotes/getpasswordrules','html'));
		$this->load->model('User');
		$this->load->model('Quote'); //Cargar el modelo al controlador
		$this->load->model('Email');
		$this->form_validation->set_error_delimiters('','');
	}

	/**
		Quotes Views
	**/

	/*
		quotes index view if user logged in
	*/
	public function index($bg = null)
	{
		if($this->session->userdata('is_logged'))
		{
			$data = $this->getDashboardTemplate();
			$data['quotes'] = $this->Quote->index();
			$this->load->view('quotes/index',$data);
		}
		else
		{
			//show_404();
			redirect('auth/login');
		}
	}

	/*
		quotes create view if user logged in
	*/
	public function create()
	{
		if($this->session->userdata('is_logged'))
		{
			$data = $this->getDashboardTemplate();
			$data['quote_create'] = $this->load->view('partials/quotes/create','',true);
			$data['users_active'] = $this->User->find_users_active();
			$this->load->view('quotes/create',$data);
		}
		else
		{
			redirect('auth/login');
		}
	}

	/**
		Quotes Methods
	**/
	
	/*
		store validate method
	*/
	public function store()
	{
		$this->form_validation->set_rules(create_rules());
		$this->form_validation->set_rules(password_rules());

		if ($this->form_validation->run() == FALSE)
		{
			$errors = $this->dataCreateValidate();
			$errors['password'] = form_error('password');
			$errors['confirm_password'] = form_error('confirm_password');
		    echo json_encode($errors);
			$this->output->set_status_header(400);
		}
		else
		{
			$data = $this->dataCreateRequest();
			$data['password'] = $this->encrypt($this->input->post('password'),'7');

			$email = $this->User->get_email_user($data['id_user']);

			if($email !== false)
			{
				if($this->Quote->create($data))
				{
					if ($this->Email->sendBasicEmail('miguel.gutierrez@correounivalle.edu.co', 'Miguel Gutierrez', $email, 'Asignacion de Citas'))
					{
						$this->session->set_flashdata('msj', 'El registro ha sido guardado y se ha enviado un correo al usuario,alert-success');
						echo json_encode(array('url' => base_url('quotes/index')));
					}
					else
					{
						$this->session->set_flashdata('msj', 'El registro ha sido guardado pero no se pudo enviar el correo,alert-warning');
						echo json_encode(array('url' => base_url('quotes/index')));
					}
				}
				else
				{
					echo json_encode(array('msj' => 'La cita no pudo ser creada. por favor, intente nuevamente'));
					$this->output->set_status_header(401);
				}
			}
			else
			{
				echo json_encode(array('msj' => 'El usuario no se encuentra registrado, por favor seleccione un usuario de la lista'));
				$this->output->set_status_header(401);
			}
		}
	}

	/**
		Quotes Aditional functions
	**/

	/*
		private funtion validate register/create
	*/
	private function dataCreateValidate()
	{
		return array(
			'quote_date' => form_error('quote_date'),
			'type_quote' => form_error('type_quote'),
			'state_quote' => form_error('state_quote'),
			'description' => form_error('description'),
			'id_user' => form_error('id_user'),
		);
	}

	/*
		private funtion request create
	*/
	private function dataCreateRequest()
	{
		return array(
			'quote_date' => $this->input->post('quote_date'),
			'type_quote' => $this->input->post('type_quote'),
			'state_quote' => $this->input->post('state_quote'),
			'description' => $this->input->post('description'),
			'id_user' => $this->input->post('id_user'),
		);
	}

	/*
		private function Dashboard template
	*/
	private function getDashboardTemplate($msj = null)
	{
		return array(
			'meta' => $this->load->view('partials/meta','',true),
			'favicon' => $this->load->view('partials/favicon', '', true),
			'css' => $this->load->view('partials/css', '', true),
			'sidebar' => $this->load->view('partials/sidebar', array('menu' => menu()), true),
			'container_fluid_header' => $this->load->view('partials/container-fluid-header','', true),
			'header_top_area' => $this->load->view('partials/header-top-area','',true),
			'mobile_menu' => $this->load->view('partials/mobile-menu',array('menu' => menu()),true),
			'footer' => $this->load->view('partials/footer','',true),
			'script' => $this->load->view('partials/script','',true),
			'msj' => $msj,
		);
	}

	/*
		private function encrypt password
	*/
	function encrypt($string, $key) {
			$result = '';
			for($i=0; $i<strlen($string); $i++) {
	    	$char = substr($string, $i, 1);
	    	$keychar = substr($key, ($i % strlen($key))-1, 1);
	    	$char = chr(ord($char)+ord($keychar));
	    	$result.=$char;
		}
		return base64_encode($result);
	}

	/*
		private function decrypt password
	*/
	function decrypt($string,$key) {
   		$result = '';
   		$string = base64_decode($string);
		for($i=0; $i<strlen($string); $i++) {
	    	$char = substr($string, $i, 1);
	    	$keychar = substr($key, ($i % strlen($key))-1, 1);
	    	$char = chr(ord($char)-ord($keychar));
	    	$result.=$char;
		}
		return $result;
	}
}