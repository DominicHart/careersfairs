function edit_modal() {
    $("#edit-modal").css("display", "none");
}
function delete_modal() {
    $("#delete-modal").css("display", "none");
}
$(".btnadmin").click(function() {
    $("#prompt").load('parts/prompt.php');
    $("#delete-modal").css("display:", "block");
});