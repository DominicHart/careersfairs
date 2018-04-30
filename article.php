<?php
include 'includes/session.php';
if (!isset($_SESSION['userID'])) {
    header('location:login');
}
include 'includes/connect.php';
include 'includes/header.html';

if(empty($_GET['id'])) {
    header("location:information");
}
$article = $_GET['id'];
include 'includes/nav.php';
?>
<div class="container-fluid">
    <div class="row article">
        <div class="col-md-8 col-md-offset-2">
            <h2>Article</h2>
            <div class="info-list">
                <a href="information" class="back-to" role="button"><i class="fa fa-chevron-left" aria-hidden="true"></i>Information</a>
            <?php
            try {
                $result = $db->prepare("SELECT * FROM information WHERE infoID = :infoID");
                $result->execute(array(':infoID' => $article));
                while ($row = $result->fetch()) {
                    $newDate = date("d/m/Y", strtotime($row['Date']));
                    echo <<<_END
                        <div class="info">
                            <div class="info-head">
                                <h3>$row[Type]</h3>
                            </div>
                            <div class="info-body">
                                <a class="title" role="button" href="article?id=$row[infoID]">$row[Title]</a> 
                                <p class="date"><i class="fa fa-calendar" aria-hidden="true"></i>$row[Date], $row[Time]</p>
_END;
                              echo  "<p class='location'><i class='fa fa-map-marker' aria-hidden='true'></i>" . $row['Location'] . "</p><p>" . nl2br($row['Description']) . "</p>";
                    echo <<<_END
                                <a class="button" href="scripts/bookmark.php?article=$row[infoID]" role="button"><i class="fa fa-star" aria-hidden="true"></i>Bookmark</a>
_END;
                    if ($aLevel == 1) {
                        echo <<<_END
                            <div class="manage">
                                <button type="submit" class="editinfo" name="$row[infoID]">Edit</button>
                                <button type="submit" class="delinfo" name="$row[infoID]">Delete</button>
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
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
