<?php
include 'includes/session.php';
include 'includes/connect.php';
include 'includes/functions.php';

if (!isset($_SESSION['userID'])) {
    header('location:login');
}
include 'includes/header.html';
if(empty($_GET['id'])) {
    header("location:maps");
}
$thismap = $_GET['id'];
include 'includes/nav.php';
?>
<div class="container-fluid">
    <div class="row this-map">
        <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            <h2>Map</h2>
            <p>This is the map for the selected event, click on it to view the event.</p>

            <?php
            $getmap = $db->prepare("SELECT * FROM event_maps JOIN event ON event_maps.eventRef = event.eventID WHERE event_maps.mapID = :mapID");
            $getmap->execute(array(':mapID' => $thismap));
            while ($row = $getmap->fetch()) {
                echo <<<_END
                            <a href="event?id=$row[eventID]">
                               <img src="images/maps/$row[image]" alt="$row[Title]" class="img-responsive">
                           </a>
_END;
            }
            ?>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
