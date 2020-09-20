<?php

class Author
{

    private $id;
    private $name;
    private $email;
    private $password;

    public function __construct($name = "", $email = "", $password = "")
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }
}
