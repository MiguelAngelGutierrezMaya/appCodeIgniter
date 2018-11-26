<?php
        if(!function_exists('password_rules'))
        {
                function password_rules()
                {
                        return array(
                        array(
                        'field' => 'password',
                        'label' => 'Contraseña',
                        'rules' => 'required|min_length[5]|max_length[40]|matches[confirm_password]|trim',
                        'errors' => array(
                                'required' => 'Debes ingresar una %s',
                                'min_length' => '%s demasiado corta',
                                'max_length' => '%s demasiado larga',
                                'matches' => 'Las contraseñas no coinciden',
                        ),
                        ),
                        array(
                                'field' => 'confirm_password',
                                'label' => 'Confirmar Contraseña',
                                'rules' => 'required|trim',
                                'errors' => array(
                                'required' => 'Por favor repita la contraseña',
                        ),
                        )
                        );
                }
        }
?>