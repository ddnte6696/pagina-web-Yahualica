<?php
  //Reviso si se tiene una sesion iniciada
    if (session_status() === PHP_SESSION_NONE) {session_start();}
  //Obtengo el archivo de configuracion
    //include_once $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['ubi'].'/lib/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/lib/config.php';
  //Se incluye el archivo de conexión
    include_once A_CONNECTION;
  //Obtengo el dato enviado
    $taquilla=campo_limpiado($_GET['ref'],2,0);
  //
?>
<!DOCTYPE html>
<html lang="es">
  <?php include_once "header.php" ?>
  <body>
    <?php include_once "nav.php" ?>
    </nav>
    <div class="container text-center">
      <div class="card">
        <div class="card-header footer-gradient">
          <h2>ELIGE TU DESTINO</h2>
        </div>
        <div class="card-body">
            <input type="text" value="<?php echo $_GET['ref']; ?>" id="identificador" hidden>
            <div class="input-group mb-3 input-group-sm">
              <div class="input-group-prepend">
                  <span class="input-group-text"><strong>DESTINO</strong></span>
              </div>
              <select  name='destino' id="destino" class="custom-select" required="">
                <?php
                  $query=$conn->prepare("SELECT * FROM ruta where punto_origen='$taquilla' group by destino");
                  $query->execute();
                  while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
                    $destino=$tabla['destino'];
                    $valor="$id||$destino";
                    $dato=campo_limpiado($valor,1,1);
                    echo "<option value='$dato'>$destino</option>";
                  }
                ?>
              </select>
            </div>
            <div class="card-footer">
                <input type="submit" value="VER CORRIDAS" class="btn btn-sm btn-primary btn-block" onclick="busca_corridas();">
            </div>
          <div id="respuesta_corrida"></div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      //habilitar buscador en los seleccionadores
        jQuery(document).ready(function($){
          $(document).ready(function() {
            $('#destino').select2();
          });
        });
      //Funcion para obtener las rutas
        function busca_corridas(opcion){
          var identificador=$("#identificador").val();
          var destino=$("#destino").val();
          $.ajax({
            type: "POST", 
            url: "corrida.php",
            data: {
              identificador:identificador,
              destino:destino,
            },
            success: function(respuesta){
              $("#respuesta_corrida").html(respuesta);
            }
          });
          return false;
        }
      //
    </script>
  </body>
  <footer></footer>
  <?php include_once "datatables.php"; ?>
</html>