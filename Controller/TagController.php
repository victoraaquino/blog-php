<?php

require_once "./../Model/Tag.php";
require_once "./../Dao/TagDAO.php";
class TagController
{

    public static function getAll()
    {
        $dao = new TagDAO();
        $res = $dao->getAll();

        $tags = [];

        foreach ($res as $i => $tagRes) {
            $newTag = new Tag();
            $newTag->setId($tagRes['id']);
            $newTag->setName($tagRes['name']);

            $tags[] = $newTag;
        }

        return $tags;
    }

    public static function getOne($tagId)
    {
        $tag = new Tag();
        $tag->setId($tagId);

        $dao = new TagDAO();
        $dao->setTag($tag);
        $res = $dao->getOne();

        $newTag = new Tag();
        $newTag->setId($res['id']);
        $newTag->setName($res['name']);

        $tags[] = $newTag;

        return $newTag;
    }
}
