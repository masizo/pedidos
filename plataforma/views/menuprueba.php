<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>menu de prueba</title>
	<script type="text/javascript" src='http://code.jquery.com/jquery-1.10.1.min.js'></script>
	<script type="text/javascript" src='http://code.jquery.com/jquery-migrate-1.2.1.min.js'></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>folders/css/geekgenier.css"/>
	<script>
	$(document).ready(function(){
		$("#boton-1").click(function(evento){
			evento.preventDefault();
			$("#iframe").attr("src", "noticia");
			$("#boton-1").css("opacity", "1.0");
			$("#boton-2").css("opacity", "0.5");
			$("#boton-3").css("opacity", "0.5");
			$("#boton-5").css("opacity", "0.5");


		});
		$("#boton-2").click(function(evento){
			evento.preventDefault();
			$("#iframe").attr("src", "audios/audio");
			$("#boton-1").css("opacity", "0.5");
			$("#boton-2").css("opacity", "1.0");
			$("#boton-3").css("opacity", "0.5");
			$("#boton-5").css("opacity", "0.5");
		});
		$("#boton-3").click(function(evento){
			evento.preventDefault();
			$("#iframe").attr("src", "admin/perfil/edit/1");
			$("#boton-1").css("opacity", "0.5");
			$("#boton-2").css("opacity", "0.5");
			$("#boton-3").css("opacity", "1.0");
			$("#boton-5").css("opacity", "0.5");

		});
		$("#boton-5").click(function(evento){
			evento.preventDefault();
			$("#iframe").attr("src", "conductor/conductor");
			$("#boton-1").css("opacity", "0.5");
			$("#boton-2").css("opacity", "0.5");
			$("#boton-3").css("opacity", "0.5");
			$("#boton-5").css("opacity", "1.0");

		});				
    });
	</script>

	<link type="text/css" href="<? echo base_url('folders/css/panel.css'); ?>" rel="Stylesheet" />
	<link href='http://fonts.googleapis.com/css?family=Advent+Pro' rel='stylesheet' type='text/css'>


</head>
<body>
		<a class="enlaceajax boton_panel"><div id="boton-1" class="texto_boton" > Noticias </div> </a>
		<a class="enlaceajax boton_panel"><div id="boton-2" class="texto_boton" > Audios </div> </a>
		<a class="enlaceajax boton_panel"><div id="boton-3" class="texto_boton" > Perfil </div> </a>
		<a class="enlaceajax boton_panel"><div id="boton-5" class="texto_boton" > Conductores </div> </a>
	<a href="<?= base_url('admin/cerrar_sesion') ?>"><input type="button" id="boton-4" class="enlaceajax cerrar_sesion" value="Cerrar Sesion"></a>
	<div id="contiene_frame" ><iframe id="iframe" class="w100 h500" src="" frameborder="0" seamless></iframe></div>
</body>
</html>