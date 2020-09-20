<?php

require_once "./../Model/Author.php";
require_once "./../Database/Connection.php";

class AuthorDAO
{

    private $author;
    private $conn;

    public function __construct(Author $author)
    {
        $this->author = $author;
        $this->conn = Connection::getConnection();
    }

    public function login()
    {
        $stmt = $this->conn->prepare("SELECT * FROM author WHERE email=:email AND password=:pass");

        $stmt->bindValue(":email", $this->author->getEmail());
        $stmt->bindValue(":pass", $this->author->getPassword());

        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

        return $res;
    }

    public function insert()
    {
        $stmt = $this->conn->prepare("INSERT INTO author (name, email, password) VALUES (:name, :email, :pass)");

        $stmt->bindValue(":name", $this->author->getName());
        $stmt->bindValue(":email", $this->author->getEmail());
        $stmt->bindValue(":pass", $this->author->getPassword());

        $res = $stmt->execute();

        return $res;
    }

    public function getOne()
    {
        $stmt = $this->conn->prepare("SELECT * FROM author WHERE id=:id");

        $stmt->bindValue(":id", $this->author->getId());

        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

        return $res;
    }
}
