<?php

require_once "./../Model/PostTag.php";
require_once "./../Model/Tag.php";
require_once "./../Model/Post.php";
require_once "./../Dao/PostTagDAO.php";

class PostTagController {

    public static function insert($data){

        $post = new Post();
        $post->setId($data['post_id']);

        foreach ($data['tags'] as $tagId) {
            $tag = new Tag();
            $tag->setId($tagId);

            $postTag = new PostTag();
            $postTag->setPost($post);
            $postTag->setTag($tag);

            $dao = new PostTagDAO();
            $dao->setPostTag($postTag);

            $dao->insert();
        }

    }

}