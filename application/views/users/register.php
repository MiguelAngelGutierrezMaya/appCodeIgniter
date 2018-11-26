<!DOCTYPE html>
<html>
<head>
	<?= $meta ?>
    <title>AppCI | Register</title>
    <?= $favicon ?>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">

	<?= $css ?>

	<!-- modernizr JS -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/vendor/modernizr-2.8.3.min.js" ></script>

	<!-- google api Recaptcha -->
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
	<div class="color-line"></div>
    <div class="row">
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12"></div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="header-top-menu tabl-d-n">
                <ul class="nav navbar-nav mai-top-nav" style="background-color: black;">
                    <?php foreach ($menu as $item): ?>
						<li class="nav-item"><a href="<?php echo $item['url']; ?>" class="nav-link"><?= $item['title'] ?></a></li>
					<?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12"></div>
    </div>
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                            	<?php foreach ($menu as $item): ?>
									<li><a href="<?php echo $item['url']; ?>"><?= $item['title'] ?></a></li>
								<?php endforeach; ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
            <div class="col-md-4 col-md-4 col-sm-4 col-xs-12">
                <div class="text-center custom-login">
                    <h3>Registro</h3>
                </div>
                <div class="hpanel">
                    <div class="panel-body">
						<div id="error"></div>
                    	<?php
							echo form_open('users/validate_create',array('method' => 'post', 'id' => 'loginForm'));
						?>
						<?= $user_create ?>
                        <div class="form-group col-lg-12" id="container_password">
                            <?php
                                echo form_label('Contraseña', 'password');
                                echo form_password(array('type' => 'password', 'name' => 'password', 'placeholder' => '**********', 'class' => 'form-control example1', 'id' => 'password1', 'value' => set_value('password')));
                            ?>
                            <div id="password">
                                <span class="text-danger" style="display: none;"></span>
                            </div>
                            <div class="pwstrength_viewport_progress" style="margin-top: 1em"></div>

                            <?php
                                echo form_label('Confirmar Contraseña', 'confirm_password');
                                echo form_password(array('type' => 'password', 'name' => 'confirm_password', 'placeholder' => '**********', 'class' => 'form-control', 'value' => set_value('confirm_password')));
                            ?>
                            <div id="confirm_password">
                                <span class="text-danger" style="display: none;"></span>
                            </div>
                        </div>
						<div class="form-group col-lg-12">
							<center>
								<div class="g-recaptcha col-md-0" data-sitekey="6Le5m1IUAAAAAFhKmA0RExjRxu2pStAL83UTA5jj"></div>
							</center>
						</div>
						<div class="text-center">
							<?php
								echo form_submit('submit', 'Registrar', array('class' => 'btn btn-success loginbtn'));
							?>
						</div>
						<?php
							echo form_close();
						?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
        </div>
        <br/>
        <div class="row">
            <div class="col-md-12 text-center">
                <p>Copyright &copy; 2018 <a href="https://colorlib.com/wp/templates/">Colorlib</a> All rights reserved. Desarrollo por: Miguel Angel Gutierrez Maya</p>
            </div>
        </div>
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
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/users/register.js"></script>
</body>
</html>