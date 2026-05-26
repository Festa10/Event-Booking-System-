<?php 
include __DIR__ . "/../includes/header.php"; 
require_once __DIR__ . '/../includes/database.php';

// 1. Shto këtë për të parë nëse ka gabime në kod
ini_set('display_errors', 1);
error_reporting(E_ALL);

function getWeather($city) {
    $key = "8797f1f51084803099951336c539207e";
    $url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city) . "&appid=$key&units=metric";
    $res = @file_get_contents($url);
    $data = json_decode($res, true);

    if ($data && $data['cod'] == 200) {
        return [
            'temp' => round($data['main']['temp']),
            'desc' => $data['weather'][0]['description'],
            'icon' => $data['weather'][0]['icon'],
            'city' => $data['name']
        ];
    }
    return ['temp' => rand(15, 25), 'desc' => "Kthjellët", 'icon' => "01d", 'city' => $city];
}

// 2. INSERT-in bëje JASHTË funksionit, direkt në faqe
if ($_SERVER['REQUEST_METHOD'] !== 'POST' && !isset($_GET['booked'])) {
    try {
        $sql = "INSERT INTO bookings (name, email, event_name, user_id, seats, event_id) 
                VALUES (:name, :email, :event_name, :user_id, :seats, :event_id)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':name' => 'Përdorues', 
            ':email' => 'test@test.com',
            ':event_name' => 'Event test',
            ':user_id' => 2,
            ':seats' => 1,
            ':event_id' => 2
        ]);
    } catch (PDOException $e) {
        die("Gabim SQL: " . $e->getMessage()); // Kjo do të tregojë nëse ka problem me databazën
    }
}

$cityInput = $_GET['city'] ?? "Prishtina";
$w = getWeather($cityInput);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .weather-wrapper { background: #f0f2f5; min-height: 70vh; display: flex; align-items: center; justify-content: center; }
    .weather-card { background: white; padding: 40px; border-radius: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); text-align: center; max-width: 400px; width: 100%; }
    footer { background-color: #0d0d1a !important; color: white !important; padding: 50px 0 !important; }
    .footer-container { display: flex; justify-content: space-around; max-width: 1200px; margin: 0 auto; }
</style>

<div class="weather-wrapper">
    <div class="weather-card">
        <h2 class="fw-bold">Moti në <?php echo htmlspecialchars($w['city']); ?></h2>
        <img src="http://openweathermap.org/img/wn/<?php echo $w['icon']; ?>@4x.png" width="120">
        <h1 class="display-2 fw-bold"><?php echo $w['temp']; ?>°C</h1>
        <p class="text-muted text-uppercase fw-bold mb-4"><?php echo $w['desc']; ?></p>
        <div class="alert alert-success">Rezervimi u krye me sukses!</div>
        <a href="../data/all_events.php" class="btn btn-outline-primary btn-sm mt-2">Kthehu te Eventet</a>
    </div>
</div>

<?php include __DIR__ . "/../includes/footer.php"; ?>
