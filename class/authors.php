<?php

class Authors
{
    private $conn;
    private $table_name = "authors";

    //fields
    public $id;
    public $first_name;
    public $second_name;
    public $last_name;
    public $birthday;

    //db constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }
    //get all
    public function getAuthors() {
        $sqlQuery = "SELECT `id`, `first_name`, `second_name`, `last_name`, `birthday` " .
            "FROM " . $this->table_name;
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }
    //get single
    public function getAuthorById() {
        $sqlQuery = "SELECT `id`, `first_name`, `second_name`, `last_name`, `birthday` " .
        "FROM " . $this->table_name .
            " WHERE `id`= ? " .
            "LIMIT 0,1;";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->first_name = $dataRow['first_name'];
        $this->second_name = $dataRow['second_name'];
        $this->last_name = $dataRow['last_name'];
        $this->birthday = $dataRow['birthday'];
    }
    //create
    public function createAuthor(): bool
    {
        $sqlQuery = "INSERT INTO ". $this->table_name .
            " SET first_name = :first_name, 
                second_name = :second_name, 
                last_name = :last_name, 
                birthday = :birthday";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->second_name = htmlspecialchars(strip_tags($this->second_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->birthday = htmlspecialchars(strip_tags($this->birthday));

        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":second_name", $this->second_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":birthday", $this->birthday);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
    //update
    public function updateAuthor(): bool
    {
        $sqlQuery = "UPDATE ". $this->table_name .
                    " SET first_name = :first_name, 
                        second_name = :second_name, 
                        last_name = :last_name, 
                        birthday = :birthday" .
                    " WHERE id = :id";

        $stmt = $this->conn->prepare($sqlQuery);

        $this->first_name = htmlspecialchars(strip_tags($this->first_name));
        $this->second_name = htmlspecialchars(strip_tags($this->second_name));
        $this->last_name = htmlspecialchars(strip_tags($this->last_name));
        $this->birthday = htmlspecialchars(strip_tags($this->birthday));

        $stmt->bindParam(":first_name", $this->first_name);
        $stmt->bindParam(":second_name", $this->second_name);
        $stmt->bindParam(":last_name", $this->last_name);
        $stmt->bindParam(":birthday", $this->birthday);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
    //delete
    public function deleteAuthor(): bool
    {
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