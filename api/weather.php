<?php 
// 1. LIDHJA ME HEADER
include __DIR__ . "/../includes/header.php"; 
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; }
    
    .weather-container {
        background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%);
        min-height: 70vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 50px 20px;
    }
    .weather-card {
        background: white;
        padding: 40px;
        border-radius: 25px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        text-align: center;
        width: 100%;
        max-width: 450px;
    }

    footer {
        background-color: #0d0d1a !important; 
        color: white !important;
        padding: 60px 0 20px 0 !important;
    }
</style>

<div class="weather-container">
    <?php
    function getLiveWeather($city) {
        $key = "8797f1f51084803099951336c539207e";
        $url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city) . "&appid=$key&units=metric";
        
        $res = @file_get_contents($url);
        if ($res === FALSE) return null;

        $data = json_decode($res, true);
        
        if ($data && $data['cod'] == 200) {
            return [
                'temp' => round($data['main']['temp']),
                'desc' => $data['weather'][0]['description'],
                'icon' => $data['weather'][0]['icon'],
                'city' => $data['name']
            ];
        }
        return null;
    }

    // Merr qytetin nga URL
    $cityInput = (isset($_GET['city']) && !empty($_GET['city'])) ? $_GET['city'] : "Prishtina";
    $w = getLiveWeather($cityInput);

    if ($w): ?>
        <div class="weather-card">
            <h2 class="fw-bold mb-1">Moti në <?php echo htmlspecialchars($w['city']); ?></h2>
            <p class="text-muted small mb-4">Parashikimi live për eventin tuaj</p>
            
            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 130px; height: 130px;">
                <img src="http://openweathermap.org/img/wn/<?php echo $w['icon']; ?>@4x.png" width="110">
            </div>
            
            <h1 class="display-2 fw-bold m-0"><?php echo $w['temp']; ?>°C</h1>
            <p class="text-uppercase text-muted fw-bold mb-4"><?php echo $w['desc']; ?></p>

            <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 15px;">
                <i class="fas fa-check-circle me-2"></i> Rezervimi u konfirmua! Email-i u dërgua.
            </div>

            <a href="../data/all_events.php" class="btn btn-outline-primary btn-sm fw-bold">
                <i class="fas fa-arrow-left me-1"></i> Kthehu te Eventet
            </a>
        </div>
    <?php else: ?>
        <div class="weather-card border border-danger">
            <i class="fas fa-exclamation-triangle text-danger display-4 mb-3"></i>
            <h3 class="fw-bold text-danger">Qyteti nuk u gjet!</h3>
            <p class="text-muted">API nuk mund të gjejë motin për: <br><strong>"<?php echo htmlspecialchars($cityInput); ?>"</strong></p>
            <a href="../data/all_events.php" class="btn btn-danger w-100 mt-3">Kthehu dhe rregulloje</a>
        </div>
    <?php endif; ?>
</div>

<?php 
// 2. LIDHJA ME FOOTER
include __DIR__ . "/../includes/footer.php"; 
?>
