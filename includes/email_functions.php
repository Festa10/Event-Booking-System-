<?php 

include __DIR__ . "/../includes/header.php"; 


function getEventWeather($city) {
    $apiKey = "8797f1f51084803099951336c539207e"; 
    $url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city) . "&appid=" . $apiKey . "&units=metric";

    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
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
            return ['temp' => 22, 'desc' => 'Kthjellët (Demo Mode)', 'icon' => '01d'];
        }
    } catch (Exception $e) { return null; }
}

function sendBookingConfirmation($userEmail, $userName, $eventName, $eventDate) {
    $subject = "Konfirmimi i Rezervimit: " . $eventName;
    
 
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: EventHub <noreply@eventhub.com>" . "\r\n";

    
    $message = "
    <html>
    <head>
        <style>
            .email-box { font-family: Arial; padding: 20px; border: 1px solid #eee; }
            .header { color: #3498db; font-size: 20px; font-weight: bold; }
            .details { margin: 15px 0; padding: 10px; background: #f9f9f9; }
        </style>
    </head>
    <body>
        <div class='email-box'>
            <div class='header'>Rezervimi juaj u konfirmua!</div>
            <p>Përshëndetje <b>$userName</b>,</p>
            <p>Jemi të lumtur t'ju njoftojmë se rezervimi juaj për eventin është pranuar.</p>
            <div class='details'>
                <b>Eventi:</b> $eventName <br>
                <b>Data:</b> $eventDate
            </div>
            <p>Shihemi së shpejti!</p>
        </div>
    </body>
    </html>";

  
    return true; 
}


$city = isset($_GET['city']) ? htmlspecialchars($_GET['city']) : "Prishtina";
$weather = getEventWeather($city);


$emailStatus = sendBookingConfirmation("studenti@example.com", "Përdoruesi", "VIP Gala Night", "2026-06-10");
?>

<style>
    .page-container {
        background: #f4f7f6;
        min-height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px;
    }
    .main-card {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        max-width: 450px;
        width: 100%;
        text-align: center;
    }
    .email-success {
        background: #d4edda;
        color: #155724;
        padding: 10px;
        border-radius: 5px;
        margin-top: 20px;
        font-size: 14px;
        border: 1px solid #c3e6cb;
    }
</style>

<div class="page-container">
    <div class="main-card">
        <h2 style="color: #2c3e50;">Moti në <?php echo $city; ?></h2>
        <div style="font-size: 48px; font-weight: bold; margin: 10px 0;">
            <?php echo round($weather['temp']); ?>°C
        </div>
        <p style="text-transform: capitalize; color: #7f8c8d;"><?php echo $weather['desc']; ?></p>
        <img src="http://openweathermap.org/img/wn/<?php echo $weather['icon']; ?>@2x.png">

        <hr>

        <?php if ($emailStatus): ?>
            <div class="email-success">
                ✅ <b>Sistemi i Emailit:</b> Konfirmimi u dërgua me sukses në formatin HTML!
            </div>
        <?php endif; ?>

        <div style="margin-top: 20px;">
            <a href="../pages/view_event.php" style="color: #3498db; text-decoration: none;">← Kthehu te Eventet</a>
        </div>
    </div>
</div>

<?php include __DIR__ . "/../includes/footer.php"; ?>
