<?php
require_once __DIR__ . '/../classes/Event.php';
include __DIR__ . "/../includes/header.php"; 

$events = [
    new Event("Classic Concert", "2026-05-15", "Prishtina", 25),
    new Event("VIP Gala Night", "2026-06-10", "Prizren", 120),
    new Event("Stand-up Comedy", "2026-08-10", "Mitrovica", 10),
    new Event("Tech Summit 2026", "2026-07-01", "Gjakova", 85),
    new Event("Art Exhibition", "2026-05-12", "Peja", 15),
    new Event("Film Festival", "2026-08-10", "Ferizaj", 20),
    new Event("Masterclass Chefs", "2026-09-05", "Gjilan", 150),
    new Event("Football Tournament", "2026-05-30", "Vushtrri", 5),
    new Event("Opera Night", "2026-10-12", "Tirana", 200),
    new Event("Gardening Workshop", "2026-04-28", "Podujeva", 12)
];
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container my-5 text-center">
    <h1 class="fw-bold mb-5">Explore All Events</h1>
    <div class="row g-4">
        <?php foreach ($events as $event): ?>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0 p-3" style="border-radius: 15px; transition: transform 0.3s;">
                    <div class="card-body">
                        <h4 class="fw-bold text-dark"><?php echo $event->title; ?></h4>
                        <hr class="my-3 opacity-25">
                        <p class="text-muted mb-1">📅 <strong>Data:</strong> <?php echo $event->date; ?></p>
                        <p class="text-muted mb-3">📍 <strong>Vendi:</strong> <?php echo $event->location; ?></p>
                        <h3 class="text-primary fw-bold mb-3"><?php echo $event->price; ?>€</h3>
                        
                        <a href="../api/weather.php?city=<?php echo urlencode($event->location); ?>" 
                           class="btn btn-primary w-100 fw-bold py-2" style="border-radius: 10px;">
                           Check Weather & Book
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
    .card:hover { transform: translateY(-10px); }
    body { background-color: #f8f9fa; }
</style>

<?php include __DIR__ . "/../includes/footer.php"; ?>
