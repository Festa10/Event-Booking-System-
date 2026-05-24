<?php 

include __DIR__ . "/../includes/header.php"; 
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
   
    nav ul { 
        display: flex !important; 
        list-style: none !important; 
        gap: 20px; 
        padding: 20px;
        background: white;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    nav ul li a { text-decoration: none !important; color: #333; font-weight: 600; }

    
    .weather-wrapper {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 60vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 50px 0;
    }
    .weather-card {
        background: white;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        text-align: center;
        max-width: 400px;
        width: 100%;
    }

    
    footer {
        background-color: #0d0d1a !important; 
        color: white !important;
        padding: 60px 0 30px 0 !important;
    }
    .footer-container {
        display: flex !important;
        justify-content: space-around !important;
        max-width: 1200px;
        margin: 0 auto;
        flex-wrap: wrap;
    }
    .footer-container div { flex: 1; min-width: 250px; padding: 10px; }
    .footer-container h3 { font-size: 22px; margin-bottom: 20px; color: white; }
    .footer-container a { color: #3498db !important; text-decoration: underline !important; }
    .copyright { 
        text-align: left; 
        max-width: 1200px; 
        margin: 30px auto 0 auto; 
        padding-left: 50px; 
        border-top: 1px solid #1a1a2e;
        padding-top: 20px;
    }
</style>

<div class="weather-wrapper">
    <?php
   
    function getWeatherData($city) {
        $apiKey = "8797f1f51084803099951336c539207e";
        $url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city) . "&appid=$apiKey&units=metric";
        $response = @file_get_contents($url);
        return $response ? json_decode($response, true) : null;
    }

    $city = isset($_GET['city']) ? htmlspecialchars($_GET['city']) : "Prishtina";
    $data = getWeatherData($city);

    if ($data && $data['cod'] == 200) {
        $temp = round($data['main']['temp']);
        $desc = $data['weather'][0]['description'];
        $icon = $data['weather'][0]['icon'];
        ?>
        <div class="weather-card">
            <h2 class="fw-bold">Moti në <?php echo $city; ?></h2>
            <img src="http://openweathermap.org/img/wn/<?php echo $icon; ?>@4x.png" width="120">
            <h1 class="display-4 fw-bold"><?php echo $temp; ?>°C</h1>
            <p class="text-muted text-uppercase"><?php echo $desc; ?></p>
            
            <div class="alert alert-success mt-3" style="font-size: 14px;">
                <i class="fas fa-check-circle"></i> Konfirmimi i rezervimit u dërgua!
            </div>
            
            <a href="../pages/view_event.php" class="btn btn-outline-primary btn-sm mt-2">
                <i class="fas fa-arrow-left"></i> Kthehu te Eventet
            </a>
        </div>
    <?php } else { ?>
        <div class="alert alert-danger">Nuk u gjetën të dhëna për këtë qytet.</div>
    <?php } ?>
</div>

<?php 
// 2. LIDHJA ME FOOTER-IN (Nga folderi includes)
include __DIR__ . "/../includes/footer.php"; 
?>
