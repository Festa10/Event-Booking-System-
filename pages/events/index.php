<?php
$root = realpath(__DIR__ . '/../../');

// 1. Përfshij header-in (dizajni yt do të mbetet siç është)
include $root . '/includes/header.php';

// 2. Përfshij skedarin që krijon lidhjen $conn
include_once $root . '/includes/database.php'; 

// 3. Përfshij klasën Event
include_once $root . '/classes/Event.php';

// 4. Kalojmë $conn (variablin e krijuar në database.php) në klasën Event
// Sigurohu që konstruktori i klasës Event pranon $conn
$event = new Event($conn); 

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

<link rel="stylesheet" href="../../assets/css/style.css">

    <img src="../../uploads/events/<?= htmlspecialchars($row['image']) ?>" alt="event">


    <div class="event-info">

        <h3><?= htmlspecialchars($row['title']) ?></h3>

        <p><?= htmlspecialchars($row['description']) ?></p>

        <p><strong>Date:</strong> <?= $row['event_date'] ?></p>

        <p><strong>Category:</strong> <?= htmlspecialchars($row['category']) ?></p>


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

<script src="/project/assets/js/event.js"></script>

<?php include "../../includes/footer.php"; ?>