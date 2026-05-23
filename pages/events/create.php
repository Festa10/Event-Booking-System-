<?php

include "../../includes/header.php";
include "../../classes/Database.php";
include "../../classes/Event.php";

$db = (new Database())->connect();
$event = new Event($db);

$msg="";

if(isset($_POST['submit'])){

$image=time()."_".$_FILES['image']['name'];

move_uploaded_file(
$_FILES['image']['tmp_name'],
"../../uploads/events/".$image
);

$event->title=$_POST['title'];
$event->description=$_POST['description'];
$event->event_date=$_POST['event_date'];
$event->category=$_POST['category'];
$event->image=$image;

if($event->create()){
$msg="Event created successfully!";
}else{
$msg="Error!";
}

}

?>

<div class="hero">
<h1>Create Event</h1>
<p>Add a new event to the system</p>
</div>

<div class="form-card">

<h2>Create Event</h2>

<form method="POST" enctype="multipart/form-data">

<input
type="text"
name="title"
placeholder="Event title"
required>

<textarea
name="description"
placeholder="Description"
required></textarea>

<input
type="date"
name="event_date"
required>

<input
type="text"
name="category"
placeholder="Category"
required>

<input
type="file"
name="image"
required>

<button type="submit" name="submit">
Create Event
</button>

</form>

<p style="text-align:center;color:green;">
<?= $msg ?>
</p>

</div>

<?php include "../../includes/footer.php"; ?>