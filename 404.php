<?php
include 'includes/session.php';
if (!isset($_SESSION['userID'])) {
    header('location:login');
}
include 'includes/connect.php';
include 'includes/header.html';
?>
<div class="container-fluid">
    <div class="row error">
        <div class="content">
            <div class="icon">
                <h2>404</h2>
            </div>
            <p>Oops, something went wrong. What would you like to do?</p>
            <ul>
                <li><a href="events"><i class="fa fa-calendar" aria-hidden="true"></i>View events</a></li>
                <li><a href="information"><i class="fa fa-info-circle" aria-hidden="true"></i>View information</a></li>
                <li><a href="maps"><i class="fa fa-map-marker" aria-hidden="true"></i>View maps</a></li>
                <li><a href="bookmarks"><i class="fa fa-star" aria-hidden="true"></i>View bookmarks</a></li>
            </ul>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://use.fontawesome.com/290a75956a.js"></script>
</body>
</html>
