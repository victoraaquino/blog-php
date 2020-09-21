<?php

require_once "./../Model/PostTag.php";
require_once "./../Controller/AuthorController.php";

class PostTagDAO
{

    private $postTag;

    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }

    public function setPostTag(PostTag $postTag)
    {
        $this->postTag = $postTag;
    }

    public function getPostTag()
    {
        return $this->postTag;
    }

    public function getAllByPost()
    {
        $stmt = $this->conn->prepare("SELECT * FROM post_tag WHERE post_id=:post_id");

        $stmt->bindValue(":post_id", $this->postTag->getPost()->getId());

        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    public function insert()
    {
        $stmt = $this->conn->prepare("INSERT INTO post_tag (post_id, tag_id) VALUES (:post_id, :tag_id)");

        $stmt->bindValue(":post_id", $this->postTag->getPost()->getId());
        $stmt->bindValue(":tag_id", $this->postTag->getTag()->getId());

        $res = $stmt->execute();

        return $res;
    }

    public function removeByPost()
    {
        $stmt = $this->conn->prepare("DELETE FROM post_tag WHERE post_id=:post_id");

        $stmt->bindValue(":post_id", $this->postTag->getPost()->getId());

        $res = $stmt->execute();

        return $res;
    }
}
