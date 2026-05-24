<?php 

include __DIR__ . "/../includes/header.php"; 
?>

<style>
   
    .page-container {
        background: linear-gradient(135deg, #ece9e6 0%, #ffffff 100%);
        min-height: 80vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 40px 20px;
        font-family: 'Poppins', sans-serif;
    }

   
    .weather-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        padding: 30px;
        width: 100%;
        max-width: 400px;
        text-align: center;
        border-top: 6px solid #3498db;
    }

    .weather-info h2 { color: #2c3e50; margin-bottom: 5px; }
    .temp-display { font-size: 50px; font-weight: bold; color: #34495e; margin: 10px 0; }
    .condition { text-transform: capitalize; color: #7f8c8d; font-weight: 600; }
    
    .status-msg {
        margin-top: 20px;
        font-size: 13px;
        padding: 10px;
        border-radius: 8px;
        background: #e8f4fd;
        color: #2980b9;
    }
</style>

<div class="page-container">

    <?php
  
    function getEventWeather($city) {
        $apiKey = "8797f1f51084803099951336c539207e"; 
        $url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city) . "&appid=" . $apiKey . "&units=metric";

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            $response = curl_exec($ch);
            $data = json_decode($response, true);
            curl_close($ch);

            if (isset($data['cod']) && $data['cod'] == 200) {
                return [
                    'temp' => $data['main']['temp'],
                    'desc' => $data['weather'][0]['description'],
                    'icon' => $data['weather'][0]['icon']
                ];
            } else {
                return ['temp' => 22, 'desc' => 'Kthjellët (Test Mode)', 'icon' => '01d'];
            }
        } catch (Exception $e) { return null; }
    }


    function sendBookingConfirmation($userEmail, $userName, $eventName, $eventDate) {
        $subject = "Konfirmimi i Rezervimit - " . $eventName;
        $headers = "MIME-Version: 1.0\r\nContent-type:text/html;charset=UTF-8\r\nFrom: no-reply@eventbooking.com\r\n";
        
        $message = "<html><body><h2>Përshëndetje $userName,</h2><p>Rezervimi për <strong>$eventName</strong> u krye me sukses!</
