<?php
// 1. Marrim klasen Event nga kolegia
require_once __DIR__ . '/Event.php';

// 2. Krijojmë vetëm klasën tënde PremiumEvent
// Kujdes: Kjo do të funksionojë nëse klasa Event e koleges i pranon këto parametra
class PremiumEvent extends Event {
    public $benefit;

    public function __construct($id, $title, $date, $price, $benefit) {
        // Këtu i dërgojmë të dhënat te klasa e koleges
        // Nëse ajo ka (title, date, location, price), atëherë:
        // $id yt do të bëhet title i saj
        // $title yt do të bëhet date i saj... etj.
        parent::__construct($id, $title, $date, $price);
        $this->benefit = $benefit;
    }
}
?>
