<?php
include("config.php");
include("models/database.php");
include("models/accounts_db.php");
include("models/account.php");


$action = filter_input(INPUT_GET, 'action');
if ($action == NULL) {
    $action = 'display_login';
}

if($action == "display_login"){
    include("views/display_login.php");

} else if($action == "login"){

    if(isset($_POST['submit']))
    {
        $email = $_POST['fname'];
        $pass = $_POST['pass'];

        if($email == '')
        {
            $_SESSION['error'] = "Email is required";
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['error'] = "<b>$email</b> is not a valid email address";
        }
        else if($pass == '')
        {
            $_SESSION['error'] = "Password is required";
        }
        else if(strlen($pass)<8)
        {
            $_SESSION['error'] = "Minimum password length is 8";
        } else {

            $result = AccountDB::check_login_details($email, $pass);

            if(false == $result) {
                $_SESSION['error'] = "Email or password is incorrect";
            } else {

                $_SESSION['email'] = $email;
                $_SESSION['fname'] = $result['fname'];
                $_SESSION['lname'] = $result['lname'];

                header("Location: ./questions/?action=display_all_questions");

                die();
            }

        }

        header("Location: ?action=display_login");
        die();

    }

    /* end of if($action == "login") */

} else if($action == "display_registeration"){

    include("views/display_registeration.php");

} else if($action == "register"){

    if(isset($_POST['submit']))
    {
        $first_name = $_POST['fname'];
        $last_name = $_POST['lname'];
        $date = $_POST['date'];
        $email = $_POST['email'];
        $password = $_POST['pass'];
        if($first_name == '')
        {
            $_SESSION['error'] = "First Name is required";
        }
        else if($last_name == '')
        {
            $_SESSION['error'] = "Last name is required";
        }
        else if($date == '')
        {
            $_SESSION['error'] = "Please enter valid date";
        }
        else if($email == '')
        {
            $_SESSION['error'] = "Enter a valid email";
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $_SESSION['error'] = "<b>$email</b> is not a valid email address";
        }
        else if($password == '')
        {
            $_SESSION['error'] = "Password is required";
        }
        else if(strlen($password)<8)
        {
            $_SESSION['error'] = "Minimum password length is 8 characters.";
        } else {


            $exist = AccountDB::is_account_exist($email);

            if($exist > 0){
                $_SESSION['error'] = "Email already exist in the database, you can login";
            } else {

                $result = AccountDB::insert_account($first_name, $last_name, $date, $email, $password);

                if($result > 0){

                    $_SESSION['success'] = "You have been registered successfully! You can login now";

                } else {
                    $_SESSION['error'] = "There is some error.";
                }


            }

        }
    } else $_SESSION['error'] = "There is some error";

    header("Location: ?action=display_registeration");


} else {
    include("views/404.php");
}