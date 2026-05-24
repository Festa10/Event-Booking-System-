<?php 

include __DIR__ . "/../includes/header.php"; 
?>

<style>

    .weather-body {
        background: #f4f7f6; 
        min-height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Poppins', sans-serif;
    }
    .weather-card {
        background: #ffffff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        text-align: center;
        width: 350px;
        border-top: 5px solid #3498db; 
    }
    .weather-icon {
        background: #f0f0f0;
        border-radius: 50%;
        margin: 15px 0;
    }
</style>

<div class="weather-body">

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

    $weather = getEventWeather("Prishtina");

    if ($weather) {
        echo "<div class='weather-card'>";
        echo "<h3 style='margin-bottom: 5px;'>Moti në Prishtinë</h3>";
        echo "<p style='font-size: 14px; color: #777;'>Për ditën e eventit tuaj</p>";
        echo "<img src='http://openweathermap.org/img/wn/" . $weather['icon'] . "@2x.png' class='weather-icon'>";
        echo "<h1 style='font-size: 45px; margin: 0; color: #2c3e50;'>" . round($weather['temp']) . "°C</h1>";
        echo "<p style='text-transform: capitalize; font-weight: 600; color: #34495e;'>" . $weather['desc'] . "</p>";
        echo "<hr style='border: 0; border-top: 1px solid #eee; margin: 20px 0;'>";
        echo "</div>";
    }
    ?>

</div>

<?php 

include __DIR__ . "/../includes/footer.php"; 
?>
