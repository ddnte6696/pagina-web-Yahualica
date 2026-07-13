<?php
  //Se revisa si la sesión esta iniciada y sino se inicia
    if (session_status() === PHP_SESSION_NONE) {session_start();}
  //Se manda a llamar el archivo de configuración
    include_once $_SERVER['DOCUMENT_ROOT'].'/'.$_SESSION['ubi'].'/lib/config.php';

class Ticket {
    private $db;

    public function __construct() {
        $this->db = getDatabaseConnection();
    }

    public function getAllTickets() {
        $stmt = $this->db->query("SELECT * FROM tickets");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTicketById($id) {
        $stmt = $this->db->prepare("SELECT * FROM tickets WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}