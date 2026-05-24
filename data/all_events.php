<?php
require_once __DIR__ . '/../classes/Event.php';
include __DIR__ . "/../includes/header.php"; 

$events = [
    new Event("Football Tournament", "2026-05-30", "Mitrovica", 5),
    new Event("Stand-up Comedy", "2026-05-20", "Prizren", 10),
    new Event("Gardening Workshop", "2026-04-28", "Prishtina", 12),
    new Event("Classic Concert", "2026-06-15", "Tirana", 25)
];
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container my-5 text-center">
    <h1 class="fw-bold mb-5">Explore Events</h1>
    <div class="row g-4">
        <?php foreach ($events as $event): ?>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 p-3" style="border-radius: 15px;">
                    <div class="card-body">
                        <h4 class="fw-bold"><?php echo $event->title; ?></h4>
                        <p class="text-muted small">📅 <?php echo $event->date; ?></p>
                        <p class="text-muted small">📍 <?php echo $event->location; ?></p>
                        <h3 class="text-primary fw-bold"><?php echo $event->price; ?>€</h3>
                        <a href="../api/weather.php?city=<?php echo urlencode($event->location); ?>" class="btn btn-primary w-100 fw-bold">Book Now</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php include __DIR__ . "/../includes/footer.php"; ?>
