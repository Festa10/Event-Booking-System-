<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>
<?php include '../config/db.php'; ?>

<?php
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM events WHERE id=$id");
$event = $result->fetch_assoc();
?>

<div class="event-detail">

    <img src="../uploads/<?php echo $event['image']; ?>">

    <h1><?php echo $event['title']; ?></h1>
    <p><?php echo $event['description']; ?></p>

    <p>📅 <?php echo $event['date']; ?></p>
    <p>📍 <?php echo $event['location']; ?></p>
    <p>💰 <?php echo $event['price']; ?> €</p>

    <a href="booking.php?id=<?php echo $event['id']; ?>" class="btn btn-book">
        Book Ticket
    </a>

</div>

<?php include '../includes/footer.php'; ?>