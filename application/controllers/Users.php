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
		
		$this->load->helper(array('getmenu','users/getloginrules','users/getregistrules','users/getcreaterules','users/getpasswordrules','users/getuniquerules','users/getrequireuseremailrules','users/getrecovrules','users/getexcelrules','html'));
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
				redirect('users/home');
			}
		}
		else
		{
			//show_404();
			redirect('users/login');
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
			$this->load->view('users/home',$data);
		}
		else
		{
			//show_404();
			redirect('users/login');
		}
	}

	/*
		users login view
	*/
	public function login()
	{
		if($this->session->userdata('is_logged'))
		{
			redirect('users/home');
		}
		else
		{
			$data = $this->getLoginTemplate();
			$this->load->view('users/login',$data);
		}
	}

	/*
		users recover view
	*/
	public function recover()
	{
		if($this->session->userdata('is_logged'))
		{
			redirect('users/home');
		}
		else
		{
			$data = $this->getLoginTemplate();
			$this->load->view('users/recover',$data);
		}
	}

	/*
		users recover_password view
	*/
	public function recover_password($token_password,$token)
	{
		if($this->session->userdata('is_logged'))
		{
			redirect('users/home');
		}
		else
		{
			if($this->User->verify_token($token_password,$token))
			{
				$data = $this->getLoginTemplate();
				$data['token'] = $token;
				$data['token_password'] = $token_password;
				$this->load->view('users/recover_password',$data);
			}
			else
			{
				$this->session->set_flashdata('msj', 'Error. La informacion suministrada ya se utilizo o se encuentra incorrecta,alert-danger');
				redirect('users/login');
			}
		}
	}

	/*
		
	*/
	public function view()
	{
		$data['title'] = 'Hola mundo';
		$data['colors'] = array('negro', 'azul', 'blanco');
		
		$this->load->view('view',$data);
		$this->load->view('footer');

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
				redirect('users/home');
			}
		}
		else
		{
			//show_404();
			redirect('users/login');
		}
	}

	/*
		users register view if logged in
	*/
	public function register()
	{
		if($this->session->userdata('is_logged'))
		{
			redirect('users/home');
		}
		else
		{
			$data = $this->getLoginTemplate();
			$data['user_create'] = $this->load->view('partials/users/create','',true);
			$this->load->view('users/register',$data);
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
				redirect('users/home');
			}
		}
		else
		{
			//show_404();
			redirect('users/login');
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
		logout method
	*/
	public function logout()
	{
		if($this->session->userdata('is_logged'))
		{
			$this->session->unset_userdata(array('id','first_name','last_name','email','state','type','is_logged'));
			$this->session->sess_destroy();
			redirect('users/login');
		}
		else
		{
			redirect('users/login');
		}
	}

	/*
		login validate method (ajax)
	*/
	public function validate()
	{
		$this->form_validation->set_rules(login_rules());

		if ($this->form_validation->run() == FALSE)
		{
			$errors = array(
				'username' => form_error('username'),
				'password' => form_error('password')
			);

			echo json_encode($errors);
			$this->output->set_status_header(400);
		}
		else
		{
			if(!$request = $this->User->login($this->input->post('username'),$this->input->post('password')))
			{
				echo json_encode(array('msj' => 'El usuario no se encuentra en nuestros registros, por favor verifique sus creenciales'));
				$this->output->set_status_header(401);
			}
			else
			{
				if(!$last_session = $this->User->set_last_session($request->id))
				{
					echo json_encode(array('msj' => 'A ocurrido un error inesperado con last_session'));
					$this->output->set_status_header(401);
				}
				else
				{
					if($request->state == 1)
					{
						$this->session->set_userdata(
							array(
								'id' => $request->id,
								'first_name' => $request->first_name,
								'last_name' => $request->last_name,
								'email' => $request->email,
								'state' => $request->state,
								'type' => $request->type,
								'is_logged' => true,
							)
						);
						
						echo json_encode(array('url' => base_url('users/home')));
					}
					else
					{
						echo json_encode(array('msj' => 'El usuario no se encuentra activo'));
						$this->output->set_status_header(401);
					}
				}
			}
		}
	}

	/*
		store method (ajax)
	*/
	public function store()
	{
		$this->validate_create('store');
	}

	/*
		register/create validate method (ajax)
	*/
	public function validate_create($position = null)
	{
		$this->form_validation->set_rules(register_rules());
		$this->form_validation->set_rules(password_rules());
		$this->form_validation->set_rules(unique_rules());
		
		if($position !== null)
		{
			$this->form_validation->set_rules(create_rules());
		}

		if ($this->form_validation->run() == FALSE)
		{
			$errors = $this->dataCreateValidate();
			$errors['password'] = form_error('password');
			$errors['confirm_password'] = form_error('confirm_password');

			if($position !== null)
			{
				$errors['state'] = form_error('state');
				$errors['type_user'] = form_error('type');
			}

		    echo json_encode($errors);
			$this->output->set_status_header(400);
		}
		else
		{
			$data = $this->dataCreateRequest();
			$data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
			$data['token'] = md5(uniqid(mt_rand(), false));

			if($position !== null)
			{
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
			else
			{
				$captcha = $this->input->post('g-recaptcha-response');
				if(!$captcha)
				{
					echo json_encode(array('msj' => 'Por favor revisar el captcha'));
					$this->output->set_status_header(401);
				}
				else
				{
					$secret = '6Le5m1IUAAAAAGEH1RTgnkWROzwHGOOxJlFJB84L'; //secret_key captcha
					$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
					$request_captcha = json_decode($response, true);

					if($request_captcha['success'] == true)
					{
						$data['state'] = 0;
						if($this->User->create($data))
						{
							$data['password'] = $this->input->post('password');

							if($this->Email->sendRegisterEmail('miguel.gutierrez@correounivalle.edu.co', 'Miguel Gutierrez', $data['email'], 'Registro de usuarios', $data))
							{
								$this->session->set_flashdata('msj', 'El registro ha sido guardado se ha enviado un email al correo ingresado para activar cuenta,alert-success');
								echo json_encode(array('url' => base_url('users/login')));
							}
							else
							{
								$this->session->set_flashdata('msj', 'El registro ha sido guardado por favor solicite al admin la activacion de su cuenta,alert-warning');
								echo json_encode(array('url' => base_url('users/login')));
							}
						}
						else
						{
							echo json_encode(array('msj' => 'El usuario no pudo ser creado. por favor, intente nuevamente'));
							$this->output->set_status_header(401);
						}
					}
					else
					{
						echo json_encode(array('msj' => 'Por favor verifica el captcha (sin modificar)'));
						$this->output->set_status_header(401);
					}
				}
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
			redirect('users/login');	
		}
		else
		{
			$this->session->set_flashdata('msj', 'La cuenta ha sido activada,alert-success');
			redirect('users/login');
		}
	}

	/*
		validate_recover method (ajax)
	*/
	public function validate_recover()
	{
		$this->form_validation->set_rules(recover_rules());

		if ($this->form_validation->run() == FALSE)
		{
			$errors['email'] = form_error('email');

		    echo json_encode($errors);
			$this->output->set_status_header(400);
		}
		else
		{
			$user = $this->User->get_user_by_email($this->input->post('email'));

			if($user !== false)
			{
				$data = array(
					'token_password' => md5(uniqid(mt_rand(), false)),
					'password_request' => 1
				);

				if($this->User->update($user->id,$data))
				{
					$data['token'] = $user->token;

					if($this->Email->sendRecoverEmail('miguel.gutierrez@correounivalle.edu.co', 'Miguel Gutierrez', $user->email, 'Recuperar contrase&ntildea', $data))
					{
						$this->session->set_flashdata('msj', 'Se ha enviado la infomacion para recuperar contraseña a su cuenta de correo registrada,alert-success');
						echo json_encode(array('url' => base_url('users/login')));
					}
					else
					{
						$this->session->set_flashdata('msj', 'Error. no se ha podido enviar el mensaje favor comunicarse con el admin,alert-danger');
						echo json_encode(array('url' => base_url('users/login')));
					}
				}
				else
				{
					echo json_encode(array('msj' => 'Error al recuperar la contraseña, comunicarse con el admin'));
					$this->output->set_status_header(401);
				}
			}
			else
			{
				echo json_encode(array('msj' => 'El email ingresado no se encuentra registrado'));
				$this->output->set_status_header(401);
			}
		}
	}

	/*
		validate_recover_password method (ajax)
	*/
	public function validate_recover_password()
	{
		$this->form_validation->set_rules(password_rules());

		if ($this->form_validation->run() == FALSE)
		{
			$errors = array(
				'password' => form_error('password'),
				'confirm_password' => form_error('confirm_password')
			);

		    echo json_encode($errors);
			$this->output->set_status_header(400);
		}
		else
		{
			$data = array(
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'token' => $this->input->post('token'),
				'token_password' => $this->input->post('token_password'),
			);

			$user = $this->User->get_user_by_token($data['token']);

			if($user !== false)
			{
				if($this->User->update($user->id,array('password' => $data['password'])))
				{
					$this->session->set_flashdata('msj', 'La contraseña se ha modificado,alert-success');
					echo json_encode(array('url' => base_url('users/login')));
				}
				else
				{
					echo json_encode(array('msj' => 'Error. La contraseña no se pudo modificar,alert-danger'));
					$this->output->set_status_header(401);
				}
			}
			else
			{
				echo json_encode(array('msj' => 'Error, el token de usuario no se encuentra registrado'));
				$this->output->set_status_header(401);
			}
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
		private function template Auth
	*/
	private function getLoginTemplate()
	{
		return array(
			'meta' => $this->load->view('partials/meta','',true),
			'favicon' => $this->load->view('partials/favicon', '', true),
			'css' => $this->load->view('partials/css', '', true),
			'script' => $this->load->view('partials/script','',true),
			'menu' => main_menu(), //llama al helper main_menu
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
}
