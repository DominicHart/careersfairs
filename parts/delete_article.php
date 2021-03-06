<div class="delete-modal" id="delete-modal" role="dialog">
    <div class="edit-container">
        <form action="scripts/delete.php" method="post">
            <div class="dialog-header">
                <button type="button" onclick="delete_modal()" class="pull-right close">&times;</button>
                <h3>Are you sure?</h3>
            </div>
            <div class="dialog-content clearfix">
                <?php
                try {
                    if ($_REQUEST['js_submit_value']) {
                        $article = $_REQUEST['js_submit_value'];
                    }
                    include "../includes/connect.php";
                    $result = $db->prepare("SELECT * FROM information WHERE infoID = :infoID");
                    $result->execute(array(':infoID' => $article));
                    while ($row = $result->fetch()) {
                        echo <<<_END
                <p>You are about to delete an article ($row[Title]).</p>
                <input type="hidden" value="$row[infoID]" name="infoID">
            </div>
            <div class="dialog-buttons">
                <button type="submit" name="submit" class="delete-yes">Yes</button>
                <button type="button" onclick="delete_modal()" class="delete-no">Cancel</button>
            </div>
        </form>
_END;
                    }
                }
                catch (PDOException $e) {
                    $error = 'Error fetching event; ' . $e->getMessage();
                } ?>
            </div>
    </div>