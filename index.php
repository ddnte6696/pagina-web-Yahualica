<!DOCTYPE html>
<html lang="es">
<?php
/*define('TARGET', 'yahualica');
if (session_status() === PHP_SESSION_NONE) {session_start();}
$_SESSION['ubi']=TARGET;
include_once $_SERVER['DOCUMENT_ROOT'].'/'.TARGET.'/lib/config.php';*/
if (session_status() === PHP_SESSION_NONE) {session_start();}
include_once $_SERVER['DOCUMENT_ROOT'].'/lib/config.php';
?>
<?php include_once "header.php"; ?>
<script type="text/javascript">
  //Función para registrar una nueva cuenta bancaria
    function busca_destinos(){
      //Defino y asigno las variables
        var puntero=$("#origen").val();
      //Indico la dirección del formulario que quiero llamar
        var url="model/venta/forms/busca_destinos.php"
      //inicio el traspaso de los datos
        $.ajax({
          type: "POST",
          url:url,
          data:{puntero:puntero},
          success: function(datos){$('#busca_destinos').html(datos);}
        });
      //
    }
  //
</script>
<body>
  <?php //include_once "nav.php"; ?>
    <div class="overlay-text">
      <h5>BIENVENIDO A</h5>
      <h1 class="font-times">OMNIBUS YAHUALICA GUADALAJARA</h1>
      <h5>LA CONEXION QUE NECESITAS, EL SERVICIO QUE MERECES</h5>
    </div>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/slide/slide_1.jpg" class="d-block w-100" alt="Slide 1">
          <div class="carousel-caption d-none d-md-block"></div>
        </div>
        <div class="carousel-item">
          <img src="img/slide/slide_2.jpg" class="d-block w-100" alt="Slide 2">
          <div class="carousel-caption d-none d-md-block"></div>
        </div>
        <div class="carousel-item">
          <img src="img/slide/slide_3.jpg" class="d-block w-100" alt="Slide 3">
          <div class="carousel-caption d-none d-md-block"></div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <div class="card">
      <div class="card-header red_yahua"></div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-8">
              <h1 class="font-times" style="  font-size: 60px;">QUIENES SOMOS</h1>
              <H3>Somos una familia tapatía que inició operaciones en el año 1978 siendo el pionero el señor Leopoldo Padilla Padilla, que con visión, trabajo y disciplina inició un servicio de transporte de pasajeros y con ella evolucionando junto con las poblaciones para tener una plantilla importante con unidades nuevas de marcas líderes en el mercado de transporte. Priorizando la seguridad, eficacia y confort del pasajero.</H3>
              <img src="img/logo_oyg/logo_02.png" style="width: auto; height: 150px;">
          </div>
          <div class="col-md-4">
            <img src="img/camiones/CM_1.jpg" style="width: auto; height: 500px;">
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header red_yahua"></div>
      <div class="card-body">
        <h1 class="font-times text-center" style="font-size: 60px;">VISITA NUESTROS PUNTOS DE VENTA</h1>

        <div class="row">
          <div class="col-md-4">
            <div class="card card-taquilla">
              <img class="card-img-top img-taquilla img-fluid" src="img/taquillas/guadalajara.jpeg" alt="Taquilla Guadalajara">
              <div class="card-body text-left car-body-taquilla">
                <h5>GUADALAJARA</h5>
                <ul>
                  <li><strong>Direccion:</strong> Carr. a Saltillo 1774, Benito Juarez, 45199 Zapopan Jal. Mexico</li>
                  <li><strong>Telefono:</strong> 333 112 5831</li>
                </ul>
              </div>
              <div class="card-footer red_yahua footer-taquilla text-center">
                <div class="row">
                  <div class="col-6">
                    <a href="https://maps.app.goo.gl/jfxk4EDmnU1Qbf2QA" target="_blank" class="link-text"><i class="fas fa-map"></i> VER EN MAPS</a>
                  </div>
                  <div class="col-6">
                    <?php echo "<a href='corridas.php?ref=".campo_limpiado("Guadalajara",1,1)."' class='link-text'><i class='fas fa-bus-alt'></i> VER CORRIDAS</a>"; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card card-taquilla">
              <img class="card-img-top img-taquilla img-fluid" src="img/taquillas/ixtlahuacan.jpeg" alt="Taquilla Ixtlahuacan">
              <div class="card-body text-left car-body-taquilla">
                <h5>IXTLAHUACAN DEL RIO</h5>
                <ul>
                  <li><strong>Direccion:</strong> Mandarina 179, La Escondida, 45260 Ixtlahuacán del Río, Jal.</li>
                  <li><strong>Telefono:</strong> 373 734 5475</li>
                </ul>
              </div>
              <div class="card-footer red_yahua footer-taquilla text-center">
                <div class="row">
                  <div class="col-6">
                    <a href="https://maps.app.goo.gl/RHuowC7V4nQb5mnE8" target="_blank" class="link-text"><i class="fas fa-map"></i> VER EN MAPS</a>
                  </div>
                  <div class="col-6">
                    <?php echo "<a href='corridas.php?ref=".campo_limpiado("Ixtlahuacan del rio",1,1)."' class='link-text'><i class='fas fa-bus-alt'></i> VER CORRIDAS</a>"; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card card-taquilla">
              <img class="card-img-top img-taquilla img-fluid" src="img/taquillas/cuquio_centro.jpeg" alt="Taquilla Cuquio Centro">
              <div class="card-body text-left car-body-taquilla">
                <h5>CUQUIO CENTRO</h5>
                <ul>
                  <li><strong>Direccion:</strong> Calle Hermenegildo Galeana 158, 45480 Cuquío, Jal.</li>
                  <li><strong>Telefono:</strong> 373 796 6512</li>
                </ul>
              </div>
              <div class="card-footer red_yahua footer-taquilla text-center">
                <div class="row">
                  <div class="col-6">
                    <a href="https://maps.app.goo.gl/CEiVLBKNRcG4Vrrx6" target="_blank" class="link-text"><i class="fas fa-map"></i> VER EN MAPS</a>
                  </div>
                  <div class="col-6">
                    <?php echo "<a href='corridas.php?ref=".campo_limpiado("cuquio centro",1,1)."' class='link-text'><i class='fas fa-bus-alt'></i> VER CORRIDAS</a>"; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card card-taquilla">
              <img class="card-img-top img-taquilla img-fluid" src="img/taquillas/cuquio_hotel.jpeg" alt="Taquilla Cuquio Hotel">
              <div class="card-body text-left car-body-taquilla">
                <h5>CUQUIO HOTEL</h5>
                <ul>
                  <li><strong>Direccion:</strong> Calle Prolongación José Ayala 1252 Col. Lázaro Cárdenas, 45480 Cuquío, Jal.</li>
                  <li><strong>Telefono:</strong> 373 688 1555</li>
                </ul>
              </div>
              <div class="card-footer red_yahua footer-taquilla text-center">
                <div class="row">
                  <div class="col-6">
                    <a href="https://maps.app.goo.gl/cCKv5kuG4EyS5x9w6" target="_blank" class="link-text"><i class="fas fa-map"></i> VER EN MAPS</a>
                  </div>
                  <div class="col-6">
                    <?php echo "<a href='corridas.php?ref=".campo_limpiado("cuquio hotel",1,1)."' class='link-text'><i class='fas fa-bus-alt'></i> VER CORRIDAS</a>"; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-taquilla">
              <img class="card-img-top img-taquilla img-fluid" src="img/taquillas/manalisco.jpeg" alt="Taquilla Manalisco">
              <div class="card-body text-left car-body-taquilla">
                <h5>MANALISCO</h5>
                <ul>
                  <li><strong>Direccion:</strong> C. Josefa Ortiz de Domínguez 6, 47330 Manalisco, Jal.</li>
                </ul>
              </div>
              <div class="card-footer red_yahua footer-taquilla text-center">
                <div class="row">
                  <div class="col-6">
                    <a href="https://maps.app.goo.gl/NoTuBiPovdU28C8ZA" target="_blank" class="link-text"><i class="fas fa-map"></i> VER EN MAPS</a>
                  </div>
                  <div class="col-6">
                    <?php echo "<a href='corridas.php?ref=".campo_limpiado("manalisco",1,1)."' class='link-text'><i class='fas fa-bus-alt'></i> VER CORRIDAS</a>"; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <div class="card card-taquilla">
              <img class="card-img-top img-taquilla img-fluid" src="img/taquillas/yahualica.jpeg" alt="Taquilla Yahualica">
              <div class="card-body text-left car-body-taquilla">
                <h5>YAHUALICA</h5>
                <ul>
                  <li><strong>Direccion:</strong> Vallarta 75, Tepeyac, 47300 Yahualica de González Gallo, Jal.</li>
                  <li><strong>Telefono:</strong> 344 788 9176</li>
                </ul>
              </div>
              <div class="card-footer red_yahua footer-taquilla text-center">
                <div class="row">
                  <div class="col-6">
                    <a href="https://maps.app.goo.gl/Nw2fSRCYztS1ywMH6" target="_blank" class="link-text"><i class="fas fa-map"></i> VER EN MAPS</a>
                  </div>
                  <div class="col-6">
                    <?php echo "<a href='corridas.php?ref=".campo_limpiado("yahualica",1,1)."' class='link-text'><i class='fas fa-bus-alt'></i> VER CORRIDAS</a>"; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <div class="card card-taquilla">
              <img class="card-img-top img-taquilla img-fluid" src="img/taquillas/teocaltiche.jpeg" alt="Taquilla Teocaltiche">
              <div class="card-body text-left car-body-taquilla">
                <h5>CENTRAL DE AUTOBUSES YAHUALICA</h5>
                <ul>
                  <li><strong>Direccion:</strong> Carretera Yahualica-Teocaltiche, Km. 3, N° 357</li>
                </ul>
              </div>
              <div class="card-footer red_yahua footer-taquilla text-center">
                    <a href="https://maps.app.goo.gl/Gw4cZbbGdHD3LcE36?g_st=iw" target="_blank" class="link-text"><i class="fas fa-map"></i> VER EN MAPS</a>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-md-4"></div>

        </div>
      </div>
    </div>
    <div class="background-div">
      <div class=" row">
        <div class="col-md-6"></div>
        <div class="col-md-6">

          <div class="form-boletos text-center">
            <h1 class="font-times">ADQUIERE TU BOLETO</h1>
            <a class='btn  btn-lg btn-light btn-block' href="app/" target="_blank"><strong>COMPRAR BOLETOS</strong></a>
          </div>
          
        </div>
      </div>
    </div>
  <script>
    $(document).ready(function(){ $('[data-toggle="tooltip"]').tooltip(); });
  </script>
</body>
<footer></footer>
<?php include_once "datatables.php"; ?>
</html>