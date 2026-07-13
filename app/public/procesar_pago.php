<?php
  //puedo verificar los errores en la página
		error_reporting(E_ALL);
		ini_set("display_errors", 1);
  //Se revisa si la sesión esta iniciada y sino se inicia
    if (session_status() === PHP_SESSION_NONE) {session_start();}
  //Se manda a llamar el archivo de configuración
    include_once $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['ubi'].'/lib/config.php';
  //Incluyo la cabecera del sistema
    //include_once '../view/header.php';
  //
  //Realizo la insercion de los boletos en la BD y obtengo la referencia de retorno;
    $referencia=registra_boletos($_SESSION['oyg_vb']);
  //Reviso si la referencia no es vacia
  if ($referencia==campo_limpiado($_SESSION['oyg_vb']['referencia'],2,0)) {
    //rEDIRIOGIR A LA PAGINA DE PAGO
      header("Location: pago.php");
  }
  //Incluyo la cabecera del sistema
    //include_once '../view/footer.php';
  //
?>