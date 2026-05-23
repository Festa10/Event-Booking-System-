<?php

include "../../includes/header.php";
include "../../classes/Database.php";
include "../../classes/Event.php";

$db = (new Database())->connect();
$event = new Event($db);

$msg="";

$event->id = $_GET['id'];
$data = $event->single();

if(isset($_POST['update'])){

    $image = $data['image'];

    if(!empty($_FILES['image']['name'])){

        $image = time() . "_" . $_FILES['image']['name'];

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../../uploads/events/" . $image
        );
    }

    $event->title = $_POST['title'];
    $event->description = $_POST['description'];
    $event->event_date = $_POST['event_date'];
    $event->category = $_POST['category'];
    $event->image = $image;

    if($event->update()){
        $msg="Event updated successfully!";
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
value="<?= $data['category'] ?>"
placeholder="Category"
required>

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

</div>

<?php include "../../includes/footer.php"; ?>