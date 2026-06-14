<?php 
include __DIR__ . '/../includes/header.php'; 
require __DIR__ . '/../includes/database.php'; 

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"] ?? '';
    $email = $_POST["email"] ?? '';
    $event = $_POST["event"] ?? '';

    if (!empty($name) && !empty($email) && !empty($event)) {
        try {
            $sql = "INSERT INTO bookings (name, email, event_name) VALUES (:name, :email, :event_name)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':event_name' => $event
            ]);
            $message = "success";
        } catch(PDOException $e) {
            $message = "Gabim: " . $e->getMessage();
        }
    }
}
?>

<?php if ($message == "success"): ?>
    <script>alert("Booking confirmed!"); window.location.href = 'booking.php';</script>
<?php elseif (!empty($message)): ?>
    <script>alert("<?= $message ?>");</script>
<?php endif; ?>

<style>
    .full-width-banner {
        width: 100vw;
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        background-color: #ff6600 !important;
        color: white;
        padding: 50px 0;
        margin-bottom: 50px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
</style>

<div class="full-width-banner">
    <h1 class="display-3 fw-semibold">Book Your Event</h1>
    <p class="lead">Fill in the details to secure your spot</p>
</div>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow p-4" style="border-radius: 15px;">
                <form method="POST" action="booking.php">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control mb-3" placeholder="Enter your name" required>

                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control mb-3" placeholder="Enter your email" required>

                    <label class="form-label">Event</label>
                    <input type="text" name="event" class="form-control mb-3" placeholder="Enter event name" required>

                    <button type="submit" class="btn btn-primary w-100">Book Now</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>