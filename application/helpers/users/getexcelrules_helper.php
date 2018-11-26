<?php
        if(!function_exists('excel_rules'))
        {
                function excel_rules()
                {
                        return array(
                        array(
                        'field' => 'type',
                        'label' => 'Formato',
                        'rules' => 'in_list[xls,xlsx]',
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