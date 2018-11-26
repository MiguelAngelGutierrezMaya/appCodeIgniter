<?php
        if(!function_exists('unique_rules'))
        {
                function unique_rules()
                {
                        return array(
                        array(
                        'field' => 'username',
                        'label' => 'Login',
                        'rules' => 'required|is_unique[users.username]|min_length[5]|max_length[30]|trim',
                        'errors' => array(
                                'required' => 'El campo %s es obligatorio',
                                'is_unique' => 'El %s de usuario se encuentra repetido',
                                'min_length' => 'Texto demasiado corto para el campo %s',
                                'max_length' => 'Texto demasiado largo para el campo %s',
                        ),
                        ),
                        array(
                        'field' => 'email',
                        'label' => 'Correo Electronico',
                        'rules' => 'required|is_unique[users.email]|valid_email|trim',
                        'errors' => array(
                                'required' => 'Debes ingresar un correo electronico',
                                'is_unique' => 'El email se encuentra repetido',
                                'valid_email' => 'Debe ingresar un email valido',
                        ),
                        )
                        );
                }
        }
?>