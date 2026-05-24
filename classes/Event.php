<?php

class Event {

    private $conn;
    public $table = "events";

    public $title;
    public $date;
    public $location;
    public $price;
    public $category; // Shto këtë rresht

    public $id;
    public $description;
    public $event_date;
    public $image;

    public function __construct($db = null, $t = null, $d = null, $l = null, $p = null) {

        $this->conn = $db;

        if($t !== null) {
            $this->title = $t;
            $this->date = $d;
            $this->location = $l;
            $this->price = $p;
        }
    }

    function display() {
        return "
        <h3>{$this->title}</h3>
        <p>{$this->date}</p>
        <p>{$this->location}</p>
        <p>{$this->price} €</p>
        ";
    }

    public function create() {
    $query = "INSERT INTO " . $this->table . " 
              (title, description, event_date, category, image) 
              VALUES 
              (:title, :description, :event_date, :category, :image)";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':title', $this->title);
    $stmt->bindParam(':description', $this->description);
    $stmt->bindParam(':event_date', $this->event_date);
    $stmt->bindParam(':category', $this->category); // Kjo rresht po të mungonte!
    $stmt->bindParam(':image', $this->image);

    return $stmt->execute();
}

    public function read() {

        $query = "SELECT * FROM $this->table ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function single() {

        $query = "SELECT * FROM $this->table WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {

        $query = "UPDATE $this->table SET
        title=:title,
        description=:description,
        event_date=:event_date,
        image=:image
        WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':event_date', $this->event_date);
        $stmt->bindParam(':image', $this->image);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    public function delete() {

        $query = "DELETE FROM $this->table WHERE id=:id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }
}
?>