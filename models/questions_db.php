<?php
class QuestionDB{

    public static function get_questions(){

        $pdo = Database::getDB();
        $query = $pdo->prepare("SELECT * FROM questions WHERE email = :email ");
        $query->bindParam("email", $_SESSION['email']);
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        $questions = [];
        foreach ($rows as $row) {
            $question = new Question($row['name'],
                $row['body'],
                $row['skills'],
                $row['email']);
            $question->setID($row['id']);
            $questions[] = $question;
        }

        return $questions;
    }

    public static function create_question($qname, $body, $skils){

        $pdo = Database::getDB();
        $query = $pdo->prepare("INSERT INTO questions (name, body, skills, email) VALUES (:name, :body, :skills, :email)");
        $query->bindParam("name", $qname);
        $query->bindParam("body", $body);
        $query->bindParam("skills", $skils);
        $query->bindParam("email", $_SESSION['email']);
        $query->execute();
        $result = $query->rowCount();
        $query->closeCursor();
        return $result;
    }

    public static function get_question($id){

        $pdo = Database::getDB();
        $query = $pdo->prepare("SELECT * FROM questions WHERE id = :id ");
        $query->bindParam("id", $id);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();

        $question = new Question($row['name'],
            $row['body'],
            $row['skills'],
            $row['email']);
        $question->setID($row['id']);

        return $question;

    }

    public static function exist_question($id){

        $pdo = Database::getDB();
        $query = $pdo->prepare("SELECT COUNT(id) FROM questions WHERE id = :id AND email = :email");
        $query->bindParam("id", $id);
        $query->bindParam("email", $_SESSION['email']);
        $query->execute();
        $result = $query->fetchColumn();
        $query->closeCursor();
        return $result;

    }

    public static function exist_by_id($id){

        $pdo = Database::getDB();
        $query = $pdo->prepare("SELECT COUNT(id) FROM questions WHERE id = :id");
        $query->bindParam("id", $id);
        $query->execute();
        $result = $query->fetchColumn();
        $query->closeCursor();
        return $result;

    }

    public static function exist_by_id_no_by_email($id){

        $pdo = Database::getDB();
        $query = $pdo->prepare("SELECT COUNT(id) FROM questions WHERE id = :id AND email != :email");
        $query->bindParam("id", $id);
        $query->bindParam("email", $_SESSION['email']);
        $query->execute();
        $result = $query->fetchColumn();
        $query->closeCursor();
        return $result;

    }

    public static function edit_question($qname, $body, $skils, $id){

        $pdo = Database::getDB();
        $query = $pdo->prepare("UPDATE questions SET name = :name, body = :body, skills = :skills WHERE id = :id");
        $query->bindParam("name", $qname);
        $query->bindParam("body", $body);
        $query->bindParam("skills", $skils);
        $query->bindParam("id", $id);
        $query->execute();
        $result = $query->rowCount();
        $query->closeCursor();
        return $result;

    }

    public static function delete_question($id){

        $pdo = Database::getDB();
        $query = $pdo->prepare("DELETE FROM questions WHERE id = :id LIMIT 1");
        $query->bindParam("id", $id);
        $query->execute();
        $result = $query->rowCount();
        $query->closeCursor();
        return $result;
    }

    public static function all_questions(){

        $pdo = Database::getDB();
        $query = $pdo->prepare("SELECT * FROM questions WHERE email != :email ");
        $query->bindParam("email", $_SESSION['email']);
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        $questions = [];
        foreach ($rows as $row) {
            $question = new Question($row['name'],
                $row['body'],
                $row['skills'],
                $row['email']);
            $question->setID($row['id']);
            $questions[] = $question;
        }

        return $questions;

    }

    public static function newAnswer($answer, $answer_by, $question_id){

        $pdo = Database::getDB();

        $query = $pdo->prepare("INSERT INTO answers (answer, answer_by, question_id) VALUES(:answer, :answer_by, :question_id)");
        $query->bindParam("answer", $answer);
        $query->bindParam("answer_by", $answer_by);
        $query->bindParam("question_id", $question_id);
        $query->execute();

        $query->closeCursor();
    }

    public static function getAnswers($question_id){

        $pdo = Database::getDB();

        $query = $pdo->prepare("SELECT * FROM answers WHERE question_id = :question_id ORDER BY votes DESC");
        $query->bindParam("question_id", $question_id);
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);

        $answers = [];

        foreach ($rows as $row) {
            $answer = new Answer($row['answer'],
                $row['answer_by'],
                $row['question_id'],
                $row['votes']);
            $answer->setID($row['id']);
            $answers[] = $answer;
        }

        $query->closeCursor();
        return $answers;
    }

}