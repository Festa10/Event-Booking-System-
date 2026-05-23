<?php

include "../../includes/header.php";
include "../../classes/Database.php";
include "../../classes/Event.php";

$db = (new Database())->connect();
$event = new Event($db);

$result = $event->read();

?>

<div class="hero">
    <h1>Event Management</h1>
<p>Create, update and organize your events easily</p>
</div>

<div class="main-content">

<div class="events-container">

<?php while($row = $result->fetch(PDO::FETCH_ASSOC)){ ?>

<div class="event-card" id="row-<?= $row['id'] ?>">

<img src="../../uploads/events/<?= $row['image'] ?>" alt="event">

<div class="event-info">

<h3><?= $row['title'] ?></h3>

<p><?= $row['description'] ?></p>

<p><strong>Date:</strong> <?= $row['event_date'] ?></p>

<p><strong>Category:</strong> <?= $row['category'] ?></p>

<div class="event-buttons">

<a href="edit.php?id=<?= $row['id'] ?>" class="edit-btn">
Edit
</a>

<button class="delete-btn"
onclick="deleteEvent(<?= $row['id'] ?>)">
Delete
</button>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

<script src="../../assets/js/event.js"></script>

<?php include "../../includes/footer.php"; ?>