<!DOCTYPE html>
<html>
	<head>
		<?= $meta ?>
	    <title>AppCI | Home</title>
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
	                                            <li>Home</li>
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
				<div class="row admin text-center">
	                <div class="col-md-12">
	                    <div class="row">
	                    	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
	                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
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
	                                <div class="widget-head-info-box">
		                                <div class="persoanl-widget-hd">
		                                    <h2 class="text-left text-uppercase"><b>Bienvenid@</b></h2>
		                                </div>
		                                <?php
											echo img(
											    array(
											        'src' => 'assets/img/code.jpg',
											        'alt' => 'profile',
											        'class' => 'img-circle circle-border m-b-md',
											        'width' => '100',
											        'height' => '100',
											    )
											);
										?>
		                            </div>
		                            <div class="widget-text-box">
		                                <h4>Usuario actual conectado</h4>
		                                <p><?= $this->session->first_name.' '.$this->session->last_name ?></p>
		                                <?php
											$path = './assets/files/'.$this->session->id.'/';
											if(file_exists($path) and $files !== false):
												foreach ($files as $row) :
										?>
												<div>
													<a href="<?php echo '../'.$row->url; ?>">Ver</a><?php echo ' - '.$row->file_name.' - ' ?>
													<a href="<?php echo base_url('files/delete/'.$row->id.'/'.$this->session->id); ?>">Eliminar</a>
												</div>
										<?php 
												endforeach;
											endif ;
										?>
		                            </div>
	                            </div>
	                        </div>
	                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
	                    </div>
	                </div>
	            </div>
			</div>
			<br/>
			<?= $footer ?>
		</div>
		<?= $script ?>
	</body>
</html>