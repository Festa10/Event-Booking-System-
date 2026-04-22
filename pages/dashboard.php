<?php
require_once "../includes/auth.php";
requireLogin();

$user = getUser();
?>

<h2>Dashboard - Event Booking System</h2>

<p>Welcome, <?php echo $user["username"]; ?></p>
<p>Role: <?php echo $user["role"]; ?></p>

<a href="events.php">View Events</a><br>

<?php if ($user["role"] === "admin"): ?>
    <a href="admin.php">Admin Panel</a><br>
<?php endif; ?>

<a href="logout.php">Logout</a>