<?php

class Answer{

    private $id, $answer, $answer_by, $question_id, $votes;

    public function __construct($answer, $answer_by, $question_id, $votes){
        $this->answer = $answer;
        $this->answer_by = $answer_by;
        $this->question_id = $question_id;
        $this->votes = $votes;
    }

    public function getID(){
        return $this->id;
    }

    public function setID($value){
        $this->id = $value;
    }

    public function getAnswer(){
        return $this->answer;
    }

    public function setAnswer($value){
        $this->answer = $value;
    }

    public function getAnswerBy(){
        return $this->answer_by;
    }

    public function setAnswerBy($value){
        $this->answer_by = $value;
    }

    public function getQuestionID(){
        return $this->question_id;
    }

    public function setQuestionID($value){
        $this->question_id = $value;
    }

    public function getVotes(){
        return $this->votes;
    }

    public function setVotes($value){
        $this->votes = $value;
    }
}