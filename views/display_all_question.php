<?php include("../views/header.php"); ?>
<?php include("../views/logged-menu.php"); ?>

    <div class="questions-div">
        <?php
        if(isset($_SESSION['success']))
            echo "<p class='success'>Success: ".$_SESSION['success']."</p>";

        unset($_SESSION['success']);
        ?>

        <!-- Tab links -->
        <div class="tab">
            <button class="tablinks" id="my_question_button" onclick="openCity(event, 'myQuestions')">My Questions</button>
            <button class="tablinks" onclick="openCity(event, 'allQuestions')">All Questions</button>
        </div>

        <!-- Tab content -->
        <div id="myQuestions" class="tabcontent">
            <h3>My Questions</h3>

            <?php
            $i = 1;
            foreach($my_questions as $q) { ?>

                <div class="questions">
                    <b><?php echo $i ?></b> <a href="?action=question_details&id=<?php echo $q->getID(); ?>"><?php echo $q->getName(); ?></a>
                </div>

                <?php
                $i++;
            } ?>

        </div>

        <div id="allQuestions" class="tabcontent">
            <h3>All Questions</h3>

            <?php
            $i = 1;
            foreach($questions as $q) { ?>

                <div class="questions">
                    <b><?php echo $i ?></b> <a href="?action=question_details&id=<?php echo $q->getID(); ?>"><?php echo $q->getName(); ?></a>
                </div>

                <?php
                $i++;
            } ?>

        </div>

    </div>

<?php include("../views/footer.php"); ?>