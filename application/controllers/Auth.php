<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
		construct_method
	**/
	public function __construct()
	{
		parent::__construct();
		
		/*
			load helpers
		*/
		$this->load->helper(array('auth/getloginrules','auth/getmenu','users/getcreaterules','auth/getrecovrules'));
		
		/*
			load model
		*/
		$this->load->model('User');
		$this->load->model('Email');

		/*
			set error delimiters
		*/
		$this->form_validation->set_error_delimiters('','');
	}

	/**
		Auth Views
	**/

	/*
		login view
	*/
	public function login()
	{
		if($this->session->userdata('is_logged'))
		{
			redirect('home');
		}
		else
		{
			$data = $this->getLoginTemplate();
			$this->load->view('auth/login', $this->getLoginTemplate());
		}
	}

	/*
		register view
	*/
	public function register()
	{
		if($this->session->userdata('is_logged'))
		{
			redirect('home');
		}
		else
		{
			$data = $this->getLoginTemplate();
			$data['user_create'] = $this->load->view('partials/users/create','',true);
			$this->load->view('auth/register',$data);
		}
	}

	/*
		recover view
	*/
	public function recover()
	{
		if($this->session->userdata('is_logged'))
		{
			redirect('home');
		}
		else
		{
			$data = $this->getLoginTemplate();
			$this->load->view('auth/recover',$data);
		}
	}

	/*
		auth recover_password view
	*/
	public function recover_password($token_password,$token)
	{
		if($this->session->userdata('is_logged'))
		{
			redirect('home');
		}
		else
		{
			if($this->User->verify_token($token_password,$token))
			{
				$data = $this->getLoginTemplate();
				$data['token'] = $token;
				$data['token_password'] = $token_password;
				$this->load->view('auth/recover_password',$data);
			}
			else
			{
				$this->session->set_flashdata('msj', 'Error. La informacion suministrada ya se utilizo o se encuentra incorrecta,alert-danger');
				redirect('auth/login');
			}
		}
	}

	/**
		Auth Methods
	**/

	/*
		index method
	*/
	public function index()
	{
		redirect('auth/login');
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
		}

		redirect('auth/login');
	}

	/*
		login validate method (ajax)
	*/
	public function auth_validate()
	{
		$this->form_validation->set_rules(login_rules());

		if ($this->form_validation->run() == FALSE)
		{
			$this->json_errors(array('username' => form_error('username'),'password' => form_error('password'), 'key' => 1),409);
		}
		else
		{
			if(!$request = $this->User->login($this->input->post('username'),$this->input->post('password')))
			{
				$this->json_errors(array('msj' => 'El usuario no se encuentra en nuestros registros, por favor verifique sus creenciales', 'key' => 2),409);
			}
			else
			{
				if(!$last_session = $this->User->set_last_session($request->id))
				{
					$this->json_errors(array('msj' => 'A ocurrido un error inesperado con last_session', 'key' => 2),409);
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
						
						$this->json_success(base_url('home'));
					}
					else
					{
						$this->json_errors(array('msj' => 'El usuario no se encuentra activo', 'key' => 2),409);
					}
				}
			}
		}
	}

	/*
		register validate method (ajax)
	*/
	public function validate_create()
	{
		$this->form_validation->set_rules(create_rules(1));
		$this->form_validation->set_rules(create_rules(2));
		$this->form_validation->set_rules(create_rules(3));

		if ($this->form_validation->run() == FALSE)
		{
			$this->json_errors(
				array(
					'first_name' => form_error('first_name'),
					'last_name' => form_error('last_name'),
					'username' => form_error('username'),
					'email' => form_error('email'),
					'password' => form_error('password'),
					'confirm_password' => form_error('confirm_password'),
					'key' => 1
				),
				409
			);
		}
		else
		{
			$data = array(
				'username' => $this->input->post('username'),
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'token' => md5(uniqid(mt_rand(), false))
			);

			$captcha = $this->input->post('g-recaptcha-response');

			if(!$captcha)
			{
				$this->json_errors(array('msj' => 'Por favor revisar el captcha', 'key' => 2),409);
			}
			else
			{
				$secret = '6Le5m1IUAAAAAGEH1RTgnkWROzwHGOOxJlFJB84L'; //secret_key captcha
				//$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");

				//url contra la que atacamos
				$ch = curl_init("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");
				//a true, obtendremos una respuesta de la url, en otro caso, 
				//true si es correcto, false si no lo es
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				//establecemos el verbo http que queremos utilizar para la petición
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
				//obtenemos la respuesta
				$response = curl_exec($ch);
				// Se cierra el recurso CURL y se liberan los recursos del sistema
				curl_close($ch);

				if($response)
				{
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
							}
							else
							{
								$this->session->set_flashdata('msj', 'El registro ha sido guardado por favor solicite al admin la activacion de su cuenta,alert-warning');
							}

							$this->json_success(base_url('auth/login'));
						}
						else
						{
							$this->json_errors(array('msj' => 'El usuario no pudo ser creado. por favor, intente nuevamente', 'key' => 2),409);
						}
					}
					else
					{
						$this->json_errors(array('msj' => 'Por favor verifica el captcha (sin modificar)', 'key' => 2),409);
					}
				}
				else
				{
					$this->error_401('Un error al hacer la peticion de validacion del captcha');
				}
			}
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
			$this->json_errors(array('email' => form_error('email'), 'key' => 1),409);
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
					}
					else
					{
						$this->session->set_flashdata('msj', 'Error. no se ha podido enviar el mensaje favor comunicarse con el admin,alert-danger');
					}

					$this->json_success(base_url('auth/login'));
				}
				else
				{
					$this->json_errors(array('msj' => 'Error al recuperar la contraseña, comunicarse con el admin', 'key' => 2),409);
				}
			}
			else
			{
				$this->json_errors(array('msj' => 'El email ingresado no se encuentra registrado', 'key' => 2),409);
			}
		}
	}

	/*
		validate_recover_password method (ajax)
	*/
	public function validate_recover_password()
	{
		$this->form_validation->set_rules(create_rules(2));

		if ($this->form_validation->run() == FALSE)
		{
			$this->json_errors(
				array(
					'password' => form_error('password'),
					'confirm_password' => form_error('confirm_password'),
					'key' => 1
				),
				409
			);
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
					$this->json_success(base_url('auth/login'));
				}
				else
				{
					$this->json_errors(array('msj' => 'Error. La contraseña no se pudo modificar', 'key' => 2),409);
				}
			}
			else
			{
				$this->json_errors(array('msj' => 'Error, el token de usuario no se encuentra registrado', 'key' => 2),409);
			}
		}
	}

	/**
		Auth Aditional functions
	**/

	/*
		private function template Auth
	*/
	private function getLoginTemplate()
	{
		return array(
			'meta' => $this->load->view('partials/meta','',true),
			'favicon' => $this->load->view('partials/favicon', '', true),
			'css' => $this->load->view('partials/css', '', true),
			'modal_preloader' => $this->load->view('partials/modal-preloader', '', true),
			'script' => $this->load->view('partials/script','',true),
			'menu' => auth_menu(), //llama al helper auth_menu
		);
	}

	/*
		json errors
	*/
	private function json_errors($array, $number)
	{
		$this->output->set_status_header($number);
		echo json_encode($array);
		
    }

    /*
		json success
    */
    private function json_success($msj)
    {
        echo json_encode(array('url' => $msj));
    }
}