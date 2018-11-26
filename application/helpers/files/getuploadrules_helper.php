<?php
        if(!function_exists('upload_rules'))
        {
                function upload_rules()
                {
                        return array(
                        array(
                        'field' => 'file_date',
                        'label' => 'Fecha',
                        'rules' => 'required',
                        'errors' => array(
                                'required' => 'El campo %s es obligatorio',
                        ),
                        ),
                        array(
                        'field' => 'type_file',
                        'label' => 'Tipo Archivo',
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