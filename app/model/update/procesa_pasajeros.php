<?php
// Se revisa si la sesión está iniciada y sino se inicia
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Se manda a llamar el archivo de configuración
include_once $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['ubi'].'/lib/config.php';

// Defino una variable para sumatoria nula
$sumatoria = 0;

// Separo los registros de los boletos 
$filas = explode('$$', $_SESSION['oyg_vb']['boletos']);
$numero_filas = count($filas);

// Defino un ciclo para recorrer la tabla
for ($i = 0; $i < $numero_filas; $i++) {
    // Separo las filas en columnas
    $columnas = explode('||', $filas[$i]);
    // Sumo los importes de los boletos
    $sumatoria += floatval($columnas[3]); // Asegúrate de convertir a float
}

// Calculo el monto a cobrar considerando la comisión de Mercado Pago
$porcentaje_comision = 0.0349; // Comisión base (3.49%)
$iva = 0.16; // IVA (16%)
$comision_fija = 4.64; // Comisión fija en pesos

/*$comision_base = $sumatoria * $porcentaje_comision; // Comisión sin IVA
$iva_comision = $comision_base * $iva; // IVA sobre la comisión
$comision_total = $comision_base + $iva_comision; // Comisión total con IVA
$cobro = $sumatoria + $comision_total; // Monto total a cobrar

// Redondeo los valores a dos decimales
$sumatoria = round($sumatoria, 2);
$comision_total = round($comision_total, 2);
$cobro = round($cobro, 2);

// Almaceno el dato del cobro, el total y la comisión en la variable de sesión
$_SESSION['oyg_vb']['importe_total'] = $sumatoria; // Subtotal (importe total de los boletos)
$_SESSION['oyg_vb']['comision'] = $comision_total; // Comisión total (incluyendo IVA)
$_SESSION['oyg_vb']['cobro'] = $cobro; // Monto total a cobrar (subtotal + comisión)*/

// Cálculo del monto a cobrar (bruto) para recibir el neto deseado
$factor_descuento = 1 - ($porcentaje_comision * (1 + $iva));
$cobro = ($sumatoria + $comision_fija) / $factor_descuento;

// Cálculo de la comisión total
$comision_total = $cobro - $sumatoria;

// Redondeo a 2 decimales
$sumatoria = round($sumatoria, 2);
$comision_total = round($comision_total, 2);
$cobro = round($cobro, 2);

// Almaceno en la sesión
$_SESSION['oyg_vb']['importe_total'] = $sumatoria;      // Lo que quieres recibir
$_SESSION['oyg_vb']['comision'] = $comision_total;      // Comisión total
$_SESSION['oyg_vb']['cobro'] = $cobro;     

// Redirecciono a la página siguiente
echo "<script>window.location.href='final.php';</script>";
?>