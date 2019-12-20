<?php

class Question {

    private $id, $name, $body, $skills, $email;

    public function __construct($name, $body, $skills, $email){
        $this->name = $name;
        $this->body = $body;
        $this->skills = $skills;
        $this->email = $email;
    }

    public function getID(){
        return $this->id;
    }

    public function setID($value){
        $this->id = $value;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($value){
        $this->name = $value;
    }

    public function getBody(){
        return $this->body;
    }

    public function setBody($value){
        $this->body = $value;
    }

    public function getSkills(){
        return $this->skills;
    }

    public function setSkills($value){
        $this->skills = $value;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($value){
        $this->email = $value;
    }

    public function getSkillsCommaSep(){
        $skillsCommaSep = "";
        $skillsArray = unserialize($this->skills);
        foreach( $skillsArray as $key => $sk) {
            $skillsCommaSep .= $sk;
            if((count($skillsArray) - 1 ) != $key )
                $skillsCommaSep .= ", ";
        }

        return $skillsCommaSep;
    }

}