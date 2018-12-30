<?php
	if(!function_exists('login_rules'))
	{
		function login_rules()
		{
			return array(
				array(
					'field' => 'username',
					'label' => 'Login',
					'rules' => 'required|trim',
					'errors' => array(
						'required' => 'El campo %s es obligatorio',
					),
				),
				array(
	                'field' => 'password',
	                'label' => 'Contraseña',
	                'rules' => 'required|trim',
	                'errors' => array(
	                	'required' => 'Debes ingresar una %s',
	                ),
		        ),
			);
		}
	}
?>