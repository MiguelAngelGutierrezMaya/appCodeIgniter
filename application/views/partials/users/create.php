<div class="form-group col-lg-12" id="first_name">
	<?php
		echo form_label('Nombres', 'first_name');
		echo form_input(array('type' => 'text', 'name' => 'first_name', 'placeholder' => 'Ej. Alex Pierce', 'class' => 'form-control', 'value' => set_value('first_name')));
	?>
	<span class="text-danger" style="display: none;"></span>
</div>
<div class="form-group col-lg-12" id="last_name">
	<?php
		echo form_label('Apellidos', 'last_name');
		echo form_input(array('type' => 'text', 'name' => 'last_name', 'placeholder' => 'Ej. Alex Pierce', 'class' => 'form-control', 'value' => set_value('last_name')));
	?>
	<span class="text-danger" style="display: none;"></span>
</div>
<div class="form-group col-lg-12" id="username">
	<?php
		echo form_label('Login', 'username');
		echo form_input(array('type' => 'text', 'name' => 'username', 'placeholder' => 'Ej. alex.pierce', 'class' => 'form-control', 'value' => set_value('username')));
	?>
	<span class="text-danger" style="display: none;"></span>
</div>
<div class="form-group col-lg-12" id="email">
	<?php
		echo form_label('Correo Electronico', 'email');
		echo form_input(array('type' => 'email', 'name' => 'email', 'placeholder' => 'example@example.com', 'class' => 'form-control', 'value' => set_value('email')));
	?>
	<span class="text-danger" style="display: none;"></span>
</div>