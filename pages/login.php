<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../includes/auth.php";
require_once "../includes/validation.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // CLEAN INPUT
    $email = sanitizeInput($_POST["email"]);
    $password = $_POST["password"];

    // VALIDATION
    if (!validateRequired($email) || !validateRequired($password)) {

        $error = "Please fill in all fields!";

    } elseif (!validateEmail($email)) {

        $error = "Invalid email format!";

    } else {

      if (login($email, $password)) {

    // ruaj rolin në session
    if (getRole() === "admin") {
        header("Location: ../admin/dashboard.php");
    } else {
        header("Location: dashboard.php"); // USER -> dashboard
    }

    exit();

} else {
    $error = "Invalid credentials!";
}
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
    margin-bottom: 0px; 
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

<a href="/project/pages/contact.php">ℹ️ About</a>

<a href="/project/pages/login.php">🔐 Login</a>

<a href="/project/pages/register.php">📝 Register</a>

<a href="/project/pages/events/index.php">⚙️ Manage Events</a>

<a href="/project/pages/events/create.php">➕ Create Event</a>
    
</nav>

<div class="container-fluid p-0 mb-5" style="background-color: #ff6600 !important; color: white;">
    <div class="py-5 text-center">
        <h1 class="display-4 fw-semibold">Log In To Your Account</h1>
        <p class="lead">Access your events and bookings</p>
    </div>
</div>

<div class="page-center">

<div class="box">

    <h3 class="title">Event Booking System</h3>

    <form method="POST">

        <input type="email" name="email" class="form-control mb-3" placeholder="Email">

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

<?php include("../includes/footer.php"); ?>

</body>
</html>
