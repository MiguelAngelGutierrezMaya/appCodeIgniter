<?php
class Quote extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
	}

	public function index()
	{
		$request = $this->db->query("SELECT quotes.*,users.first_name,users.last_name,users.email FROM quotes INNER JOIN users ON quotes.id_user = users.id ORDER BY quotes.id DESC");
		return $request->result();
	}

	public function find($id)
	{
		
	}

	public function update()
	{
		
	}

	public function delete()
	{
		
	}

	public function create($request)
	{
		if($this->db->insert('quotes', $request))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}