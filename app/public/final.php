<?php
  //Se revisa si la sesión esta iniciada y sino se inicia
    if (session_status() === PHP_SESSION_NONE) {session_start();}
  //Se manda a llamar el archivo de configuración
    include_once $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['ubi'].'/lib/config.php';
  //Incluyo la cabecera del sistema
    include_once '../view/header.php';
  //
?>
<div class="card text-center">
  <div class="card-header">
    <h3 class="card-title">RESUMEN DE COMPRA</h3>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <h5>PASAJEROS AGREGADOS</h5>
        <table class="table table-sm table-hover table-bordered">
          <thead>
            <tr>
              <th>Asiento</th>
              <th>Nombre</th>
              <th>Tipo</th>
              <th>Precio</th>
            </tr>
          </thead>
            <?php
              //separo los registros de los boletos 
                $filas=explode('$$',$_SESSION['oyg_vb']['boletos']);
                $numero_filas=count($filas);
              //inicio un cilo for para imprimir la tabla
                for ($i=0; $i <$numero_filas ; $i++) {
                  $columnas=explode('||',$filas[$i]);
                  $numero_columnas=count($columnas);
                  echo "
                    <tr>
                      <td>".$columnas[0]."</td>
                      <td>".$columnas[1]."</td>
                      <td>".$columnas[2]."</td>
                      <td>$ ".number_format($columnas[3],0)." MXN</td>
                    </tr>
                  ";
                }
              //
            ?>
          <tbody>
        </table>
      </div>
      <div class="col-md-6">
        <table class="table table-sm table-hover table-bordered">
          <tr>
            <th>SUBTOTAL</th>
            <td>$ <?php echo number_format($_SESSION['oyg_vb']['importe_total'],2); ?> MXN</td>
          </tr>
          <tr>
            <th>CUOTA DE SERVICIO</th>
            <td>$ <?php echo number_format($_SESSION['oyg_vb']['comision'],2); ?> MXN</td>
          </tr>
          <tr>
            <th>TOTAL</th>
            <td>$ <?php echo number_format($_SESSION['oyg_vb']['cobro'],2); ?> MXN</td>
          </tr>
        </table>
        <a  href="procesar_pago.php" class="btn btn-primary btn-bg btn-block">Finalizar compra por $ <?php echo number_format($_SESSION['oyg_vb']['cobro'],2); ?> </a>
      </div>
    </div>
  </div>
</div>
<?php
  //Incluyo la cabecera del sistema
    include_once '../view/footer.php';
  //
?>