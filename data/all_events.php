
<?php
require_once __DIR__ . '/../classes/PremiumEvent.php';

$events = [
    new Event("Classic Concert", "2026-05-15", "Prishtina", 25),
    new PremiumEvent("VIP Gala Night", "2026-06-10", "Tirana", 120, "Free Drinks & Backstage Access"),
    new Event("Stand-up Comedy", "2026-05-20", "Prizren", 10),
    new PremiumEvent("Tech Summit 2026", "2026-07-01", "Peja", 85, "Certificate & Workshop"),
    new Event("Art Exhibition", "2026-05-12", "Gjakova", 15),
    new Event("Film Festival", "2026-08-10", "Ferizaj", 20),
    new Event("Football Tournament", "2026-05-30", "Mitrovica", 5),
    new Event("Gardening Workshop", "2026-04-28", "Prishtina", 12)
];

usort($events, function($a, $b) {
    return $a->price <=> $b->price;
});

// PËRFSHIJ HEADER-IN
include __DIR__ . "/../includes/header.php"; 
?>

<div class="container my-5">
    <h1 class="text-center mb-5 fw-bold">Explore Events</h1>
    <div class="row g-4">
        <?php foreach ($events as $event): ?>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0" style="border-radius: 15px; overflow: hidden;">
                    <div class="card-body p-4">
                        <h4 class="fw-bold"><?php echo $event->name; ?></h4>
                        <p class="text-muted mb-1"><i class="far fa-calendar-alt me-2"></i><?php echo $event->date; ?></p>
                        <p class="fw-bold text-primary"><?php echo $event->price; ?>€</p>
                        
                        <?php if ($event instanceof PremiumEvent): ?>
                            <div class="badge bg-warning text-dark mb-3">Premium: <?php echo $event->perks; ?></div>
                        <?php endif; ?>

                        <a href="../api/weather.php?city=<?php echo urlencode($event->location); ?>" class="btn btn-primary w-100 fw-bold py-2" style="border-radius: 10px;">
                            Book Now
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include __DIR__ . "/../includes/footer.php"; ?>


