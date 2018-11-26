<?php
        if(!function_exists('create_rules'))
        {
                function create_rules()
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
?>