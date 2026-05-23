<?php

include "../../classes/Database.php";
include "../../classes/Event.php";

$db = (new Database())->connect();
$event = new Event($db);

if(isset($_GET['id'])) {

    $event->id = $_GET['id'];

    if($event->delete()) {

        echo "success";

    } else {

        echo "error";
    }

}

?>