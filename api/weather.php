<?php


function getEventWeather($city) {
    $apiKey = "8797f1f51084803099951336c539207e"; 
    $url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city) . "&appid=" . $apiKey . "&units=metric";

    try {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception("Gabim gjatë lidhjes me API: " . curl_error($ch));
        }

        $data = json_decode($response, true);
        curl_close($ch);

        if ($data['cod'] != 200) {
            throw new Exception("Qyteti nuk u gjet ose API Key është i pasaktë.");
        }

        return [
            'temp' => $data['main']['temp'],
            'desc' => $data['weather'][0]['description'],
            'icon' => $data['weather'][0]['icon']
        ];

    } catch (Exception $e) {
        error_log($e->getMessage());
        return null;
    }
}

$city = "Prishtina"; 
$weather = getEventWeather($city);

if ($weather) {
    echo "<h1>Informacionet mbi Motin</h1>";
    echo "<strong>Qyteti:</strong> " . $city . "<br>";
    echo "<strong>Temperatura:</strong> " . $weather['temp'] . "°C <br>";
    echo "<strong>Kushtet:</strong> " . $weather['desc'] . "<br>";
    echo "<img src='http://openweathermap.org/img/wn/" . $weather['icon'] . "@2x.png' alt='Weather icon'>";
} else {
    echo "Gabim: Nuk mund të merren të dhënat e motit.";
}
