<?php
class Email extends CI_Model
{
	public function __construct()
	{
		$config = Array(
	        'protocol' => 'smtp',
	        'smtp_host' => 'ssl://smtp.googlemail.com',
	        'smtp_port' => 465,
	        'smtp_user' => 'example@example.com',
	        'smtp_pass' => '**********',
	        'mailtype'  => 'html', 
	        'charset'   => 'iso-8859-1'
	    );

		$this->load->library('email',$config);
	}

	public function sendBasicEmail($from, $name_from, $email_to, $subject)
	{
		$this->email->set_newline("\r\n");
		$this->email->from($from, $name_from);
		$this->email->to($email_to);
		$this->email->subject($subject);

		$this->email->attach($_SERVER['DOCUMENT_ROOT'].'/appCodeIgniter/assets/img/logo/logo.png');
		$this->email->attach($_SERVER['DOCUMENT_ROOT'].'/appCodeIgniter/assets/img/code.jpg');
		$this->email->attach($_SERVER['DOCUMENT_ROOT'].'/appCodeIgniter/assets/img/green1.png');

    	$data['cid'] = $this->email->attachment_cid($_SERVER['DOCUMENT_ROOT'].'/appCodeIgniter/assets/img/logo/logo.png');

		$this->email->message($this->load->view('emails/templates/quotes_create',$data,true));

		return $this->send();
	}

	public function sendRegisterEmail($from, $name_from, $email_to, $subject, $data)
	{
		$this->email->set_newline("\r\n");
		$this->email->from($from, $name_from);
		$this->email->to($email_to);
		$this->email->subject($subject);

		$this->email->attach($_SERVER['DOCUMENT_ROOT'].'/appCodeIgniter/assets/img/logo/logo.png');

		$data['cid'] = $this->email->attachment_cid($_SERVER['DOCUMENT_ROOT'].'/appCodeIgniter/assets/img/logo/logo.png');

		$this->email->message($this->load->view('emails/templates/register',$data,true));

		return $this->send();
	}

	public function sendRecoverEmail($from, $name_from, $email_to, $subject, $data)
	{
		$this->email->set_newline("\r\n");
		$this->email->from($from, $name_from);
		$this->email->to($email_to);
		$this->email->subject($subject);

		$this->email->attach($_SERVER['DOCUMENT_ROOT'].'/appCodeIgniter/assets/img/logo/logo.png');

		$data['cid'] = $this->email->attachment_cid($_SERVER['DOCUMENT_ROOT'].'/appCodeIgniter/assets/img/logo/logo.png');

		$this->email->message($this->load->view('emails/templates/recover',$data,true));

		return $this->send();
	}

	public function send()
	{
		if($this->email->send())
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}