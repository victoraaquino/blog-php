<?php

require_once "./../Model/Tag.php";

class TagDAO {

    private $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }
}