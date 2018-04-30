<?php
include 'includes/session.php';

if (!isset($_SESSION['userID'])) {
    header('location:login');
}

include 'includes/header.html';
include 'includes/nav.php';
?>
<div class="container-fluid">
    <div class="row maps">
        <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            <h2>Maps</h2>
            <p>View maps for employer events. Each map shows the building, surrounding area and locations of employers within the map. Click on a map to zoom.</p>
            <div class="row">
                <?php
                    $getmaps = $db->query("SELECT * FROM event_maps JOIN event ON event_maps.eventRef = event.eventID");
                    $getmaps->execute();
                    while ($row = $getmaps->fetch()) {
                        echo <<<_END
                        <div class="col-sm-6">
                            <a class="map" href="map?id=$row[mapID]">
                                <img src="images/maps/$row[image]" alt="$row[Title]" class="img-responsive">
                                <span class="caption"></span>
                                <p>$row[Title]</p>
                            </a>
                        </div>
_END;
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
