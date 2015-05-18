
<div class="row">
	<div class="col-md-2 col-md-offset-7 derecha">
		<!--  inicio formulario   -->
		<?php
			echo $Tipouser1;
			echo form_open('user/registro');

			echo form_error('nombre');
			echo form_label('Nombre','nombre');echo'<br>';
			
			
			echo form_error('contra');
			echo form_label('Contraseña','contra');echo'<br>';
			
			
			echo form_error('ccontra');
			echo form_label('Confirma contraseña','ccontra');echo'<br>';
			
			
			echo form_error('correo');
			echo form_label('Correo','correo');echo'<br>';
			
			
			echo form_error('estado');
			echo form_label('Estado','estado');echo'<br>';
			
			
			
		?>
	</div>

	<div class="col-md-3">
		<?php
		echo form_input('nombre'); echo'<br>';
		echo form_password('contra'); echo'<br>';
		echo form_password('ccontra'); echo'<br>';
		echo form_input('correo'); echo'<br>';
		echo form_input('estado'); echo'<br>';


		?>

	</div>
</div>

<div class="row">
	<div class="col-md-3 col-md-offset-8">
		<?php
			echo form_label('Tipo', 'tipo');echo'<br>';

			echo form_error('Tipouser1');
			echo form_label('Comprador', 'comprador');
			echo form_checkbox('Tipouser1','acceptar', TRUE);echo'<br>';
			echo form_label('Vendedor', 'vendedor');
			echo form_checkbox('Tipouser2','acceptar', FALSE);echo'<br>';
			echo form_label('Colaorador', 'colaborador');
			echo form_checkbox('Tipouser3','acceptar', FALSE);echo'<br><br>';
			
			echo form_submit('registro','Registro');

			echo form_close();
		?>
	</div>
</div>