<?php

require "./../Model/Author.php";
require "./../Dao/AuthorDAO.php";

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
}
