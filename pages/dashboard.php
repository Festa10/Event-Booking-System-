<?php
require_once "../includes/auth.php";
requireLogin();
$user = getUser();
?>
<!DOCTYPE html>
<html lang="sq">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>EventHub - Dashboard</title>

<link rel="stylesheet" href="/event-booking-system/assets/css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
body{
    background:#f8fafc;
    font-family: 'Poppins', Arial;
}
.topbar{
    background:white;
    padding:15px 20px;
    border-radius:16px;
    box-shadow:0 5px 20px rgba(0,0,0,0.05);
    display:flex;
    justify-content:space-between;
    align-items:center;
}
.welcome{
    background:linear-gradient(135deg, #667eea, #764ba2);
    color:white;
    border-radius:18px;
    padding:25px;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
}
.card-box{
    background:white;
    border-radius:16px;
    padding:20px;
    box-shadow:0 8px 20px rgba(0,0,0,0.05);
    transition:0.2s;
}
.card-box:hover{
    transform:translateY(-5px);
}
.icon{
    font-size:26px;
}
.num{
    font-size:26px;
    font-weight:bold;
}
</style>
</head>

<body>

<nav class="navbar">
    <a href="/project/#top">🏠 Home</a>
    <a href="/project/pages/events.php">📅 Events</a>
    <a href="/project/pages/booking.php">🎟 Booking</a>
    <a href="/project/pages/login.php">🔐 Login</a>
    <a href="/project/pages/register.php">📝 Register</a>
    <a href="#">ℹ️ About</a>
</nav>

<div class="container py-4">

    <div class="topbar mb-4">
        <div>
            Hello, <b><?php echo $user["username"]; ?></b> 👋
        </div>
        <a href="logout.php" class="btn btn-outline-dark btn-sm">Logout</a>
    </div>

    <div class="welcome mb-4">
        <h4>Welcome back!</h4>
        <p class="mb-0">Manage your events and activities easily.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card-box text-center">
                <div class="icon">📅</div>
                <h6 class="mt-2 text-muted">Events</h6>
                <div class="num">10</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box text-center">
                <div class="icon">🎫</div>
                <h6 class="mt-2 text-muted">Reservations</h6>
                <div class="num">3</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box text-center">
                <div class="icon">👤</div>
                <h6 class="mt-2 text-muted">Status</h6>
                <div class="num">Active</div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <h5 class="mb-3">Actions</h5>

        <div class="row g-3">
            <div class="col-md-6">
                <a href="view_event.php" class="text-decoration-none">
                    <div class="card-box p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">View Events</h6>
                                <small class="text-muted">Explore available events</small>
                            </div>
                            <div class="icon">📅</div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-6">
                <div class="card-box p-4 h-100" style="opacity:0.6;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1">Coming soon</h6>
                            <small class="text-muted">New features in development</small>
                        </div>
                        <div class="icon">✨</div>
                    </div>
                </div>
            </div>
        </div>
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
        <a href="/project/pages/about.php">About</a>
       
    </div>

    <div>
        <h3>Contact</h3>
        <p>Email: eventbooking@gmail.com</p>
        <p>Phone: 044 552 332</p>
    </div>

</div>

<div class="footer-bottom">
    © 2026 Event Booking System | All Rights Reserved
</div>

</footer>

</body>
</html>