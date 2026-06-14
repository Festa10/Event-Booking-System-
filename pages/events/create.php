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

        $image = time() . "_" . basename($_FILES['image']['name']);
        $uploadPath = "../../uploads/events/" . $image;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {

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

<h2 class="form-title">Create Event</h2>

<form method="POST" enctype="multipart/form-data">

        <input 
        type="text" 
        name="title" 
        placeholder="Event title" 
        required>

        <textarea 
        name="description" 
        placeholder="Description"
        rows="4"
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

    <p class="message">
        <?= $msg ?>
    </p>

</div>

<style>

.form-card{
    max-width: 450px; /* U zvogëlua nga 600px */
    margin: 40px auto;
    background: white;
    padding: 25px; /* U zvogëlua nga 35px */
    border-radius: 14px; /* Pak më elegante */
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

.form-title{
    text-align:center;
    margin-bottom:20px;
    font-size:24px; /* U zvogëlua nga 28px */
    font-weight:700;
    color:#111827;
}

.form-card form{
    display: flex;
    flex-direction: column;
    gap: 14px; /* Distanca mes fushave u zvogëlua nga 18px */
}

.form-card input,
.form-card textarea{
    width: 100%;
    padding: 12px; /* Hapësira e brendshme u zvogëlua nga 16px */
    border: 1px solid #d1d5db;
    border-radius: 10px;
    font-size: 15px; /* Shkronjat pak më të vogla */
    box-sizing: border-box;
}

.form-card textarea{
    resize: vertical;
}

.form-card button{
    padding: 14px; /* U zvogëlua nga 16px */
    border: none;
    border-radius: 10px;
    background: #2563eb;
    color: white;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.3s;
}

.form-card button:hover{
    background: #1d4ed8;
}

.message{
    text-align: center;
    margin-top: 15px;
    font-weight: 600;
    color: green;
}

</style>

<?php include "../../includes/footer.php"; ?>