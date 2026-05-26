<?php

include "../../includes/database.php";
require_once "../../classes/Event.php";
require_once "../../includes/auth.php";

requireRole(["admin"]);

$event = new Event($conn);

// check ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid request");
}

$event->id = $_GET['id'];

if ($event->delete()) {
    header("Location: index.php?msg=deleted");
    exit();
} else {
    die("Error deleting event");
}
?>