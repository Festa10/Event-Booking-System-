<?php

include("includes/database.php");

if ($conn) {
    echo "Database is working ✔";
} else {
    echo "Database NOT working ❌";
}

?>