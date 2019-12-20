<?php

class AccountDB {
    public static function check_login_details($email, $pass){

        $pdo = Database::getDB();
        // global $pdo;
        $query = $pdo->prepare("SELECT fname, lname FROM users WHERE email = :email AND password = :password ");
        $query->bindParam("email", $email);
        $query->bindParam("password", $pass);
        $query->execute();
        $result =  $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $result;

    }

    public static function is_account_exist($email){

        $pdo = Database::getDB();
        $query = $pdo->prepare("SELECT COUNT(id) FROM users WHERE email = :email");
        $query->bindParam("email", $email);
        $query->execute();
        $exist = $query->fetchColumn();
        $query->closeCursor();
        return $exist;

    }

    public static function insert_account($first_name, $last_name, $date, $email, $password){

        $pdo = Database::getDB();
        $query = $pdo->prepare("INSERT INTO users (fname, lname, dob, email, password) VALUES (:fname, :lname, :dob, :email, :password)");
        $query->bindParam("fname", $first_name);
        $query->bindParam("lname", $last_name);
        $query->bindParam("dob", $date);
        $query->bindParam("email", $email);
        $query->bindParam("password", $password);
        $query->execute();
        $result = $query->rowCount();
        $query->closeCursor();
        return $result;
    }
}





