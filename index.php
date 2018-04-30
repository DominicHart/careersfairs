<?php
include 'includes/session.php';

if (!isset($_SESSION['userID'])) {
    header('location:login');
}

include 'includes/header.html';
include 'includes/nav.php';
?>
<div class="container-fluid">
    <div class="row intro">
        <div class="content">
            <h2>NTU Careers Fairs</h2>
            <p>Stay up to date with employers and events</p>
            <a role="button" href="events.php">View Events</a>
        </div>
    </div>
    <div class="row about">
        <div class="col-sm-8 col-sm-offset-2">
            <h2>Welcome to Careers Fairs</h2>
            <p>This website is dedicated to the Nottingham Trent University Careers Fairs. On this website you can view event details, general information, view event maps for upcoming fairs and more. To get started, click one of the links in the navigation bar or one of the links that can be found below.</p>
        </div>
    </div>
    <div class="row next-section">
        <div class="col-sm-6 col-md-3">
            <div class="i-container">
                <i class="fa fa-info" aria-hidden="true"></i>
            </div>
            <a href="information.php">Information</a>
            <p>Browse fair information.</p>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="i-container">
                <i class="fa fa-calendar" aria-hidden="true"></i>
            </div>
            <a href="events.php">Events</a>
            <p>View fair events.</p>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="i-container">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
            </div>
            <a href="maps.php">Map</a>
            <p>View fair maps.</p>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="i-container">
                <i class="fa fa-comment" aria-hidden="true"></i>
            </div>
            <a href="feedback.php">Feedback</a>
            <p>Give your feedback.</p>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>

