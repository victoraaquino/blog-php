<?php

require_once "../Model/PostTag.php";
require_once "../Model/Tag.php";
require_once "../Model/Post.php";
require_once "../Dao/PostTagDAO.php";
require_once "TagController.php";

class PostTagController
{

    public static function getAllByPost($postId)
    {
        $post = new Post();
        $post->setId($postId);

        $postTag = new PostTag();
        $postTag->setPost($post);

        $dao = new PostTagDAO();
        $dao->setPostTag($postTag);

        $res = $dao->getAllByPost();

        $tags = [];

        foreach ($res as $i => $resPostTag) {
            $tags[] = TagController::getOne($resPostTag['tag_id']);
        }

        return $tags;
    }

    public static function insert($data)
    {
        var_dump($data['tags']);
        foreach ($data['tags'] as $tagId) {
            $tag = new Tag();
            $tag->setId($tagId);

            $post = new Post();
            $post->setId($data['post_id']);

            $postTag = new PostTag();
            $postTag->setPost($post);
            $postTag->setTag($tag);

            $dao = new PostTagDAO();
            $dao->setPostTag($postTag);

            $dao->insert();
        }
    }

    public static function removeByPost($postId)
    {
        $post = new Post();
        $post->setId($postId);

        $postTag = new PostTag();
        $postTag->setPost($post);

        $dao = new PostTagDAO();
        $dao->setPostTag($postTag);
        $dao->removeByPost();
    }
}
