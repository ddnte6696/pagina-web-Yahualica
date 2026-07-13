<?php
  //Reviso si se tiene una sesion iniciada
    if (session_status() === PHP_SESSION_NONE) {session_start();}
  //Obtengo el archivo de configuracion
    //include_once $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['ubi'].'/lib/config.php';
    include_once $_SERVER['DOCUMENT_ROOT'].'/lib/config.php';
  //Se incluye el archivo de conexión
    include_once A_CONNECTION;
  //Obtengo el dato enviado
    $taquilla=campo_limpiado($_POST['identificador'],2,0);
    $dato=explode("||", campo_limpiado($_POST['destino'],2,0));
    $id_destino=$dato[0];
    $nombre_destino=$dato[1];
  //
?>
<div class="card">
  <div class="card-header">
    <h5>CORRIDAS DESDE <?php echo "$taquilla HACIA $nombre_destino";?></h5>
  </div>
  <div class="card-body">
    <table class="table table-bordered table-sm table-hover" id="tabla">
      <thead>
        <tr>
          <th>Hora</th>
          <th></th>
          <th>Corrida</th>
        </tr>
      </thead>
      <tbody>
        <?php
            $orden_sql = "
            SELECT 
              servicio.hora,
              servicio.nombre_ruta
            from servicio as servicio 
              join ruta as ruta on servicio.identificador=ruta.identificador 
            where 
              ruta.destino='$nombre_destino' and ruta.punto_origen='$taquilla'
          ";
          //$orden_sql = "SELECT * FROM corridas where origen='$taquilla'";
          try {
            $query=$conn->prepare($orden_sql);
            $query->execute();
            while ($tabla=$query->fetch(PDO::FETCH_ASSOC)) {
              $nombre=$tabla['nombre_ruta'];
              $hora=$tabla['hora'];
              echo "
                <tr>
                  <td>$hora</td>
                  <td>".transforma_hora($hora)."</td>
                  <td>$nombre</td>
                </tr>
              ";
            }
          } catch (PDOException $e) {
            //Almaceno el error en una variabLe
            $error=$e->getMessage();
            //Ubico el archivo desde donde se presenta el error
            $archivo=__FILE__;
            //Mando a escribir el mensaje
            escribir_log($error,$orden_sql,$archivo);
            //Detengo el procedimiento
            die();
          }
        ?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  //Funcio para la tabla
    $(document).ready( function () {
      var table = $('#tabla').DataTable( {
        responsive: true,
        "language": {
          "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        "info": true,
        "pagingType":"full_numbers",
        dom: 'Bfrtip',
        lengthMenu: [
          [ 10, 25, 50, -1 ],
          [ '10 Filas', '25 Filas', '50 Filas', 'Mostrar todo' ]
        ],
        buttons:{
          buttons:[],
        },
      } );
      table.on( 'responsive-resize', function ( e, datatable, columns ) {
        var count = columns.reduce( function (a,b) {
          return b === false ? a+1 : a;
        }, 0 );
        console.log( count +' column(s) are hidden' );
      } );
    } );
  //
</script>