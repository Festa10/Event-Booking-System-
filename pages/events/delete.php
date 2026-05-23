<?php

include "../../classes/Database.php";
include "../../classes/Event.php";

$db = (new Database())->connect();
$event = new Event($db);

$event->id = $_GET['id'];
$event->delete();

header("Location: index.php");

?>