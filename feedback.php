<?php
include 'includes/session.php';

if (!isset($_SESSION['userID'])) {
    header('location:login');
}


include 'includes/connect.php';
include 'includes/header.html';
include 'includes/nav.php';
?>
<div class="container-fluid">
    <div class="row feedback">
        <div class="col-md-8 col-md-offset-2">
            <h2>Feedback</h2>
            <div class="comment">
                <form method="post" action="scripts/feedback.php">
                    <div class="form-group">
                        <div class="header">
                            <i class="fa fa-check" aria-hidden="true"></i>
                            <label for="event">Which event did you attend?</label>
                        </div>
                        <div class="body">
                            <select name="eventref" class="form-control" id="event">
                                <option selected>Please select an event...</option>
                                <?php
                                $result = $db->prepare("SELECT * FROM event");
                                $result->execute();
                                while ($row = $result->fetch()) {
                                    $newDate = date("d/m/Y", strtotime($row['Date']));
                                    echo "<option value='" . $row['eventID'] . "'>" . $row['Title'] . "&nbsp;(" . $newDate . ")</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="header">
                            <i class="fa fa-check" aria-hidden="true"></i>
                            <label for="1">What did you think of this fair?</label>
                        </div>
                        <div class="body">
                            <textarea class="form-control" name="1" placeholder="Enter your answer here..." id="1" rows="8" cols="30" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="header">
                            <i class="fa fa-check" aria-hidden="true"></i>
                            <label for="2">Which employers did you like?</label>
                        </div>
                        <div class="body">
                            <textarea class="form-control" name="2" placeholder="Enter your answer here..." id="2" rows="8" cols="30" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="header">
                            <i class="fa fa-check" aria-hidden="true"></i>
                            <label for="3">Who would you like to see next time?</label>
                        </div>
                        <div class="body">
                            <textarea class="form-control" name="3" placeholder="Enter your answer here..." id="3" rows="8" cols="30" required></textarea>
                        </div>
                    </div>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>

