<?php
include("../includes/database.php");
require_once("../includes/validation.php");

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 🔥 CLEAN INPUT (vetëm sanitize një herë)
    $username = sanitizeInput($_POST["username"]);
    $email = sanitizeInput($_POST["email"]);
    $password = $_POST["password"];

    // 🔥 VALIDATION (centralized)
    if (!validateRequired($username) || !validateRequired($email) || !validateRequired($password)) {
        $error = "Please fill in all fields!";
    }
    elseif (!validateEmail($email)) {
        $error = "Invalid email format!";
    }
    elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters!";
    }
    else {

        // 🔥 CHECK IF EMAIL EXISTS (prepared statement)
        $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $error = "Email already exists!";
        } else {

            // 🔥 HASH PASSWORD (security standard)
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // 🔥 INSERT USER
            $stmt = $conn->prepare("INSERT INTO users(name, email, password, role) VALUES(?, ?, ?, 'user')");
            $stmt->bind_param("sss", $username, $email, $hashedPassword);

            if ($stmt->execute()) {
                $success = "Account created successfully! You can now log in.";
            } else {
                $error = "Something went wrong!";
            }
        }
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

<div class="container-fluid p-0" style="background-color: #ff6600 !important; color: white;">
    <div class="py-5 text-center">
        <h1 class="display-4 fw-semibold">Create Your Account</h1>
        <p class="lead">Join us to start booking amazing events</p>
    </div>
</div>

<div class="page-center">
    <div class="card p-4">
        <h4 class="text-center mb-3">Register</h4>
        <form method="POST">
            <input type="text" name="username" class="form-control mb-3" placeholder="Username">
            <input type="email" name="email" class="form-control mb-3" placeholder="Email">
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

<?php include("../includes/footer.php"); ?>