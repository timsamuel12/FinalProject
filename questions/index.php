<?php
include("../config.php");
include("../models/database.php");
include("../models/questions_db.php");
include("../models/question.php");
include("../models/answer.php");
include("../models/answer_db.php");

if(!isset($_SESSION['email'])) {
    header("Location: ../");
    die();
}

$action = filter_input(INPUT_GET, 'action');
if ($action == NULL) {
    $action = 'display_questions';
}

if($action == "display_questions"){
    $result = QuestionDB::get_questions();
    include("../views/display_questions.php");

} else if($action == "display_new_question"){
    include("../views/display_new_question.php");

} else if($action == "create_new_question"){

    if(isset($_POST['submit']))
    {
        $qname = $_POST['qname'];

        $body = $_POST['body'];
        $skills = $_POST['skills'];
        if($qname == '')
        {
            $_SESSION['error'] = "Question name is required";
        }
        else if(strlen($qname)<3)
        {
            $_SESSION['error'] = "Question name character length minimum is 3.";
        }
        else if($body == '')
        {
            $_SESSION['error'] = "Question Body is required to be filled.";
        }
        else if(strlen($body)>500)
        {
            $_SESSION['error'] = "Question body must contain less than 500 characters";
        }
        else
        {
            $array = explode(",", $skills);
            $skils = serialize($array);

            $result = QuestionDB::create_question($qname, $body, $skils);

            if($result > 0)
                $_SESSION['success'] = "Question has been submitted successfully!";
            else
                $_SESSION['error'] = "There is some error.";

        }
    } else $_SESSION['error'] = "There was an error.";

    header("Location: ?action=display_new_question");

} else if($action == "display_edit_question"){

    $id = intval(filter_input(INPUT_GET, 'id'));

    if($id < 1) die("Invalid ID");

    $question = QuestionDB::get_question($id);

    if(false == $question)
        die("Invalid ID");

    include("../views/display_edit_question.php");

} else if($action == "edit_question"){

    $id = intval(filter_input(INPUT_GET, 'id'));

    if($id < 1) die("Invalid ID");

    $result = QuestionDB::exist_question($id);

    if($result < 1){
        echo "Invalid ID";
        die();
    }

    if(isset($_POST['submit']))
    {
        $qname = $_POST['qname'];

        $body = $_POST['body'];
        $skills = $_POST['skills'];
        if($qname == '')
        {
            $_SESSION['error'] = "Question name is required";
        }
        else if(strlen($qname)<3)
        {
            $_SESSION['error'] = "Question name character length minimum is 3.";
        }
        else if($body == '')
        {
            $_SESSION['error'] = "Question Body is required to be filled.";
        }
        else if(strlen($body)>500)
        {
            $_SESSION['error'] = "Question body must contain less than 500 characters";
        }
        else
        {
            $array = explode(",", $skills);
            $skils = serialize($array);

            $result = QuestionDB::edit_question($qname, $body, $skils, $id);

            if($result > 0)
                $_SESSION['success'] = "Question has been edited successfully!";
            else
                $_SESSION['error'] = "There is some error.";

        }
    } else $_SESSION['error'] = "There was an error.";

    header("Location: ?action=display_edit_question&id=".$id);

} else if($action == "delete_question"){

    $id = intval(filter_input(INPUT_GET, 'id'));

    if($id < 1) die("Invalid ID");

    $result = QuestionDB::exist_question($id);

    if($result < 1){
        echo "Invalid ID";
        die();
    }

    $r = QuestionDB::delete_question($id);

    if($r > 0)
        $_SESSION['success'] = "Selected question has been deleted successfully!";
    else
        $_SESSION['error'] = "There is some error.";

    header("Location: ./");

} else if($action == "display_all_questions"){

    $my_questions = QuestionDB::get_questions();
    $questions = QuestionDB::all_questions();

    include("../views/display_all_question.php");

} else if($action == "question_details"){

    $id = intval(filter_input(INPUT_GET, 'id'));

    if($id < 1) die("Invalid ID");

    $result = QuestionDB::exist_by_id($id);

    if($result < 1){
        echo "Invalid ID";
        die();
    }

    $question = QuestionDB::get_question($id);

    $answers = QuestionDB::getAnswers($id);

    include("../views/question_details.php");


} else if($action == "post_answer"){

    $id = intval(filter_input(INPUT_GET, 'id'));

    if($id < 1) die("Invalid ID");

    $result = QuestionDB::exist_by_id_no_by_email($id);

    if($result < 1){
        echo "Invalid ID";
        die();
    }




    if(isset($_POST['submit'])){

        $answer = $_POST['answer'];

        if(empty($answer)){
            $_SESSION['error'] = "Answer must not be empty.";
            header("Location: ?action=question_details&id=".$id);
            die();
        }

        QuestionDB::newAnswer($answer, $_SESSION['email'], $id);

        $_SESSION['success'] = "Your answer has been posted successfully!";
        header("Location: ?action=question_details&id=".$id);

    } else $_SESSION['error'] = "There was an error.";

    header("Location: ?action=question_details&id=".$id);

} else if($action == "up"){

    $answer_id = intval(filter_input(INPUT_GET, 'answer_id'));
    $question_id = intval(filter_input(INPUT_GET, 'question_id'));

    AnswerDB::upVote($answer_id);

    $_SESSION['success_votes'] = "Your have successfully voted!";
    header("Location: ?action=question_details&id=".$question_id);

} else if($action == "down"){

    $answer_id = intval(filter_input(INPUT_GET, 'answer_id'));
    $question_id = intval(filter_input(INPUT_GET, 'question_id'));

    AnswerDB::downVote($answer_id);

    $_SESSION['success_votes'] = "Your have successfully voted!";
    header("Location: ?action=question_details&id=".$question_id);

} else {
    include("../views/404.php");
}