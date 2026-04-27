<?php
require_once "../includes/auth.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (login($username, $password)) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>EventHub - Login</title>

<link rel="stylesheet" href="/event-booking-system/assets/css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
body{
    background:#f4f6fb;
    font-family: 'Poppins', Arial;
}

.page-center{
    min-height:75vh;
    display:flex;
    align-items:center;
    justify-content:center;
}

.box{
    background:white;
    width:100%;
    max-width:380px;
    padding:35px;
    border-radius:16px;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

.title{
    text-align:center;
    font-weight:bold;
    margin-bottom:20px;
}

input{
    border-radius:10px !important;
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
    <a href="#">ℹ️ About</a>
</nav>

<div class="page-center">

<div class="box">

    <h3 class="title">Event Booking System</h3>

    <form method="POST">

        <input type="text" name="username" class="form-control mb-3" placeholder="Username">

        <input type="password" name="password" class="form-control mb-3" placeholder="Password">

        <?php if ($error): ?>
            <div class="alert alert-danger py-2 text-center">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <button class="btn btn-primary w-100">Login</button>

    </form>

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