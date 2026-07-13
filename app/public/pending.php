<?php
session_start();

// Verificar si se recibieron los parámetros necesarios
if (isset($_GET['payment_id']) && isset($_GET['status'])) {
    $id_pago = $_GET['payment_id'];
    $estado = $_GET['status'];
    $referencia = $_GET['external_reference'] ?? "No disponible";

    // Consultar la API de Mercado Pago para obtener más detalles del pago
    $accessToken = "APP_USR-3907237835175069-042513-54392cff1eae5de032c47aa617dd5531-1773584073"; // Reemplaza con tu token de acceso
    $url = "https://api.mercadopago.com/v1/payments/" . $id_pago;

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
        $monto = $paymentDetails['transaction_details']['total_paid_amount'];
        $moneda = $paymentDetails['currency_id'];
        $monto_total_transaccion=$paymentDetails['transaction_amount'];
        $monto_neto_transaccion=$paymentDetails['transaction_details']['net_received_amount'];

        // Información del comprador
        $mail_comprador = $paymentDetails['payer']['email'] ?? "No disponible";
        $nombre_comprador = $paymentDetails['payer']['first_name'] . " " . $paymentDetails['payer']['last_name'];

        // Detalles del pago
        $metodo_pago = $paymentDetails['payment_method_id'];
        $tipo_pago = $paymentDetails['payment_type_id'];
        $cantidad_cuotas = $paymentDetails['transaction_details']['installments'] ?? 0;
        $importe_cuotas = $paymentDetails['transaction_details']['installment_amount'] ?? 0;

        // Fechas importantes
        $fecha_creacion = $paymentDetails['date_created'];
        $fecha_aprovacion = $paymentDetails['date_approved'] ?? "Pendiente";

    } else {
        echo "No se pudo obtener información adicional del pago.";
        $monto = "Desconocido";
        $moneda = "Desconocido";
    }
} else {
    echo "No se recibieron los datos del pago.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Exitoso</title>
</head>
<body>
    <h1>¡Pago Exitoso!</h1>
    <p>Gracias por su compra.</p>
    <h2>Detalles del Pago:</h2>
    <ul>
        <li>ID de Pago: <?php echo htmlspecialchars($id_pago); ?></li>
        <li>Monto: <?php echo htmlspecialchars($monto); ?> <?php echo htmlspecialchars($moneda); ?></li>
        <li>Monto total de la transaccion: <?php echo htmlspecialchars($monto_total_transaccion); ?> <?php echo htmlspecialchars($moneda); ?></li>
        <li>Monto neto: <?php echo htmlspecialchars($monto_neto_transaccion); ?> <?php echo htmlspecialchars($moneda); ?></li>
        <li>Estado: <?php echo htmlspecialchars($estado); ?></li>
        <li>Referencia Externa: <?php echo htmlspecialchars($referencia); ?></li>
        <li>Método de Pago: <?php echo htmlspecialchars($metodo_pago); ?></li>
        <li>Tipo de Pago: <?php echo htmlspecialchars($tipo_pago); ?></li>
        <li>Cuotas: <?php echo htmlspecialchars($cantidad_cuotas); ?></li>
        <li>Monto por Cuota: <?php echo htmlspecialchars($importe_cuotas); ?></li>
        <li>Correo del Comprador: <?php echo htmlspecialchars($mail_comprador); ?></li>
        <li>Nombre del Comprador: <?php echo htmlspecialchars($nombre_comprador); ?></li>
        <li>Fecha de Creación: <?php echo htmlspecialchars($fecha_creacion); ?></li>
        <li>Fecha de Aprobación: <?php echo htmlspecialchars($fecha_aprovacion); ?></li>
    </ul>
    <a href="/">Volver a la página principal</a>
</body>
</html>