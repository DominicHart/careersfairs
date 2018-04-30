<?php
include 'includes/session.php';

if (isset($_SESSION['userID'])) {
    header('location:index');
}

include 'includes/header.html';
?>
<div class="container-fluid">
    <div class="row login">
        <form action="scripts/login_action.php" method="post">
            <img src="images/logo.png" alt="ntu-logo" class="img-responsive">
            <?php
            if(isset($_GET['login_error'])) {
                $login_error = $_GET['login_error'];
                if ($login_error == "1") {
                    echo "<p>The username and password you provided could not be verified, please check they are correct and try again.</p>";
                }
            }
            ?>
            <div class="form-group">
                <label for="username" class="sr-only">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username e.g. N0601040" required autofocus>
            </div>
            <div class="form-group">
                <label for="password" class="sr-only">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" name="submit">SIGN IN</button>
        </form>
    </div>
</div>
</body>
</html>
