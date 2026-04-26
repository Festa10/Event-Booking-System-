<?php


require_once __DIR__ . '/Event.php';

// 2. Trashëgimia e klasës PremiumEvent nga Event
class PremiumEvent extends Event {
    public $benefit;

    public function __construct($id, $title, $date, $price, $benefit) {
        // Thirret konstruktori i klasës prind (Event)
        parent::__construct($id, $title, $date, $price);
        $this->benefit = $benefit;
    }
}

?>
