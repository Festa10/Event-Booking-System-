<?php

 
function sendBookingConfirmation($userEmail, $userName, $eventName, $eventDate) {
    
    $subject = "Konfirmimi i Rezervimit - " . $eventName;
    
    $message = "
    <html>
    <head>
        <title>Konfirmimi i Rezervimit</title>
    </head>
    <body>
        <h2>Përshëndetje $userName,</h2>
        <p>Ju njoftojmë se rezervimi juaj për eventin <strong>$eventName</strong> u krye me sukses!</p>
        <p><strong>Data e eventit:</strong> $eventDate</p>
        <br>
        <p>Faleminderit që përdorni platformën tonë!</p>
    </body>
    </html>
    ";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: no-reply@eventbooking.com" . "\r\n";

    try {
       
        $sent = mail($userEmail, $subject, $message, $headers);

        if (!$sent) {
            throw new Exception("Email-i nuk mund të dërgohej. Kontrolloni konfigurimin e serverit.");
        }

        return true;
    } catch (Exception $e) {
        error_log("Gabim gjatë dërgimit të email-it: " . $e->getMessage());
        return false;
    }
}
