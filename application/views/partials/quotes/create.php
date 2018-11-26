<div class="form-group col-lg-12" id="quote_date">
	<?php
		echo form_label('Fecha', 'quote_date');
		echo form_input(array('type' => 'date', 'name' => 'quote_date', 'class' => 'form-control', 'value' => set_value('quote_date')));
	?>
	<span class="text-danger" style="display: none;"></span>
</div>
<div class="form-group col-lg-12" id="type_quote">
	<?php
		echo form_label('Tipo Cita', 'type_quote');
		echo '<div class="chosen-select-single mg-b-20">';
		echo 
			form_dropdown('type_quote', 
				array(
					'Medico General' => 'Medico General',
					'Especialista' => 'Especialista',
					'Cirujano' => 'Cirujano'
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
<div class="form-group col-lg-12" id="state_quote">
	<?php
		echo form_label('Estado', 'state_quote');
		echo '<div class="chosen-select-single mg-b-20">';
		echo 
			form_dropdown('state_quote', 
				array(
					'1' => 'Activo',
					'0' => 'Inactivo'
				), 
				'1', 
				array(
					'class' => 'chosen-select',
					'tabindex' => '-1'
				)
			);
		echo '</div>';
	?>
	<span class="text-danger" style="display: none;"></span>
</div>
<div class="form-group col-lg-12" id="description">
	<?php
		echo form_label('Descripcion Detallada', 'description');
		echo form_textarea(array('name' => 'description', 'placeholder' => 'Ej. Cita para revision general', 'class' => 'form-control', 'value' => set_value('description')));
	?>
	<span class="text-danger" style="display: none;"></span>
</div>