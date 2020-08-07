var dataVal = null;
function updateSubmissionTable() {
    $.ajax({
        url: "view_subs.php",
        method: "POST",
        data: dataVal
    }).done(function (response) {
        $('#submissions_result').html(response);
    })
}
function updateMessagesTable() {
    $.ajax({url: "usr_msgs.php"}).done(function(response){
        $('#messages_result').html(response);
    })
}
updateMessagesTable();
$('#refresh_messages').on('click', function(){
    updateMessagesTable()
});
$('#submissions_sort .btn').on('click', function(){
    var category = $(this)[0].innerHTML;
    if (category === "All") {
        dataVal = null;
    } else {
        dataVal = {categ: category};
    }
    updateSubmissionTable()
})