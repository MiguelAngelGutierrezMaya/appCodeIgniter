<?php
	if(!function_exists('recover_rules'))
	{
		function recover_rules()
		{
			return array(
				array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'required|valid_email|trim',
					'errors' => array(
						'required' => 'El campo %s es obligatorio',
						'valid_email' => 'Debe ingresar un email valido',
					),
				)
			);
		}
	}
?>