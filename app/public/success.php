<?php
//Se revisa si la sesión esta iniciada y sino se inicia
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
if ($_SESSION['ubi']=='') { $_SESSION['ubi']="app"; }
//Se manda a llamar el archivo de configuración
    include_once $_SERVER['DOCUMENT_ROOT'] . '/' . $_SESSION['ubi'] . '/lib/config.php';

// Verificar si se recibieron los parámetros necesarios
    if (isset($_GET['payment_id']) && isset($_GET['status'])) {
        $id_pago = campo_limpiado($_GET['payment_id']);
        $estado = campo_limpiado($_GET['status']);
        $referencia = campo_limpiado($_GET['external_reference']) ?? "No disponible";

        // Consultar la API de Mercado Pago para obtener más detalles del pago
            $accessToken =A_TOKEN;
            $url = "https://api.mercadopago.com/v1/payments/" . $id_pago;
        //
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer " . $accessToken
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $paymentDetails = json_decode($response, true);

        if (isset($paymentDetails['id'])) {
            // Datos básicos
                $monto = campo_limpiado($paymentDetails['transaction_details']['total_paid_amount']);
                $moneda = campo_limpiado($paymentDetails['currency_id']);
                $monto_total_transaccion = campo_limpiado($paymentDetails['transaction_amount']);
                $monto_neto_transaccion = campo_limpiado($paymentDetails['transaction_details']['net_received_amount']);
            // Información del comprador
                $mail_comprador = campo_limpiado($paymentDetails['payer']['email']) ?? "No disponible";
                $nombre_comprador = campo_limpiado($paymentDetails['payer']['first_name']) . " " . campo_limpiado($paymentDetails['payer']['last_name']);
            // Detalles del pago
                $metodo_pago = campo_limpiado($paymentDetails['payment_method_id']);
                $tipo_pago = campo_limpiado($paymentDetails['payment_type_id']);
                $cantidad_cuotas = $paymentDetails['transaction_details']['installments'] ?? 0;
                $importe_cuotas = campo_limpiado($paymentDetails['transaction_details']['installment_amount']) ?? 0;
            // Fechas importantes
                $fecha_creacion = campo_limpiado($paymentDetails['date_created']);
                $fecha_aprovacion = campo_limpiado($paymentDetails['date_approved']) ?? "Pendiente";
            // Defibno la sentencia para insertar los datos en la base de datos
                $sentencia = "INSERT INTO venta_web (id_pago, estado, referencia, monto, monto_neto, moneda, mail_comprador, nombre_comprador, metodo_pago, tipo_pago, cantidad_cuotas, importe_cuotas, fecha_creacion, fecha_aprovacion) VALUES ('$id_pago', '$estado', '$referencia', '$monto', '$monto_neto_transaccion', '$moneda', '$mail_comprador', '$nombre_comprador', '$metodo_pago', '$tipo_pago', $cantidad_cuotas, $importe_cuotas, '$fecha_creacion', '$fecha_aprovacion')";
            //Ejecuto la sentencia
                $resultado=ejecuta_sentencia_sistema($sentencia,true);
            //Evaluo el resultado
                if ($resultado===TRUE) {
                    //Actualizo el estado de los boletos vendidos
                        $sentencia2="UPDATE boleto SET estado=2 WHERE referencia='$referencia';";
                    //Ejecuto la sentencia
                        $resultado2=ejecuta_sentencia_sistema($sentencia2,true);
                    //Evaluo el resultado
                        if ($resultado2===TRUE) {
                            //Redirijo a la pagina de impresion de los boletos
                                header("Location: boletos.php?ref=".campo_limpiado($referencia,1));
                            //
                        }
                    //
                }
        } else {
            echo "No se pudo obtener información adicional del pago.";
            $monto = "Desconocido";
            $moneda = "Desconocido";
        }
    } else {
        echo "No se recibieron los datos del pago.";
        exit;
    }
