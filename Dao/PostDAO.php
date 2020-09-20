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

    //Retorna todos os posts cadastrados
    public function getAll()
    {
        $stmt = $this->conn->prepare("SELECT * FROM post");

        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    //Retorna todos os posts cadastrados por autor
    public function getAllByAuthor()
    {
        $stmt = $this->conn->prepare("SELECT * FROM post WHERE author_id=:author_id");

        $stmt->bindValue(":author_id", $this->post->getAuthor()->getId());

        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    //Retorna um post especifico
    public function getOne()
    {
        $stmt = $this->conn->prepare("SELECT * FROM post WHERE id=:id");

        $stmt->bindValue(":id", $this->post->getId());

        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];

        return $res;
    }

    //Inseri um post no banco
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

    //Atualiza um post no banco
    public function update()
    {
        $stmt = $this->conn->prepare("UPDATE post SET title=:title, text=:text, time=:time WHERE id=:id");

        $stmt->bindValue(":id", $this->post->getId());
        $stmt->bindValue(":title", $this->post->getTitle());
        $stmt->bindValue(":text", $this->post->getText());
        $stmt->bindValue(":time", $this->post->getTime());

        $res = $stmt->execute();

        return $res;
    }

    //Deleta um post no banco
    public function remove()
    {
        $stmt = $this->conn->prepare("DELETE FROM post WHERE id=:id");

        $stmt->bindValue(":id", $this->post->getId());

        $res = $stmt->execute();

        return $res;
    }
}
