<?php include __DIR__ . '/../includes/header.php'; ?>
<?php require __DIR__ . '/../includes/db.php'; ?>

<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $event = $_POST["event"];

    if ($name && $email && $event) {

        try {

            $sql = "INSERT INTO bookings(name, email, event_name)
                    VALUES(:name, :email, :event_name)";

            $stmt = $conn->prepare($sql);

            $stmt->execute([
                ':name' => htmlspecialchars($name),
                ':email' => htmlspecialchars($email),
                ':event_name' => htmlspecialchars($event)
            ]);

            $message = "🎉 Booking confirmed for $name for $event.";

        } catch(PDOException $e) {

            $message = $e->getMessage();
        }
    }
}
?>

<section class="booking-page">

    <div class="booking-box">

        <h2 style="text-align:center;">Book Event</h2>

        <form id="bookingForm" method="POST">

            <label>Full Name</label>
            <input type="text" name="name" placeholder="Enter your name" required>

            <label>Email</label>
            <input type="email" name="email" placeholder="Enter your email" required>

            <label>Event</label>
            <input type="text" name="event" placeholder="Enter event you want to book" required>

            <button type="submit" class="btn-book">
                Book Now
            </button>

        </form>

        <p class="message"><?php echo $message; ?></p>

    </div>

</section>

<script>
document.getElementById("bookingForm")
.addEventListener("submit", function(e){

    e.preventDefault();

    let formData = new FormData(this);

    fetch("",{
        method:"POST",
        body:formData
    })
    .then(response => response.text())
    .then(data => {
        location.reload();
    });

});
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>