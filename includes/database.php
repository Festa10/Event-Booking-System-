<?php
// Kjo është mënyra e saktë për t'u lidhur me PDO
// që klasa jote Event.php të mos thotë më "Fatal Error"
$host = "127.0.0.1";
$db_name = "eventbooking";
$username = "root";
$password = "";
$port = "3307";

try {
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$db_name;charset=utf8mb4", $username, $password);
    // Kjo ndihmon që PDO të raportojë gabimet siç duhet
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>