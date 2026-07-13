<?php
  //Se revisa si la sesión esta iniciada y sino se inicia
  if (session_status() === PHP_SESSION_NONE) {session_start();}
  //Se manda a llamar el archivo de configuración
  include_once $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['ubi'].'/lib/config.php';
  
  //Creo un arreglo de informacion
    $datos =array (
      'clave'=>campo_limpiado('WEB',1,0),
      'taquilla'=>campo_limpiado('GUADALAJARA',1,0),
      'title'=>TITLE,
    );
  //asigno los datos del arreglo a la variable de sesion
    $_SESSION[UBI]=$datos;
  //Incluyo la cabecera del sistema
    include_once '../view/header.php';
  //Obtengo datos de la sesion
    $taquilla_actual=campo_limpiado($_SESSION[UBI]['taquilla'],2,0);
    $clave=campo_limpiado($_SESSION[UBI]['clave'],2,0);
  //Obtengo el id de la taquilla
    $sentencia="SELECT id as exist FROM destinos WHERE destino='$taquilla_actual';";
     $id_taquilla_actual=busca_existencia($sentencia);
    $dato_actual=campo_limpiado(("$id_taquilla_actual||$taquilla_actual"),1,0);
  //Identifico cual es la ultima taquilla identificada como punto de venta
    $id_ultima_taquilla=busca_existencia("SELECT id as exist FROM destinos WHERE punto=true and id<>$id_taquilla_actual ORDER BY id DESC LIMIT 1;");
  //Obtengo su nombre
    $sentencia="SELECT destino as exist FROM destinos WHERE id=$id_ultima_taquilla;";
    $taquilla_ultima=busca_existencia($sentencia);
  //Creeo un concatenado de ese dato
    $dato_ultima=campo_limpiado(("$id_ultima_taquilla||$taquilla_ultima"),1,0);
?>
<script type="text/javascript">
  //Función para registrar una nueva cuenta bancaria
    function busca_destinos(){
      //Defino y asigno las variables
        var puntero=$("#origen").val();
      //Indico la dirección del formulario que quiero llamar
        var url="../model/forms/busca_destinos.php"
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
  window.onload=busca_destinos;
</script>
<style>
  #respuesta_corridas {
    background-image: url('../img/background.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    min-height: 200px;
  }
</style>
<div class="card text-center">
  <div class="card-header"><h3>VENTA DE BOLETOS</h3></div>
  <div class="card-body">
    <form enctype="multipart/form-data" class="form-horizontal" method="post" name="frm_corridas" id="frm_corridas">
      <div class="row text-center">
        <div class="col-md-4">
          <label for="clave" class="col-form-label">Selecciona el dia en que deseas viajar</label>
          <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
              <span class="input-group-text"><strong>FECHA</strong></span>
            </div>
            <input type='date' name='fecha' name='fecha' min='<?php echo ahora(1) ?>' class='form-control' value='<?php echo ahora(1) ?>' required=''/>
          </div>
        </div>
        <div class="col-md-4">
          <label for="clave" class="col-form-label">Selecciona desde donde quieres salir</label>
          <div class="input-group mb-3 input-group-sm">
            <div class="input-group-prepend">
                <span class="input-group-text"><strong>ORIGEN</strong></span>
            </div>
            <select  name='origen' id="origen" class="custom-select"  style="color:black"  onchange="busca_destinos();" required="">
              <?php
                //echo "<option value=''>SELECCIONA UNA OPCION</option>";
                echo "<option value='$dato_actual'>$taquilla_actual</option>";
                echo "<option value='$dato_ultima'>$taquilla_ultima</option>";
              ?>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <label for="clave" class="col-form-label">Selecciona el destino al que deseas viajar</label>
          <div id="busca_destinos">
          </div>
        </div>
      </div>
    </form>
    <input type="submit" id="boton_registro" value="VER CORRIDAS" class="btn btn-sm btn-primary btn-block" onclick="busca_corridas( );">
  </div>
  <div class="card-footer">
    <div id="respuesta_corridas"></div>
  </div>
</div>
<script>
  function busca_corridas(){
    $.ajax({
      type: "POST",
      url: "../model/queries/corridas.php",
      data: $("#frm_corridas").serialize(),
      beforeSend: function(){$("#respuesta_corridas").html("<div class='spinner-border'></div>");},
      success: function(data){$("#respuesta_corridas").html(data);},
    });
    return false;
  }
  //habilitar buscador en los seleccionadores
    jQuery(document).ready(function($){
      $(document).ready(function() {
        $('#origen').select2();
      });
    });
  //Funcion para imprimir el div de los boletos
    function imprimirDiv(nombreDiv) {
      var contenido = document.getElementById(nombreDiv).innerHTML;
      var contenidoOriginal = document.body.innerHTML;
      document.body.innerHTML = contenido;
      window.print();
      document.body.innerHTML = contenidoOriginal;
      venta_boletos();
    }
  //
</script>
<?php
 
  //Incluyo la cabecera del sistema
    include_once '../view/footer.php';
  //
?>