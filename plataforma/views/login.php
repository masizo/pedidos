<html lang="es">
    <head>
		<meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>LOGIN PANEL</title>        
        <link rel="shortcut icon" href="<?php echo base_url();?>folders/images/favicon.ico"/> 
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>folders/css/login.css"/>
        <script src="<?php echo base_url();?>folders/js/modernizr.custom.63321.js"></script>        
		<style>
			body {
				background: #e1c192 url(<?php echo base_url();?>folders/images/wood_pattern.jpg);
			}
		</style>
    </head>
    <body>
        <div class="container">			
			<section class="main">
				<form method="POST" class="form-2">
			    <?php echo form_open('user/login');?>
					<h1><span class="sign-up">Iniciar Sesion</span></h1>
					<p class="float">
						<label for="login"><i class="icon-user"></i>Usuario</label>
						<input type="text" name="userlogin" placeholder="Usuario" value="<?= set_value('userlogin'); ?>" required>
					</p>
					<p class="float">
						<label for="password"><i class="icon-lock"></i>Contraseña</label>
						<input type="password" name="passwordlogin" placeholder="Contraseña" class="showpassword" value="<?= set_value('passwordlogin'); ?>" required>
					</p>
					<?if(isset($error)){ ?>			         
			           <p class="error"> <?echo $error;?> </p>
		               <?}?>
		             <?php echo validation_errors('<div class="error">', '</div>'); ?>
					<p class="clearfix">						
					 	<input type="submit" name="submit" value="Entrar">
					</p>
				<?php echo form_close();?>
				</form>​​
			</section>			
        </div>
		<!-- jQuery if needed -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript">
			$(function(){
			    $(".showpassword").each(function(index,input) {
			        var $input = $(input);
			        $("<p class='opt'/>").append(
			            $("<input type='checkbox' class='showpasswordcheckbox' id='showPassword' />").click(function() {
			                var change = $(this).is(":checked") ? "text" : "password";
			                var rep = $("<input placeholder='Contraseña' type='" + change + "' />")
			                    .attr("id", $input.attr("id"))
			                    .attr("name", $input.attr("name"))
			                    .attr('class', $input.attr('class'))
			                    .val($input.val())
			                    .insertBefore($input);
			                $input.remove();
			                $input = rep;
			             })
			        ).append($("<label for='showPassword'/>").text("Ver contraseña")).insertAfter($input.parent());
			    });

			    $('#showPassword').click(function(){
					if($("#showPassword").is(":checked")) {
						$('.icon-lock').addClass('icon-unlock');
						$('.icon-unlock').removeClass('icon-lock');    
					} else {
						$('.icon-unlock').addClass('icon-lock');
						$('.icon-lock').removeClass('icon-unlock');
					}
			    });
			});
		</script>
    </body>
</html>
