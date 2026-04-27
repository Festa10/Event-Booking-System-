
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
body { background-color: #f0f2f5; font-family: 'Poppins', sans-serif; margin: 0; padding: 0; }
.container { max-width: 1000px; }
.event-card { border: none; border-radius: 20px; transition: all 0.3s ease; overflow: hidden; background: white; }
.event-card:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
.premium-glow { border: 2px solid #ffc107; background: linear-gradient(145deg, #ffffff, #fffdf2); }
.price-badge { font-size: 1.2rem; color: #2ecc71; font-weight: 800; }
.btn-reserve { border-radius: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; }

.navbar { background: #ffffff; padding: 1rem; box-shadow: 0 2px 10px rgba(0,0,0,0.05); display: flex; justify-content: center; gap: 20px; }
.navbar a { text-decoration: none; color: #333; font-weight: 500; transition: 0.3s; }
.navbar a:hover { color: #007bff; }

footer { background: #333; color: white; padding: 40px 0 20px; margin-top: 50px; }
.footer-container { display: flex; justify-content: space-around; flex-wrap: wrap; max-width: 1100px; margin: 0 auto; padding: 0 20px; }
.footer-container div { flex: 1; min-width: 250px; margin-bottom: 20px; }
.footer-container h3 { font-size: 1.2rem; margin-bottom: 15px; color: white; }
.footer-container p { font-size: 0.9rem; opacity: 0.8; line-height: 1.6; }
.copyright { text-align: center; border-top: 1px solid #444; margin-top: 30px; padding-top: 20px; font-size: 0.8rem; opacity: 0.6; }
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
