<?php

function getEventWeather($city) {
    $apiKey = "8797f1f51084803099951336c539207e"; 
    $url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city) . "&appid=" . $apiKey . "&units=metric";

    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        
    
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
           
            return [
                'temp' => 22,
                'desc' => 'Kthjellët (Test Mode)',
                'icon' => '01d'
            ];
        }

    } catch (Exception $e) {
        return null;
    }
}


$city = "Prishtina"; 
$weather = getEventWeather($city);

if ($weather) {
    echo "<div style='font-family: Arial; border: 1px solid #ccc; padding: 20px; width: 300px; border-radius: 10px;'>";
    echo "<h2>Moti në " . $city . "</h2>";
    echo "<img src='http://openweathermap.org/img/wn/" . $weather['icon'] . "@2x.png' style='background: #eee; border-radius: 50%;'>";
    echo "<p style='font-size: 24px;'><strong>" . $weather['temp'] . "°C</strong></p>";
    echo "<p>Kushtet: " . ucfirst($weather['desc']) . "</p>";
    echo "</div>";
} else {
    echo "Gabim kritik: Nuk mund të lidhet me serverin.";
}

?>
