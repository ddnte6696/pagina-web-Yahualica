<?php
  //Se revisa si la sesión esta iniciada y sino se inicia
  if (session_status() === PHP_SESSION_NONE) {session_start();}
  //Se manda a llamar el archivo de configuración
  include_once $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['ubi'].'/lib/config.php';
  //Obtengo el tao enviado
    $referencia=campo_limpiado($_GET['ref'],2);
  //Incluyo la cabecera del sistema
    include_once '../view/header.php';
  //Busco algunos datos del pago
    $sentencia=" SELECT * FROM venta_web WHERE referencia='$referencia';";
  //Ejecuto la sentencia y almaceno lo obtenido en una variable
    $resultado_sentencia=retorna_datos_sistema($sentencia);
  //Identifico si el reultado no es vacio
    if ($resultado_sentencia['rowCount'] > 0) {
      //Almaceno los datos obtenidos
        $resultado = $resultado_sentencia['data'];
      // Recorrer los datos y llenar las filas
        foreach ($resultado as $tabla) {
          //Creeo las variables del identificador
            $id=$tabla['id'];
            $id_pago=$tabla['id_pago'];
            $estado=$tabla['estado'];
            $monto=$tabla['monto'];
            $monto_neto=$tabla['monto_neto'];
            $moneda=$tabla['moneda'];
            $cuota=$monto-$monto_neto;
          //
        }
      //
    }
  //
  //Busco algunos datos del boleto
    $sentencia=" SELECT *,count(id) as cuenta_pasajeros FROM boleto WHERE referencia='$referencia';";
  //Ejecuto la sentencia y almaceno lo obtenido en una variable
    $resultado_sentencia=retorna_datos_sistema($sentencia);
  //Identifico si el reultado no es vacio
    if ($resultado_sentencia['rowCount'] > 0) {
      //Almaceno los datos obtenidos
        $resultado = $resultado_sentencia['data'];
      // Recorrer los datos y llenar las filas
        foreach ($resultado as $tabla) {
          //Creeo las variables del identificador
            $id=$tabla['id'];
            $punto_venta=$tabla['punto_venta'];
            $origen=$tabla['origen'];
            $destino=$tabla['destino'];
            $tipo=$tabla['tipo'];
            $precio=$tabla['precio'];
            $pasajero=$tabla['pasajero'];
            $asiento=$tabla['asiento'];
            $f_corrida=campo_limpiado(transforma_fecha($tabla['f_corrida'],1, " DE "),0,1);
            $corrida=$tabla['corrida'];
            $hora_corrida=transforma_hora($tabla['hora_corrida']);
            $f_venta=$tabla['f_venta'];
            $h_venta=$tabla['h_venta'];
            $referencia=$tabla['referencia'];
            $estado=$tabla['estado'];
            $comentarios=$tabla['motivo'];
            $cuenta_pasajeros=$tabla['cuenta_pasajeros'];
          //
        }
      //
    }
  //
?>
<style type="text/css">
  body::before {
    content: "";
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    z-index: 0;
    background: url('../img/Logotipo Omnibus/sin fondo/logo omnibus_Mesa de trabajo 1-02.png') no-repeat center center;
    background-size: 60%;
    opacity: 0.10;         /* Más bajo = más tenue */
    filter: blur(4px);     /* Ajusta el desenfoque */
    pointer-events: none;  /* Permite interactuar con el contenido */
  }
  body {
    position: relative;
    z-index: 1;
    background: none !important; /* Elimina el background-image directo */
  }
  .ticket, .header, .route, .details, .section-title, .terms, .footer {
    position: relative;
    z-index: 1;
  }
  .header {
    text-align: center;
    border-bottom: 2px solid #3A1220;
    padding-bottom: 10px;
  }
  .logos img {
    height: 30px;
    margin: 0 10px;
  }
  .route {
    background-color: #3A1220;
    color: white;
    padding: 10px;
    font-size: 1.2em;
    text-align: center;
    margin-top: 10px;
  }
  .details {
    margin: 15px 0;
  }
  .details strong {
    width: 150px;
  }
  .section-title {
    background-color: #eee;
    padding: 8px;
    font-weight: bold;
    margin-top: 20px;
  }
  .terms {
    font-size: 0.8em;
    color: #333;
    margin-top: 10px;
  }
  .footer {
    text-align: center;
    margin-top: 30px;
    font-size: 0.75em;
    color: #666;
  }
  @media print {
    @page { size: auto; }
      body::before {
        content: "";
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        z-index: 0;
        background: url('../img/Logotipo Omnibus/sin fondo/logo omnibus_Mesa de trabajo 1-02.png') no-repeat center center;
        background-size: 60%;
        opacity: 0.10;         /* Más bajo = más tenue */
        filter: blur(4px);     /* Ajusta el desenfoque */
        pointer-events: none;  /* Permite interactuar con el contenido */
      }
      body {
        position: relative;
        z-index: 1;
        background: none !important; /* Elimina el background-image directo */
      }
      .ticket, .header, .route, .details, .section-title, .terms, .footer {
        position: relative;
        z-index: 1;
      }
      .header {
        text-align: center;
        border-bottom: 2px solid #3A1220;
        padding-bottom: 10px;
      }
      .logos img {
        height: 30px;
        margin: 0 10px;
      }
      .route {
        background-color: #3A1220;
        color: white;
        padding: 10px;
        font-size: 1.2em;
        text-align: center;
        margin-top: 10px;
      }
      .details {
        margin: 15px 0;
      }
      .details strong {
        width: 150px;
      }
      .section-title {
        background-color: #eee;
        padding: 8px;
        font-weight: bold;
        margin-top: 20px;
      }
      .terms {
        font-size: 0.8em;
        color: #333;
        margin-top: 10px;
      }
      .footer {
        text-align: center;
        margin-top: 30px;
        font-size: 0.75em;
        color: #666;
      }
    }
</style>
<body>
  <div class="row align-items-center justify-content-center text-center">
    <div class="col-sm-2">
      <img src="../img/Logotipo Omnibus/Imagenes/logo omnibus_Mesa de trabajo 1-06.jpg"  style='height: 100px' alt="Logo 1">
    </div>
    <div class="col-sm-4">
      <h1><strong>PASE DE ABORDAR</strong></h1>
    </div>
    <div class="col-sm-6">
      <p>Entrega tu pase de abordar impreso en andenes o presentalo de manera digital  (telefono movil) 15 o 20 minutos antes de tu viaje</p>
    </div>
  </div>    
  <div class="route text-center">
    <div class="row align-items-center justify-content-center">
      <div class="col-sm-4"><h1><strong><?php echo $origen; ?></strong></h1></div>
      <div class="col-sm-4"><h3><i class='fas fa-bus-alt' style="width: 40px;"></i><i class='fas fa-arrow-right' style="width: 40px;"></i></h3></div>
      <div class="col-sm-4"><h1><strong><?php echo $destino; ?></strong></h1></div>
    </div>  
  </div>
  <div class="details row">
    <div class="col-sm-4">
      <P style="font-size: x-large;"><strong>FECHA Y HORA DE VIAJE:</strong> <?php echo $f_corrida." ".campo_limpiado(transforma_hora($hora_corrida,"12",":"),0,1);?></P>
      <P style="font-size: x-large;"><strong>RUTA:</strong> <?php echo $corrida;?></P>
      
    </div>
    <div class="col-sm-4">
      <p><strong>ID DE PAGO:</strong> <?php echo $id_pago;?></p>
      <p><strong>SUBTOTAL:</strong> <?php echo $moneda." ".number_format($monto_neto,2);?></p>
      <p><strong>CUOTA DE SERVICIO:</strong> <?php echo $moneda." ".number_format($cuota,2);?></p>
      <p><strong>TOTAL:</strong> <?php echo $moneda." ".number_format($monto,2);?></p>
    </div>
    <div class="col-sm-4">
      <p class="text-center"><img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo urlencode(campo_limpiado($referencia,1)); ?>" alt="QR Código de Referencia"></p>
    </div>
  </div>
  <div class="route align-items-center justify-content-center"><strong>TÉRMINOS Y CONDICIONES</strong></div>
  <div>
    <h4 class="text-center"><strong>Condiciones del servicio</strong></h4>
    <li>Para abordar la unidad es necesario presentar este pase de abordar de manera impresa al conductor de la unidad.</li>
    <li>Presentarse al anden 20 minutos antes de la salida de su viaje, para abordar en tiempo y forma.</li>
    <li>Los menores de edad no pueden viajar solos y solo podrán viajar acompañados de un adulto con boleto pagado.</li>
    <strong><li>Este pase no es cancelable y no se realiza reembolso total o parcial del monto pagado.</li>
    <li>Este pase de abordar es válido únicamente para la fecha y hora indicada, de no abordar la unidad en tiempo y forma será la pérdida del viaje.</li></strong>
    <li>No se permite viajar con animales exóticos o en peligro de extinción, armas de fuego o punzo cortantes, como navajas, picahielo, etc., así como objetos o sustancias peligrosas (tanques de gas, oxigeno, solventes, etc.)</li>
    <h4 class="text-center"><strong>Requisitos legales</strong></h4>
    <li>Por disposición del Gobierno Federal es necesario al momento de abordar y durante el viaje, presentar una identificación oficial vigente (INE, pasaporte, cedula profesional, licencia de conducir)</li>
    <li>Para personas extranjeras, deberán presentar una identificación con fotografía y su forma migratoria múltiple (FMM) la cual es expedida por el instituto Nacional de Migración.</li>
    <strong><li>En caso de no presentar estos requisitos no podrá abordar la unidad y será la perdida de su viaje, por lo que no se realizará cancelación o reembolso.</li></strong>
    <h4 class="text-center"><strong>Recomendaciones del sector salud</strong></h4>
    <li>Es obligatorio el uso de cubrebocas al momento de abordar la unidad, durante u al término del viaje.</li>
    <li>Se recomienda llevar consigo Gel Antibacterial de bolsillo y usarlo de manera constante.</li>
  </div>
  <div class="route align-items-center justify-content-center"><strong>PASAJEROS</strong></div>
  <div class="text-center">
    <table style="width: 100%;">
      <thead>
        <tr>
          <th>FOLIO</th>
          <th>PASAJERO</th>
          <th>ASIENTO</th>
          <th>TIPO</th>
          <th>PRECIO</th>
        </tr>
      </thead>
      <tbody>
        <?php
          //Busco las rutas que van hacia ese punto
            $sentencia=" SELECT * FROM boleto WHERE referencia='$referencia';";
          //Ejecuto la sentencia y almaceno lo obtenido en una variable
            $resultado_sentencia=retorna_datos_sistema($sentencia);
          //Identifico si el reultado no es vacio
            if ($resultado_sentencia['rowCount'] > 0) {
              //Almaceno los datos obtenidos
                $resultado = $resultado_sentencia['data'];
              // Recorrer los datos y llenar las filas
                foreach ($resultado as $tabla) {
                  //Creeo las variables del identificador
                    $id=$tabla['id'];
                    $punto_venta=$tabla['punto_venta'];
                    $origen=$tabla['origen'];
                    $destino=$tabla['destino'];
                    $tipo=$tabla['tipo'];
                    $precio=$tabla['precio'];
                    $pasajero=$tabla['pasajero'];
                    $asiento=$tabla['asiento'];
                    $f_corrida=campo_limpiado(transforma_fecha($tabla['f_corrida'],1, " DE "),0,1);
                    $corrida=$tabla['corrida'];
                    $hora_corrida=transforma_hora($tabla['hora_corrida']);
                    $f_venta=$tabla['f_venta'];
                    $h_venta=$tabla['h_venta'];
                    $referencia=$tabla['referencia'];
                    $estado=$tabla['estado'];
                    $comentarios=$tabla['motivo'];
                  //Imprimo los datos de la tabla
                    echo "
                      <tr>
                        <td>$id</td>
                        <td>$pasajero</td>
                        <td>$asiento</td>
                        <td>$tipo</td>
                        <td>$precio</td>
                      </tr>
                    ";
                  //
                }
              //
            }
          //
        ?>
      </tbody>
    </table>
  </div>
</body>
<!--footer class="text-center">Omnibus Yahualica Guadalajara S.A. de C.V. © 2025</footer-->
<script type="text/javascript">
    window.onload = function() {
        window.print();
    }
</script>