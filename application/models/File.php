<?php
class File extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function index()
	{

	}

	/*
		find file by id
	*/
	public function find($id)
	{
		$request = $this->db->get_where('files',array('id' => $id), 1);

		if(!$request->result())
		{
			return false;
		}
		
		return $request->row();
	}

	/*
		find files by id_user
	*/
	public function find_files($id_user)
	{
		$request = $this->db->get_where('files',array('id_user' => $id_user));

		if(!$request->result())
		{
			return false;
		}

		return $request->result();
	}

	public function update($id, $request)
	{

	}

	public function create($request)
	{
		if($this->db->insert('files', $request))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function delete($id)
	{
		if($this->db->delete('files', array('id' => $id)))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

}