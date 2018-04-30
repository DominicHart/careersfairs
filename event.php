<?php
include 'includes/session.php';
if (!isset($_SESSION['userID'])) {
    header('location:login');
}
include 'includes/connect.php';
include 'includes/header.html';

if(empty($_GET['id'])) {
    header("location:events");
}
$thisevent = $_GET['id'];
include 'includes/nav.php';
?>
<div class="container-fluid">
    <div id="edit-delete"></div>
    <div class="row this-event">
        <div class="col-sm-8 col-sm-offset-2">
            <h2>Event</h2>
            <div class="event-list">
                <a href="events" class="back-to" role="button"><i class="fa fa-chevron-left" aria-hidden="true"></i>Events</a>
                <?php
                try {
                    $result = $db->prepare("SELECT * FROM event WHERE eventID = :eventID");
                    $result->execute(array(':eventID' => $thisevent));
                    while ($row = $result->fetch()) {
                        $newDate = date("d/m/Y", strtotime($row['Date']));
                        echo <<<_END
                        <div class="event">
                            <div class="event-head">
                                <h3>$row[Type]</h3>
                            </div>
                            <div class="event-body">
                                <a class="title" role="button" href="#">$row[Title]</a> 
                                <p class="date"><i class="fa fa-calendar" aria-hidden="true"></i>$row[Date], $row[Time]
_END;
                        /*if(time() > strtotime($newDate)) {
                            echo "<b class='pull-right'>Completed</b></p>";
                        }*/

                        echo "<p class='location'><i class='fa fa-map-marker' aria-hidden='true'></i>" . $row['Location'] . "</p><p>" . nl2br($row['Description']) . "</p>";
                        echo <<<_END
                                <a class="button" href="scripts/bookmark.php?event=$row[eventID]" role="button"><i class="fa fa-star" aria-hidden="true"></i>Bookmark</a>
_END;
                        if ($aLevel == 1) {
                            echo <<<_END
                            <div class="manage">
                                <button type="submit" class="editevent" name="$row[eventID]">Edit</button>
                                <button type="submit" class="delevent" name="$row[eventID]">Delete</button>
                            </div>
_END;
                        }
                        echo <<<_END
                    </div>
                 </div>

_END;
                    }
                }
                catch(PDOException $e) {
                    echo "Event not found";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
