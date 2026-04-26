<?php
require_once __DIR__ . '/../classes/PremiumEvent.php';

$events = [
    
    new Event(1, "Classic Concert", "2026-05-15", 25),
    new PremiumEvent(2, "VIP Gala Night", "2026-06-10", 120, "Free Drinks & Backstage Access"),
    new Event(3, "Stand-up Comedy Show", "2026-05-20", 10),
    new PremiumEvent(4, "Tech Summit 2026", "2026-07-01", 85, "Certificate & Workshop"),
    new Event(5, "Art Exhibition", "2026-05-12", 15),
    new Event(6, "Film Festival", "2026-08-10", 20),
    new PremiumEvent(7, "Masterclass with Chefs", "2026-09-05", 150, "Gift Knife Set & Tasting"),
    new Event(8, "5x5 Football Tournament", "2026-05-30", 5),
    new PremiumEvent(9, "Opera Night - Front Row", "2026-10-12", 200, "Meet & Greet with Artists"),
    new Event(10, "Gardening Workshop", "2026-04-28", 12)
];

// Automatic sorting by price (from lowest to highest)
usort($events, function($a, $b) {
    return $a->price <=> $b->price;
});
?> 
