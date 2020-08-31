var vWidth = $(window).width(), vHeight = $(window).height();
$('.full').css({"min-height": vHeight, "max-width": vWidth});
var currentyear = new Date;
$('footer span').html('&copy;' + currentyear.getFullYear() + ' Forbidden Verses');
$(window).scroll(function () {
    var i = $(window).scrollTop();
    if (i <= 700) {
        $('#mainBanner').css({"opacity": 1 - i / 900, "filter": "blur(" + i/250 + "px)"});
        $('#journal_intro').css({"transform": "translateY(" + i/5.5 + "px)", "opacity": 1 - i / 500});
    } else {
        $('#journal_intro').css({"transform": "translateY(700px)","opacity": 1 - i});
    }
});
$('#attachment').on('click', function(event){
    event.preventDefault();
    window.open("upload.php");
});
$('.custom-upload').on('click', function(){
    $('#attachment').trigger('click');
});
$('#submit').on('click', function(e){
    e.preventDefault();
})
function submitForm(destination){
    $.ajax({
        url: "lib/" + destination + ".php",
        method: "POST",
        data: $('#' + destination + '_form').serialize()
    }).done(function(response){
        if (destination === "submissions"){
            window.localStorage.removeItem('attachment_url');
        }
        if(response === '<div class="alert alert-success alert-dismissible fade show mt-5" role="alert">Form submitted!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'){
            $('#' + destination + '_form')[0].reset();
        }
        $('fieldset').append(response);
    })
}
$('#submissions_form #submit').on('click', function(){
    $('input[name="file_location"]').attr('value', window.localStorage.getItem('attachment_url'));
    submitForm('submissions');
})
$('#contact_form #submit').on('click', function(){
    submitForm('contact');
})
function decryptData(data) {
    return window.atob(window.atob(data));
}
function scrollToMember(){
    $('html, body').delay(400).animate({
        scrollTop: $('#members_tab').offset().top
    }, 1000);
}
function updateCollabs(){
    $.getJSON('lib/collabs.json', function(data){
        $.each(data, function (key, val) {
            var objKey = key;
            $.each(val, function (key, val) {
                // take a key and keep appending to .collabs
            })
        })
    })
}
function updateTeam(){
    $.getJSON('lib/team.json', function(data){
        $.each(data, function(key, val){
            var objKey = key;
            var objKeyTrim = String(objKey).replace('=', '').replace('=', '');
            $.each(val, function (key, val) {
                $('.members').append('<a class="card m-2" id="' + objKeyTrim + '-tab" data-toggle="tab" href="#' + objKeyTrim + '" role="tab" aria-controls="' + objKeyTrim + '" aria-selected="false" onclick="scrollToMember()"><div class="card-body"><h2 class="card-title">' + decryptData(objKey) + '</h2></div></a>');
                $('#members_tab').append('<div class="tab-pane container p-5 fade rounded-pill" id="' + objKeyTrim + '" role="tabpanel" aria-labelledby="' + objKeyTrim + '-tab"><div class="row"><div class="col-md-3 d-flex"><img src="' + val[1] + '" alt="' + decryptData(objKey) + '" class="img-fluid rounded-circle align-self-center"></div><div class="col-md-7 text-center"><h2 class="mt-5">' + decryptData(objKey) + '</h2><h3>' + decryptData(key) + '</h3><p class="p-3">' + decryptData(val[0]) + '</p></div></div></div>');
            })
        })
    });
}
updateTeam();