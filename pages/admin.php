<?php
require_once "../includes/auth.php";
require_once "../includes/database.php";

// PROTECT ADMIN PAGE
requireRole("admin");

$user = getUser();

// STATS FROM DATABASE
$events = $conn->query("SELECT COUNT(*) AS total FROM events")->fetch_assoc()['total'];
$users = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
$bookings = $conn->query("SELECT COUNT(*) AS total FROM bookings")->fetch_assoc()['total'];
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

<a href="/project/pages/view_event.php">📅 Events</a>

<a href="/project/pages/booking.php">🎟 Booking</a>

<a href="/project/pages/contact.php">ℹ️ About</a>

<a href="/project/pages/login.php">🔐 Login</a>

<a href="/project/pages/register.php">📝 Register</a>

<a href="/project/pages/events/index.php">⚙️ Manage Events</a>

<a href="/project/pages/events/create.php">➕ Create Event</a>
    
</nav>

<div class="container py-4">

    <div class="top mb-4">
        <div>Admin Panel - <b><?php echo $user["name"]; ?></b></div>
        <a href="logout.php" class="btn btn-outline-primary btn-sm">Logout</a>
    </div>

    <div class="row g-4">

    <div class="col-md-4">
        <div class="card card-box p-4 text-center">
            <h6>Events</h6>
            <h2 class="text-primary"><?php echo $events; ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-box p-4 text-center">
            <h6>Users</h6>
            <h2 class="text-success"><?php echo $users; ?></h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-box p-4 text-center">
            <h6>Reservations</h6>
            <h2 class="text-warning"><?php echo $bookings; ?></h2>
        </div>
    </div>

</div>

<?php include("../includes/footer.php"); ?>

</body>
</html>