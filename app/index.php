<?php
  //Definimos de primera mano la aplicacion
    define('TARGET', 'app');
  //Inicializamos la sesion
    if (session_status() === PHP_SESSION_NONE) {session_start();}
  //Definimos la ubicacion de la aplicacion en la variable de sesion
    $_SESSION['ubi']=TARGET;
  //Incluimos el archivo de configuracion
    include_once $_SERVER['DOCUMENT_ROOT'].'/'.TARGET.'/lib/config.php';
  //Agregamos el nobre de la pagina a la variable de sesionq
    $_SESSION[$_SESSION['ubi']]['title']=TITLE;
  //Definimos la constante de la aplicacion
    define('CONTENT_TYPE', 'text/html');
   header('Content-Type: ' . CONTENT_TYPE);
  //Redireccionamos a la vista principal
    header('Location: public/inicio.php');
    
?>