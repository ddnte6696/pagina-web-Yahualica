<?php
//Se revisa si la sesión esta iniciada y sino se inicia
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
if ($_SESSION['ubi']=='') { $_SESSION['ubi']="app"; }
//Se manda a llamar el archivo de configuración
    include_once $_SERVER['DOCUMENT_ROOT'] . '/' . $_SESSION['ubi'] . '/lib/config.php';
    //Incluyo la cabecera del sistema
        //include_once '../view/header.php';
    //Defino algunas variables necesarias
        $fecha_cancela=ahora(1);
        $usuario_cancela='WEB';
        $motivo='PAGO FALLIDO';
    //Imprimo un mensaje de error
    echo "
        <script type='text/javascript'>
            alert('EL PAGO FUE CANCELADO, POR FAVOR INTENTE NUEVAMENTE.');
        </script>
    ";
    // Verificar si se recibieron los parámetros necesarios
        if (isset($_GET['payment_id']) && isset($_GET['status'])) {
            $id_pago = campo_limpiado($_GET['payment_id']);
            $estado = campo_limpiado($_GET['status']);
            $referencia = campo_limpiado($_GET['external_reference']) ?? "No disponible";
            //Actualizo el estado de los boletos vendidos
                $sentencia="UPDATE boleto SET estado=3,fecha_cancela='$fecha_cancela', usuario_cancela='$usuario_cancela', motivo='$motivo' WHERE referencia='$referencia';";
            //Ejecuto la sentencia
                $resultado=ejecuta_sentencia_sistema($sentencia,true);
            //Evaluo el resultado
                if ($resultado===TRUE) {
                    //Redirijo a la pagina de impresion de los boletos
                        header("Location: https://omnibus-guadalajara.com/");
                    //
                }
            //
    } else {
        echo "No se recibieron los datos del pago.";
        header("Location: https://omnibus-guadalajara.com/");
        exit;
    }
?>