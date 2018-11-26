<?php
        if(!function_exists('register_rules'))
        {
                function register_rules()
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
        }
?>