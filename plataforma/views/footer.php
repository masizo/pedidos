</div> <!-- Cerrando contenedor -->

 <footer class="row">
        <div class="large-12 columns"><hr />
            <div class="row">
              <a href="" target="_blank">
              <div class="large-12 columns centrado seleccion1">
                  Derechos Reservados
              </div>
              </a>
 
              
 
            </div>
        </div>
      </footer>
 
      <!-- End Footer -->
 
 
    </div>
  </div>
  </div>

            <!--Fancys -->



                 <?php foreach($primeras as $primeras_item): ?>

            <!-- Click En la nota Primeras -->
                        <div id="primera-<?= $primeras_item['id']?>" class="reveal-modal expand hauto">
                                <iframe src="<?= base_url('main/individual/');?>/<?=$primeras_item['id']?>/<?=$primeras_item['titulo']?>/<?=$primeras_item['seccion']?>" class="w100 h600" frameborder="0"></iframe>
                                <a class="close-reveal-modal">&#215;</a>
                        </div> 
            
                 <?php endforeach?>

                 <?php foreach($recientes as $recientes_item): ?>

            <!-- Click En la nota Recientes -->
                        <div id="reciente-<?= $recientes_item['id']?>" class="reveal-modal expand hauto">
                                <iframe src="<?= base_url('main/individual/');?>/<?=$recientes_item['id']?>/<?=$recientes_item['titulo']?>/<?=$recientes_item['seccion']?>" class="w100 h600" frameborder="0"></iframe>
                                <a class="close-reveal-modal">&#215;</a>
                        </div> 
            
                 <?php endforeach?>


                <!-- <?php foreach($recientes as $recientes_item): ?>

            <!-- Click En la nota Recientes
                        <div id="reciente-<?= $recientes_item['id']?>" class="reveal-modal expand hauto">
                                <iframe src="<?= base_url('main/individual/');?>/<?=$recientes_item['id']?>" class="w100 h600" frameborder="0"></iframe>
                                <a class="close-reveal-modal">&#215;</a>
                        </div> 
            
                 <?php endforeach?> -->


                <?php foreach($seccion1 as $seccion_item): ?>

            <!-- Click En la nota seccion -->
                        <div id="seccion1-<?= $seccion_item['id']?>" class="reveal-modal expand hauto">
                                <iframe src="<?= base_url('main/individual/');?>/<?=$seccion_item['id']?>/<?=$seccion_item['titulo']?>/<?=$seccion_item['seccion']?>" class="w100 h600" frameborder="0"></iframe>
                                <a class="close-reveal-modal">&#215;</a>
                        </div> 
            
                <?php endforeach?>

                <?php foreach($seccion2 as $seccion_item): ?>

            <!-- Click En la nota seccion -->
                        <div id="seccion2-<?= $seccion_item['id']?>" class="reveal-modal expand hauto">
                                <iframe src="<?= base_url('main/individual/');?>/<?=$seccion_item['id']?>/<?=$seccion_item['titulo']?>/<?=$seccion_item['seccion']?>" class="w100 h600" frameborder="0"></iframe>
                                <a class="close-reveal-modal">&#215;</a>
                        </div> 
            
                <?php endforeach?>

                <?php foreach($seccion3 as $seccion_item): ?>

            <!-- Click En la nota seccion -->
                        <div id="seccion3-<?= $seccion_item['id']?>" class="reveal-modal expand hauto">
                                <iframe src="<?= base_url('main/individual/');?>/<?=$seccion_item['id']?>/<?=$seccion_item['titulo']?>/<?=$seccion_item['seccion']?>" class="w100 h600" frameborder="0"></iframe>
                                <a class="close-reveal-modal">&#215;</a>
                        </div> 
            
                <?php endforeach?>

                <?php foreach($seccion as $seccion_item): ?>

            <!-- Click En la nota seccion -->
                        <div id="seccion-<?= $seccion_item['id']?>" class="reveal-modal expand hauto">
                                <iframe src="<?= base_url('main/individual/');?>/<?=$seccion_item['id']?>/<?=$seccion_item['titulo']?>/<?=$seccion_item['seccion']?>" class="w100 h600" frameborder="0"></iframe>
                                <a class="close-reveal-modal">&#215;</a>
                        </div> 
            
                <?php endforeach?>


                <?php foreach($conductores as $conductores_item): ?>

            <!-- Click En la nota Recientes -->
                        <div id="conductor-<?= $conductores_item['id']?>" class="reveal-modal expand hauto">
                                <iframe src="<?= base_url('main/conductor');?>/<?=$conductores_item['id']?>" class="w100 h600" frameborder="0"></iframe>
                                <a class="close-reveal-modal">&#215;</a>
                        </div> 
            
                 <?php endforeach?>




                  <div id="contacto" class="reveal-modal centrado">
                    <h2>Contacto</h2>
                    <h3>Número de Telefono Celular</h3>
                    <div> +52 (311-191-49-79) </div>
                    <h3>Correo Electronico</h3>
                    <div> lic.luis.robles@gmail.com </div>
                    <h3> Ubicación Proximamente</h3>
                    <div> Mapa </div>
                    <a class="close-reveal-modal">&#215;</a>
                  </div>
                  
                  

            
            <!-- Fin Fancys  -->      





   <script>
      document.write('<script src=' +
      ('__proto__' in {} ? '<? echo base_url(); ?>/folders/js/vendor/zepto' : '<? echo base_url(); ?>/folders/js/vendor/jquery') +
      '.js><\/script>')
      </script>
    
  <script src="<? echo base_url('folders/js/foundation/foundation.js') ?>"></script>
  <script src="<? echo base_url('folders/js/foundation/foundation.alerts.js') ?>"></script>
  <script src="<? echo base_url('folders/js/foundation/foundation.clearing.js') ?>"></script>
  <script src="<? echo base_url('folders/js/foundation/foundation.cookie.js') ?>"></script>
  <script src="<? echo base_url('folders/js/foundation/foundation.dropdown.js') ?>"></script>
  <script src="<? echo base_url('folders/js/foundation/foundation.forms.js') ?>"></script>
  <script src="<? echo base_url('folders/js/foundation/foundation.joyride.js') ?>"></script>
  <script src="<? echo base_url('folders/js/foundation/foundation.magellan.js') ?>"></script>
  <script src="<? echo base_url('folders/js/foundation/foundation.orbit.js') ?>"></script>
  <script src="<? echo base_url('folders/js/foundation/foundation.placeholder.js') ?>"></script>
  <script src="<? echo base_url('folders/js/foundation/foundation.reveal.js') ?>"></script>
  <script src="<? echo base_url('folders/js/foundation/foundation.section.js') ?>"></script>
  <script src="<? echo base_url('folders/js/foundation/foundation.tooltips.js') ?>"></script>
  <script src="<? echo base_url('folders/js/foundation/foundation.topbar.js') ?>"></script>
  <script src="<? echo base_url('folders/js/foundation/foundation.interchange.js') ?>"></script>
  <script>
    $(document).foundation();
  </script>





