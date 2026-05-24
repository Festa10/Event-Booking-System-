<?php 

function myErrorHandler($errno, $errstr, $errfile, $errline) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}
set_error_handler("myErrorHandler");


include __DIR__ . "/../includes/header.php"; 
?>

<style>
    .weather-page-wrapper {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 85vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Poppins', sans-serif;
        padding: 20px;
    }
    .weather-card {
        background: #ffffff;
        padding: 40px;
        border-radius: 25px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        text-align: center;
        width: 100%;
        max-width: 400px;
        border: 1px solid rgba(255,255,255,0.3);
    }
    .weather-icon-bg {
        background: #f8f9fa;
        border-radius: 50%;
        width: 130px;
        height: 130px;
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .temp-large { font-size: 55px; font-weight: 700; color: #2c3e50; margin: 0; }
    .condition-text { text-transform: capitalize; color: #7f8c8d; font-size: 18px; font-weight: 500; }
    .btn-back {
        margin-top: 25px;
        display: inline-block;
        padding: 10px 20px;
        background: #3498db;
        color: white;
        text-decoration: none;
        border-radius: 10px;
        font-size: 14px;
        transition: 0.3s;
    }
    .btn-back:hover { background: #2980b9; color: white; }
</style>

<div class="weather-page-wrapper">
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
                return ['temp' => 22, 'desc' => 'Kthjellët (Demo)', 'icon' => '01d'];
            }
        } catch (Exception $e) { return null; }
    }

   
    $city = isset($_GET['city']) ? htmlspecialchars($_GET['city']) : "Prishtina";
    
    try {
        $weather = getEventWeather($city);

        if ($weather) {
            echo "<div class='weather-card'>";
            echo "<h2 style='margin-bottom: 5px; color: #333;'>Moti në $city</h2>";
            echo "<p style='font-size: 14px; color: #999; margin-bottom: 20px;'>Parashikimi live për lokacionin e eventit</p>";
            
            echo "<div class='weather-icon-bg'>";
            echo "<img src='http://openweathermap.org/img/wn/" . $weather['icon'] . "@4x.png' width='110'>";
            echo "</div>";
            
            echo "<p class='temp-large'>" . round($weather['temp']) . "°C</p>";
            echo "<p class='condition-text'>" . $weather['desc'] . "</p>";
            
            echo "<a href='../pages/view_event.php' class='btn-back'>← Kthehu te Eventet</a>";
            
            echo "</div>";
        }
    } catch (Exception $e) {
        echo "<div class='alert alert-danger'>Gabim: " . $e->getMessage() . "</div>";
    }
    ?>
</div>

<?php 

include __DIR__ . "/../includes/footer.php"; 
?>
