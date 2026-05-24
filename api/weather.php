<?php 

include __DIR__ . "/../includes/header.php"; 
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; }
    
  
    nav ul { 
        display: flex !important; 
        list-style: none !important; 
        gap: 20px; 
        padding: 15px;
        background: white;
        margin: 0;
        justify-content: center;
    }
    nav ul li a { text-decoration: none !important; color: #333; font-weight: 500; }

  
    .weather-container {
        background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%);
        min-height: 65vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 50px 20px;
    }
    .weather-card {
        background: white;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        text-align: center;
        width: 100%;
        max-width: 450px;
    }

  
    footer {
        background-color: #0d0d1a !important; 
        color: white !important;
        padding: 60px 0 20px 0 !important;
        margin-top: 0;
    }
    .footer-container {
        display: flex !important;
        justify-content: space-around !important;
        max-width: 1200px;
        margin: 0 auto;
        flex-wrap: wrap;
    }
    .footer-container div { flex: 1; min-width: 250px; padding: 15px; }
    .footer-container h3 { font-size: 22px; margin-bottom: 20px; color: white; }
    .footer-container a { color: #3498db !important; text-decoration: underline !important; }
    .copyright { 
        text-align: left; 
        max-width: 1200px; 
        margin: 40px auto 0 auto; 
        padding: 20px 0 0 50px; 
        border-top: 1px solid #1a1a2e;
        font-size: 14px;
    }
</style>

<div class="weather-container">
    <?php
 
    function fetchWeather($city) {
        $key = "8797f1f51084803099951336c539207e";
        $url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city) . "&appid=$key&units=metric";
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $res = curl_exec($ch);
        curl_close($ch);
        
        $data = json_decode($res, true);
        
        if ($data && $data['cod'] == 200) {
            return [
                'temp' => round($data['main']['temp']),
                'desc' => $data['weather'][0]['description'],
                'icon' => $data['weather'][0]['icon'],
                'city' => $data['name']
            ];
        }
        
        return ['temp' => 22, 'desc' => 'Kthjellët', 'icon' => '01d', 'city' => $city];
    }

  
    $cityInput = (!empty($_GET['city'])) ? $_GET['city'] : "Prishtina";
    $w = fetchWeather($cityInput);
    ?>

    <div class="weather-card">
        <h2 class="fw-bold mb-1">Moti në <?php echo $w['city']; ?></h2>
        <p class="text-muted small mb-4">Parashikimi live për eventin tuaj</p>
        
        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 120px; height: 120px;">
            <img src="http://openweathermap.org/img/wn/<?php echo $w['icon']; ?>@4x.png" width="100">
        </div>
        
        <h1 class="display-3 fw-bold m-0"><?php echo $w['temp']; ?>°C</h1>
        <p class="text-uppercase text-muted fw-bold mb-4"><?php echo $w['desc']; ?></p>

        <div class="alert alert-success border-0 shadow-sm" style="border-radius: 12px;">
            <i class="fas fa-check-circle me-2"></i> Konfirmimi i rezervimit u dërgua!
        </div>

        <a href="../pages/view_event.php" class="text-decoration-none fw-bold mt-3 d-inline-block">
            <i class="fas fa-arrow-left me-1"></i> Kthehu te Eventet
        </a>
    </div>
</div>

<?php 

include __DIR__ . "/../includes/footer.php"; 
?>
