<?php

class PaymentService {
    private $accessToken;

    public function __construct($accessToken) {
        $this->accessToken = $accessToken;
    }

    public function createPayment($data) {
        $url = "https://api.mercadopago.com/v1/payments";
        $headers = [
            "Content-Type: application/json",
            "Authorization: Bearer " . $this->accessToken
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function getPaymentStatus($paymentId) {
        $url = "https://api.mercadopago.com/v1/payments/" . $paymentId;
        $headers = [
            "Authorization: Bearer " . $this->accessToken
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    public function createPreference($data) {
        $url = "https://api.mercadopago.com/checkout/preferences";
        $headers = [
            "Content-Type: application/json",
            "Authorization: Bearer " . $this->accessToken
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}