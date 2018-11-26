<!DOCTYPE html>
<html>
	<head>
		<?= $meta ?>
	    <title>AppCI | File Upload</title>
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
	                                            <li><a href="<?php echo base_url('files/index'); ?>">Files</a> <span class="bread-slash">/</span>
	                                            </li>
	                                            <li><span class="bread-blod">Upload</span>
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
				                        <?php if(count($msj['success']) !== 0): ?>
				                        <div id="alert" class="alert alert-success" role="alert">
				                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				                                <span aria-hidden="true">&times;</span>
				                            </button>
			                            	<?php foreach($msj['success'] as $msj_success): ?>
			                            		<span><?php echo $msj_success ?></span><br/>
			                            	<?php endforeach ?>
				                        </div>
				                        <?php endif; ?>

				                        <?php if(count($msj['error_database']) !== 0): ?>
				                        <div id="alert" class="alert alert-warning" role="alert">
				                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				                                <span aria-hidden="true">&times;</span>
				                            </button>
			                            	<?php foreach($msj['error_database'] as $msj_warning): ?>
			                            		<span><?php echo $msj_warning ?></span><br/>
			                            	<?php endforeach ?>
				                        </div>
				                        <?php endif; ?>

				                        <?php if(count($msj['error_upload']) !== 0): ?>
				                        <div id="alert" class="alert alert-danger" role="alert">
				                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				                                <span aria-hidden="true">&times;</span>
				                            </button>
			                            	<?php foreach($msj['error_upload'] as $msj_danger): ?>
			                            		<?php echo $msj_danger ?>
			                            	<?php endforeach ?>
				                        </div>
				                        <?php endif; ?>
			                        <?php endif; ?>
	                            	<div id="error"></div>
	                            	<h2>Cargar archivos</h2>
	                            	<br/>
	                            	<?php
										echo form_open_multipart('users/file_upload',array('method' => 'post', 'id' => 'loginForm'));
									?>
									<div class="form-group col-lg-12" id="file_date">
										<?php
											echo form_label('Fecha', 'file_date');
											echo form_input(array('type' => 'date', 'name' => 'file_date', 'class' => 'form-control', 'value' => set_value('file_date')));
										?>
										<span class="text-danger" style="display: none;"></span>
									</div>
									<div class="form-group col-lg-12" id="type_file">
										<?php
											echo form_label('Tipo Archivo', 'type_file');
											echo '<div class="chosen-select-single mg-b-20">';
											echo 
												form_dropdown('type_file',
													array(
														'Evidencia Medico General' => 'Evidencia Medico General',
														'Evidencia Especialista' => 'Evicencia Especialista',
														'Evidencia Cirujano' => 'Evidencia Cirujano'
													), 
													'', 
													array(
														'class' => 'chosen-select',
														'tabindex' => '-1'
													)
												);
											echo '</div>';
										?>
										<span class="text-danger" style="display: none;"></span>
									</div>
									<div class="form-group col-lg-12" id="file">
										<?php
											echo form_label('Archivo', 'file');
										?>
                                        <input type="file" class="form-control" id="archivo[]" name="archivo[]" multiple="">
                                	</div>
									<div class="text-center">
										<?php
											echo form_submit('submit', 'Registrar', array('class' => 'btn btn-success loginbtn', 'name' => 'fileSubmit'));
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
		<div id="WarningModalhdbgcl" class="modal modal-adminpro-general Customwidth-popup-WarningModal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-color-modal bg-color-3"></div>
                    <div class="modal-body" style="text-align: left;">
                    	<div class="preloader-wrapper">
						    <div class="preloader">
						        <img src="<?php echo base_url();?>assets/img/preloader.gif" alt="NILA">
						    </div>
						</div>
                    </div>
                    <div class="modal-footer"></div>
                </div>
            </div>
        </div>
		<?= $script ?>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/files/massive_upload.js"></script>
	</body>
</html>