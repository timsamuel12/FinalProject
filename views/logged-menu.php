<ul>
    <li><a href="?action=display_all_questions" <?php if($action == "display_all_questions") echo 'class="active"'; ?>>All Questions</a></li>
    <li><a href="?action=display_questions" <?php if($action == "display_questions") echo 'class="active"'; ?>>My Questions</a></li>
    <li><a href="?action=display_new_question" <?php if($action == "display_new_question") echo 'class="active"'; ?>>Add New Question</a></li>
    <li style="float:right"><a href="../logout.php">Logout</a></li>
    <li style="float:right"><a><i>Logged in as <?php echo $_SESSION['fname'] ?> <?php echo $_SESSION['lname'] ?></i></a></li>
</ul>