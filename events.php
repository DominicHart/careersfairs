<?php
include 'includes/session.php';

if (!isset($_SESSION['userID'])) {
    header('location:login');
}
if (isset($_GET['action'])) {
    $event = $_GET['action'];
    if (!empty($event)) {
        if ($event == 'deleted') {
            echo "<script>alert('The event was successfully deleted.');</script>";
        } else if ($event == 'updated') {
            echo "<script>alert('The event was successfully updated.');</script>";
        } else if ($event == 'created') {
            echo "<script>alert('The event has been added to your bookmarks. You can access your bookmarks from your dropdown in the navigation bar.');</script>";
        }
    }
}
include 'includes/connect.php';
include 'includes/functions.php';
include 'includes/header.html';
include 'includes/nav.php';
?>
<div class="container-fluid">
    <div id="edit-delete"></div>
    <div class="row events">
        <div class="col-sm-8 col-sm-offset-2">
        <h2>Upcoming Events</h2>
            <div class="event-list">
            <?php
            /*$title = "Education Placement Showcase Yr 1 Students (Childhood Studies, Joint / Single Honours in Education)";
            echo slug($title);*/
            try {
                if(isset($_POST['submit']) && (!isset($_POST['submit2']))) {
                    $query = "SELECT * from event WHERE Title LIKE :Type OR Description LIKE :Type OR Type LIKE :Type";
                    $filter = $_POST['any-filter'];
                    $append = "%";
                    $filter = $append .= $filter .= $append;
                }
                else if(!isset($_POST['submit']) && (isset($_POST['submit2']))){
                    $query = "SELECT * from event ORDER BY Date ASC";
                    $filter = "None";
                }
                else {
                    $query = "SELECT * from event ORDER BY Date ASC";
                    $filter = "None";
                }
                $result = $db->prepare($query);
                if(isset($filter)) {
                    $result->bindParam(':Type', $filter, PDO::PARAM_STR);
                }
                $result->execute();
                while ($row = $result->fetch()) {
                    //echo time() . "<br>" . strtotime($row['Date']);
                    if (strlen($row['Description']) > 300) {
                        $row['Description'] = substr($row['Description'], 0, 300);
                        $row['Description'] = $row['Description'] . "...";
                    }
                    $date = date("d/m/Y");
                    echo <<<_END
                        <div class="event">
                            <div class="event-head">
                                <h3>$row[Type]</h3>
                            </div>
                            <div class="event-body">
                                <a class="title" role="button" href="event?id=$row[eventID]">$row[Title]</a>    
                                <p class="date"><i class="fa fa-calendar" aria-hidden="true"></i>$row[Date], $row[Time]
_END;
                                //$Date = $row[Date];
                                /*if(time() > strtotime($Date)) {
                                    echo "<b class='pull-right'>Completed</b></p>";
                                }*/
                    echo <<<_END
                                <p class="location"><i class="fa fa-map-marker" aria-hidden="true"></i>$row[Location]</p>
                                <p>$row[Description]</p>
                                <a class="button" role="button" href="event?id=$row[eventID]"><i class="fa fa-info-circle" aria-hidden="true"></i>More Details</a>
                                <a class="button" href="scripts/bookmark.php?event=$row[eventID]" role="button"><i class="fa fa-star" aria-hidden="true"></i>Bookmark</a>
_END;
                    if($aLevel == 1) {
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
                header("location: 404");
            }
            ?>
            </div>
            <form action="" method="post" class="filter">
                <div class="form-group">
                    <label for="filter">Filter by:</label>
                    <input type="text" name="any-filter" id="any-filter" class="form-control" placeholder="Enter a search term">
                </div>
                <div class="form-group">
                    <label for="filters">Active Filter:</label>
                    <p id="filters"><?php if(isset($filter)){echo str_replace("%"," ",$filter);}else{echo"none";} ?></p>
                </div>
                <?php if(isset($_POST['submit'])){echo "<button type='submit' name='submit2' class='clear'><i class='fa fa-remove' aria-hidden='true'></i> Clear Filter</button>";}?>
                <button type="submit" name="submit" class="submit">SUBMIT</button>
            </form>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
