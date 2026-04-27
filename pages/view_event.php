
<?php
// 1. Ngarkimi i të dhënave
require_once __DIR__ . '/../data/all_events.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EventHub - Booking System</title>

<link rel="stylesheet" href="../project/assets/css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

html, body {
    height: 100%;
    margin: 0;
}


body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background: #f4f6fb;
    font-family: 'Poppins', Arial;
}

.page-center {
    flex: 1; 
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    margin-bottom: 50px; 
}

footer {
    flex-shrink: 0;
    background: #0f172a;
    color: #cbd5e1;
    padding: 40px 20px;
    margin-top: auto;
}

.footer-container {
    display: flex; 
    justify-content: space-between; 
    padding: 20px 40px;
    background-color: #1a1a2e;
    color: #ffffff;
}

.footer-section {
    flex: 1; 
    padding: 0 15px;
}

.footer-section h3 {
    margin-bottom: 10px;
    font-size: 18px;
}

.footer-section ul {
    list-style: none; 
    padding: 0;
}

.footer-bottom {
    text-align: center;
    padding: 10px;
    background-color: #161625;
    font-size: 12px;
}


.navbar {
    padding: 20px;
    background: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    margin-bottom: 60px; 
}

.box {
    background: white;
    width: 100%;
    max-width: 380px;
    padding: 35px;
    border-radius: 16px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}
.title { text-align: center; font-weight: bold; margin-bottom: 20px; }
input { border-radius: 10px !important; }
.btn { border-radius: 10px; }
</style>
</head>
<body>



<nav class="navbar">
    <a href="/project/#top">🏠 Home</a>
    <a href="/project/pages/view_event.php">📅 Events</a>
    <a href="/project/pages/booking.php">🎟 Booking</a>

    <!-- AUTH -->
    <a href="/project/pages/login.php">🔐 Login</a>
    <a href="/project/pages/register.php">📝 Register</a>


    <a href="/project/pages/contact.php">ℹ️ About</a>
</nav>

<div class="container py-5">
<div class="text-center mb-5">
<h1 class="display-4 fw-bold">Explore Events</h1>
<p class="text-muted">Find and book your spot at the best events</p>
</div>

<div class="row g-4">
<?php foreach ($events as $e): ?>
<div class="col-md-6 col-lg-4">
<div class="card h-100 event-card <?php echo ($e instanceof PremiumEvent) ? 'premium-glow' : 'shadow-sm'; ?>">
<div class="card-body p-4 d-flex flex-column">
<div class="d-flex justify-content-between align-items-start mb-3">
<h5 class="fw-bold mb-0"><?php echo htmlspecialchars($e->title); ?></h5>
<?php if ($e instanceof PremiumEvent): ?>
<span class="badge bg-warning text-dark">PREMIUM</span>
<?php endif; ?>
</div>

<p class="text-muted small mb-3">📅 <?php echo $e->date; ?></p>
<p class="price-badge mb-3"><?php echo $e->price; ?>€</p>

<?php if ($e instanceof PremiumEvent): ?>
<div class="alert alert-light border-warning py-2 mb-3">
<small class="text-dark">🎁 <strong>Benefit:</strong> <?php echo htmlspecialchars($e->benefit); ?></small>
</div>
<?php endif; ?>

<div class="mt-auto">
<a href="confirm.php?name=<?php echo urlencode($e->title); ?>"
class="btn btn-primary w-100 btn-reserve">
Book Now
</a>
</div>
</div>
</div>
</div>
<?php endforeach; ?>
</div>
</div>
<footer>

<div class="footer-container">

    <div>
        <h3>About Us</h3>
        <p>We provide the best event booking experience for concerts, weddings, festivals and more.</p>
    </div>

    <div>
        <h3>Quick Links</h3>
        <a href="/project/index.php">Home</a><br>
        <a href="/project/pages/view_event.php">Events<a/><br>
        <a href="/project/pages/contact.php">About</a>
       
    </div>

    <div>
        <h3>Contact</h3>
        <p>Email: eventbooking@gmail.com</p>
        <p>Phone: 044 552 332</p>
    </div>

</div>

<p class="copyright">© 2026 Event Booking System | All Rights Reserved</p>

</footer>

</body>
</html>
