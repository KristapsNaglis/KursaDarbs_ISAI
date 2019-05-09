<?php

/**
 * Created by PhpStorm.
 * User: Kristaps
 * Date: 08-May-19
 * Time: 19:18
 */

/* Class to handle tickets */

class Ticket {

    /* Properties */
    public $id = null;
    public $title = null;
    public $price = null;
    public $artist = null;
    public $venue = null;
    public $seating = null;
    public $dateOfEvent = null;
    public $description = null;
    public $dateOfInserting = null;
    public $isFeatured = null;
    public $isMainFeatured = null;

    /* Constructor */
    public function __construct($data = array()) {
        if (isset($data['id'])) $this->id = (int)$data['id'];
        if (isset($data['title'])) $this->title = preg_replace("/[^.,-_'@?!:$ a-zA-Z0-9()]/", "", $data['title']);
        if (isset($data['price'])) $this->price = (int)$data['price'];
        if (isset($data['artist'])) $this->artist = $data['artist'];
        if (isset($data['venue'])) $this->venue = $data['venue'];
        if (isset($data['seating'])) $this->seating = $data['seating'];
        if (isset($data['dateOfEvent'])) $this->dateOfEvent = (int)$data['dateOfEvent'];
        if (isset($data['description'])) $this->description = preg_replace("/[^.,-_'@?!:$ a-zA-Z0-9()]/", "", $data['description']);
        if (isset($data['dateOfInserting'])) $this->dateOfInserting = (int)$data['dateOfInserting'];
        if (isset($data['isFeatured'])) $this->isFeatured = $data['isFeatured'];
        if (isset($data['isMainFeatured'])) $this->isMainFeatured = $data['isMainFeatured'];
    }

    /* Store form */
    public function storeFormValues($params) {

        // Store all the parameters
        $this->__construct($params);

        // Parse and store the publication and event date
        if (isset($params['dateOfInserting'] ) && isset($params['dateOfEvent'] )) {
            $insertionDate = explode('-', $params['dateOfInserting']);
            $eventDate = explode('-', $params['dateOfEvent']);

            if (count($insertionDate) == 3) {
                list ($y, $m, $d) = $insertionDate;
                $this->dateOfInserting = mktime(0, 0, 0, $m, $d, $y);
            }
            if (count($eventDate) == 3) {
                list ($y, $m, $d) = $eventDate;
                $this->dateOfEvent = mktime(0, 0, 0, $m, $d, $y);
            }
        }
    }

    public static function getById($id) {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT *, UNIX_TIMESTAMP(dateOfEvent) AS dateOfEvent FROM tickets WHERE id = :id";
        $st = $conn->prepare($sql);
        $st->bindValue(":id", $id, PDO::PARAM_INT);
        $st->execute();
        $row = $st->fetch();
        $conn = null;
        if ($row) return new Ticket($row);
    }

    public static function getList($numRows = 1000000, $order = "dateOfInserting DESC") {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT SQL_CALC_FOUND_ROWS *, UNIX_TIMESTAMP(dateOfEvent) AS dateOfEvent FROM tickets ORDER BY " .
            $order . " LIMIT :numRows";

        $st = $conn->prepare($sql);
        $st->bindValue(":numRows", $numRows, PDO::PARAM_INT);
        $st->execute();
        $list = array();

        while ($row = $st->fetch()) {
            $article = new Ticket($row);
            $list[] = $article;
        }

        // Now get the total number of tickets that matched the criteria
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query($sql)->fetch();
        $conn = null;
        return (array("results" => $list, "totalRows" => $totalRows[0]));
    }

    public function insert() {

        // Does the Ticket object already have an ID?
        if (!is_null($this->id)) trigger_error("Ticket::insert(): Attempt to insert an Ticket object that already has its ID property set (to $this->id).", E_USER_ERROR);

        // Insert the Ticket
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "INSERT INTO tickets ( title, price, artist, venue, seating, dateOfEvent, description, dateOfInserting) 
          VALUES ( :title, :price, :artist, :venue, :seating, FROM_UNIXTIME(:dateOfEvent), :description ,FROM_UNIXTIME(:dateOfInserting))";
        $st = $conn->prepare($sql);
        $st->bindValue(":title", $this->title, PDO::PARAM_STR);
        $st->bindValue(":price", $this->price, PDO::PARAM_INT);
        $st->bindValue(":artist", $this->artist, PDO::PARAM_STR);
        $st->bindValue(":venue", $this->venue, PDO::PARAM_STR);
        $st->bindValue(":seating", $this->seating, PDO::PARAM_STR);
        $st->bindValue(":dateOfEvent", $this->dateOfEvent, PDO::PARAM_INT);
        $st->bindValue(":description", $this->description, PDO::PARAM_STR);
        $st->bindValue(":dateOfInserting", $this->dateOfInserting, PDO::PARAM_INT);

        $st->execute();
        $this->id = $conn->lastInsertId();
        $conn = null;
    }

    public function update() {

        // Does the Article object have an ID?
        if (is_null($this->id)) trigger_error("Ticket::update(): Attempt to update an Ticket object that does not have its ID property set.", E_USER_ERROR);

        // Update the Article
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE tickets SET id=:id , title=:title, price=:price, artist=:artist, venue=:venue, seating=:seating, dateOfEvent=FROM_UNIXTIME(:dateOfEvent), description=:description, dateOfInserting=FROM_UNIXTIME(:dateOfInserting) WHERE id = :id";
        $st = $conn->prepare($sql);
        $st->bindValue(":id", $this->id, PDO::PARAM_INT);
        $st->bindValue(":title", $this->title, PDO::PARAM_STR);
        $st->bindValue(":price", $this->price, PDO::PARAM_INT);
        $st->bindValue(":artist", $this->artist, PDO::PARAM_STR);
        $st->bindValue(":venue", $this->venue, PDO::PARAM_STR);
        $st->bindValue(":seating", $this->seating, PDO::PARAM_STR);
        $st->bindValue(":dateOfEvent", $this->dateOfEvent, PDO::PARAM_INT);
        $st->bindValue(":description", $this->description, PDO::PARAM_STR);
        $st->bindValue(":dateOfInserting", $this->dateOfInserting, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
    }

    public function delete() {

        // Does the Article object have an ID?
        if (is_null($this->id)) trigger_error("Ticket::delete(): Attempt to delete an Ticket object that does not have its ID property set.", E_USER_ERROR);

        // Delete the Ticket
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $st = $conn->prepare("DELETE FROM tickets WHERE id = :id LIMIT 1");
        $st->bindValue(":id", $this->id, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
    }
}
