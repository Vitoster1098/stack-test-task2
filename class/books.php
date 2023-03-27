<?php

class Books
{
    private $conn;
    private $table_name = "books";

    // поля
    public $id;
    public $title;
    public $author_id;
    public $release_date;

    // конструктор для соединения с бд
    public function __construct($db)
    {
        $this->conn = $db;
    }
    //get all
    public function getBooks() {
        $sqlQuery = "SELECT `id`, `title`, `author_id`, `release_date` FROM " . $this->table_name;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    //get single
    public function getBookById() {
        $sqlQuery = "SELECT `id`, `title`, `author_id`, `release_date` " .
            "FROM " . $this->table_name .
            " WHERE `id`= ? " .
            "LIMIT 0,1;";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->title = $dataRow['title'];
        $this->author_id = $dataRow['author_id'];
        $this->release_date = $dataRow['release_date'];
    }
    //create
    public function createBook() {
        $sqlQuery = "INSERT INTO ". $this->table_name .
            " SET title = :title, 
                author_id = :author_id, 
                release_date = :release_date";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->release_date = htmlspecialchars(strip_tags($this->release_date));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":author_id", $this->author_id);
        $stmt->bindParam(":release_date", $this->release_date);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
    //update
    public function updateBook() {
        $sqlQuery = "UPDATE ". $this->table_name .
            " SET title = :title, 
                author_id = :author_id, 
                release_date = :release_date" .
            " WHERE id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->release_date = htmlspecialchars(strip_tags($this->release_date));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":author_id", $this->author_id);
        $stmt->bindParam(":release_date", $this->release_date);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
    //delete
    public function deleteBook() {
        $sqlQuery = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($sqlQuery);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}
?>