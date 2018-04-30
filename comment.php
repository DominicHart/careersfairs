<?php
include 'includes/session.php';
if (!isset($_SESSION['userID'])) {
    header('location:login');
}
if ($aLevel == 0) {
    header('location:index');
}
include 'includes/connect.php';
include 'includes/header.html';
if(empty($_GET['id'])) {
    header("location:admin");
}
$thisfeedback = $_GET['id'];
include 'includes/nav.php';
?>
<div class="container-fluid">
    <div class="row feedback">
        <div class="col-md-8 col-md-offset-2">
            <h2>Feedback</h2>
            <?php
            try {
                $result = $db->prepare("SELECT * from feedback JOIN users ON feedback.userID = users.userID JOIN event ON feedback.eventID = event.eventID WHERE feedback.feedbackID = :feedbackID;");
                $result->execute(array(':feedbackID' => $thisfeedback));
                while ($row = $result->fetch()) {
                    $comments[] = array('Fullname' => $row['Fullname'], 'Title' => $row['Title'], '1' => $row['whatdidyouthink'], '2' => $row['whichemployers'], '3' => $row['whowould']);
                }
                if (empty($comments)) {
                    header('location:404');
                }
                else {
                    foreach ($comments as $comment)
                        echo <<<_END
                    <div class="thisfeedback">
                        <div class="head">
                            <h3>Feedback</h3>
                        </div>
                        <div class="body">
                            <h4>Name:</h4>
                            <p>$comment[Fullname]</p>
                            <h4>Which event did you attend?</h4>
                            <p>$comment[Title]</p>
                            <h4>What did you think of this fair?</h4>
                            <p>$comment[1]</p>
                            <h4>Which employers did you like?</h4>
                            <p>$comment[2]</p>
                            <h4>Who would you like to see next time?</h4>
                            <p>$comment[3]</p>
                        </div>
                    </div>
_END;
                }
            }
            catch(PDOException $e) {
                header('location:404');
            }
            ?>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
