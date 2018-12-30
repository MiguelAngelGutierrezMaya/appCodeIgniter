<?php
	if(!function_exists('auth_menu'))
	{
		function auth_menu()
		{
			return array(
				array(
					'title' => 'Login',
					'url' => base_url('auth/login'),
				),
				array(
					'title' => 'Registro',
					'url' => base_url('auth/register'),
				),
			);
		}
	}
?>