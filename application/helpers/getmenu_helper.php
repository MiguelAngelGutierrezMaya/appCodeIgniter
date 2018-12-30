<?php
	if(!function_exists('menu'))
	{
		function menu()
		{
			return array(
				array(
					'title' => 'Usuarios',
					'icon' => 'fa big-icon fa-user icon-wrap',
					'aria-expanded' => 'true',
					'type' => array(5),
					'content' => array(
						array(
							'title' => 'Consultar Usuarios',
							'url' => base_url('users/index'),
							'class' => 'fa fa-search sub-icon-mg',
						),
						array(
							'title' => 'Crear Usuario',
							'url' => base_url('users/create'),
							'class' => 'fa fa-plus sub-icon-mg',
						),
						array(
							'title' => 'Reporte Usuarios',
							'url' => base_url('users/excel'),
							'class' => 'fa fa-file-excel-o text-success sub-icon-mg',
						),
					),
				),
				array(
					'title' => 'Imagenes',
					'icon' => 'fa big-icon fa-file-image-o icon-wrap',
					'aria-expanded' => 'true',
					'type' => array(5),
					'content' => array(
						array(
							'title' => 'Consultar Archivos',
							'url' => base_url('files/index'),
							'class' => 'fa fa-search sub-icon-mg',
						),
						array(
							'title' => 'Cargar Archivos',
							'url' => base_url('files/upload'),
							'class' => 'fa fa-upload sub-icon-mg',
						),
						array(
							'title' => 'Carga Masiva',
							'url' => base_url('files/massive_upload'),
							'class' => 'fa fa-upload sub-icon-mg',
						),
					),
				),
				array(
					'title' => 'Citas',
					'icon' => 'fa big-icon fa-file icon-wrap',
					'aria-expanded' => 'false',
					'type' => array(5,4,3,2,1,0),
					'content' => array(
						array(
							'title' => 'Consultar Citas',
							'url' => base_url('quotes/index'),
							'class' => 'fa fa-search sub-icon-mg',
						),
						array(
							'title' => 'Nueva Cita',
							'url' => base_url('quotes/create'),
							'class' => 'fa fa-plus sub-icon-mg',
						),
						array(
							'title' => 'Reporte Citas',
							'url' => base_url('quotes/index'),
							'class' => 'fa fa-file-excel-o text-success sub-icon-mg',
						),
					),
				),
				array(
					'title' => 'Transferencias',
					'icon' => 'fa big-icon fa-map icon-wrap',
					'aria-expanded' => 'true',
					'type' => array(5),
					'content' => array(
						array(
							'title' => 'Consultar transferencias',
							'url' => '#',
							'class' => 'fa fa-search sub-icon-mg',
						),
						array(
							'title' => 'Nueva transferencia',
							'url' => '#',
							'class' => 'fa fa-plus sub-icon-mg',
						),
						array(
							'title' => 'Asignar transferencia',
							'url' => base_url('transfers/assign'),
							'class' => 'fa fa-plus sub-icon-mg',
						),
					),
				),
			);
		}
	}