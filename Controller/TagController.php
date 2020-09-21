<?php

require_once "./../Dao/TagDAO.php";
class TagController {

    public static function getAll(){
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

}