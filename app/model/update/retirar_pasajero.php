<?php
  // Se revisa si la sesión está iniciada y sino se inicia
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }

  // Se manda a llamar el archivo de configuración
  include_once $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['ubi'].'/lib/config.php';

  // Obtengo los datos mandados por el formulario
    $numero = campo_limpiado($_POST['dato'], 2, 0);
  //Obtengo el array de boletos y los separo
    $filas = explode('$$', $_SESSION['oyg_vb']['boletos']);
  //Obtengo el numero de filas
    $numero_filas=count($filas);
  //Le resto 1
    $filas_restantes=$numero_filas-1;
  //Evaluo las filas restantes
    if ($filas_restantes==0) {
      //Separo las columnas de la fila
        $columnas=explode('||',$filas[0]);
      //Almaceno el numero del asiento
        $asiento=$columnas[0];
      //Defino la variable de sesion de boletos en vacio
        $_SESSION['oyg_vb']['boletos']=Null;
      //Despliego la tabla de pasajeros
        echo "
          <script>
            $('#ta$asiento').removeClass('btn-warning disabled');
            $('#ta$asiento').addClass('btn-primary text-light');
            muestra_pasajeros();
          </script>
        ";
      //
    } else {
      //Recorro el arreglo de filas
      for ($i=0; $i <$numero_filas ; $i++) {
        //Verifico si el valor a eliminar coincide con el de la fila
        if ($i==$numero) {
          //Separo las columnas de la fila
            $columnas=explode('||',$filas[$i]);
          //Almaceno el numero del asiento
            $asiento=$columnas[0];
          //Elimino el valor de la fila
            unset($filas[$i]);
          //Reordeno el arreglo
           $filas = array_values($filas);
          //Defino la variable de sesion de boletos
            $_SESSION['oyg_vb']['boletos']=implode('$$', $filas);
          //Despliego la tabla de pasajeros
            echo "
              <script>
                $('#ta$asiento').removeClass('btn-warning disabled');
						    $('#ta$asiento').addClass('btn-primary text-light');
                muestra_pasajeros();
              </script>
            ";
        } else {
          //Defino la variable de sesion de boletos
            $_SESSION['oyg_vb']['boletos']=implode('$$', $filas);
          //
        }
      }
    }
?>