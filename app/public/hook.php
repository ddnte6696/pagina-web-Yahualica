
<?php
// Recibe la notificación de MercadoPago

// Lee el contenido del POST recibido
$input = file_get_contents('php://input');

// Opcional: Guarda la notificación en un archivo para depuración
file_put_contents(__DIR__ . '/webhook_log.txt', date('Y-m-d H:i:s') . " - " . $input . PHP_EOL, FILE_APPEND);

// Decodifica el JSON recibido
$data = json_decode($input, true);

// Procesa la notificación según el tipo de evento
if (isset($_GET['type']) && $_GET['type'] === 'payment') {
    // Aquí puedes consultar la API de MercadoPago para obtener detalles del pago
    // Ejemplo: $data['data']['id'] contiene el ID del pago
    // Puedes actualizar el estado del pago en tu base de datos aquí
}

// Responde a MercadoPago con un 200 OK
http_response_code(200);
echo 'OK';
?>