<?php

require_once "../../includes/database.php";
require_once "../../classes/Event.php";

$event = new Event($conn); // PDO connection

if (isset($_GET['id'])) {

    $event->id = $_GET['id'];

    if ($event->delete()) {
        echo "success";
    } else {
        echo "error";
    }
}
?>