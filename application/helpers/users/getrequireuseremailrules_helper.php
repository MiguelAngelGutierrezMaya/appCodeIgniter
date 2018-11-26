<?php
        if(!function_exists('requireuseremail_rules'))
        {
                function requireuseremail_rules()
                {
                        return array(
                        array(
                        'field' => 'username',
                        'label' => 'Login',
                        'rules' => 'required|min_length[5]|max_length[30]|trim',
                        'errors' => array(
                                'required' => 'El campo %s es obligatorio',
                                'min_length' => 'Texto demasiado corto para el campo %s',
                                'max_length' => 'Texto demasiado largo para el campo %s',
                        ),
                        ),
                        array(
                        'field' => 'email',
                        'label' => 'Correo Electronico',
                        'rules' => 'required|valid_email|trim',
                        'errors' => array(
                                'required' => 'Debes ingresar un correo electronico',
                                'valid_email' => 'Debe ingresar un email valido',
                        ),
                        )
                        );
                }
        }
?>