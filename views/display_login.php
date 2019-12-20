<?php include("views/header.php"); ?>
<?php include("views/not-logged-menu.php"); ?>

    <div class="container-div">
        <h1>Login</h1>
        <form method="post" action="?action=login">
            <div class="container">

                <?php
                if(isset($_SESSION['error'])){
                    echo "<p class='error'>Error: ".$_SESSION['error']."</p>";
                    unset($_SESSION['error']);
                }
                ?>

                <label for="fname"><b>Email</b></label>
                <input type="email" placeholder="Enter Email" name="fname" id="fname" required>

                <label for="pass"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="pass" id="pass" required>

                <button type="submit" name="submit">Login</button>

            </div>
        </form>
    </div>


<?php include("views/footer.php"); ?>