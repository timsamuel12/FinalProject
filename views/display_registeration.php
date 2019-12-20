<?php include("views/header.php"); ?>
<?php include("views/not-logged-menu.php"); ?>

    <div class="container-div">
        <h1>Register:</h1>
        <form method="post" action="?action=register">
            <div class="container">

                <?php
                if(isset($_SESSION['error']))
                    echo "<p class='error'>Error: ".$_SESSION['error']."</p>";
                else if(isset($_SESSION['success']))
                    echo "<p class='success'>Success: ".$_SESSION['success']."</p>";

                unset($_SESSION['error']);
                unset($_SESSION['success']);
                ?>

                <label for="fname"><b>First Name:</b></label>
                <input type="text" placeholder="Enter First Name" name="fname" id="fname" required>

                <label for="lname"><b>Last Name:</b></label>
                <input type="text" placeholder="Enter Last Name" name="lname" id="lname" required>

                <label for="date"><b>Date of Birth:</b></label>
                <input type="date" placeholder="Enter Date of Birth" name="date" id="date" required>

                <label for="email"><b>Email</b></label>
                <input type="email" placeholder="Enter Email" name="email" id="email" required>

                <label for="pass"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="pass" id="pass" required>

                <button type="submit" name="submit">Register</button>

            </div>
        </form>
    </div>


<?php include("views/footer.php"); ?>