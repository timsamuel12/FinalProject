<?php include("../views/header.php"); ?>
<?php include("../views/logged-menu.php"); ?>

    <div class="questions-div">


        <h3>Question Details:</h3>

        <p>
            Name: <?php echo $question->getName(); ?>
        </p>

        <p>
            Body: <?php echo $question->getBody(); ?>
        </p>

        <p>
            Skills: <?php echo $question->getSkillsCommaSep(); ?>
        </p>

        <p><small>Question by: <?php echo $question->getEmail(); ?></small></p>

        <?php if($_SESSION['email'] != $question->getEmail()){ ?>
            <?php
            if(isset($_SESSION['success'])){
                echo "<p class='success'>Success: ".$_SESSION['success']."</p>";
                unset($_SESSION['success']);
            }
            else if(isset($_SESSION['error'])){
                echo "<p class='error'>Error: ".$_SESSION['error']."</p>";
                unset($_SESSION['error']);
            }

            ?>
            <form method="POST" action="?action=post_answer&id=<?php echo $question->getID(); ?>">
                <div class="container">

                    <label for="answer"><b>Your Answer</b></label>
                    <textarea id="answer" required="" rows="5" name="answer"></textarea>

                    <button type="submit" name="submit">Submit Answer</button>

                </div>
            </form>
        <?php } ?>
        <h4>Answers:</h4>
        <?php
        if(isset($_SESSION['success_votes'])){
            echo "<p class='success'>Success: ".$_SESSION['success_votes']."</p>";
            unset($_SESSION['success_votes']);
        }

        ?>
        <?php foreach($answers as $answer){ ?>
            <p>
                <i><?php echo $answer->getAnswer(); ?></i> <a href="?action=up&answer_id=<?php echo $answer->getID(); ?>&question_id=<?php echo $question->getID(); ?>">Up</a> | <a href="?action=down&answer_id=<?php echo $answer->getID(); ?>&question_id=<?php echo $question->getID(); ?>">Down</a>
                <br>
                <small>Answer by: <?php echo $answer->getAnswerBy(); ?></small>
            </p>
        <?php } ?>


    </div>

<?php include("../views/footer.php"); ?>