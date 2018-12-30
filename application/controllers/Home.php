<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		
		/*
			load helpers
		*/
		$this->load->helper(array('getmenu'));
		
		/*
			set error delimitars
		*/
		$this->form_validation->set_error_delimiters('','');
	}

	/*
		index method
	*/
	public function index()
	{
		if($this->session->userdata('is_logged'))
		{
			$data = $this->getDashboardTemplate();
			$this->load->view('home', $data);
		}
		else
		{
			redirect('auth/login');
		}
	}

	/**
		Home Aditional functions
	**/

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
}