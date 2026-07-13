<?php
    //Se revisa si la sesión esta iniciada y sino se inicia
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    //Se manda a llamar el archivo de configuración
        include_once $_SERVER['DOCUMENT_ROOT'] . '/' . $_SESSION['ubi'] . '/lib/config.php';
require_once '../model/services/PaymentService.php';
class PaymentController {
    private $paymentService;

    public function __construct($paymentService) {
        $this->paymentService = $paymentService;
    }

    public function processPayment($data) {
        // Datos de ejemplo para la preferencia
        $preferenceData = [
            "items" => [
                [   
                    "id" => campo_limpiado($_SESSION['oyg_vb']['referencia'],2,0),
                    "title" => "PASE DE ABORDAR",
                    "quantity" => 1,
                    "unit_price" => $_SESSION['oyg_vb']['cobro'],
                    "currency_id" => "MX",
                    "description" => "Pase de abordaje",
                    "category_id" => "Travels",
                ]
            ],
            "notification_url" => "https://omnibus-guadalajara.com/app/public/hook.php",
            "external_reference" => campo_limpiado($_SESSION['oyg_vb']['referencia'],2,0), // Identificador único de tu sistema
            "back_urls" => [
                "success" => A_SUCCESS,
                "failure" => A_FAILURE,
                "pending" => A_PENDING
            ],
            "auto_return" => "approved",
            "payment_methods" => [
                "excluded_payment_types" => [
                    ["id" => "ticket"],         // Excluye boletos (ejemplo: OXXO, Pago Fácil)
                    ["id" => "atm"],           // Excluye pagos en cajeros automáticos
                    ["id" => "bank_transfer"]  // Excluye transferencias SPEI
                ],
                "installments" => 12 // Limita la cantidad máxima de cuotas (opcional)
            ]

        ];

        // Crear la preferencia utilizando el servicio
        $preference = $this->paymentService->createPreference($preferenceData);

        // Redirigir al usuario al enlace de pago
        if (isset($preference['init_point'])) {
            header("Location: " . $preference['init_point']);
            exit();
        } else {
            echo "Error al crear la preferencia de pago.";
        }
    }

    public function success() {
        // Aquí puedes manejar la lógica después de un pago exitoso
        echo "Pago procesado con éxito.";
    }

    public function failure() {
        // Aquí puedes manejar la lógica después de un fallo en el pago
        echo "El pago ha fallado.";
    }
}

// Llama al controlador para crear la preferencia
//$paymentController = new PaymentController(new PaymentService("APP_USR-3907237835175069-042513-54392cff1eae5de032c47aa617dd5531-1773584073"));
$paymentController = new PaymentController(new PaymentService(A_TOKEN));
$paymentController->processPayment([]);