<?php
require_once "../includes/auth.php";
requireRole("admin");

$user = getUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>EventHub - Admin Panel</title>

<link rel="stylesheet" href="/event-booking-system/assets/css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
body{
    background:#f4f6fb;
    font-family: 'Poppins', Arial;
}

.top{
    background:white;
    padding:15px 20px;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.card-box{
    background:white;
    border:none;
    border-radius:16px;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

.btn{
    border-radius:10px;
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
    <a href="/project/pages/admin.php">⚙️ Admin</a>
</nav>

<div class="container py-4">

    <div class="top mb-4">
        <div>Admin Panel - <b><?php echo $user["username"]; ?></b></div>
        <a href="logout.php" class="btn btn-outline-primary btn-sm">Logout</a>
    </div>

    <div class="row g-4">

        <div class="col-md-4">
            <div class="card card-box p-4 text-center">
                <h6>Events</h6>
                <h2 class="text-primary">12</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-box p-4 text-center">
                <h6>Users</h6>
                <h2 class="text-success">45</h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-box p-4 text-center">
                <h6>Reservations</h6>
                <h2 class="text-warning">30</h2>
            </div>
        </div>

    </div>

    <div class="card card-box p-4 mt-4 text-center">
        <a href="add-event.php" class="btn btn-primary me-2">Add Event</a>
        <a href="manage-events.php" class="btn btn-outline-primary">Manage</a>
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
        <p>Home</p>
        <p>Events</p>
        <p>Booking</p>
        <p>About</p>
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