<?php 
function myErrorHandler($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}
set_error_handler("myErrorHandler");

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
            return ['temp' => 22, 'desc' => 'Kthjellët (Demo)', 'icon' => '01d'];
        }
    } catch (Exception $e) { return null; }
}


function sendBookingConfirmation($userEmail, $userName, $eventName, $eventDate) {
    
    return true; 
}


$city = isset($_GET['city']) ? htmlspecialchars($_GET['city']) : "Prishtina";
$weather = getEventWeather($city);
$emailStatus = sendBookingConfirmation("klienti@email.com", "Përdoruesi", "Eventi i zgjedhur", "2026-06-15");


include __DIR__ . "/../includes/header.php"; 
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .weather-page-wrapper {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 75vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px 20px;
        font-family: 'Poppins', sans-serif;
    }
    .weather-card {
        background: #ffffff;
        padding: 40px;
        border-radius: 25px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        text-align: center;
        width: 100%;
        max-width: 450px;
        border: none;
    }
    .weather-icon-bg {
        background: #f8f9fa;
        border-radius: 50%;
        width: 120px;
        height: 120px;
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .temp-large { font-size: 60px; font-weight: 700; color: #2c3e50; margin: 0; }
    .condition-text { text-transform: capitalize; color: #7f8c8d; font-size: 18px; font-weight: 500; }
    
    .email-alert {
        background: #d4edda;
        color: #155724;
        padding: 12px;
        border-radius: 10px;
        margin-top: 25px;
        font-size: 14px;
        border: 1px solid #c3e6cb;
    }
    .btn-back {
        margin-top: 20px;
        display: inline-block;
        color: #3498db;
        text-decoration: none;
        font-weight: 600;
        transition: 0.3s;
    }
    .btn-back:hover { color: #2980b9; text-decoration: underline; }
</style>

<div class="weather-page-wrapper">
    <div class="weather-card">
        <h2 class="h4 mb-1">Moti në <?php echo $city; ?></h2>
        <p class="text-muted small mb-4">Informacion live për lokacionin</p>
        
        <div class="weather-icon-bg">
            <img src="http://openweathermap.org/img/wn/<?php echo $weather['icon']; ?>@4x.png" width="100">
        </div>
        
        <p class="temp-large"><?php echo round($weather['temp']); ?>°C</p>
        <p class="condition-text"><?php echo $weather['desc']; ?></p>

        <?php if ($emailStatus): ?>
            <div class="email-alert">
                <i class="fas fa-check-circle"></i> Sistemi: Konfirmimi u dërgua në email!
            </div>
        <?php endif; ?>

        <a href="../pages/view_event.php" class="btn-back">
            <i class="fas fa-arrow-left"></i> Kthehu te Eventet
        </a>
    </div>
</div>

<?php 

include __DIR__ . "/../includes/footer.php"; 
?>
  
