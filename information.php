<?php
include 'includes/session.php';

if (!isset($_SESSION['userID'])) {
    header('location:login');
}
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if (!empty($action)) {
        if ($action == 'deleted') {
            echo "<script>alert('The article was successfully deleted.');</script>";
        } else if ($action == 'updated') {
            echo "<script>alert('The article was successfully updated.');</script>";
        } else if ($action == 'created') {
            echo "<script>alert('The article has been added to your bookmarks. You can access your bookmarks from your dropdown in the navigation bar');</script>";
        }
    }
}

include 'includes/connect.php';
include 'includes/header.html';
include 'includes/nav.php';
?>
<div class="container-fluid">
    <div id="edit-delete"></div>
    <div class="row information">
        <div class="col-md-8 col-md-offset-2">
            <h2>Information</h2>
            <div class="info-list">
                <?php
                try {
                    if(isset($_POST['submit']) && (!isset($_POST['submit2']))) {
                        $query = "SELECT * from information WHERE Title LIKE :Type OR Description LIKE :Type OR Type LIKE :Type";
                        $filter = $_POST['any-filter'];
                        $append = "%";
                        $filter = $append .= $filter .= $append;
                    }
                    else if(!isset($_POST['submit']) && (isset($_POST['submit2']))){
                        $query = "SELECT * from information ORDER BY Date ASC";
                        $filter = "None";
                    }
                    else {
                        $query = "SELECT * from information ORDER BY Date ASC";
                        $filter = "None";
                    }
                    $stmt = $db->prepare($query);
                    if(isset($filter)) {
                        $stmt->bindParam(':Type', $filter, PDO::PARAM_STR);
                    }
                    $stmt->execute();
                    while ($row = $stmt->fetch()) {
                        $newDate = date("d/m/Y", strtotime($row['Date']));
                        if(strlen($row['Description'])> 300) {
                            $row['Description']=substr($row['Description'],0,300);
                            $row['Description'] = $row['Description']."...";
                        }
                        echo <<<_END
                            <div class="info">
                                <div class="info-head">
                                    <h3>$row[Type]</h3>
                                </div>
                                <div class="info-body">
                                    <a class="title" role="button" href="article?id=$row[infoID]">$row[Title]</a> 
                                    <p class="date"><i class="fa fa-calendar" aria-hidden="true"></i>$row[Date], $row[Time]</p>
                                    <p class="location"><i class="fa fa-map-marker" aria-hidden="true"></i>$row[Location]</p>
                                    <p>$row[Description]</p>
                                    <a class="button" role="button" href="article?id=$row[infoID]"><i class="fa fa-info-circle" aria-hidden="true"></i>More Details</a>
                                    <a class="button" href="scripts/bookmark.php?article=$row[infoID]" role="button"><i class="fa fa-star" aria-hidden="true"></i>Bookmark</a>
_END;
                        if($aLevel == 1) {
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
