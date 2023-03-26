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

}
?>