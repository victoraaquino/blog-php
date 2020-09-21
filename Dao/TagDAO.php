<?php

require_once "./../Model/Tag.php";
require_once "./../Database/Connection.php";

class TagDAO
{

    private $tag;

    public function __construct()
    {
        $this->conn = Connection::getConnection();
    }

    public function setTag(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function getTag()
    {
        return $this->tag;
    }

    //Retorna todos as tags cadastrados
    public function getAll()
    {
        $stmt = $this->conn->prepare("SELECT * FROM tag");

        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }
}
