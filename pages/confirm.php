<?php 
// 1. Merr emrin e eventit nga URL
$eventName = isset($_GET['name']) ? $_GET['name'] : "Unknown Event";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventHub - Booking Successful</title>

    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { 
            background-color: #f8f9fa; 
            font-family: 'Poppins', sans-serif; 
            margin: 0; 
            display: flex; 
            flex-direction: column; 
            min-height: 100vh; 
        }
        
        .navbar { 
            background: #fff; 
            padding: 1rem; 
            box-shadow: 0 2px 10px rgba(0,0,0,0.05); 
            display: flex; 
            justify-content: center; 
            gap: 20px; 
        }
        .navbar a { 
            text-decoration: none; 
            color: #333; 
            font-weight: 500; 
            transition: 0.3s;
        }
        .navbar a:hover { color: #007bff; }

        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .success-card { 
            max-width: 500px; 
            width: 100%;
            border: none; 
            border-radius: 25px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1); 
            background: white;
        }

        .icon-circle { 
            width: 80px; 
            height: 80px; 
            background: #d4edda; 
            color: #28a745; 
            border-radius: 50%; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 40px; 
            margin: 0 auto 20px; 
        }

        footer { 
            background: #333; 
            color: white; 
            padding: 40px 0 20px; 
        }
        .footer-container { 
            display: flex; 
            justify-content: space-around; 
            flex-wrap: wrap; 
            max-width: 1100px; 
            margin: 0 auto; 
            padding: 0 20px; 
        }
        .footer-container div { flex: 1; min-width: 200px; margin-bottom: 20px; }
        .footer-container h3 { font-size: 1.2rem; margin-bottom: 15px; color: #ffc107; }
        .footer-container p { font-size: 0.9rem; opacity: 0.8; line-height: 1.6; }
        .copyright { 
            text-align: center; 
            border-top: 1px solid #444; 
            margin-top: 30px; 
            padding-top: 20px; 
            font-size: 0.8rem; 
            opacity: 0.6; 
        }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="../index.php"> Home</a>
    <a href="view-events.php"> Events</a>
    <a href="booking.php"> Booking</a>
    <a href="#"> About</a>
</nav>

<div class="main-content">
    <div class="card success-card p-5 text-center">
        <div class="icon-circle">✓</div>
        <h1 class="fw-bold text-dark">Booking Successful!</h1>
        <p class="text-muted mt-3">
            Thank you for choosing to attend: <br>
            <strong class="text-primary fs-5"><?php echo htmlspecialchars($eventName); ?></strong>
        </p>
        <div class="alert alert-info py-2 mt-3">
            <small>A confirmation email will be sent shortly.</small>
        </div>
        <a href="view-events.php" class="btn btn-primary btn-lg mt-4 w-100" style="border-radius: 12px;">
            Back to Events
        </a>
    </div>
</div>

<footer>
    <div class="footer-container">
        <div>
            <h3>About Us</h3>
            <p>We provide the best event booking experience.</p>
        </div>
        <div>
            <h3>Contact</h3>
            <p>Email: eventbooking@gmail.com</p>
        </div>
    </div>
    <p class="copyright">© 2026 Event Booking System | All Rights Reserved</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
