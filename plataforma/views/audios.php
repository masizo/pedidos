
        <!-- :::::::::::::::::: Notas y Mas Secciones ::::::::::::::::::: -->
        <div class="large-3 columns centrado seleccion1">
         

			<div class="centrado">
				<img src="" alt="">
				Escuchanos en vivo
				<div class="h50">
					<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="191" height="46" bgcolor="#FFFFFF">
					<param name="movie" value="http://www.museter.com/ffmp3-config.swf" />
					<param name="flashvars" value="url=http://tuasesorweb.com:8050/;&lang=sp&codec=mp3&volume=100&introurl=&autoplay=false&traking=true&jsevents=false&buffering=5&skin=http://www.museter.com/skins/compact/ffmp3-compact.xml&title=MAXIMA%2098.9&welcome=RADIOTRECE%20DF" />
					<param name="wmode" value="window" />
					<param name="allowscriptaccess" value="always" />
					<param name="scale" value="noscale" />
					<embed src="http://www.museter.com/ffmp3-config.swf" flashvars="url=http://tuasesorweb.com:8050/;&lang=sp&codec=mp3&volume=100&introurl=&autoplay=false&traking=true&jsevents=false&buffering=5&skin=http://www.museter.com/skins/compact/ffmp3-compact.xml&title=RADIOTRECE%20DF&welcome=MAXIMA%2098.9" width="191" scale="noscale" height="46" wmode="window" bgcolor="#FFFFFF" allowscriptaccess="always" type="application/x-shockwave-flash" />
					</object>	
				</div>
			</div>

			<hr>
			<?php foreach($audios as $audios_item): ?>
			<div class="">
				<div class="titulo3 centrado"><?=$audios_item['titulo'];?></div>
				<img src="<?php echo base_url('folders/images/');?>/audios/<?= $audios_item['imagen'] ?> " alt="" class="centrado m10 img-ajustada">
				<audio controls class="m10 w90">
				  <source src="<?php echo base_url('folders/images/');?>/audios/<?= $audios_item['audio'] ?>" type="audio/ogg">
				  <source src="<?php echo base_url('folders/images/');?>/audios/<?= $audios_item['audio'] ?>" type="audio/mpeg">
				Your browser does not support the audio element.
				</audio>
			</div>
			<hr>
		<?php endforeach?>


			

 

