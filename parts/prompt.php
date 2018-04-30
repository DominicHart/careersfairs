<div class="delete-modal" id="delete-modal" role="dialog">
    <div class="edit-container">
        <form action="scripts/reminders.php" method="post">
            <div class="dialog-header">
                <button type="button" onclick="delete_modal()" class="pull-right close">&times;</button>
                <h3>Are you sure?</h3>
            </div>
            <div class="dialog-content clearfix">
                <p>Clicking Yes will send event reminders by email, to all students with bookmarked events. Do you wish to continue?</p>
            </div>
            <div class="dialog-buttons">
                <button type="submit" name="submit" class="delete-yes">Yes</button>
                <button type="button" onclick="delete_modal()" class="delete-no">Cancel</button>
            </div>
        </form>
    </div>
</div>