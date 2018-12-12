<?php
        if(!function_exists('validate_rules'))
        {
                function validate_rules()
                {
                        return array(
                        array(
                        'field' => 'origin_place',
                        'label' => 'Origen',
                        'rules' => 'differs[destination_place]',
                        'errors' => array(
                                'differs' => 'El valor del campo %s debe ser diferente al del destino',
                        ),
                        ),
                        array(
                        'field' => 'destination_place',
                        'label' => 'Destino',
                        'rules' => 'differs[origin_place]',
                        'errors' => array(
                                'differs' => 'El valor del campo %s debe ser diferente al del origen',
                        ),
                        )
                        );
                }
        }
?>