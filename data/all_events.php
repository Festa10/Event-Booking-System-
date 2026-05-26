<?php
require_once __DIR__ . '/../includes/database.php';
include __DIR__ . "/../includes/header.php";

function getEvents($conn) {
    try {
        $stmt = $conn->prepare("SELECT * FROM events ORDER BY event_date ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return [];
    }
}

$events = getEvents($conn);
?>

<!-- HERO -->
<div class="container-fluid p-0 mb-5" style="background: linear-gradient(135deg, #ff6600, #ff8533); color: white;">
    <div class="py-5 text-center">
        <h1 class="display-4 fw-bold">Explore All Events</h1>
        <p class="lead">Discover, check weather & book your favorite events</p>
    </div>
</div>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- EVENTS -->
<div class="container my-5">
    <div class="row g-4">

        <?php if (!empty($events)): ?>
            <?php foreach ($events as $event): ?>
                <div class="col-md-4">

                    <div class="card event-card h-100 border-0 shadow-sm p-3">

                        <div class="card-body text-center">

                            <h4 class="fw-bold text-dark">
                                <?= htmlspecialchars($event['title']) ?>
                            </h4>

                            <hr class="opacity-25">

                            <!-- DATE (nga event_date) -->
                            <p class="text-muted mb-1">
                                📅 <strong>Date:</strong>
                                <?= htmlspecialchars($event['event_date']) ?>
                            </p>

                            <!-- CATEGORY (te ti është si location) -->
                            <p class="text-muted mb-3">
                                📍 <strong>Category:</strong>
                                <?= htmlspecialchars($event['category']) ?>
                            </p>

                            <p class="text-muted mb-3">
                                <?= htmlspecialchars($event['description']) ?>
                            </p>

                            <a href="../api/weather.php?city=<?= urlencode($event['category']) ?>&event_id=<?= $event['id'] ?>"
                               class="btn btn-primary w-100 fw-bold py-2">
                                🌤 Check Weather & Book
                            </a>

                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No events found.</p>
        <?php endif; ?>

    </div>
</div>

<style>
body {
    background: #f8f9fa;
}

.event-card {
    border-radius: 16px;
    transition: 0.3s ease;
}

.event-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
}
</style>

<?php include __DIR__ . "/../includes/footer.php"; ?>