<?php
include 'includes/session.php';
if (!isset($_SESSION['userID'])) {
    header('location:login');
}
if ($aLevel == 0) {
    header('location:index');
}
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if (!empty($action)) {
        if ($action == 'ecreated') {
            echo "<script>alert('The event was successfully created.');</script>";
        } else if ($action == 'icreated') {
            echo "<script>alert('The article was successfully created.');</script>";
        } else if ($action == 'pushed') {
            echo "<script>alert('Event reminders have been sent.');</script>";
        } else if ($action == 'mcreated') {
            echo "<script>alert('The map was successfully added.');</script>";
        }
    }
}
include 'includes/connect.php';
include 'includes/header.html';
include 'includes/nav.php';
?>
<div class="container-fluid">
    <div class="row admin">
        <div class="col-sm-8 col-sm-offset-2">
            <h2>Admin Panel</h2>
            <div id="prompt"></div>
                <button type="button" class="btnadmin"><i class="fa fa-envelope" aria-hidden="true"></i>Push Event Reminders</button>
            <h3 class="first">View Events Feedback</h3>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr><th>Ref</th><th>Name</th><th>Event</th></tr>
                    </thead>
                    <tbody>
                        <?php
                        try {
                            if(isset($_POST['filter'])) {
                                $query = "SELECT * FROM feedback JOIN users ON feedback.userID = users.userID JOIN event ON feedback.eventID = event.eventID WHERE event.Title LIKE :Filter OR users.Fullname LIKE :Filter ORDER BY feedbackID";
                                $filter = $_POST['any-filter'];
                                $append = "%";
                                $filter = $append .= $filter .= $append;
                            }
                            else if(isset($_POST['no-filter'])) {
                                $query = "SELECT * FROM feedback JOIN users ON feedback.userID = users.userID JOIN event ON feedback.eventID = event.eventID ORDER BY feedbackID";
                                $filter = "None";
                            }
                            else {
                                $query = "SELECT * FROM feedback JOIN users ON feedback.userID = users.userID JOIN event ON feedback.eventID = event.eventID ORDER BY feedbackID";
                                $filter = "None";
                            }
                            $result = $db->prepare($query);
                            if(isset($filter)) {
                                $result->bindParam(':Filter', $filter, PDO::PARAM_STR);
                            }
                            $result->execute();
                            while ($row = $result->fetch()) {
                                if (strlen($row['Title']) > 40) {
                                    $row['Title'] = substr($row['Title'], 0, 40);
                                    $row['Title'] = $row['Title'] . "...";
                                }
                                echo <<<_END
                                    <tr><td><a href="comment?id=$row[feedbackID]">$row[feedbackID]</a><td>$row[Fullname]</td><td><a href="event?id=$row[eventID]">$row[Title]</a></td></tr>
_END;
                            }
                        }
                        catch(PDOException $e) {
                            $error = 'Error fetching feedback; ' . $e->getMessage();
                        }
                        ?>
                    </tbody>
                </table>
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
                <?php if(isset($_POST['filter'])){echo "<button type='submit' name='no-filter' class='clear'><i class='fa fa-remove' aria-hidden='true'></i> Clear Filter</button>";}?>
                <button type="submit" name="filter" class="submit">SUBMIT</button>
            </form>
            <h3>Add an event</h3>
            <div class="row">
                <form action="scripts/new.php" method="post">
                    <div class="form-group col-sm-6">
                        <label for="type">Type</label>
                        <select name="type" id="type" class="form-control" required>
                            <option selected>- Select an option -</option>
                            <option value="Recruitment Event">Recruitment Event</option>
                            <option value="Job Search">Job Search</option>
                            <option value="Briefing">Briefing</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter the title" required>
                    </div>
                    <div class="form-group col-sm-12 date">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="day">Day</label>
                                <?php $day1 = "1"; $day31 = 1 + 30; $days = range($day1, $day31); ?>
                                <select name="day" id="day" class="form-control" required>
                                    <?php foreach($days as $day):
                                        echo "<option value='" . $day . "'>" . $day . "</option>";
                                    endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="month">Month</label>
                                <select name="month" id="month" class="form-control" required>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="year">Year</label>
                                <?php $startyear = date("Y"); $endyear = date("Y") + 1; $years = range($startyear, $endyear); ?>
                                <select name="year" id="year" class="form-control" required>
                                    <?php foreach($years as $year):
                                        echo "<option value='" . $year . "'>" . $year . "</option>";
                                    endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12 time">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="timefrom">From</label>
                                <input type="time" id="timefrom" name="timefrom" class="form-control">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="timeto">Until</label>
                                <input type="time" id="timeto" name="timeto" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="location">Location</label>
                        <input type="text" name="location" id="location" placeholder="Enter a location" class="form-control" required>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows="7" cols="30" class="form-control" placeholder="Enter the description" required></textarea>
                    </div>
                    <div class="col-sm-12">
                        <button class="pull-right submit" type="submit" name="submit-event">Submit</button>
                    </div>
                </form>
            </div>
            <h3>Add information</h3>
            <div class="row">
                <form method="post" action="scripts/new.php">
                    <div class="form-group col-sm-6">
                        <label for="type">Type</label>
                        <select name="type2" id="type2" class="form-control" required>
                            <option selected>- Select an option -</option>
                            <option value="General Information">General Information</option>
                            <option value="Exhibitors">Exhibitors</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="title">Title</label>
                        <input type="text" name="title2" id="title2" class="form-control" placeholder="Enter the title" required>
                    </div>
                    <div class="form-group col-sm-12 date">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="day2">Day</label>
                                <?php $day1 = "1"; $day31 = 1 + 30; $days = range($day1, $day31); ?>
                                <select name="day2" id="day2" class="form-control" required>
                                    <?php foreach($days as $day):
                                        echo "<option value='" . $day . "'>" . $day . "</option>";
                                    endforeach; ?>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="month2">Month</label>
                                <select name="month2" id="month2" class="form-control" required>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="year2">Year</label>
                                <?php $startyear = date("Y"); $endyear = date("Y") + 1; $years = range($startyear, $endyear); ?>
                                <select name="year2" id="year2" class="form-control" required>
                                    <?php foreach($years as $year):
                                        echo "<option value='" . $year . "'>" . $year . "</option>";
                                    endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12 time">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="timefrom2">From</label>
                                <input type="time" id="timefrom2" name="timefrom2" class="form-control">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="timeto2">Until</label>
                                <input type="time" id="timeto2" name="timeto2" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="location">Location</label>
                        <input type="text" name="location2" id="location2" placeholder="Enter a location" class="form-control" required>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="description">Description</label>
                        <textarea name="description2" id="description2" rows="7" cols="30" class="form-control" placeholder="Enter the description" required></textarea>
                    </div>
                    <div class="col-sm-12">
                        <button class="pull-right submit" type="submit" name="submit-info">Submit</button>
                    </div>
                </form>
            </div>
            <h3>Add Maps</h3>
            <div class="row">
                <form method="post" enctype="multipart/form-data" action="scripts/maps.php">
                    <div class="form-group col-sm-6">
                        <label for="eventRef">Event</label>
                        <select name="eventRef" id="eventRef" class="form-control">
                            <option selected>- Select an option -</option>
                            <?php $events = $db->query("SELECT eventID, Title FROM event"); $events->execute();
                            while ($row = $events->fetch(PDO::FETCH_ASSOC))
                            {
                                echo "<option value='" . $row['eventID'] .  "'>" . $row['Title'] . "</option>";
                            }?>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="img">Image</label>
                        <input type="file" class="form-control" name="Image" id="image">
                    </div>
                    <div class="col-sm-12">
                        <button class="pull-right submit" type="submit" name="submit-info">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
