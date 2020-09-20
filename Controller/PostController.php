<?php

require_once "./../Model/Post.php";
require_once "./../Dao/PostDAO.php";
require_once "./../Controller/AuthorController.php";
class PostController
{

    public static function insert($data)
    {
        $post = new Post();
        $post->setTitle($data["title"]);
        $post->setText($data["text"]);
        $post->setTime(date('Y-m-d H:i:s'));

        $author = AuthorControler::getOne($data["author_id"]);

        $post->setAuthor($author);

        $dao = new PostDAO();
        $dao->setPost($post);
        $res = $dao->insert();

        if ($res) {
            header("Location: home.php");
        } else {
            header("Location: post.php?erro=true");
        }
    }

    public static function getAllByAuthor($authorId)
    {
        $author = new Author();
        $author->setId($authorId);

        $post = new Post();
        $post->setAuthor($author);

        $dao = new PostDAO();
        $dao->setPost($post);
        $res = $dao->getAllByAuthor();

        return $res;
    }

    public static function getAll(){
        $dao = new PostDAO();

        $res = $dao->getAll();

        return $res;
    }
}
