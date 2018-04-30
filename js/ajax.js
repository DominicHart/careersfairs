$(document).on("click", ".editevent" , function(){
    var name = this.name;
    $("#edit-delete").load('parts/edit_event.php', {js_submit_value : name});
    $("#edit-modal").css("display", "block");
});
$(document).on("click", ".delevent" , function(){
    var name = this.name;
    $("#edit-delete").load('parts/delete_event.php', {js_submit_value : name});
    $("#delete-modal").css("display", "block");
});
$(document).on("click", ".editinfo" , function(){
    var name = this.name;
    $("#edit-delete").load('parts/edit_article.php', {js_submit_value : name});
    $("#edit-modal").css("display", "block");
});
$(document).on("click", ".delinfo" , function(){
    var name = this.name;
    $("#edit-delete").load('parts/delete_article.php', {js_submit_value : name});
    $("#delete-modal").css("display", "block");
});