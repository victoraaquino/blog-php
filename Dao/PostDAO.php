<?php

require_once "./../Model/Post.php";
require_once "./../Database/Connection.php";

class PostDAO
{

    private $post;
    private $conn;

    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }

    public function setPost(Post $post)
    {
        $this->post = $post;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function insert()
    {
        $stmt = $this->conn->prepare("INSERT INTO post (title, author_id, text, time) VALUES (:title, :author_id, :text, :time)");

        $stmt->bindValue(":title", $this->post->getTitle());
        $stmt->bindValue(":author_id", $this->post->getAuthor()->getId());
        $stmt->bindValue(":text", $this->post->getText());
        $stmt->bindValue(":time", $this->post->getTime());

        $res = $stmt->execute();

        return $res;
    }

    public function getAllByAuthor()
    {
        $stmt = $this->conn->prepare("SELECT * FROM post WHERE author_id=:author_id");

        $stmt->bindValue(":author_id", $this->post->getAuthor()->getId());

        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    public function getAll()
    {
        $stmt = $this->conn->prepare("SELECT * FROM post");

        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }
}
