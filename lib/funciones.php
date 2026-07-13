<?php
  //Llamada de librerías de PHPMailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
  //Tipos de extensiones de archivos permitidos
    $extensionesPermitidas = array('jpg', 'jpeg', 'pdf');
  //Función para eliminar los acentos y la virgulilla de la Ñ
    function eliminar_tildes($cadena){
      $cadena = str_replace('Á','A',$cadena);
      $cadena = str_replace('É','E',$cadena);
      $cadena = str_replace('Í','I',$cadena);
      $cadena = str_replace('Ó','O',$cadena);
      $cadena = str_replace('Ú','U',$cadena);
      $cadena = str_replace('Ñ','N',$cadena);
      return $cadena;
    }
  //Funcion para poner o quitar comillas de un texto
    function pone_comillas($texto){ return str_replace('çÇç', '"', $texto); }
  //
    function quita_comillas($texto){ return str_replace('"', 'çÇç', $texto); }
  //Devuelve la fecha en palabras y separados con guion bajo
    function ref_fecha(){
      $hoy = getdate();
      $ano=$hoy['year'];
      switch ($hoy['mon']) {
        case '1':
          $mes='Enero';
        break;
        case '2':
          $mes='Febrero';
        break;
        case '3':
          $mes='Marzo';
        break;
        case '4':
          $mes='Abril';
        break;
        case '5':
          $mes='Mayo';
        break;
        case '6':
          $mes='Junio';
        break;
        case '7':
          $mes='Julio';
        break;
        case '8':
          $mes='Agosto';
        break;
        case '9':
          $mes='Septiembre';
        break;
        case '10':
          $mes='Octubre';
        break;
        case '11':
          $mes='Noviembre';
        break;
        case '12':
          $mes='Diciembre';
        break;
      }
      $dia=$hoy['mday'];
      $referencia=$dia."_".$mes."_".$ano."_";
      return $referencia;
    }
  //Devuelve la fecha en palabras
    function transforma_fecha($fecha){
      $dato = explode("-",$fecha);
      $ano=$dato[0];
      switch ($dato[1]) {
        case '1':
          $mes='Enero';
        break;
        case '2':
          $mes='Febrero';
        break;
        case '3':
          $mes='Marzo';
        break;
        case '4':
          $mes='Abril';
        break;
        case '5':
          $mes='Mayo';
        break;
        case '6':
          $mes='Junio';
        break;
        case '7':
          $mes='Julio';
        break;
        case '8':
          $mes='Agosto';
        break;
        case '9':
          $mes='Septiembre';
        break;
        case '10':
          $mes='Octubre';
        break;
        case '11':
          $mes='Noviembre';
        break;
        case '12':
          $mes='Diciembre';
        break;
      }
      $dia=$dato[2];
      $referencia=$dia." de ".$mes." del ".$ano;
      return $referencia;
    }
  //Devuelve la hora en formato de 12 HRS
    function transforma_hora($hora){
      $hora_formateada = date('g:i a', strtotime($hora));
      return $hora_formateada;
    }
  //Devuelve la fecha en numero y separada con diagonal
    function transforma_fecha_diagonal($fecha){
      $dato = explode("-",$fecha);
      $ano=$dato[0];
      $mes=$dato[1];
      $dia=$dato[2];
      $referencia=$dia."/".$mes."/".$ano;
      return $referencia;
    }
  //Devuelve la fecha y hora actuales
    function ahora($tipo){
      $hoy = getdate();
      switch ($tipo) {
        //Se solicita la fecha
        case '1':
          $actual=date('Y-m-d');
        break;
        //Se solicita la hora
        case '2':
          $actual=date('H:i:s');
        break;
        //Se solicitan el timestamp actual
        case '3':
          $actual=date('Y-m-d H:i:s');
        break;
      }      
      return $actual;
    }
  //Devuelve la referencia horaria
    function referencia_horaria(){
      //Obtengo la hora actual
      $hoy=ahora(2);
      //Le elimino los : y la guardo en la variable
      $referencia_horaria=str_replace(':','',$hoy);
      //Devuelvo el valor
      return $referencia_horaria;
    }
  //Devuelve la referencia tenporal
    function referencia_temporal(){
      //Obtengo la hora actual
      $time=ahora(2);
      //Le elimino los : y la guardo en la variable
      $tiempo=str_replace(':','',$time);
      //Obtengo la fecha actual
      $date=ahora(1);
      //Le elimino los - y la guardo en la variable
      $dia=str_replace('-','',$date);
      //Realizo cun concatenado
      $referencia_temporal=$dia."-".$tiempo;
      //Devuelvo el valor
      return $referencia_temporal;
    }
  //Devuelve el dato limpiado, le da formato al texto y lo encripta según los identificadores 
    function campo_limpiado($dato,$encript,$mayus){
      if (($mayus==1)&&($encript==1)) { //Mayusculas y encriptar
        //Limpieza del campo
          $campo = htmlspecialchars(limpiar_campo($dato),ENT_QUOTES);
        //Conversion a mayúsculas
          $campo = mb_strtoupper($campo);
        //Encriptacion
          $campo = encriptar_ligero($campo);
        //
      }elseif (($mayus==2)&&($encript==1)) { //Minusculas y encriptar
        //Limpieza del campo
          $campo = htmlspecialchars(limpiar_campo($dato),ENT_QUOTES);
        //Conversion a minusculas
          $campo = strtolower($campo);
        //Encriptacion
          $campo = encriptar_ligero($campo);
        //
      }elseif (($mayus==0)&&($encript==1)) { //Solo encriptar
        //Limpieza del campo
          $campo = htmlspecialchars(limpiar_campo($dato),ENT_QUOTES);
        //Encriptacion
          $campo = encriptar_ligero($campo);
        //
      }elseif(($mayus==1)&&($encript==2)) { //Mayusculas y desencriptar
        //Desencriptacion
          $campo = desencriptar_ligero($dato);
        //Conversion a mayúsculas
          $campo = mb_strtoupper($campo);
        //Limpieza del campo
          $campo = htmlspecialchars(limpiar_campo($campo),ENT_QUOTES);
        //
      }elseif (($mayus==2)&&($encript==2)) { //Minusculas y desencriptar
        //Desencriptacion
          $campo = desencriptar_ligero($dato);
        //Conversion a minusculas
          $campo = strtolower($campo);
        //Limpieza del campo
          $campo = htmlspecialchars(limpiar_campo($campo),ENT_QUOTES);
        //
      }elseif (($mayus==0)&&($encript==2)) { //Solo desencriptar
        //Desencriptacion
          $campo = desencriptar_ligero($dato);
        //Limpieza del campo
          $campo = htmlspecialchars(limpiar_campo($campo),ENT_QUOTES);
        //
      }elseif(($mayus==1)&&($encript==0)) { //Mayusculas
        //Limpieza del campo
          $campo = htmlspecialchars(limpiar_campo($dato),ENT_QUOTES);
        //Conversion a mayúsculas
          $campo = mb_strtoupper($campo);
        //
      }elseif (($mayus==2)&&($encript==0)) { //Minusculas
        //Limpieza del campo
          $campo = htmlspecialchars(limpiar_campo($dato),ENT_QUOTES);
        //Conversion a minusculas
          $campo = strtolower($campo);
        //
      }elseif (($mayus==0)&&($encript==0)) { //Solo desencriptar
        //Limpieza del campo
          $campo = htmlspecialchars(limpiar_campo($dato),ENT_QUOTES);
        //
      }
      //Se regresa el dato ya formateado
      return $campo;
    }
  //Devuelve el dato limpiado, le da formato al texto y lo encripta según los identificadores
    function campo_limpiado_nuevo($dato,$encript,$mayus,$llenado){
      if (($mayus==1)&&($encript==1)) { //Mayusculas y encriptar
        //Limpieza del campo
          $campo = htmlspecialchars(limpiar_campo($dato),ENT_QUOTES);
        //Revision de llenado
          if ($llenado==1) {
            if (!empty($campo)) {
              $campo = $campo;
            }else{
              //Se imprime un mensaje de alerta
              echo "<script>alert('¡ATENCION!, UNO DE LOS DATOS ESTA INCOMPLETO');</script>";
              //Se deiene el procedimiento
              die();
            }
          }
        //Conversion a mayúsculas
          $campo = mb_strtoupper($campo);
        //Encriptacion
          $campo = encriptar_ligero($campo);
        //
      }elseif (($mayus==2)&&($encript==1)) { //Minusculas y encriptar
        //Limpieza del campo
          $campo = htmlspecialchars(limpiar_campo($dato),ENT_QUOTES);
        //Revision de llenado
          if ($llenado==1) {
            if (!empty($campo)) {
              $campo = $campo;
            }else{
              //Se imprime un mensaje de alerta
              echo "<script>alert('¡ATENCION!, UNO DE LOS DATOS ESTA INCOMPLETO');</script>";
              //Se deiene el procedimiento
              die();
            }
          }
        //Conversion a minusculas
          $campo = strtolower($campo);
        //Encriptacion
          $campo = encriptar_ligero($campo);
        //
      }elseif (($mayus==0)&&($encript==1)) { //Solo encriptar
        //Limpieza del campo
          $campo = htmlspecialchars(limpiar_campo($dato),ENT_QUOTES);
        //Revision de llenado
          if ($llenado==1) {
            if (!empty($campo)) {
              $campo = $campo;
            }else{
              //Se imprime un mensaje de alerta
              echo "<script>alert('¡ATENCION!, UNO DE LOS DATOS ESTA INCOMPLETO');</script>";
              //Se deiene el procedimiento
              die();
            }
          }
        //Encriptacion
          $campo = encriptar_ligero($campo);
        //
      }elseif(($mayus==1)&&($encript==2)) { //Mayusculas y desencriptar
        //Revision de cadena llena
          if (!empty($dato)) {
            //No se realiza nada
          }else{
            //Se imprime un mensaje de alerta
            echo "<script>alert('VALOR O DATO INVALIDO');</script>";
            //Se deiene el procedimiento
            die();
          }
        //Desencriptacion
          $campo = desencriptar_ligero($dato);
        //Limpieza del campo
          $campo = htmlspecialchars(limpiar_campo($campo),ENT_QUOTES);
        //Conversion a mayúsculas
          $campo = mb_strtoupper($campo);
        //Revision de llenado
          if ($llenado==1) {
            if (!empty($campo)) {
              $campo = $campo;
            }else{
              //Se imprime un mensaje de alerta
              echo "<script>alert('¡ATENCION!, UNO DE LOS DATOS ESTA INCOMPLETO');</script>";
              //Se deiene el procedimiento
              die();
            }
          }
        //
      }elseif (($mayus==2)&&($encript==2)) { //Minusculas y desencriptar
        //Revision de cadena llena
          if (!empty($dato)) {
            //No se realiza nada
          }else{
            //Se imprime un mensaje de alerta
            echo "<script>alert('VALOR O DATO INVALIDO');</script>";
            //Se deiene el procedimiento
            die();
          }
        //Desencriptacion
          $campo = desencriptar_ligero($dato);
        //Limpieza del campo
          $campo = htmlspecialchars(limpiar_campo($campo),ENT_QUOTES);
        //Conversion a minusculas
          $campo = strtolower($campo);
        //Revision de llenado
          if ($llenado==1) {
            if (!empty($campo)) {
              $campo = $campo;
            }else{
              //Se imprime un mensaje de alerta
              echo "<script>alert('¡ATENCION!, UNO DE LOS DATOS ESTA INCOMPLETO');</script>";
              //Se deiene el procedimiento
              die();
            }
          }
        //
      }elseif (($mayus==0)&&($encript==2)) { //Solo desencriptar
        //Revision de cadena llena
          if (!empty($dato)) {
            //No se realiza nada
          }else{
            //Se imprime un mensaje de alerta
            echo "<script>alert('VALOR O DATO INVALIDO');</script>";
            //Se deiene el procedimiento
            die();
          }
        //Desencriptacion
          $campo = desencriptar_ligero($dato);
        //Limpieza del campo
          $campo = htmlspecialchars(limpiar_campo($campo),ENT_QUOTES);
        //Revision de llenado
          if ($llenado==1) {
            if (!empty($campo)) {
              $campo = $campo;
            }else{
              //Se imprime un mensaje de alerta
              echo "<script>alert('¡ATENCION!, UNO DE LOS DATOS ESTA INCOMPLETO');</script>";
              //Se deiene el procedimiento
              die();
            }
          }
        //
      }elseif(($mayus==1)&&($encript==0)) { //Mayusculas
        //Limpieza del campo
          $campo = htmlspecialchars(limpiar_campo($dato),ENT_QUOTES);
        //Revision de llenado
          if ($llenado==1) {
            if (!empty($campo)) {
              $campo = $campo;
            }else{
              //Se imprime un mensaje de alerta
              echo "<script>alert('¡ATENCION!, UNO DE LOS DATOS ESTA INCOMPLETO');</script>";
              //Se deiene el procedimiento
              die();
            }
          }
        //Conversion a mayúsculas
          $campo = mb_strtoupper($campo);
        //Revision de llenado
          if ($llenado==1) {
            if (!empty($campo)) {
              $campo = $campo;
            }else{
              //Se imprime un mensaje de alerta
              echo "<script>alert('¡ATENCION!, UNO DE LOS DATOS ESTA INCOMPLETO');</script>";
              //Se deiene el procedimiento
              die();
            }
          }
        //
      }elseif (($mayus==2)&&($encript==0)) { //Minusculas
        //Revision de llenado
          if ($llenado==1) {
            if (!empty($dato)) {
              //No se realiza nada
            }else{
              //Se imprime un mensaje de alerta
              echo "<script>alert('¡ATENCION!, UNO DE LOS DATOS ESTA INCOMPLETO');</script>";
              //Se deiene el procedimiento
              die();
            }
          }
        //Limpieza del campo
          $campo = htmlspecialchars(limpiar_campo($dato),ENT_QUOTES);
        //Conversion a minusculas
          $campo = strtolower($campo);
        //Revision de llenado
          if ($llenado==1) {
            if (!empty($campo)) {
              $campo = $campo;
            }else{
              //Se imprime un mensaje de alerta
              echo "<script>alert('¡ATENCION!, UNO DE LOS DATOS ESTA INCOMPLETO');</script>";
              //Se deiene el procedimiento
              die();
            }
          }
        //
      }elseif (($mayus==0)&&($encript==0)) { //Ningun formato
        //Revision de llenado
          if ($llenado==1) {
            if (!empty($dato)) {
              //No se realiza nada
            }else{
              //Se imprime un mensaje de alerta
              echo "<script>alert('¡ATENCION!, UNO DE LOS DATOS ESTA INCOMPLETO');</script>";
              //Se deiene el procedimiento
              die();
            }
          }
        //Limpieza del campo
          $campo = htmlspecialchars(limpiar_campo($dato),ENT_QUOTES);
        //Revision de llenado
          if ($llenado==1) {
            if (!empty($campo)) {
              $campo = $campo;
            }else{
              //Se imprime un mensaje de alerta
              echo "<script>alert('¡ATENCION!, UNO DE LOS DATOS ESTA INCOMPLETO');</script>";
              //Se deiene el procedimiento
              die();
            }
          }
        //
      }
      //Se regresa el dato ya formateado
      return $campo;
    }
  //Función para enviar correo y dar una respuesta
    function manda_correo($cabecera,$destino,$mensaje,$respuesta){
      $mail = new PHPMailer(true);
      try {
        $mail->isSMTP();
        $mail->CharSet="utf-8";
        $mail->Host=HOST_SEND;
        $mail->SMTPAuth=true;
        $mail->Username=MAIL_SEND;
        $mail->Password=PASS_SEND ;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port=PORT_SEND;
        $mail->setFrom(MAIL_SEND);
        $mail->addAddress($destino);
        $mail->isHTML(true);
        $mail->Subject=$cabecera;
        $mail->Body=$mensaje;
        $mail->AltBody=$mensaje;
        $mail->send();
        return $respuesta;
      } catch (Exception $e) {
        //Almaceno el error en una variabLe
        $error=$e->getMessage();
        //Ubico el archivo desde donde se presenta el error
        $archivo=__FILE__."::Funcion manda_correo";
        //Mando a escribir el mensaje
        escribir_log($error,'',$archivo);
        //Detengo el procedimiento
        die();
      }
    }
  //Función para escribir el log de fallos
    function escribir_log($error,$sentencia,$archivo) {
      //Le quito los saltos de linea a la sentencia
      $sentencia = str_replace("\n",'',$sentencia);
      //Creeo la referencia de tiempo
      $referencia=referencia_horaria();
      //Evaluo si existe un logueo
      if(isset($_SESSION[UBI]['id'])){
        $usuario=campo_limpiado($_SESSION[UBI]['nombre'],2,0)." ".campo_limpiado($_SESSION[UBI]['apellido'],2,0);
        $linea="$referencia!!$usuario!!$error!!$sentencia!!$archivo";
      }else{
        $linea="$referencia!!NO IDENTIFICADO!!$error!!$sentencia!!$archivo";
      }
      //Encripto el texto
      $texto=campo_limpiado($linea,1,0);
      // Ruta y nombre del archivo de log
      $nombre_txt = A_LOGS . ahora(1) . "-ErrorLog.txt";
      // Intentar abrir el archivo
      $archivo = fopen($nombre_txt, 'a+');
      if ($archivo) {
        // Escribir en el archivo
        fwrite($archivo, $texto . "\n");
        // Cerrar el archivo
        fclose($archivo);
        echo "<script>alert('¡ERROR!, CONTACTA CON EL ADMINISTRADOR (CODIGO: $referencia)');</script>";
      } else {
        echo "<script>alert('¡ERROR!');</script>";
      }
    }
  //Función para obtener los datos de una sentencia ejecutada en la BD central
    function retorna_datos_sistema($sentencia) {
      include A_CONNECTION;
      try {
        //Preparo la sentencia a ejecutar
        $sql = $conn->prepare($sentencia);
        //Ejecutar la sentencia
        $sql->execute();
        // Obtener el número de filas afectadas
        $rowCount = $sql->rowCount();
        // Obtener los datos de la tabla
        $datos = array();
        while ($fila = $sql->fetch(PDO::FETCH_ASSOC)) {
            $datos[] = $fila;
        }
        // Cerrar el cursor
        $sql->closeCursor();
        // Retornar el resultado
        return array('data' => $datos, 'rowCount' => $rowCount);;
        //
      } catch (PDOException $e) {
        //Almaceno el error en una variabLe
        $error=$e->getMessage();
        //Ubico el archivo desde donde se presenta el error
        $archivo=__FILE__."::Funcion busca_dato_plataforma";
        //Mando a escribir el mensaje
        escribir_log($error,$sentencia,$archivo);
        //Detengo el procedimiento
        die();
      }
    }
  //Función para buscar la cantidad de registros existentes
    function busca_existencia($sentencia) {
      include A_CONNECTION;
      try {
        //Preparo la sentencia a ejecutar
        $sql = $conn->prepare($sentencia);
        //Ejecutar la sentencia
        $sql->execute();
        //Asocio los datos de la tabla obtenidos
        $tabla=$sql->fetch(PDO::FETCH_ASSOC);
        //Retorna el valor obtenido
        return $tabla['exist'];
        //finalizo el cursor
        $sql->CloseCursor();
        //
      } catch (PDOException $e) {
        //Almaceno el error en una variabLe
        $error=$e->getMessage();
        //Ubico el archivo desde donde se presenta el error
        $archivo=__FILE__."::Funcion busca_existencia";
        //Mando a escribir el mensaje
        escribir_log($error,$sentencia,$archivo);
        //Detengo el procedimiento
        die();
      }
    }
  //Función para ejecutar sentencias dentro de la base de datos de la plataforma
    function ejecuta_sentencia_sistema($sentencia,$mensaje) {
      include A_CONNECTION;
      try {
        //Preparo la sentencia a ejecutar
        $sql=$conn->prepare($sentencia);
        //ejecuto la sentencia
        $res=$sql->execute();
        //finalizo el cursor
        $sql->CloseCursor();
        //Retorna el valor de mensaje dado
        return $mensaje;
        //
      } catch (PDOException $e) {
        //Almaceno el error en una variabLe
        $error=$e->getMessage();
        //Ubico el archivo desde donde se presenta el error
        $archivo=__FILE__."::Funcion ejecuta_sentencia_sistema";
        //Mando a escribir el mensaje
        escribir_log($error,$sentencia,$archivo);
        //Detengo el procedimiento
        die();
      }
    }
  // Función para ejecutar sentencias dentro de la base de datos de la plataforma
    function registra_bitacora($mensaje) {
      include A_CONNECTION;
      $sentencia="
      INSERT INTO bitacora (fecha,hora,accion,usuario) VALUES (
        '".ahora(1)."',
        '".ahora(2)."',
        '$mensaje',
        ".campo_limpiado($_SESSION[UBI]['id'],2,0)."
      );";
      try {
        //Preparo la sentencia a ejecutar
        $sql=$conn->prepare($sentencia);
        //ejecuto la sentencia
        $res=$sql->execute();
        //finalizo el cursor
        $sql->CloseCursor();
        //Retorna el valor de mensaje dado
        return $mensaje;
        //
      } catch (PDOException $e) {
        //Almaceno el error en una variabLe
        $error=$e->getMessage();
        //Ubico el archivo desde donde se presenta el error
        $archivo=__FILE__."::Funcion registra_bitacora";
        //Mando a escribir el mensaje
        escribir_log($error,$sentencia,$archivo);
        //Detengo el procedimiento
        die();
      }
    }
  /*//Funcion para generar los sevicios del dia
    function genera_corridas($fecha,$inicio){
      //Defino una variable para contar los registros realizados
        $contador=0;
      //Verifico si se solicitaron las corridas de una taquilla en especifico
        if($inicio!=''){ $agregado=" and punto_origen='$inicio'"; }else{ $agregado=Null; }
      //Defino la sentencia para obtener todas las corridas activas
        $sentencia="SELECT * FROM servicio where estatus=true$agregado";
      //Ejecuto la sentencia y almaceno lo obtenido en una variable
        $resultado_sentencia=retorna_datos_sistema($sentencia);
      //Identifico si el reultado no es vacio
        if ($resultado_sentencia['rowCount'] > 0) {
          //Almaceno los datos obtenidos
            $resultado = $resultado_sentencia['data'];
          // Recorrer los datos y llenar las filas
            foreach ($resultado as $tabla_servicio) {
              //Creo una variable especial
                $id_servicio=$tabla_servicio['id'];
                $nombre_ruta=$tabla_servicio['nombre_ruta'];
                $identificador=$tabla_servicio['identificador'];
                $id_punto_inicial=$tabla_servicio['id_punto_inicial'];
                $punto_inicial=$tabla_servicio['punto_inicial'];
                $id_punto_origen=$tabla_servicio['id_punto_origen'];
                $punto_origen=$tabla_servicio['punto_origen'];
                $id_punto_final=$tabla_servicio['id_punto_final'];
                $punto_final=$tabla_servicio['punto_final'];
                $hora=$tabla_servicio['hora'];
              //Reviso su existencia en la tabla de servicios
                $sentencia="
                  SELECT count(id) as exist FROM corrida WHERE 
                  identificador='$identificador' and 
                  id_servicio=$id_servicio and 
                  servicio='$nombre_ruta' and 
                  fecha='$fecha' and 
                  hora='$hora' and 
                  id_punto_origen=$id_punto_origen and 
                  punto_origen='$punto_origen';
                ";
                $existencia=busca_existencia($sentencia);
                if ($existencia<1) {
                  //Defino la creacion del servicio
                    $sentencia="
                      INSERT INTO corrida (
                        identificador,
                        id_servicio,
                        servicio,
                        fecha,
                        hora,
                        id_punto_origen,
                        punto_origen,
                        estatus
                      ) VALUES (
                        '$identificador',
                        $id_servicio,
                        '$nombre_ruta',
                        '$fecha',
                        '$hora',
                        $id_punto_origen,
                        '$punto_origen',
                        1
                      );
                    ";
                  //Realizo la ejecucion de la sentencia
                    $devuelto=ejecuta_sentencia_sistema($sentencia,true);
                  //Si la insercion se realizo correctamente
                    if ($devuelto==true) { $contador++; }
                  //
                }
              //
            }
          //
        }
      //Retorno la cantidad de registros creados
        return $contador;
      //
    }*/
  //Funcion para registrar los boletos vendidos
    function registra_boletos($array){
      //Obtengo la clave del usuario en turno
        $clave=campo_limpiado($_SESSION[UBI]['clave'],2,0);
      //Si viene por venta web, el estado se marca como
        if ($clave=='WEB') { $estado=1; }else{ $estado=2; }
      //Almaceno y separo los datos enviados
        $referencia=campo_limpiado($array['referencia'],2,0);
        $fecha=campo_limpiado($array['fecha'],2,0);
        $taquilla=campo_limpiado($array['taquilla'],2,0);
        $origen=campo_limpiado($array['origen'],2,0);
        $id_destino=campo_limpiado($array['id_destino'],2,0);
        $nombre_destino=campo_limpiado($array['nombre_destino'],2,0);
        $precio_destino=campo_limpiado($array['precio_destino'],2,0);
        $corrida=campo_limpiado($array['corrida'],2,0);
        $hora_corrida=campo_limpiado($array['hora'],2,0);
        $f_actual=ahora(1);
        $h_actual=ahora(2);
      //Defino una variable de contador vacio
        $contador=Null;
      //Separo los datos de los boletos
        $datos_boletos=explode('$$',campo_limpiado($array['boletos'],0,0));
      //Obtengo la cantidad de boletos a insertar
        $numero_filas=count($datos_boletos);
      //Si la cantidad de filas no es nula
        if ($numero_filas!=Null) {
          //Itero un ciclo para revisar el arreglo
            for ($i=0; $i <$numero_filas ; $i++) {
              //Separo los datos de cada fila en columnas
                $columnas=explode('||',$datos_boletos[$i]);
              //Almaceno cada dato en una variable
                $asiento=$columnas[0];
                $nombre_pasajero=$columnas[1];
                $tipo_boleto=$columnas[2];
                $precio=number_format($columnas[3],0);
              //Reviso si ya existe el boleto en la base de datos
                $sentencia="
                  SELECT 
                    count(id) as exist
                  FROM 
                    boleto 
                  where
                    punto_venta='$taquilla' and 
                    origen='$origen' and 
                    destino='$nombre_destino' and 
                    tipo ='$tipo_boleto' and 
                    precio='$precio' and 
                    pasajero='$nombre_pasajero' and 
                    asiento='$asiento' and 
                    f_corrida='$fecha' and 
                    corrida='$corrida' and 
                    hora_corrida='$hora_corrida' and 
                    f_venta='$f_actual'
                ";
              //Se ejecuta la sentencia y se almacena el resutado
                $existencia=busca_existencia($sentencia);
              //Evaluo si ya existe un boleto con esas caracteristicas
                if ($existencia<1) {
                  //Defino la insercion del boleto
                    $sentencia="
                      INSERT INTO boleto (
                        punto_venta,
                        origen,
                        destino,
                        tipo,
                        precio,
                        pasajero,
                        asiento,
                        f_corrida,
                        corrida,
                        hora_corrida,
                        f_venta,
                        h_venta,
                        usuario,
                        referencia,
                        estado
                      ) VALUES (
                        '$taquilla',
                        '$origen',
                        '$nombre_destino',
                        '$tipo_boleto',
                        '$precio',
                        '$nombre_pasajero',
                        '$asiento',
                        '$fecha',
                        '$corrida',
                        '$hora_corrida',
                        '$f_actual',
                        '$h_actual',
                        '$clave',
                        '$referencia',
                        '$estado'

                      );
                    ";
                  //Realizo la ejecucion de la sentencia
                    $devuelto=ejecuta_sentencia_sistema($sentencia,true);
                  //Si la insercion se realizo correctamente
                    if ($devuelto==true) { $contador++; }
                  //
                }
              //
            }
          //
        }
      //Si se elaboro de manera correcta el registro, retorno la referencia
        return $referencia;
      //
    }
  //
?>