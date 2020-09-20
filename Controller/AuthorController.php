<?php

require_once "./../Model/Author.php";
require_once "./../Dao/AuthorDAO.php";

class AuthorControler
{

    public static function login($filters)
    {
        $author = new Author();
        $author->setEmail($filters["email"]);
        $author->setPassword(md5($filters["password"]));

        $dao = new AuthorDAO($author);

        $res = $dao->login();

        if (count($res) > 0) {
            $_SESSION["user"] = $res;
            header("Location: home.php");
        } else {
            header("Location: login.php?error=true");
        }
    }

    public static function register($data)
    {
        $author = new Author();
        $author->setName($data["name"]);
        $author->setEmail($data["email"]);
        $author->setPassword(md5($data["password"]));

        $dao = new AuthorDAO($author);
        $res = $dao->insert();

        if ($res) {
            header("Location: login.php");
        } else {
            header("Location: register.php?error=true");
        }
    }

    public static function getOne($id){
        $author = new Author();
        $author->setId($id);

        $dao = new AuthorDAO($author);
        $res = $dao->getOne();

        $author->setName($res['name']);
        $author->setEmail($res['email']);
        $author->setPassword($res['password']);

        return $author;
    }
}
