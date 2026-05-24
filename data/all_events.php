<?php
require_once __DIR__ . '/../classes/PremiumEvent.php';

$events = [
   
    new Event("Classic Concert", "2026-05-15", "Prishtina", 25),
    new PremiumEvent("VIP Gala Night", "2026-06-10", "Tirana", 120, "Free Drinks & Backstage Access"),
    new Event("Stand-up Comedy", "2026-05-20", "Prizren", 10),
    new PremiumEvent("Tech Summit 2026", "2026-07-01", "Peja", 85, "Certificate & Workshop"),
    new Event("Art Exhibition", "2026-05-12", "Gjakova", 15),
    new Event("Film Festival", "2026-08-10", "Ferizaj", 20),
    new PremiumEvent("Masterclass Chefs", "2026-09-05", "Prizren", 150, "Gift Knife Set & Tasting"),
    new Event("Football Tournament", "2026-05-30", "Mitrovica", 5),
    new PremiumEvent("Opera Night", "2026-10-12", "Prishtina", 200, "Meet & Greet"),
    new Event("Gardening Workshop", "2026-04-28", "Prishtina", 12)
];


usort($events, function($a, $b) {
    return $a->price <=> $b->price;
});
?>

