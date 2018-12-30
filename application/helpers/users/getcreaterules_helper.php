<?php
        if(!function_exists('create_rules'))
        {
                function create_rules($id)
                {
                        if($id == 1)
                        {
                                return array(
                                array(
                                'field' => 'first_name',
                                'label' => 'Nombres',
                                'rules' => 'required|min_length[5]|max_length[100]|trim',
                                'errors' => array(
                                        'required' => 'El campo %s es obligatorio',
                                        'min_length' => 'Texto demasiado corto para el campo %s',
                                        'max_length' => 'Texto demasiado largo para el campo %s',
                                ),
                                ),
                                array(
                                'field' => 'last_name',
                                'label' => 'Apellidos',
                                'rules' => 'required|min_length[5]|max_length[100]|trim',
                                'errors' => array(
                                        'required' => 'El campo %s es obligatorio',
                                        'min_length' => 'Texto demasiado corto para el campo %s',
                                        'max_length' => 'Texto demasiado largo para el campo %s',
                                ),
                                )
                                );
                        }

                        if($id == 2)
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

                        if($id == 3)
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

                        if($id == 4)
                        {
                                return array(
                                array(
                                'field' => 'type',
                                'label' => 'Tipo Usuario',
                                'rules' => 'in_list[0,1,2,3,4,5]',
                                'errors' => array(
                                        'in_list' => 'Debe seleccionar el %s de la lista presentada',
                                ),
                                ),
                                array(
                                'field' => 'state',
                                'label' => 'Estado',
                                'rules' => 'in_list[0,1]',
                                'errors' => array(
                                        'in_list' => 'Debe seleccionar el %s de la lista presentada',
                                ),
                                )
                                );
                        }
                }
        }
?>