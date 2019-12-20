<?php
class AnswerDB{

    public static function upVote($id){
        $pdo = Database::getDB();
        $query = $pdo->prepare("UPDATE answers SET votes = votes + 1 WHERE id = :id");
        $query->bindParam("id", $id);
        $query->execute();
        $query->closeCursor();
    }

    public static function downVote($id){
        $pdo = Database::getDB();
        $query = $pdo->prepare("UPDATE answers SET votes = votes - 1 WHERE id = :id");
        $query->bindParam("id", $id);
        $query->execute();
        $query->closeCursor();
    }

}