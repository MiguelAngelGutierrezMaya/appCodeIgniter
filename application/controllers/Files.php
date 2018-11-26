<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Files extends CI_Controller {

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
		
		$this->load->helper(array('getmenu','files/getuploadrules','html'));
		$this->load->model('File'); //Cargar el modelo al controlador
		$this->form_validation->set_error_delimiters('','');
	}

	/**
		Users Views
	**/

	/*
		users index view if user logged in
	*/
	public function index()
	{
		echo "Files index controller";
	}

	/*
		files upload view if user logged in
	*/
	public function upload()
	{
		if($this->session->userdata('is_logged'))
		{
			if($this->session->type == 5)
			{
				$data = $this->getDashboardTemplate();
				$this->load->view('files/upload',$data);
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

	public function massive_upload()
	{
		if($this->session->userdata('is_logged'))
		{
			if($this->session->type == 5)
			{
				$data = $this->getDashboardTemplate();
				$this->load->view('files/massive_upload',$data);
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
		Files Methods
	**/
	
	/*
		file_upload method (ajax)
	*/
	public function file_upload()
	{
		$this->form_validation->set_rules(upload_rules());

		if ($this->form_validation->run() == FALSE)
		{
			$errors = array(
				'file_date' => form_error('file_date'),
				'type_file' => form_error('type_file'),
			);

		    echo json_encode($errors);
			$this->output->set_status_header(400);
		}
		else
		{
			$ruta = './assets/files/'.$this->session->id.'/';

			if(!file_exists($ruta)){
				mkdir($ruta);
			}

			chmod($ruta, 0777);

			$config['upload_path'] = $ruta; //Se posiciona en la carpeta raiz del proyecto con ./
	        $config['allowed_types'] = 'gif|jpg|png|pdf|xls|xlsx|docx';
	        $config['max_size'] = '25600'; //tamaño en KB (25 MB)
	        $config['max_width'] = '5000';
	        $config['max_height'] = '5000';
	 
	        $this->load->library('upload', $config);

	        if(!$this->upload->do_upload('archivo'))
	        {
	            echo json_encode(array('msj' => $this->upload->display_errors()));
	            $this->output->set_status_header(401);
	        }
	        else
	        {
	        	$file_info = $this->upload->data();
	            chmod($ruta.$file_info['file_name'], 0777);

	        	$data = $this->dataCreateRequest();
	        	$data['file_name'] = $file_info['file_name'];
	        	$data['url'] = $ruta.$file_info['file_name'];

	        	if($this->File->create($data))
	        	{
	        		$this->session->set_flashdata('msj', 'El archivo '.$file_info['file_name'].' se ha cargado exitosamente y se ha guardado el registro,alert-success');
	            	echo json_encode(array('url' => base_url('files/upload')));
	        	}
	        	else
	        	{
	        		$this->session->set_flashdata('msj', 'El archivo '.$file_info['file_name'].' se ha cargado exitosamente pero el registro no se pudo guardar,alert-warning');
	            	echo json_encode(array('url' => base_url('files/upload')));
	        	}
	        }
		}
	}

	public function file_massive_upload()
	{
		$this->form_validation->set_rules(upload_rules());

		if ($this->form_validation->run() == FALSE)
		{
			$errors = array(
				'file_date' => form_error('file_date'),
				'type_file' => form_error('type_file'),
			);

		    echo json_encode($errors);
			$this->output->set_status_header(400);
		}
		else
		{
			$data = array();
			$msj = array(
				'success' => array(),
				'error_upload' => array(),
				'error_database' => array(),
			);

	        if(!empty($_FILES['archivo']['name'])){

	        	$ruta = './assets/files/'.$this->session->id.'/';

				if(!file_exists($ruta)){
					mkdir($ruta);
				}

				chmod($ruta, 0777);
	            
	            $files = count($_FILES['archivo']['name']);

	            for($i = 0; $i < $files; $i++)
	            {
	                $_FILES['file_data']['name'] = $_FILES['archivo']['name'][$i];
	                $_FILES['file_data']['type'] = $_FILES['archivo']['type'][$i];
	                $_FILES['file_data']['tmp_name'] = $_FILES['archivo']['tmp_name'][$i];
	                $_FILES['file_data']['error'] = $_FILES['archivo']['error'][$i];
	                $_FILES['file_data']['size'] = $_FILES['archivo']['size'][$i];

	                $config['upload_path'] = $ruta; //Se posiciona en la carpeta raiz del proyecto con ./
			        $config['allowed_types'] = 'gif|jpg|png|pdf|xls|xlsx|docx';
			        $config['max_size'] = '25600'; //tamaño en KB (25 MB)
			        $config['max_width'] = '5000';
			        $config['max_height'] = '5000';
	                
	                $this->load->library('upload', $config);

	                $this->upload->initialize($config);

					if(!$this->upload->do_upload('file_data'))
			        {
			            $msj['error_upload'][$i] = $_FILES['file_data']['name'].' '.$this->upload->display_errors();
			        }
			        else
			        {
						$file_info = $this->upload->data();
            			chmod($ruta.$file_info['file_name'], 0777);

            			$data = $this->dataCreateRequest();
			        	$data['file_name'] = $file_info['file_name'];
			        	$data['url'] = $ruta.$file_info['file_name'];

			        	if($this->File->create($data))
			        	{
			        		$msj['success'][$i] = 'El archivo '.$file_info['file_name'].' se ha cargado exitosamente y se ha guardado el registro';
			        	}
			        	else
			        	{
			        		$msj['error_database'][$i] = 'El archivo '.$file_info['file_name'].' se ha cargado exitosamente pero el registro no se pudo guardar';
			        	}
			        }
	            }

	            $this->session->set_flashdata('msj', $msj);
	            echo json_encode(array('url' => base_url('files/massive_upload')));
	        }
	        else
	        {
	        	echo json_encode(array('msj' => 'Error, los archivos no se pudieron cargar'));
	            $this->output->set_status_header(401);
	        }
		}
	}

	/*
		file_delete method
	*/
	public function delete($id,$user_id)
	{
		$file = $this->File->find($id);
		$ruta = './assets/files/'.$user_id.'/';

		if(is_file($ruta.$file->file_name))
		{
			if(unlink($ruta.$file->file_name))
			{
				if($this->File->delete($file->id))
				{
					$this->session->set_flashdata('msj', 'El archivo ha sido eliminado,alert-success');
					redirect('users/home');
				}
				else
				{
					$this->session->set_flashdata('msj', 'El archivo ha sido eliminado pero el registro no,alert-warning');
					redirect('users/home');
				}
			}
			else
			{
				$this->session->set_flashdata('msj', 'El archivo no se ha podido eliminar,alert-warning');
				redirect('users/home');
			}
		}
		else
		{
			$this->session->set_flashdata('msj', 'El archivo no existe,alert-danger');
			redirect('users/home');
		}
	}

	/**
		Files Aditional functions
	**/

	/*
		private funtion validate register/create
	*/
	private function dataCreateValidate()
	{
		return array(
			'file_date' => form_error('file_date'),
			'type_file' => form_error('type_file')
		);
	}

	/*
		private funtion request register/create
	*/
	private function dataCreateRequest()
	{
		return array(
			'file_date' => $this->input->post('file_date'),
			'type_file' => $this->input->post('type_file'),
			'id_user' => $this->session->id,
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