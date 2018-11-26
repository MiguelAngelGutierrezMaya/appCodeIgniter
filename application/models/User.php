<?php
class User extends CI_Model 
{
	public function __construct()
	{
		$this->load->database();
	}

	public function index()
	{
		$request = $this->db->query("SELECT * FROM users ORDER BY id DESC");
		return $request->result();
	}

	public function find($id)
	{
		$this->db->select('id,first_name,last_name,username,email,type,state')->where('id',$id);
		$request = $this->db->get('users');
		return $request->row();
	}

	public function find_users_active()
	{
		$this->db->select('id,first_name,last_name')->where('state',1);
		$request = $this->db->get('users');

		foreach ($request->result() as $row)
		{
			$data[$row->id] = $row->first_name.' '.$row->last_name;
		}

		return $data;
	}

	public function update($id, $request)
	{
		$this->db->set($request);
		$this->db->where('id', $id);

		if($this->db->update('users'))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function create($request)
	{
		if($this->db->insert('users', $request))
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
		if($this->db->delete('users', array('id' => $id)))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	/*
		get users by state
	*/
	public function get_users_by_state($state)
	{
		$request = $this->db->get_where('users',array('state' => $state));

		if(!$request->result())
		{
			return false;
		}

		return $request->result();
	}

	/*
		get user by username or email and password
	*/
	public function login($username, $password)
	{
		$request = $this->db->get_where('users',array('username' => $username), 1);

		if(!$request->result())
		{
			$request = $this->db->get_where('users',array('email' => $username), 1);

			if(!$request->result())
			{
				return false;
			}
		}
		if(!password_verify($password, $request->row()->password))
		{
			return false;
		}
		return $request->row();
	}

	/*
		get id user by username
	*/
	public function get_id_user_by_username($username)
	{
		$request = $this->db->get_where('users',array('username' => $username), 1);

		if(!$request->result())
		{
			return false;
		}

		$row = $request->row();

		return $row->id;
	}

	/*
		get id user by email
	*/
	public function get_id_user_by_email($email)
	{
		$request = $this->db->get_where('users',array('email' => $email), 1);

		if(!$request->result())
		{
			return false;
		}

		$row = $request->row();

		return $row->id;
	}

	/*
		get user by email
	*/
	public function get_user_by_email($email)
	{
		$request = $this->db->get_where('users',array('email' => $email), 1);

		if(!$request->result())
		{
			return false;
		}

		return $request->row();
	}

	/*
		get user by token
	*/
	public function get_user_by_token($token)
	{
		$request = $this->db->get_where('users',array('token' => $token), 1);

		if(!$request->result())
		{
			return false;
		}

		return $request->row();
	}

	/*
		get email user by id
	*/
	public function get_email_user($id)
	{
		$request = $this->db->get_where('users',array('id' => $id), 1);

		if(!$request->result())
		{
			return false;
		}

		$row = $request->row();

		return $row->email;
	}

	/*
		set user last_session
	*/
	public function set_last_session($id)
	{
		return $this->db->query("UPDATE users SET last_session = NOW() WHERE id = ?", $id);
	}

	/*
		set user state
	*/
	public function active($username)
	{
		$request = $this->db->get_where('users',array('username' => $username), 1);
		$row = $request->row();

		if($row->state == 0)
		{
			return $this->db->query("UPDATE users SET state = 1 WHERE id = ?", $row->id);
		}
		else
		{
			return false;
		}
	}

	/*
		verify the password reset request
	*/
	public function verify_token($token_password,$token)
	{
		$request = $this->db->get_where('users',array('token' => $token), 1);

		if(!$request->result())
		{
			return false;
		}
		else
		{
			$user = $request->row();

			if(($user->token_password == $token_password) and ($user->password_request == 1))
			{
				$this->update($user->id,array('password_request' => 0));
				return true;
			}
			else
			{
				return false;
			}
		}
	}
}