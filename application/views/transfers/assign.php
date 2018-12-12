<!DOCTYPE html>
<html>
	<head>
		<?= $meta ?>
	    <title>AppCI | User Create</title>
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
	                                            <li><a href="<?php echo base_url('transfers/index'); ?>">Transfers</a> <span class="bread-slash">/</span>
	                                            </li>
	                                            <li><span class="bread-blod">Assign</span>
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
	                            	<div id="error"></div>
	                            	<h2>Transferencia</h2>
	                            	<br/>
	                            	<?php
										echo form_open('transfers/validate_create',array('method' => 'post', 'id' => 'loginForm'));
									?>
									<div class="form-group col-lg-12" id="origin_place">
										<?php
											echo form_label('Origen', 'origin_place');
											echo '<div class="chosen-select-single mg-b-20">';
											echo 
												form_dropdown('origin_place',
													array(
														'none' => 'Seleccione una opcion',
														'10.401961,-75.555327,Bocagrande' => 'Bocagrande, Cartagena',
														'10.3950965,-75.56224,El Laguito' => 'El Laguito, Cartagena',
														'10.3942723,-75.551688,Castillogrande' => 'Castillogrande, Cartagena',
														'10.4199938,-75.545866,Getsemaní,' => 'Getsemaní, Cartagena',
														'10.4119699,-75.534948,Manga' => 'Manga, Cartagena',
														'10.471126,-75.49687,La Boquilla' => 'La Boquilla, Cartagena',
														'10.3898213,-75.529126,Isla Manzanillo' => 'Isla Manzanillo, Cartagena',
														'10.4331537,-75.541261,El Cabrero' => 'El Cabrero, Cartagena',
														'10.4050473,-75.518207,Bruselas' => 'Bruselas, Cartagena',
														'10.41191,-75.511292,Boston' => 'Boston, Cartagena',
														'10.4200923,-75.518207,La María' => 'La María, Cartagena',
														'10.514071,-75.498642,Manzanillo' => 'Manzanillo, Cartagena'
													),
													'none',
													array(
														'class' => 'chosen-select',
														'tabindex' => '-1'
													)
												);
											echo '</div>';
										?>
										<span class="text-danger" style="display: none;"></span>
									</div>
									<div class="form-group col-lg-12" id="destination_place">
										<?php
											echo form_label('Destino', 'destination_place');
											echo '<div class="chosen-select-single mg-b-20">';
											echo 
												form_dropdown('destination_place',
													array(
														'none' => 'Seleccione una opcion',
														'10.401961,-75.555327,Bocagrande' => 'Bocagrande, Cartagena',
														'10.3950965,-75.56224,El Laguito' => 'El Laguito, Cartagena',
														'10.3942723,-75.551688,Castillogrande' => 'Castillogrande, Cartagena',
														'10.4199938,-75.545866,Getsemaní,' => 'Getsemaní, Cartagena',
														'10.4119699,-75.534948,Manga' => 'Manga, Cartagena',
														'10.471126,-75.49687,La Boquilla' => 'La Boquilla, Cartagena',
														'10.3898213,-75.529126,Isla Manzanillo' => 'Isla Manzanillo, Cartagena',
														'10.4331537,-75.541261,El Cabrero' => 'El Cabrero, Cartagena',
														'10.4050473,-75.518207,Bruselas' => 'Bruselas, Cartagena',
														'10.41191,-75.511292,Boston' => 'Boston, Cartagena',
														'10.4200923,-75.518207,La María' => 'La María, Cartagena',
														'10.514071,-75.498642,Manzanillo' => 'Manzanillo, Cartagena'
													),
													'none',
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
											echo form_submit('submit', 'Consultar', array('class' => 'btn btn-success loginbtn'));
										?>
									</div>
									<?php
										echo form_close();
									?>
	                            </div>
	                        </div>
	                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
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
                        <h4 class="modal-title">Ruta Transferencia</h4>
                        <div class="modal-close-area modal-close-df">
                            <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                        </div>
                    </div>
                    <div class="modal-body" style="text-align: left;">
                    	<div id="error"></div>
                    	<div class="row">
                			<div id="origin" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    			Origen:
                    			<span class="text-danger"></span>
                    		</div>
                    		<div id="destination" class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    			Destino:
                    			<span class="text-danger"></span>
                    		</div>
                    		<br/>
                    		<div id="map" class="col-lg-12 col-md-12 col-sm-6 col-xs-12"></div>
                    		<br/>
                    	</div>
                    	<?php
							echo form_open('assign/register',array('method' => 'POST', 'id' => 'loginFormAssign'));
						?>
						<div class="form-group col-lg-12" id="distance">
							<?php
								echo form_label('Distancia', 'distance');
								echo form_input(array('type' => 'text', 'name' => 'distance', 'placeholder' => 'Ej. 1500km', 'class' => 'form-control', 'readonly', 'value' => set_value('distance')));
							?>
							<span class="text-danger" style="display: none;"></span>
                        </div>
                        <div class="form-group col-lg-12" id="cobro">
							<?php
								echo form_label('Valor cobro', 'cobro');
								echo form_input(array('type' => 'text', 'name' => 'cobro', 'placeholder' => 'Ej. 50000', 'class' => 'form-control', 'value' => set_value('cobro')));
							?>
							<span class="text-danger" style="display: none;"></span>
                        </div>
						<div class="text-center">
							<?php
								echo form_submit('submit', 'Guardar', array('class' => 'btn btn-lg btn-success loginbtn'));
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
		<?= $script ?>
		<script type="text/javascript" src="<?php echo base_url();?>assets/js/transfers/assign.js"></script>
		<script id="script_data"></script>
	</body>
</html>