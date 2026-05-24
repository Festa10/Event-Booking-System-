<?php

include "../../includes/header.php";
require_once "../../includes/database.php";
require_once "../../classes/Event.php";

$event = new Event($conn);

$msg = "";

if (isset($_POST['submit'])) {

    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $event_date = $_POST['event_date'];
    $category = trim($_POST['category']);

    if (
        !empty($title) &&
        !empty($description) &&
        !empty($event_date) &&
        !empty($category) &&
        !empty($_FILES['image']['name'])
    ) {

        // secure image name
        $image = time() . "_" . basename($_FILES['image']['name']);
        $uploadPath = "../../uploads/events/" . $image;

        // upload image
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {

            // set data
            $event->title = htmlspecialchars($title);
            $event->description = htmlspecialchars($description);
            $event->event_date = $event_date;
            $event->category = htmlspecialchars($category);
            $event->image = $image;

            if ($event->create()) {
                $msg = "✔ Event created successfully!";
            } else {
                $msg = "❌ Error while inserting into database!";
            }

        } else {
            $msg = "❌ Image upload failed!";
        }

    } else {
        $msg = "⚠ Please fill all fields!";
    }
}

?>

<div class="hero">
    <h1>Create Event</h1>
    <p>Add a new event to the system</p>
</div>

<div class="form-card">

<form method="POST" enctype="multipart/form-data">

    <input type="text" name="title" placeholder="Event title" required>

    <textarea name="description" placeholder="Description" required></textarea>

    <input type="date" name="event_date" required>

    <input type="text" name="category" placeholder="Category" required>

    <input type="file" name="image" required>

    <button type="submit" name="submit">
        Create Event
    </button>

</form>

<p style="text-align:center;color:green;">
    <?= $msg ?>
</p>

</div>

<?php include "../../includes/footer.php"; ?>