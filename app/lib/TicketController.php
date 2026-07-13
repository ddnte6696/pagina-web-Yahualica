<?php
require_once '../model/Ticket.php';

class TicketController {
    public function index() {
        $ticketModel = new Ticket();
        $tickets = $ticketModel->getAllTickets();
        require_once '../app/views/tickets/index.php';
    }

    public function show($id) {
        $ticketModel = new Ticket();
        $ticket = $ticketModel->getTicketById($id);
        require_once '../app/views/tickets/show.php';
    }
}