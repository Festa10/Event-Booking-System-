<?php

include "../../includes/header.php";
require_once "../../includes/database.php";
require_once "../../classes/Event.php";

$event = new Event($conn);

$msg = "";

// CHECK ID
if (!isset($_GET['id'])) {
    die("Missing event ID");
}

$event->id = $_GET['id'];
$data = $event->single();

if (isset($_POST['update'])) {

    $image = $data['image'];

    // upload image
    if (!empty($_FILES['image']['name'])) {

        $image = time() . "_" . $_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../../uploads/events/" . $image
        );
    }

    $event->title = $_POST['title'];
    $event->description = $_POST['description'];
    $event->event_date = $_POST['event_date'];
    $event->image = $image;

    if ($event->update()) {
        $msg = "Event updated successfully!";
    } else {
        $msg = "Error updating event!";
    }
}

?>

<div class="hero">
    <h1>Edit Event</h1>
    <p>Update your event information</p>
</div>

<div class="form-card">

<form method="POST" enctype="multipart/form-data">
<input
type="text"
name="title"
value="<?= $data['title'] ?>"
placeholder="Event title"
required>

<textarea
name="description"
placeholder="Description"
required><?= $data['description'] ?></textarea>

<input
type="date"
name="event_date"
value="<?= $data['event_date'] ?>"
required>

<input
type="text"
name="category"
<?php
$data = $event->single();
if ($data === false) {
    echo "ID e dërguar: " . $event->id . "<br>";
    echo "Tabela e kërkuar: " . $event->table . "<br>";
    echo "Query nuk ktheu asnjë rezultat.";
    exit;
}
?>

<input
type="file"
name="image">

<button type="submit" name="update">
Update Event
</button>

</form>

<p style="text-align:center;color:green;margin-top:15px;">
<?= $msg ?>
</p>

<?php include "../../includes/footer.php"; ?>

</div>

<?php include "../../includes/footer.php"; ?>