<?php
require_once '../lib/TicketController.php';
require_once '../lib/PaymentController.php';

$uri = $_SERVER['REQUEST_URI'];

if ($uri === '/tickets') {
    $controller = new TicketController();
    $controller->index();
} elseif ($uri === '/tickets/show') {
    $controller = new TicketController();
    $controller->show($_GET['id']);
} elseif ($uri === '/payments/process') {
    $controller = new PaymentController();
    $controller->process();
} elseif ($uri === '/payments/success') {
    $controller = new PaymentController();
    $controller->success();
} else {
    echo "404 - Página no encontrada";
}