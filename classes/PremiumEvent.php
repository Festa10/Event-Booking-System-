<?php

require_once __DIR__ . '/Event.php';

class PremiumEvent extends Event {
public $benefit;

public function __construct($t, $d, $l, $p, $benefit) {

parent::__construct($t, $d, $l, $p);
$this->benefit = $benefit;
}

function display() {
$output = parent::display();
$output .= "<p>Bonus: $this->benefit</p>";
return $output;
}
}
?>



