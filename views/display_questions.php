<?php include("../views/header.php"); ?>
<?php include("../views/logged-menu.php"); ?>

    <div class="container-div">
        <h1>Questions?</h1>
        <form method="post" action="?action=create_new_question">
            <div class="container">

                <?php
                if(isset($_SESSION['error']))
                    echo "<p class='error'>Error: ".$_SESSION['error']."</p>";

                else if(isset($_SESSION['success']))
                    echo "<p class='success'>Success: ".$_SESSION['success']."</p>";

                unset($_SESSION['error']);
                unset($_SESSION['success']);
                ?>

                <label for="qname"><b>Question Name:</b></label>
                <input type="text" placeholder="Question Name" name="qname" id="qname" required>

                <label for="body"><b>Question Body:</b></label>
                <textarea name="body" id="body" placeholder="Body" rows="3"></textarea>

                <label for="skills"><b>Question Skills:</b></label>
                <input type="text" placeholder="Enter Skill" name="skills" id="skills" required>

                <button type="submit" name="submit">Submit</button>

            </div>
        </form>
    </div>

<?php include("../views/footer.php"); ?>