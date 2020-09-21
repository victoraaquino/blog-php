<?php

require_once "./../Model/Post.php";
require_once "./../Dao/PostDAO.php";
require_once "AuthorController.php";
require_once "PostTagController.php";
class PostController
{

    public static function getAll()
    {
        $dao = new PostDAO();

        $res = $dao->getAll();

        $posts = [];

        foreach ($res as $i => $postRes) {
            $newPost = new Post();
            $newPost->setId($postRes['id']);
            $newPost->setTitle($postRes['title']);
            $newPost->setText($postRes['text']);
            $newPost->setTime($postRes['time']);
            $newPost->setAuthor(AuthorControler::getOne($postRes['author_id']));
            $newPost->setTags(PostTagController::getAllByPost( $newPost->getId()));

            $posts[] = $newPost;
        }

        return $posts;
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

        $posts = [];

        foreach ($res as $i => $postRes) {
            $newPost = new Post();
            $newPost->setId($postRes['id']);
            $newPost->setTitle($postRes['title']);
            $newPost->setText($postRes['text']);
            $newPost->setTime($postRes['time']);
            $newPost->setAuthor(AuthorControler::getOne($postRes['author_id']));
            $newPost->setTags(PostTagController::getAllByPost( $newPost->getId()));

            $posts[] = $newPost;
        }

        return $posts;
    }

    public static function getOne($postId)
    {

        $post = new Post();
        $post->setId($postId);

        $dao = new PostDAO();
        $dao->setPost($post);
        $res = $dao->getOne();

        $newPost = new Post();
        $newPost->setId($res['id']);
        $newPost->setTitle($res['title']);
        $newPost->setText($res['text']);
        $newPost->setTime($res['time']);
        $newPost->setAuthor(AuthorControler::getOne($res['author_id']));
        $newPost->setTags(PostTagController::getAllByPost( $newPost->getId()));

        return $newPost;
    }

    public static function insert($data)
    {

        $post = new Post();
        $post->setTitle($data["title"]);
        $post->setText($data["text"]);
        $post->setTime(date('Y-m-d H:i:s'));

        $post->setAuthor(AuthorControler::getOne($data["author_id"]));

        $dao = new PostDAO();
        $dao->setPost($post);
        $res = $dao->insert(); //retorna o id inserido

        $post->setId($res);

        PostTagController::insert([
            'post_id' => $post->getId(),
            'tags' => $data['tags']
        ]);

        if ($res > 0) {
            header("Location: home.php");
        } else {
            header("Location: post.php?erro=true");
        }
    }

    public static function update($data)
    {
        $post = new Post();
        $post->setId($data['id']);
        $post->setTitle($data['title']);
        $post->setText($data['text']);
        $post->setTime(date('Y-m-d H:i:s'));

        $dao = new PostDAO();
        $dao->setPost($post);
        $res = $dao->update();

        PostTagController::insert([
            'post_id' => $post->getId(),
            'tags'=> $data['tags']
        ]);

        if ($res) {
            header("Location: home.php");
        } else {
            header("Location: post.php?erro=true");
        }
    }

    public static function remove($postId)
    {
        $post = new Post();
        $post->setId($postId);

        PostTagController::removeByPost($post->getId());

        $dao = new PostDAO();
        $dao->setPost($post);
        $res = $dao->remove();

        if ($res) {
            header("Location: home.php");
        } else {
            header("Location: home.php?erro=true");
        }
    }
}
