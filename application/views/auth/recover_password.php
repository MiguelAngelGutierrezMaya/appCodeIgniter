<!DOCTYPE html>
<html>
<head>
	<?= $meta ?>
    <title>AppCI | Recupera</title>
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
                    <h3>Recuperar Contraseña</h3>
                </div>
                <div class="hpanel">
                    <div class="panel-body">
                        <div id="error"></div>
                        <?php
							echo form_open('auth/validate_recover_password',array('method' => 'post', 'id' => 'loginForm'));
						?>
                            <div class="form-group col-lg-12">
                                <input type="hidden" name="token" value="<?php echo $token ?>" class="form-control">
                                <input type="hidden" name="token_password" value="<?php echo $token_password ?>" class="form-control">
                            </div>
                            <div class="form-group col-lg-12" id="password">
                                <?php
                                    echo form_label('Contraseña', 'password');
                                    echo form_password(array('type' => 'password', 'name' => 'password', 'placeholder' => '**********', 'class' => 'form-control example1', 'id' => 'password1', 'value' => set_value('password')));
                                ?>

                                <span class="text-danger" style="display: none;"></span>
                                <div class="pwstrength_viewport_progress" style="margin-top: 1em"></div>
                            </div>
                            <div class="form-group col-lg-12" id="confirm_password">
                                <?php
                                    echo form_label('Confirmar Contraseña', 'confirm_password');
                                    echo form_password(array('type' => 'password', 'name' => 'confirm_password', 'placeholder' => '**********', 'class' => 'form-control', 'value' => set_value('confirm_password')));
                                ?>

                                <span class="text-danger" style="display: none;"></span>
                            </div>
                            <?php
								echo form_submit('submit', 'Recuperar', array('class' => 'btn btn-success btn-block loginbtn'));
							?>
                        <?php
							echo form_close();
						?>
                        <hr/>
                        <div class="text-center">
                        	No tienes cuenta? registrate <strong><a href="<?php echo base_url('auth/register'); ?>">aqui</a></strong>
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
    <?= $modal_preloader ?>
    <?= $script ?>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/auth/recover_password.js"></script>
</body>
</html>