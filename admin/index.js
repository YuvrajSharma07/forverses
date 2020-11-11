var dataVal = {show: 'show'};
// Functions
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
    $.ajax({
        url: "usr_msgs.php",
        method: 'POST',
        data: dataVal
    }).done(function(response){
        $('#messages_result').html(response);
    })
}
function deleteMessage(value){
    $.ajax({
        url: "usr_msgs.php",
        method: 'POST',
        data: {del: 'del', item: value[0].id.replace('msg_', '')}
    }).done(function(response){
        var alert_class = new String();
        if(response == 'Success') {
            alert_class = 'alert-success';
        } else {
            alert_class = 'alert-danger';
        }
        $('body').append('<div class="alert ' + alert_class + ' alert-dismissible fixed-bottom fade show" role="alert">' + response + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        updateMessagesTable()
    })
}
function toBinary(string) {
    const codeUnits = new Uint16Array(string.length);
    for (let i = 0; i < codeUnits.length; i++) {
        codeUnits[i] = string.charCodeAt(i);
    }
    return String.fromCharCode(...new Uint8Array(codeUnits.buffer));
}
function fromBinary(binary) {
    const bytes = new Uint8Array(binary.length);
    for (let i = 0; i < bytes.length; i++) {
        bytes[i] = binary.charCodeAt(i);
    }
    return String.fromCharCode(...new Uint16Array(bytes.buffer));
}
function decryptData(data, extra) {
    if(extra){
        return fromBinary(window.atob(window.atob(data)));
    }
    return window.atob(window.atob(data));
}
function encryptData(data, extra) {
    if(extra){
        return window.btoa(window.btoa(toBinary(data)));
    }
    return window.btoa(window.btoa(data));
}
function updateTeam() {
    $('.team_members').children().remove();
    $.getJSON('../lib/team.json', function(data){
        $.each(data, function(key, val){
            var objKey = key;
            var objKeyTrim = String(objKey).replace(/=/g, '');
            $.each(val, function (key, val) {
                var imgPath = "../" + val[1];
                $('.team_members').append('<div class="card m-3"><img src="' + imgPath + '" class="card-img-top" alt="' + decryptData(objKey) + '"><div class="card-body"><h4 class="card-title">' + decryptData(objKey) + '</h4><h5>' + decryptData(key) + '</h5><p class="card-text">' + decryptData(val[0], true) + '</p></div></div>')
            })
        })
    });
}
function updateEvents(){
    $('#current_events').children().remove();
    $.ajax({
        url: "make_event.php",
        method: "POST",
        data: dataVal
    }).done(function (response) {
        $('#current_events').html(response);
    })
}
function deleteEvent(value){
    $.ajax({
        url: "make_event.php",
        method: 'POST',
        data: {del: 'del', item: value[0].id.replace('eve_', '')}
    }).done(function(response){
        var alert_class = new String();
        if(response == 'Success') {
            alert_class = 'alert-success';
        } else {
            alert_class = 'alert-danger';
        }
        $('body').append('<div class="alert ' + alert_class + ' alert-dismissible fixed-bottom fade show" role="alert">' + response + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        updateEvents();
    })
}
function updateCollab(){
    $('#current_collabs').children().remove();
    $.ajax({
        url: "make_collab.php",
        method: "POST",
        data: dataVal
    }).done(function (response) {
        $('#current_collabs').html(response);
    })
}
function deleteCollab(value){
    $.ajax({
        url: "make_collab.php",
        method: 'POST',
        data: {del: 'del', item: value[0].id.replace('collab_', '')}
    }).done(function(response){
        var alert_class = new String();
        if(response == 'Success') {
            alert_class = 'alert-success';
        } else {
            alert_class = 'alert-danger';
        }
        $('body').append('<div class="alert ' + alert_class + ' alert-dismissible fixed-bottom fade show" role="alert">' + response + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        updateCollab();
    })
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
                $(appendTo).find('div.d-flex').append('<div class="card mb-3 w-50"><div class="card-header text-center p-0"><div class="btn-group w-100"><button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="showImages()">Select Image</button><div class="dropdown-menu w-100"><div class="dropdown-divider"></div><a class="dropdown-item" href="upload.php" target="_blank"><i class="fa fa-upload"></i> Upload</a></div></div></div><img src="' + imgPath + '" class="card-img-top" alt="' + decryptData(objKey) + '"><div class="card-body"><div class="form-group"><input class="form-control team_name" value="' + decryptData(objKey) + '"></div><div class="form-group"><input class="form-control team_desig" value="' + decryptData(key) + '"></div><div class="form-group"><textarea class="form-control team_descript" style="height: 10rem">' + decryptData(val[0], true) + '</textarea></div><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" style="background-color: ' + val[2] + '"></span></div><input class="form-control team_color" oninput="displayColor(this)" value="' + val[2] + '"></div></div><button class="btn btn-outline-danger delete-user" onclick="deleteMember(this)"><i class="fa fa-user-times"></i></button></div>')
            })
        })
    }).done(function(){
        $(appendTo).append('<button class="btn btn-outline-info btn-block" type="button" onclick="addMember()"><i class="fa fa-plus"></i> Add Member</button>');
    });
}
function addMember() {
    $('#console .modal-body .d-flex').append('<div class="card mb-3 w-50"><div class="card-header text-center p-0"><div class="btn-group w-100"><button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="showImages()">Select Image</button><div class="dropdown-menu w-100"><div class="dropdown-divider"></div><a class="dropdown-item" href="upload.php" target="_blank"><i class="fa fa-upload"></i> Upload</a></div></div></div><img src="" class="card-img-top" alt=""><div class="card-body"><div class="form-group"><input class="form-control team_name" value="" placeholder="Name"></div><div class="form-group"><input class="form-control team_desig" value="" placeholder="Designation"></div><div class="form-group"><textarea class="form-control team_descript" style="height: 10rem" placeholder="Description"></textarea></div><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text"></span></div><input class="form-control team_color" placeholder="Write a color code / name / rgb value" oninput="displayColor(this)" value=""></div></div><button class="btn btn-outline-danger delete-user" onclick="deleteMember(this)"><i class="fa fa-user-times"></i></button></div>');
}
function displayColor(element) {
    element.previousSibling.childNodes[0].style.backgroundColor = element.value
}
function deleteMember(element) {
    element.parentNode.remove();
}
function commitTeamChanges() {
    var fileCon = [];
    $('#console .modal-body .card').each(function() {
        var name = encryptData($(this).find('.team_name').val());
        var desig = encryptData($(this).find('.team_desig').val());
        var descript = encryptData($(this).find('.team_descript').val(), true);
        var setColor = $(this).find('.team_color').val();
        var img = $(this).find('img.card-img-top').attr('src').replace('../', '');
        var tempCon = '"' + name + '": {"' + desig + '": ["' + descript + '", "' + img + '", "' + setColor + '"]}';
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
function approveSub(element){
    var elemID = element.parents('tr').children()[0].innerHTML;
    $.ajax({
        url: 'view_subs.php',
        method: 'POST',
        data: {action: 'approve', item: elemID}
    }).done(function(response){
        var alert_class = new String();
        if(response == 'Success') {
            alert_class = 'alert-success';
            updateSubmissionTable();
            approvedPosts();
        } else {
            alert_class = 'alert-danger';
        }
        $('body').append('<div class="alert ' + alert_class + ' alert-dismissible fixed-bottom fade show" role="alert">' + response + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    })
}
function disapproveSub(element){
    var elemID = element.parents('tr').children()[0].innerHTML;
    var elemLink = element.parents('tr').children()[4].childNodes[0].attributes[0].nodeValue;
    $.ajax({
        url: 'view_subs.php',
        method: 'POST',
        data: {action: 'delete', item: elemID, link: elemLink}
    }).done(function(response){
        var alert_class = new String();
        if(response == 'Success') {
            alert_class = 'alert-success';
            updateSubmissionTable();
        } else {
            alert_class = 'alert-danger';
        }
        $('body').append('<div class="alert ' + alert_class + ' alert-dismissible fixed-bottom fade show" role="alert">' + response + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    })
}
function makeSub(element) {
    var categ = element.parents('tr').children()[2].innerHTML;
    
//    $('#console').modal('show');
//    $('#console').append('')
}
function webAesthItems(value, appendTo){
    $(appendTo).children().remove();
    $.ajax({
        url: 'css_writer.php',
        method: 'POST',
        data: {show: 'show', item: value}
    }).done(function(response){
        var items = response.replace(':root {', '').replace('}','').trim().split(/;/m);
        items.pop();
        items.forEach(function(item){
            var difference = item.split(':');
            var preview = '<div class="showPreview" style="width: 100%;background-color: ' + difference[1] + ';border: 2px solid rgba(255,255,255,0.5);padding: 1rem"></div>';
            if(value == 'font_var'){
                preview = '<div class="showPreview" style="font-family: ' + difference[1] + ';">Lorem Ipsum</div>'
            }
            $(appendTo).append('<tr><td>' + difference[0] + '</td><td><input type="text" class="form-control" value="' + difference[1] + '" oninput="showPreview($(this))"></td><td>' + preview + '</td></tr>');
        })
    })
}
function webAesthPost(value, content) {
    $.ajax({
        url: 'css_writer.php',
        method: 'POST',
        data: {write: 'write', item: value, contents: content}
    }).done(function(response){
        var alert_class = new String();
        if(response == 'Success') {
            alert_class = 'alert-success';
        } else {
            alert_class = 'alert-danger';
        }
        $('body').append('<div class="alert ' + alert_class + ' alert-dismissible fixed-bottom fade show" role="alert">' + response + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    })
}
function showPreview(element) {
    if(element.parents('tr').children()[0].innerHTML.search('font') > 0) {
        element.parents('tr').children().children('.showPreview').css({"font-family": element.val()});
    } else {
        element.parents('tr').children().children('.showPreview').css({"background-color": element.val()});
    }
}
function approvedPosts() {
    $.ajax({
        url: 'view_subs.php',
        method: 'POST',
        data: {show: 'show', approved: '1'}
    }).done(function(response){
        $('#approvedPosts').html(response)
    })
}
function asyncRefresh(){
    updateTeam();
    updateMessagesTable();
    updateSubmissionTable();
    approvedPosts();
    updateEvents();
    updateCollab();
}
function addEvent(from){
    var tempCon = []
    from.children('form').children('#event_slides').children('.input-group').children('.form-control').each(function(num, elem){
        tempCon.push(elem.value.replaceAll(' ', ''))
    });
    var eveImages = tempCon.join();
    var eveName = from.children('form').children('.form-group').children('#event_name')[0].value.trim();
    var eveDesc = from.children('form').children('.form-group').children('#event_desc')[0].value.trim();
    var evePoster = from.children('form').children('.form-group').children('#event_poster')[0].value.trim();
    var eveContent = from.children('form').children('.form-group').children('#event_content')[0].value.trim();
    var eveFile = eveName.toLowerCase().replaceAll(' ', '_') + '_page.html';
    $.ajax({
        url: 'make_event.php',
        method: 'POST',
        data: {make: 'make',name: eveName,description: eveDesc,content: eveContent,fileName: eveFile,poster: evePoster,slides: eveImages}
    }).done(function(response){
        var alert_class = new String();
        if(response == 'Success') {
            alert_class = 'alert-success';
        } else {
            alert_class = 'alert-danger';
        }
        $('body').append('<div class="alert ' + alert_class + ' alert-dismissible fixed-bottom fade show" role="alert">' + response + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        updateEvents()
    })
}
function makeEvent(appendTo){
    $(appendTo).append('<form enctype="multipart/form-data"><div class="form-group"><input class="form-control" id="event_name" placeholder="Name of the event" type="text"></div><div class="form-group"><input class="form-control" id="event_desc" placeholder="Short description" type="text"></div><hr><div class="form-group"><input class="form-control" id="event_poster" placeholder="URL of poster for the event" type="text" onfocusout="gdriveURL($(this))"><small class="form-text text-muted">Google Drive links only.</small></div><div class="form-group"><textarea class="form-control" id="event_content" placeholder="Content for the event page" type="text"></textarea></div><div class="form-group text-center" id="event_slides"><label>Drive links of images for the slideshow in order</label><br><div class="input-group mb-3"><input type="text" class="form-control" onfocusout="gdriveURL($(this))"><div class="input-group-append"><button class="btn btn-outline-danger" type="button" onclick="removeSlidesInput($(this))"><i class="fa fa-close"></i></button></div></div><button class="btn btn-dark rounded-circle" onclick="addSlidesInput($(this))" type="button"><i class="fa fa-plus"></i></button></div></form>');
}
function gdriveURL(element){
    var newVal = element.val().replace('file/d/', 'uc?id=').replace('/view?usp=sharing', '').trim();
    element[0].value = newVal;
    if(!element.parent().hasClass('input-group')){
        element.parent().find('img').remove();
        element.parent().append('<img src="' + newVal + '" class="img-fluid">');
    }
}
function addCollab(from){
    var tempCon = []
    from.children('form').children('#collab_slides').children('.input-group').children('.form-control').each(function(num, elem){
        tempCon.push(elem.value.replaceAll(' ', ''))
    });
    var eveImages = tempCon.join();
    var eveName = from.children('form').children('.form-group').children('#collab_name')[0].value.trim();
    var eveDesc = from.children('form').children('.form-group').children('#collab_desc')[0].value.trim();
    var evePoster = from.children('form').children('.form-group').children('#collab_poster')[0].value.trim();
    $.ajax({
        url: 'make_collab.php',
        method: 'POST',
        data: {make: 'make',name: eveName,description: eveDesc,poster: evePoster,slides: eveImages}
    }).done(function(response){
        var alert_class = new String();
        if(response == 'Success') {
            alert_class = 'alert-success';
            updateSubmissionTable();
        } else {
            alert_class = 'alert-danger';
        }
        $('body').append('<div class="alert ' + alert_class + ' alert-dismissible fixed-bottom fade show" role="alert">' + response + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        updateCollab()
    })
}
function makeCollab(appendTo){
    $(appendTo).append('<form enctype="multipart/form-data"><div class="form-group"><input class="form-control" id="collab_name" placeholder="Name of the collaboration" type="text"></div><div class="form-group"><input class="form-control" id="collab_desc" placeholder="Short description" type="text"></div><hr><div class="form-group"><input class="form-control" id="collab_poster" placeholder="Main picture / logo" type="text" onfocusout="gdriveURL($(this))"><small class="form-text text-muted">Google Drive links only.</small></div><div class="form-group text-center" id="collab_slides"><label>Drive links of images for the slideshow in order</label><br><div class="input-group mb-3"><input type="text" class="form-control" onfocusout="gdriveURL($(this))"><div class="input-group-append"><button class="btn btn-outline-danger" type="button" onclick="removeEventSlidesInput($(this))"><i class="fa fa-close"></i></button></div></div><button class="btn btn-dark rounded-circle" onclick="addSlidesInput($(this))" type="button"><i class="fa fa-plus"></i></button></div></form>');
}
function addSlidesInput(element){
    element.before('<div class="input-group mb-3"><input type="text" class="form-control" onfocusout="gdriveURL($(this))"><div class="input-group-append"><button class="btn btn-outline-danger" type="button" onclick="removeSlidesInput($(this))"><i class="fa fa-close"></i></button></div></div>')
}
function removeSlidesInput(element){
    element.parents('.input-group').remove()
}
function saveChangesWeb(element){
    var elements = [];
    element.parents('.modal-footer').siblings('.modal-body').children('.table-responsive').children('.table').children('tr').each(function () {
        var var_name = $(this).children('td')[0].innerHTML;
        var var_value = $(this).children('td').children('.form-control').val();
        var temp = [var_name, var_value];
        elements.push(temp.join(':'));
    })
    var fileCon = ':root {' + elements.join(';') + ';}';
    if (elements.length > 0) {
        if (fileCon.search(/color/i) > 0) {
            webAesthPost('journal', fileCon);
        }
    } else {
        $('#console .modal-body .table').append('<tr><td>Please make sure you have selected a feature before saving changes</td></tr>')
    }
}
function webAssetsItems(value, appendTo){
    $(appendTo).children().remove();
    $.ajax({
        url: 'css_writer.php',
        method: 'POST',
        data: {show: 'show', item: value}
    }).done(function(response){
        $(appendTo).append('<textarea class="form-control web_assets_' + value.replaceAll(' ', '_') + '" style="height: 25rem">' + response + '</textarea><button class="btn btn-outline-success my-5" type="button" onclick="webAssetsPost($(this).prev())"><i class="fa fa-save"></i> Save Changes</button>');
    })
}
function webAssetsPost(element) {
    var value = element[0].classList[1].replace('web_assets_', '');
    var content = element[0].value;
    $.ajax({
        url: 'css_writer.php',
        method: 'POST',
        data: {write: 'write', item: value, contents: content}
    }).done(function(response){
        var alert_class = new String();
        if(response == 'Success') {
            alert_class = 'alert-success';
        } else {
            alert_class = 'alert-danger';
        }
        $('body').append('<div class="alert ' + alert_class + ' alert-dismissible fixed-bottom fade show" role="alert">' + response + '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    })
}
// jQuery Events
$('#refresh_messages').on('click', function(){
    updateMessagesTable()
});
$('#submissions_sort .btn').on('click', function(){
    var category = $(this)[0].innerHTML;
    if (category === "All") {
        dataVal = {show: 'show'}
    } else {
        dataVal = {show: 'show',categ: category};
    }
    updateSubmissionTable();
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
    asyncRefresh();
});
$('#web_aesth .btn-group button').each(function(){
    $(this).on('click', function(){
        var action = $(this)[0].textContent.trim().toLowerCase()
        if(action == 'colours'){
            webAesthItems('colors', '#web_aesth_items');
        } else if (action == 'fonts'){
            webAesthItems('font_var', '#web_aesth_items');
        }
    })
});
$('#web_assets .btn-group button').each(function(){
    $(this).on('click', function(){
        var action = $(this)[0].textContent.trim().toLowerCase()
        if(action == 'custom css'){
            webAssetsItems('custom', '#web_assets_items');
        } else if (action == 'fonts'){
            webAssetsItems('fonts', '#web_assets_items');
        } else if (action == 'images') {
            window.location.assign('web_assets.php')
        }
    })
});
$('#journal_editor button').each(function(){
    $(this).on('click', function(){
        var action = $(this)[0].textContent.trim().toLowerCase()
        if(action == 'colours') {
            $('#console').modal('show');
            $('#console .modal-body').append('<div class="table-responsive"><table class="table"></table></div>');
            $('#console .modal-footer').prepend('<button type="button" class="btn btn-success" onclick="saveChangesWeb($(this))"><i class="fa fa-save"></i></button>');
            webAesthItems('journal', '#console .modal-body .table');
        } else if (action == 'upload'){
            window.open('journal_editor.php');
        }
    })
});
$('#web_aesth .table tfoot button').each(function(){
    $(this).on('click', function(){
        var elements = [];
        $(this).parents('tfoot').siblings('tbody').children('tr').each(function(){
            var var_name = $(this).children('td')[0].innerHTML;
            var var_value = $(this).children('td').children('.form-control').val();
            var temp = [var_name, var_value];
            elements.push(temp.join(':'));
        })
        var fileCon = ':root {' + elements.join(';') + ';}';
        if (elements.length > 0) {
            if (fileCon.search(/color/i) > 0) {
                webAesthPost('colors', fileCon);
            } else {
                webAesthPost('font_var', fileCon);
            }
        } else {
            $('#web_aesth_items').append('<tr><td>Please make sure you have selected a feature before saving changes</td></tr>');
        }
    })
});
$('#add_event').on('click', function(){
    $('#console').modal('show');
    $('#console .modal-footer').prepend('<button type="button" class="btn btn-success" onclick="addEvent($(this).parent().prev())"><i class="fa fa-save"></i></button>');
    makeEvent('#console .modal-body');
})
$('#add_collab').on('click', function(){
    $('#console').modal('show');
    $('#console .modal-footer').prepend('<button type="button" class="btn btn-success" onclick="addCollab($(this).parent().prev())"><i class="fa fa-save"></i></button>');
    makeCollab('#console .modal-body');
})
$('#logOut_user').on('click', function(){
    $.ajax({
        url: 'header.php',
        method: 'POST',
        data: {request: 'exit'}
    }).done(function(){
        window.location.reload()
    });
})
// Run on open page
asyncRefresh();