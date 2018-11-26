<!DOCTYPE html>
<html>
	<head>
		<?= $meta ?>
	    <title>AppCI | Users Excel</title>
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
	                                            <li><a href="<?php echo base_url('users/index'); ?>">Users</a> <span class="bread-slash">/</span>
	                                            </li>
	                                            <li><span class="bread-blod">Excel</span>
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
	                    	<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
	                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	                            <div class="admin-content analysis-progrebar-ctn res-mg-t-15">
	                            	<?php if($msj = $this->session->flashdata('msj')): ?>
	                            	<?php $msj_ex = explode(",", $msj); ?>
									<div id="alert" class="alert <?php echo $msj_ex[1]; ?>" role="alert">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
										<span>
											<?php echo $msj_ex[0]; ?>
											<?php echo validation_errors(); ?>
										</span>
									</div>
									<?php endif; ?>
	                            	<h2>Reporte Usuarios</h2>
	                            	<br/>
	                            	<?php
										echo form_open('users/excel_report',array('method' => 'post', 'id' => 'loginForm'));
									?>
									<div class="form-group col-lg-12" id="state">
										<?php
											echo form_label('Estado', 'state');
											echo '<div class="chosen-select-single mg-b-20">';
											echo 
												form_dropdown('state',
													array(
														'2' => 'Seleccione el estado',
														'1' => 'Activo',
														'0' => 'Inactivo',
													),
													set_value('state'),
													array(
														'class' => 'chosen-select',
														'tabindex' => '-1'
													)
												);
											echo '</div>';
										?>
										<span class="text-danger" style="display: none;"></span>
									</div>
									<div class="form-group col-lg-12" id="type">
										<?php
											echo form_label('Formato', 'type');
											echo '<div class="chosen-select-single mg-b-20">';
											echo 
												form_dropdown('type',
													array(
														'2' => 'Seleccione el formato',
														'xls' => 'xls',
														'xlsx' => 'xlsx',
													),
													set_value('type'),
													array(
														'class' => 'chosen-select',
														'tabindex' => '-1'
													)
												);
											echo '</div>';
										?>
										<span class="text-danger" style="display: none;"></span>
									</div>
									<div class="text-center">
										<?php
											echo form_submit('submit', 'Generar', array('class' => 'btn btn-success loginbtn'));
										?>
									</div>
									<?php
										echo form_close();
									?>
	                            </div>
	                        </div>
	                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
	                    </div>
	                </div>
				</div>
			</div>
			<br/>
			<?= $footer ?>
		</div>
		<?= $script ?>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/users/excel.js"></script>
	</body>
</html>