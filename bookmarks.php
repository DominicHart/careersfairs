<?php
include 'includes/session.php';

if (!isset($_SESSION['userID'])) {
    header('location:login');
}
if (isset($_GET['action'])) {
    $event = $_GET['action'];
    if (!empty($event)) {
        if ($event == 'edeleted') {
            echo "<script>alert('The event has been removed from your bookmarks.');</script>";
        }  else if ($event == 'ideleted') {
            echo "<script>alert('The article has been removed from your bookmarks.');</script>";
        }
    }
}
include 'includes/connect.php';
include 'includes/header.html';
include 'includes/nav.php';
?>
<div class="container-fluid">
    <div class="row bookmarks">
        <div class="col-sm-8 col-sm-offset-2">
            <h2>Bookmarks</h2>
            <h3>Events</h3>
            <?php
            try {
                if (empty($events)) {
                    echo <<<_END
                    <p>You do not have any events bookmarked.</p>
_END;
                }
                else {
                    foreach ($events as $event):
                        echo <<<_END
                        <div class="bookmark">
                           <form action="scripts/dBookmark.php" method="post">
                               <input type="hidden" value="$event[ID]" name="event">
                               <button type="submit" name="submit" class="remove">&times;</button>
                           </form>
                           <a class="bookmark" href="event?id=$event[ID]">$event[Title]</a>
                       </div>               
_END;
                    endforeach;
                }
                echo "<h3>Information</h3>";
                if (empty($info)) {
                    echo <<<_END
                        <p>You do not have any information bookmarked.</p>
_END;
                }
                else {
                    foreach ($info as $inf):
                        echo <<<_END
                        <div class="bookmark">
                            <form action="scripts/dBookmark.php" method="post">
                                <input type="hidden" value="$inf[ID]" name="info">
                                <button type="submit" name="submit" class="remove">&times;</button>
                            </form>
                            <a class="bookmark" href="information?id=$inf[ID]">$inf[Title]</a>
                        </div>               
_END;
                    endforeach;
                }
            }
            catch(PDOException $e) {
                echo "Error";
            }
            ?>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
