<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
		
		$this->load->helper(array('getmenu','users/getcreaterules','users/getrequireuseremailrules','users/getexcelrules'));
		$this->load->model('User'); //Cargar el modelo al controlador
		$this->load->model('Email');
		$this->load->model('Excel');
		$this->load->model('File');
		$this->form_validation->set_error_delimiters('','');
	}

	/**
		Users Views
	**/

	/*
		users index view if logged in
	*/
	public function index()
	{
		if($this->session->userdata('is_logged'))
		{
			if($this->session->type == 5)
			{
				$data = $this->getDashboardTemplate();
				$data['user_create'] = $this->load->view('partials/users/create','',true);
				$data['users'] = $this->User->index();
				$this->load->view('users/index',$data);
			}
			else
			{
				redirect('home');
			}
		}
		else
		{
			//show_404();
			redirect('auth/login');
		}
	}

	/*
		users home view dashboard if logged in
	*/
	public function home()
	{
		if($this->session->userdata('is_logged'))
		{
			$data = $this->getDashboardTemplate();
			$data['files'] = $this->File->find_files($this->session->id);
			$this->load->view('home',$data);
		}
		else
		{
			//show_404();
			redirect('auth/login');
		}
	}

	/*
		users create view if logged in
	*/
	public function create()
	{
		if($this->session->userdata('is_logged'))
		{
			if($this->session->type == 5)
			{
				$data = $this->getDashboardTemplate();
				$data['user_create'] = $this->load->view('partials/users/create','',true);
				$this->load->view('users/create',$data);
			}
			else
			{
				redirect('home');
			}
		}
		else
		{
			//show_404();
			redirect('auth/login');
		}
	}

	/*
		users excel view if logged in
	*/
	public function excel()
	{
		if($this->session->userdata('is_logged'))
		{
			if($this->session->type == 5)
			{
				$data = $this->getDashboardTemplate();
				$this->load->view('users/excel',$data);
			}
			else
			{
				redirect('home');
			}
		}
		else
		{
			//show_404();
			redirect('auth/login');
		}
	}

	/**
		Users Methods
	**/

	/*
		find user method (ajax)
	*/
	public function find($id)
	{
		if(!$request = $this->User->find($id))
		{
			echo json_encode(array('msj' => 'A ocurrido un error al buscar el usuario con el id especificado'));
			$this->output->set_status_header(401);
		}
		else
		{
			echo json_encode($request);
		}
	}

	/*
		update method (ajax)
	*/
	public function edit()
	{
		$this->form_validation->set_rules(register_rules());
		$this->form_validation->set_rules(create_rules());
		$this->form_validation->set_rules(requireuseremail_rules());

		if ($this->form_validation->run() == FALSE)
		{
			$errors = $this->dataCreateValidate();
			$errors['state'] = form_error('state');
			$errors['type_user'] = form_error('type');

		    echo json_encode($errors);
			$this->output->set_status_header(400);
		}
		else
		{
			$data = $this->dataCreateRequest();
			$data['type'] = $this->input->post('type');
			$data['state'] = $this->input->post('state');

			$id_user = $this->input->post('id');
			$id_query_username = $this->User->get_id_user_by_username($data['username']);
			$id_query_email = $this->User->get_id_user_by_email($data['email']);

			if($id_user !== $id_query_username)
			{
				echo json_encode(array('msj' => 'El nombre de usuario se encuentra repetido'));
				$this->output->set_status_header(401);
			}
			else if($id_user !== $id_query_email)
			{
				echo json_encode(array('msj' => 'El email se encuentra repetido'));
				$this->output->set_status_header(401);
			}
			else
			{
				if($this->session->id !== $id_user)
				{
					if($this->User->update($this->input->post('id'),$data))
					{
						$this->session->set_flashdata('msj', 'El registro ha sido actualizado,alert-warning');
						echo json_encode(array('url' => base_url('users/index')));
					}
					else
					{
						echo json_encode(array('msj' => 'El usuario no pudo ser creado. por favor, intente nuevamente'));
						$this->output->set_status_header(401);
					}
				}
				else
				{
					echo json_encode(array('msj' => 'Un usuario no puede modificarse a si mismo'));
					$this->output->set_status_header(401);
				}
			}
		}
	}

	/*
		delete method (ajax)
	*/
	public function delete($id)
	{
		if($this->User->delete($id))
		{
			$this->session->set_flashdata('msj', 'El registro ha sido eliminado,alert-danger');
			echo json_encode(array('url' => base_url('users/index')));
		}
		else
		{
			$this->session->set_flashdata('msj', 'El registro no se pudo eliminar,alert-danger');
			echo json_encode(array('url' => base_url('users/index')));
			$this->output->set_status_header(401);
		}
	}

	/*
		create validate method (ajax)
	*/
	public function validate_create($position = null)
	{
		$this->form_validation->set_rules(create_rules(1));
		$this->form_validation->set_rules(create_rules(2));
		$this->form_validation->set_rules(create_rules(3));
		$this->form_validation->set_rules(create_rules(4));

		if ($this->form_validation->run() == FALSE)
		{
			$errors = $this->dataCreateValidate();
			
			$errors['password'] = form_error('password');
			$errors['confirm_password'] = form_error('confirm_password');
			$errors['state'] = form_error('state');
			$errors['type_user'] = form_error('type');

		    echo json_encode($errors);
			$this->output->set_status_header(400);
		}
		else
		{
			$data = $this->dataCreateRequest();
			$data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			$data['token'] = md5(uniqid(mt_rand(), false));
			$data['type'] = $this->input->post('type');
			$data['state'] = $this->input->post('state');

			if($this->User->create($data))
			{
				$data['password'] = $this->input->post('password');

				if($this->Email->sendRegisterEmail('miguel.gutierrez@correounivalle.edu.co', 'Miguel Gutierrez', $data['email'], 'Registro de usuario', $data))
				{
					$this->session->set_flashdata('msj', 'El registro ha sido guardado se ha enviado un email al usuario,alert-success');
					echo json_encode(array('url' => base_url('users/index')));
				}
				else
				{
					$this->session->set_flashdata('msj', 'El registro ha sido guardado pero no se pudo enviar el email,alert-warning');
					echo json_encode(array('url' => base_url('users/index')));
				}
			}
			else
			{
				echo json_encode(array('msj' => 'El usuario no pudo ser creado. por favor, intente nuevamente'));
				$this->output->set_status_header(401);
			}
		}
	}

	/*
		active method (ajax)
	*/
	public function active($username)
	{
		if(!$active = $this->User->active($username))
		{
			$this->session->set_flashdata('msj', 'Error. La cuenta ya ha sido activada (en caso de no estarlo solicite la activacion al administrador),alert-danger');
			redirect('auth/login');
		}
		else
		{
			$this->session->set_flashdata('msj', 'La cuenta ha sido activada,alert-success');
			redirect('auth/login');
		}
	}

	/*
		excel_report method
	*/
	public function excel_report()
	{
		$this->form_validation->set_error_delimiters('<br/>','');
		$this->form_validation->set_rules(excel_rules());

		if ($this->form_validation->run() == FALSE)
		{
			$errors = array(
				'type' => form_error('type'),
				'state' => form_error('state')
			);

		    $this->session->set_flashdata('msj', 'Se presentarion los siguientes errores:, alert-danger');
		    $this->excel();
		}
		else
		{
			$data = array(
				'state' => $this->input->post('state'),
				'type' => $this->input->post('type')
			);

			$users = $this->User->get_users_by_state($data['state']);

			if($users !== false)
			{
				$columns = array('id','first_name','last_name','username','email','state','type');
				$index = array('A1','B1','C1','D1','E1','F1','G1');

				$excel_data = array(
					'creator' => 'miguel angel',
					'title' => 'usuarios',
					'description' => 'reporte usuarios',
					'key_words' => 'excel usuarios',
					'category' => 'admin'
				);

				$this->Excel->users_excel($columns,$users,$data['type'],$excel_data,$index,'Usuarios');
			}
			else
			{
				$this->session->set_flashdata('msj', 'El sistema no tiene registros de usuarios con el estado seleccionado, alert-danger');
		    	redirect('users/excel');
			}
		}
	}

	/**
		Users Aditional functions
	**/

	/*
		private funtion validate register/create
	*/
	private function dataCreateValidate()
	{
		return array(
			'first_name' => form_error('first_name'),
			'last_name' => form_error('last_name'),
			'username' => form_error('username'),
			'email' => form_error('email')
		);
	}

	/*
		private funtion request register/create
	*/
	private function dataCreateRequest()
	{
		return array(
			'username' => $this->input->post('username'),
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'email' => $this->input->post('email'),
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
		json errors
	*/
	private function json_errors($array, $number) {
        echo json_encode($array);
        $this->output->set_status_header($number);
    }

    /*
		json error 401
    */
    private function error_401($msj) {
        echo json_encode(array('msj' => $msj));
        $this->output->set_status_header(401);
    }

    /*
		json success
    */
    private function json_success($msj) {
        echo json_encode(array('url' => $msj));
    }
}
