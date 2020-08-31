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
function decryptData(data) {
    return window.atob(window.atob(data));
}
function encryptData(data) {
    return window.btoa(window.btoa(data));
}
function updateTeam(){
    $.getJSON('../lib/team.json', function(data){
        $.each(data, function(key, val){
            var objKey = key;
            var objKeyTrim = String(objKey).replace('=', '').replace('=', '');
            $.each(val, function (key, val) {
                var imgPath = "../" + val[1];
                $('.team_members').append('<div class="card m-3"><img src="' + imgPath + '" class="card-img-top" alt="' + decryptData(objKey) + '"><div class="card-body"><h4 class="card-title">' + decryptData(objKey) + '</h4><h5>' + decryptData(key) + '</h5><p class="card-text">' + decryptData(val[0]) + '</p></div></div>')
            })
        })
    });
}
function teamEditor(appendTo){
    $(appendTo).append('<div class="d-flex flex-wrap"></div>');
    $('#console .modal-footer').prepend('<button type="button" class="btn btn-success" onclick="commitTeamChanges()"><i class="fa fa-save"></i></button>')
    $.getJSON('../lib/team.json', function(data){
        $.each(data, function(key, val){
            var objKey = key;
            var objKeyTrim = String(objKey).replace('=', '').replace('=', '');
            $.each(val, function (key, val) {
                var imgPath = "../" + val[1];
                $(appendTo).find('div.d-flex').append('<div class="card mb-3 w-50"><div class="card-header text-center p-0"><div class="btn-group w-100"><button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="showImages()">Select Image</button><div class="dropdown-menu w-100"><div class="dropdown-divider"></div><a class="dropdown-item" href="upload.php" target="_blank"><i class="fa fa-upload"></i> Upload</a></div></div></div><img src="' + imgPath + '" class="card-img-top" alt="' + decryptData(objKey) + '"><div class="card-body"><div class="form-group"><input class="form-control team_name" value="' + decryptData(objKey) + '"></div><div class="form-group"><input class="form-control team_desig" value="' + decryptData(key) + '"></div><div class="form-group"><textarea class="form-control team_descript" style="height: 10rem">' + decryptData(val[0]) + '</textarea></div></div><button class="btn btn-outline-danger delete-user" onclick="deleteMember(this)"><i class="fa fa-user-times"></i></button></div>')
            })
        })
    }).done(function(){
        $(appendTo).append('<button class="btn btn-outline-info btn-block" type="button" onclick="addMember()"><i class="fa fa-plus"></i> Add Member</button>');
    });
}
function addMember() {
    $('#console .modal-body .d-flex').append('<div class="card mb-3 w-50"><div class="card-header text-center p-0"><div class="btn-group w-100"><button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="showImages()">Select Image</button><div class="dropdown-menu w-100"><div class="dropdown-divider"></div><a class="dropdown-item" href="upload.php" target="_blank"><i class="fa fa-upload"></i> Upload</a></div></div></div><img src="" class="card-img-top" alt=""><div class="card-body"><div class="form-group"><input class="form-control team_name" value="" placeholder="Name"></div><div class="form-group"><input class="form-control team_desig" value="" placeholder="Designation"></div><div class="form-group"><textarea class="form-control team_descript" style="height: 10rem" placeholder="Description"></textarea></div></div><button class="btn btn-outline-danger delete-user" onclick="deleteMember(this)"><i class="fa fa-user-times"></i></button></div>');
}
function deleteMember(element){
    element.parentNode.remove();
}
function commitTeamChanges() {
    var fileCon = [];
    $('#console .modal-body .card').each(function(){
        var name = encryptData($(this).find('.team_name').val());
        var desig = encryptData($(this).find('.team_desig').val());
        var descript = encryptData($(this).find('.team_descript').val());
        var img = $(this).find('img.card-img-top').attr('src').replace('../', '');
        var tempCon = '"' + name + '": {"' + desig + '": ["' + descript + '", "' + img + '"]}';
        fileCon.push(tempCon);
    });
    var putJSON = '{' + fileCon.toString() + '}';
    $.ajax({
        url: 'edit_members.php',
        method: 'POST',
        data: {change: putJSON}
    }).done(function(response){
        if(response == false){
            $('#console .modal-body').append('<div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">Changes could not be made.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        } else {
            $('#console .modal-body').append('<div class="alert alert-success alert-dismissible fade show mt-3" role="alert">Changes made!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        }
    })
}
function showImages(){
    $.ajax({
        url: 'show_imgs.php',
        method: 'POST',
        data: {show: 1}
    }).done(function(response){
        $('.dropdown-divider').before(response);
    });
    $('.dropdown-menu').parent('.btn-group').on('hide.bs.dropdown', function () {
        $('.dropdown-menu').find('.dropdown-item:not([href="upload.php"])').remove()
    });
}
function changeImg(element){
    element.parentNode.parentNode.parentElement.nextSibling.attributes.src.nodeValue = element.childNodes[0].attributes.src.nodeValue;
}
function deleteImg(value){
    $.ajax({
        url: 'show_imgs.php',
        method: 'POST',
        data: {delete: 1, file: value}
    }).done(function(response){
        if(response == "success") {
            $('#console').find('img[src="' + value + '"]').parents('tr').remove();
        }
    });
}
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
$('#edit_team').on('click', function(){
    $('#console').modal('show');
    teamEditor('#console .modal-body');
})
$('#edit_team_assets').on('click', function(){
    $('#console').modal('show');
    $('#console .modal-body').append('<table class="table"><tr><th>Item</th><th>Action</th></tr></table>');
    $.ajax({
        url: 'show_imgs.php',
        method: 'POST',
        data: {show: 'del'}
    }).done(function(response){
        $('#console .table').append(response);
    })
})
$('#console').on('hide.bs.modal', function(){
    $('#console .modal-body').empty();
    $('#console .modal-footer').find('.fa-save').parent('button').remove();
})
// run on open
updateTeam();
updateMessagesTable();