<!DOCTYPE html>
<html>
<head>
	<?= $meta ?>
    <title>AppCI | Login</title>
    <?= $favicon ?>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">

	<?= $css ?>

	<!-- modernizr JS -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/vendor/modernizr-2.8.3.min.js" ></script>
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
                <div class="text-center m-b-md custom-login">
                    <h3>Login</h3>
                </div>
                <div class="hpanel">
                    <div class="panel-body">
                        <?php if($msj = $this->session->flashdata('msj')): ?>
                        <?php $msj_ex = explode(",", $msj); ?>
                        <div id="alert" class="alert <?php echo $msj_ex[1]; ?>" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <span><?php echo $msj_ex[0]; ?></span>
                        </div>
                        <?php endif; ?>
                        <div id="error"></div>
                        <?php
							echo form_open('users/validate',array('method' => 'post', 'id' => 'loginForm'));
						?>
                            <div class="form-group" id="username">
                            	<?php
									echo form_label('Login','username', array('class' => 'control-label'));
									echo form_input(array('type' => 'text', 'name' => 'username', 'placeholder' => 'Username o email', 'class' => 'form-control', 'class' => 'form-control', 'required', 'value' => set_value('username')));
								?>
                                <span class="text-danger" style="display: none;"></span>
                            </div>
                            <div class="form-group" id="password">
                            	<?php
									echo form_label('Contraseña','password', array('class' => 'control-label'));
									echo form_input(array('type' => 'password', 'name' => 'password', 'placeholder' => '**********', 'class' => 'form-control', 'class' => 'form-control'));
								?>
                                <span class="text-danger" style="display: none;"></span>
                            </div>
                            <?php
								echo form_submit('submit', 'Ingresar', array('class' => 'btn btn-success btn-block loginbtn'));
							?>
                        <?php
							echo form_close();
						?>
                        <div style="margin-top: 1em;" class="text-center">
                            <strong><a href="<?php echo base_url('users/recover'); ?>">Olvide mi contraseña</a></strong>
                        </div>
                        <hr/>
                        <div class="text-center">
                        	No tienes cuenta? registrate <strong><a href="<?php echo base_url('users/register'); ?>">aqui</a></strong>
                        </div>
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

    <!-- Animaciones con wow js (depende de animated.css y se debe crear el objeto en js) -->
    <!--<div class="wowload rollIn" style="text-align: center;">
        <h2>Esto es una prueba</h2>
    </div>-->
    <?= $script ?>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/users/login.js"></script>
</body>
</html>