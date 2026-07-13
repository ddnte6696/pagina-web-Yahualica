<?php
  // Se revisa si la sesión está iniciada y sino se inicia
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  // Se manda a llamar el archivo de configuración
    include_once $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['ubi'].'/lib/config.php';
  //Obtengo los datos enviados por el formulario
    $dto=explode("||",campo_limpiado($_POST['datos'],2,0));
    $id_corrida=$dto[0];
    $corrida=$dto[1];
    $id_punto_inicial=$dto[2];
    $punto_inicial=$dto[3];
    $hora=$dto[4];
  //Defino los boletos en vacio y la corrida
    $_SESSION['oyg_vb']['id_corrida']=campo_limpiado($id_corrida,1,0);
    $_SESSION['oyg_vb']['corrida']=campo_limpiado($corrida,1,0);
    $_SESSION['oyg_vb']['hora']=campo_limpiado($hora,1,0);
    $_SESSION['oyg_vb']['id_punto_inicial']=campo_limpiado($id_punto_inicial,1,0);
    $_SESSION['oyg_vb']['punto_inicial']=campo_limpiado($punto_inicial,1,0);
  //Redirecciono a la pagina siguiente
    echo "<script>window.location.href='pasajeros.php';</script>";
  //

?>