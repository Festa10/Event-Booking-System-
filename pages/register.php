<?php
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (!empty($username) && !empty($password)) {
        $success = "Account created successfully! You can now log in.";
    } else {
        $error = "Please fill in all fields!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>EventHub - Register</title>

<link rel="stylesheet" href="/event-booking-system/assets/css/style.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
body{
    background:#f8fafc;
    font-family: 'Poppins', Arial;
    min-height:100vh;
}

.page-center{
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:70vh;
}

.card{
    width:100%;
    max-width:420px;
    border:none;
    border-radius:18px;
    box-shadow:0 10px 30px rgba(0,0,0,0.1);
}

h4{
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

<div class="page-center">

<div class="card p-4">

    <h4 class="text-center mb-3">Register</h4>

    <form method="POST">

        <input type="text" name="username" class="form-control mb-3" placeholder="Username">

        <input type="password" name="password" class="form-control mb-3" placeholder="Password">

        <?php if ($error): ?>
            <div class="alert alert-danger text-center"><?= $error ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success text-center"><?= $success ?></div>
        <?php endif; ?>

        <button class="btn btn-primary w-100">Create Account</button>

    </form>

    <div class="text-center mt-3">
        <a href="login.php">Already have an account? Login here</a>
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