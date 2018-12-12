<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transfers extends CI_Controller {

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
		
		$this->load->helper(array('getmenu','transfers/getvalidaterules','html'));
	}

	/**
		Transfers Views
	**/

	/*
		transfers index view if user logged in
	*/
	public function index()
	{
		if($this->session->userdata('is_logged') and $this->session->type == 5)
		{
			echo "Usuario Autorizado";
		}
		else
		{
			echo "Usuario No autoriozado";
			//show_404();
		}
	}

	/*
		transfers assign view if user logged in
	*/
	public function assign()
	{
		if($this->session->userdata('is_logged'))
		{
			$data = $this->getDashboardTemplate();

			$this->load->view('transfers/assign',$data);
		}
		else
		{
			redirect('transfers/login');
		}
	}

	/*
		transfers register view if user login
	*/
	public function register($lat1,$lon1,$place1,$lat2,$lon2,$place2)
	{
		if($this->session->userdata('is_logged'))
		{
			$response = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$lat1,$lon1&destinations=$lat2,$lon2&key=YOUR_API_KEY");
			$arr = json_decode($response, true);

			$data = $this->getDashboardTemplate();
			$data['lat1'] = $lat1;
			$data['lon1'] = $lon1;
			$data['place1'] = $place1;
			$data['lat2'] = $lat2;
			$data['lon2'] = $lon2;
			$data['place2'] = $place2;
			$data['medium1'] = ($data['lat1'] + $data['lat2']) / 2;
			$data['medium2'] = ($data['lon1'] + $data['lon2']) / 2;

			if($arr["status"] == 'OVER_QUERY_LIMIT')
			{
				$data['distance'] = "Limite diario excedido";
				$data['time'] = "none";
			}
			else
			{
				$number = explode(' ',$arr["rows"][0]["elements"][0]["distance"]["text"]);
				$data['distance'] = round(($number[0] * 1.609344),2).' km';
				$data['time'] = 'tiempo: '.$arr["rows"][0]["elements"][0]["duration"]["text"];
			}

			$data['zoom'] = 14;
			$this->load->view('transfers/register',$data);
		}
		else
		{
			redirect('transfers/index');
		}
	}

	/**
		Transfers Methods
	**/

	/*
		validate_create method (ajax)
	*/
	public function validate_create()
	{
		$this->form_validation->set_rules(validate_rules());

		if ($this->form_validation->run() == FALSE)
		{
			$errors = array(
				'origin_place' => form_error('origin_place'),
				'destination_place' => form_error('destination_place')
			);

		    echo json_encode($errors);
			$this->output->set_status_header(400);
		}
		else
		{
			if($this->input->post('origin_place') == 'none' || $this->input->post('destination_place') == 'none')
			{
				echo json_encode(array('msj' => 'ninguno de los campos debe estar vacio'));
				$this->output->set_status_header(401);
			}
			else
			{
				$origin_place = explode(',',$this->input->post('origin_place'));
				$destination_place = explode(',',$this->input->post('destination_place'));
				
				echo json_encode(array('url' => base_url('transfers/register/'.$origin_place[0].'/'.$origin_place[1].'/'.$origin_place[2].'/'.$destination_place[0].'/'.$destination_place[1].'/'.$destination_place[2])));
			}
		}
	}

	/**
		Transfers Aditional functions
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

	/*
		private function
	*/
	/*
		private function getDistance($lat1, $lon1, $lat2, $lon2, $unit, $decimals)
		{
			// Cálculo de la distancia en grados
		    $degrees = rad2deg(acos((sin(deg2rad($lat1))*sin(deg2rad($lat2))) + (cos(deg2rad($lat1))*cos(deg2rad($lat2))*cos(deg2rad($lon1-$lon2)))));
		   
		    // Conversión de la distancia en grados a la unidad escogida (kilómetros, millas o millas naúticas)
		    switch($unit)
		    {
		      case 'km':
		        $distance = $degrees * 111.13384; // 1 grado = 111.13384 km, basándose en el diametro promedio de la Tierra (12.735 km)
		        break;
		      case 'mi':
		        $distance = $degrees * 69.05482; // 1 grado = 69.05482 millas, basándose en el diametro promedio de la Tierra (7.913,1 millas)
		        break;
		      case 'nmi':
		        $distance =  $degrees * 59.97662; // 1 grado = 59.97662 millas naúticas, basándose en el diametro promedio de la Tierra (6,876.3 millas naúticas)
		    }

		    return round($distance, $decimals);
		}
	*/
}