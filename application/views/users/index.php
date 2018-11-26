<!DOCTYPE html>
<html>
	<head>
		<?= $meta ?>
	    <title>AppCI | User Index</title>
	    <?= $favicon ?>

	    <!-- Google Fonts -->
	    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">

		<?= $css ?>

		<!-- modernizr JS -->
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/vendor/modernizr-2.8.3.min.js" ></script>
	</head>
	<body>
		<?= $sidebar ?>
		<div class="all-content-wrapper">
			<?= $container_fluid_header ?>
			<div class="header-advance-area">
				<?= $header_top_area ?>
				<?= $mobile_menu ?>
				<div class="breadcome-area">
	                <div class="container-fluid">
	                    <div class="row">
	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                            <div class="breadcome-list">
	                                <div class="row">
	                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                                        <ul class="breadcome-menu">
	                                            <li><a href="<?php echo base_url('users/home'); ?>">Home</a> <span class="bread-slash">/</span>
	                                            </li>
	                                            <li><span class="bread-blod">Users</span>
	                                            </li>
	                                        </ul>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
			</div>
			<div class="section-admin container-fluid">
				<div class="row admin">
					<div class="col-md-12">
	                    <div class="row">
	                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	                            <div class="admin-content analysis-progrebar-ctn res-mg-t-15">
	                            	<?php if($msj = $this->session->flashdata('msj')): ?>
	                            	<?php $msj_ex = explode(",", $msj); ?>
									<div id="alert" class="alert <?php echo $msj_ex[1]; ?>" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<span><?php echo $msj_ex[0]; ?></span>
									</div>
									<?php endif; ?>
									<div class="data-table-area mg-tb-15">
				                        <div class="sparkline13-list">
				                            <div class="sparkline13-hd">
				                                <div class="main-sparkline13-hd">
				                                	<h2>Usuarios registrados</h2>
				                                </div>
				                            </div>
				                            <div class="sparkline13-graph">
				                                <div class="datatable-dashv1-list custom-datatable-overright">
				                                    <div id="toolbar">
				                                        <select class="form-control">
															<option value="">Basico</option>
															<option value="all">Exportar Todos</option>
															<option value="selected">Exportar Seleccionados</option>
														</select>
				                                    </div>
				                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
				                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
				                                        <thead>
				                                            <tr>
				                                                <th data-field="state" data-checkbox="true"></th>
				                                                <th data-field="id">Codigo</th>
				                                                <th data-field="name" data-editable="true">Login</th>
				                                                <th data-field="company" data-editable="true">Nombres</th>
				                                                <th data-field="price" data-editable="true">Apellidos</th>
																<th data-field="date" data-editable="true">Email</th>
																<th data-field="task" data-editable="true">Tipo</th>
																<th data-field="email" data-editable="true">Estado</th>
				                                                <th data-field="action">Acciones</th>
				                                            </tr>
				                                        </thead>
				                                        <tbody>
				                                            <?php foreach ($users as $row): ?>
																<tr>
																	<td></td>
																	<td><?= $row->id ?></td>
																	<td><?= $row->username ?></td>
																	<td><?= $row->first_name ?></td>
																	<td><?= $row->last_name ?></td>
																	<td><?= $row->email ?></td>
																	<td><?= $row->state == 1 ? 'Activo' : 'Inactivo' ?></td>
																	<td><?= $row->type == 5 ? 'Admin' : 'User' ?></td>
																	<td class="datatable-ct">
																		<button style="margin: 0.2em;" data-toggle="tooltip"class="pd-setting-ed" data-original-title="Edit" onclick="<?php echo 'modify('.$row->id.')'; ?>"><i title="Editar" class="fa fa-pencil" aria-hidden="true"></i></button>
																		<button style="margin: 0.2em;" data-toggle="tooltip" title="" class="pd-setting-ed" data-original-title="Trash" onclick="<?php echo 'delete_user('.$row->id.')'; ?>"><i title="Eliminar" class="fa fa-trash-o" aria-hidden="true"></i></button>
																	</td>
																</tr>
															<?php endforeach; ?>
				                                        </tbody>
				                                    </table>
				                                </div>
				                            </div>
				                        </div>
							        </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
				</div>
			</div>
			<br/>
			<?= $footer ?>
		</div>
		<div id="WarningModalhdbgcl" class="modal modal-adminpro-general Customwidth-popup-WarningModal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-color-modal bg-color-3">
                        <h4 class="modal-title">Modificar Usuario</h4>
                        <div class="modal-close-area modal-close-df">
                            <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                        </div>
                    </div>
                    <div class="modal-body" style="text-align: left;">
                    	<div id="error"></div>
                    	<?php
							echo form_open('users/edit',array('method' => 'POST', 'id' => 'loginFormEdit'));
						?>
						<div class="form-group col-lg-12" id="id_user">
							<input type="hidden" name="id" value="id_user" class="form-control">
						</div>
						<?= $user_create ?>
						<div class="form-group col-lg-12">
							<div id="type">
								<span class="text-danger" style="display: none;"></span>
							</div>
							<div id="state">
								<span class="text-danger" style="display: none;"></span>
							</div>
                        </div>
						<div class="text-center">
							<?php
								echo form_submit('submit', 'Editar', array('class' => 'btn btn-lg btn-success loginbtn'));
							?>
						</div>
						<?php
							echo form_close();
						?>
                    </div>
                    <div class="modal-footer">
                        <a data-dismiss="modal" href="#">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="DangerModalhdbgcl" class="modal modal-adminpro-general FullColor-popup-DangerModal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-color-modal bg-color-4">
                        <h4 class="modal-title">Eliminar Usuario</h4>
                        <div class="modal-close-area modal-close-df">
                            <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                        </div>
                    </div>
                    <div class="modal-body">
                        <span class="adminpro-icon adminpro-danger-error modal-check-pro information-icon-pro"></span>
                        <h4>¿Desea eliminar este registro de usuario?</h4>
                        <p>Si elimina el usuario, este no podra volver a ingresar al sistema</p>
                    </div>
                    <div class="modal-footer">
                        <?php
							echo form_open('users/delete',array('method' => 'GET', 'id' => 'loginFormDelete'));
						?>
						<?php
							echo form_submit('submit', 'Eliminar', array('class' => 'btn btn-lg btn-success loginbtn'));
						?>
						<?php
							echo form_close();
						?>
                    </div>
                </div>
            </div>
        </div>
		<?= $script ?>
		
		<!-- data table JS -->
		<script src="<?php echo base_url();?>assets/js/data-table/bootstrap-table.js"></script>
		<script src="<?php echo base_url();?>assets/js/data-table/tableExport.js"></script>
		<script src="<?php echo base_url();?>assets/js/data-table/data-table-active.js"></script>
		<!--
			<script src="<?php echo base_url();?>assets/js/data-table/bootstrap-table-editable.js"></script>
		-->
		<script src="<?php echo base_url();?>assets/js/data-table/bootstrap-editable.js"></script>
		<script src="<?php echo base_url();?>assets/js/data-table/bootstrap-table-resizable.js"></script>
		<script src="<?php echo base_url();?>assets/js/data-table/colResizable-1.5.source.js"></script>
		<script src="<?php echo base_url();?>assets/js/data-table/bootstrap-table-export.js"></script>

		<script type="text/javascript" src="<?php echo base_url();?>assets/js/users/index.js"></script>
	</body>
</html>