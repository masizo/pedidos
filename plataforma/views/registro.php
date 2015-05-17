<html>
	<head>
			<title>::: Pedidos Nayarit :::</title>
	</head>
<body>

<h1> Registro de Usuario </h1>

<!--  inicio formulario   -->
<?php
	echo form_open('user/registro');

	echo form_error('nombre');
	echo form_label('Nombre','nombre');
	echo form_input('nombre'); echo'<br><br>';
	
	echo form_error('contra');
	echo form_label('Contraseña','contra');
	echo form_password('contra'); echo'<br><br>';
	
	echo form_error('ccontra');
	echo form_label('Confirma contraseña','ccontra');
	echo form_password('ccontra'); echo'<br><br>';
	
	echo form_error('correo');
	echo form_label('Correo','correo');
	echo form_input('correo'); echo'<br><br>';
	
	echo form_error('estado');
	echo form_label('Estado','estado');
	echo form_input('estado'); echo'<br><br>';
	
	echo form_label('Tipo', 'tipo');echo'<br>';

	echo form_error('Tipouser1');
	echo form_error('Tipouser2');
	echo form_error('Tipouser3');
	echo form_label('Comprador', 'comprador');
	echo form_checkbox('Tipouser1','acceptar', FALSE);echo'<br>';
	echo form_label('Vendedor', 'vendedor');
	echo form_checkbox('Tipouser2','acceptar', FALSE);echo'<br>';
	echo form_label('Colaorador', 'colaborador');
	echo form_checkbox('Tipouser3','acceptar', FALSE);echo'<br><br>';
	
	echo form_submit('registro','Registro');

	echo form_close();
?>


</body>

</html>