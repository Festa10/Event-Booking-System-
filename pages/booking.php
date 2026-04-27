<?php include __DIR__ . '/../includes/header.php'; ?>

<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $event = $_POST["event"];

    if ($name && $email && $event) {
        $message = "🎉 Booking confirmed for $name for $event.";
    }
}
?>

<section class="booking-page">

    <div class="booking-box">

       <h2 style="text-align: center;">Book Event</h2>


        <form method="POST">

            <label>Full Name</label>
            <input type="text" name="name" placeholder="Enter your name" required>

            <label>Email</label>
            <input type="email" name="email" placeholder="Enter your email" required>

            <label>Event</label>
            <input type="text" name="event" placeholder="Enter event you want to book" required>

            <button type="submit" class="btn-book">Book Now</button>

        </form>

        <p class="message"><?php echo $message; ?></p>

    </div>

</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
