<?php
        if(!function_exists('create_rules'))
        {
                function create_rules()
                {
                        return array(
                        array(
                        'field' => 'quote_date',
                        'label' => 'Fecha',
                        'rules' => 'required',
                        'errors' => array(
                                'required' => 'El campo %s es obligatorio',
                        ),
                        ),
                        array(
                        'field' => 'type_quote',
                        'label' => 'Tipo Cita',
                        'rules' => 'required|min_length[5]|max_length[100]|trim',
                        'errors' => array(
                                'required' => 'El campo %s es obligatorio',
                                'min_length' => 'Texto demasiado corto para el campo %s',
                                'max_length' => 'Texto demasiado largo para el campo %s',
                        ),
                        ),
                        array(
                        'field' => 'description',
                        'label' => 'Descripcion Detallada',
                        'rules' => 'required|min_length[5]|trim',
                        'errors' => array(
                                'required' => 'El campo %s es obligatorio',
                                'min_length' => 'Texto demasiado corto para el campo %s',
                        ),
                        ),
                        array(
                        'field' => 'state_quote',
                        'label' => 'Estado',
                        'rules' => 'in_list[0,1]|integer',
                        'errors' => array(
                                'in_list' => 'Debe seleccionar el %s de la lista presentada',
                                'integer' => 'Debe seleccionar el %s de la lista presentada (sin editar)',
                        ),
                        ),
                        array(
                        'field' => 'id_user',
                        'label' => 'Usuario',
                        'rules' => 'integer',
                        'errors' => array(
                                'integer' => 'Debe seleccionar un %s de la lista presentada',
                        ),
                        )
                        );
                }
        }
?>