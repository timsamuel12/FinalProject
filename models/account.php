<?php


class Account
{

    private $id, $fname, $lname, $dob, $email, $password;

    public function __construct($fname, $lname, $dob, $email, $password)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->dob = $dob;
        $this->email = $email;
        $this->password = $password;
    }

    public function getID()
    {
        return $this->id;
    }

    public function setID($value)
    {
        $this->id = $value;
    }

    public function getFname()
    {
        return $this->fname;
    }

    public function setFname($value)
    {
        $this->fname = $value;
    }

    public function getLname()
    {
        return $this->lname;
    }

    public function setLname($value)
    {
        $this->lname = $value;
    }

    public function getDOB()
    {
        return $this->dob;
    }

    public function setDOB($value)
    {
        $this->dob = $value;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($value)
    {
        $this->email = $value;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($value)
    {
        $this->password = $value;
    }
}
