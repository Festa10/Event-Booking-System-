<?php

include "../../includes/header.php";
require_once "../../includes/database.php";
require_once "../../classes/Event.php";

$event = new Event($conn);
$msg = "";

// 1. KONTROLLO ID-në MENJËHERË
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Missing event ID");
}

$event->id = $_GET['id'];
$data = $event->single();

// Nëse nuk gjendet asnjë event me këtë ID
if ($data === false) {
    echo "<div style='padding:20px; text-align:center; color:red;'>";
    echo "<h3>❌ Event not found!</h3>";
    echo "ID: " . htmlspecialchars($event->id) . "<br>";
    echo "</div>";
    include "../../includes/footer.php";
    exit;
}

// 2. PROCESO ETAPËN E UPDATE
if (isset($_POST['update'])) {

    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $event_date = $_POST['event_date'];
    $category = trim($_POST['category']);
    $image = $data['image']; // Mbajmë imazhin e vjetër si parazgjedhje

    // Upload imazhin e ri nëse ka
    if (!empty($_FILES['image']['name'])) {
        $image = time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            "../../uploads/events/" . $image
        );
    }

    // Gati për t'i dërguar në klasë
    $event->title = htmlspecialchars($title);
    $event->description = htmlspecialchars($description);
    $event->event_date = $event_date;
    $event->category = htmlspecialchars($category);
    $event->image = $image;

    if ($event->update()) {
        $msg = "✔ Event updated successfully!";
        // Rifreskojmë të dhënat që të shfaqen vlerat e reja në formë
        $data = $event->single();
    } else {
        $msg = "❌ Error updating event!";
    }
}

?>

<div class="hero">
    <h1>Edit Event</h1>
    <p>Update your event information</p>
</div>

<div class="form-card">

<link rel="stylesheet" href="../../assets/css/style.css">

    <h2 class="form-title">Edit Event</h2>

    <form method="POST" enctype="multipart/form-data">

        <input 
        type="text" 
        name="title" 
        value="<?= htmlspecialchars($data['title']) ?>" 
        placeholder="Event title" 
        required>

        <textarea 
        name="description" 
        placeholder="Description"
        rows="4" 
        required><?= htmlspecialchars($data['description']) ?></textarea>

        <input 
        type="date" 
        name="event_date" 
        value="<?= $data['event_date'] ?>" 
        required>

        <input 
        type="text" 
        name="category" 
        value="<?= htmlspecialchars($data['category']) ?>" 
        placeholder="Category" 
        required>

        <input 
        type="file" 
        name="image">

        <button type="submit" name="update">
            Update Event
        </button>

    </form>

    <?php if(!empty($msg)): ?>
        <p class="message"><?= $msg ?></p>
    <?php endif; ?>

</div>

<style>

.form-card{
    max-width: 450px; /* E njëjtë si te kodi i parë i Create */
    margin: 40px auto;
    background: white;
    padding: 25px; 
    border-radius: 14px; 
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

.form-title{
    text-align:center;
    margin-bottom:20px;
    font-size:24px; 
    font-weight:700;
    color:#111827;
}

.form-card form{
    display: flex; /* Kthehet në një kolonë, njësoj si te Create */
    flex-direction: column;
    gap: 14px; 
}

.form-card input,
.form-card textarea{
    width: 100%;
    padding: 12px; 
    border: 1px solid #d1d5db;
    border-radius: 10px;
    font-size: 15px; 
    box-sizing: border-box;
}

.form-card textarea{
    resize: vertical;
}

.form-card button{
    padding: 14px; 
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