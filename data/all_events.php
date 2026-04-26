
<?php
require_once __DIR__ . '/../classes/PremiumEvent.php';

$events = [
new Event("Classic Concert", "2026-05-15", "Hall A", 25),
new PremiumEvent("VIP Gala Night", "2026-06-10", "Hotel Emerald", 120, "Free Drinks & Backstage Access"),
new Event("Stand-up Comedy", "2026-05-20", "Theater", 10),
new PremiumEvent("Tech Summit 2026", "2026-07-01", "Innovation Hub", 85, "Certificate & Workshop"),
new Event("Art Exhibition", "2026-05-12", "City Gallery", 15),
new Event("Film Festival", "2026-08-10", "Cinema", 20),
new PremiumEvent("Masterclass Chefs", "2026-09-05", "Kitchen Studio", 150, "Gift Knife Set & Tasting"),
new Event("Football Tournament", "2026-05-30", "Sports Center", 5),
new PremiumEvent("Opera Night", "2026-10-12", "Opera House", 200, "Meet & Greet"),
new Event("Gardening Workshop", "2026-04-28", "Botanical Garden", 12)
];

usort($events, function($a, $b) {
return $a->price <=> $b->price;
});
?>


