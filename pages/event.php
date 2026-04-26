<?php include '../includes/header.php'; ?>
<?php include '../includes/nav.php'; ?>
<?php include '../config/db.php'; ?>

<div class="events-container">

<?php
$result = $conn->query("SELECT * FROM events ORDER BY date ASC");

while($event = $result->fetch_assoc()){
?>

<div class="event">
    <img src="../uploads/<?php echo $event['image']; ?>">
    <div class="event-content">
        <h3><?php echo $event['title']; ?></h3>
        <p><?php echo $event['date']; ?></p>

        <a href="event-details.php?id=<?php echo $event['id']; ?>" class="btn btn-view">View</a>
    </div>
</div>

<?php } ?>

</div>

<?php include '../includes/footer.php'; ?>