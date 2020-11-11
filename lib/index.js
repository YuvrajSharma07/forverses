$('#loader').modal({
    backdrop: 'static',
    keyboard: false
})
$('#loader').modal('show');
window.onload = function(){
    setTimeout(function(){
        $('#loader').modal('hide');
    }, 1000)
}
var vWidth = $(window).width(), vHeight = $(window).height();
$('.full').css({"min-height": vHeight, "max-width": vWidth});
var currentyear = new Date;
$('footer span').html('&copy;' + currentyear.getFullYear() + ' Forbidden Verses');
if (window.navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
    $('div').each(function () {
        if ($(this).css('background-attachment').match(/(fixed)/)) {
            $(this).css('background-attachment', 'scroll')
        }
    })
}
$(window).scroll(function () {
    if(!window.navigator.userAgent.match(/(iPod|iPhone|iPad)/)){
    }
        var i = $(window).scrollTop();
        if (i <= 700) {
//            $('#mainBanner').css({"opacity": 1 - i / 900,"filter": "blur(" + i / 250 + "px)"});
//            $('#journal_intro').css({"transform": "translateY(" + i/5.5 + "px)", "opacity": 1 - i / 500});
            $('#event_title .card-img-top').css({"filter": "brightness(" + (1 - i / 1200) + ")"});
        } else {
//            $('#journal_intro').css({"transform": "translateY(700px)","opacity": 1 - i});
        }
    if ($(this).scrollTop() > 10) {
        $('.navbar').addClass('scrolled');
    } else {
        $('.navbar').removeClass('scrolled');
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
function fromBinary(binary) {
    const bytes = new Uint8Array(binary.length);
    for (let i = 0; i < bytes.length; i++) {
        bytes[i] = binary.charCodeAt(i);
    }
    return String.fromCharCode(...new Uint16Array(bytes.buffer));
}
function decryptData(data, extra) {
    if(extra) {
        return fromBinary(window.atob(window.atob(data)));
    }
    return window.atob(window.atob(data));
}
function scrollToMember(){
    $('html, body').delay(400).animate({
        scrollTop: $('#members_tab').offset().top
    }, 1000);
}
function updateCollabs(){
    $.ajax({
        url: 'lib/collabs.php',
        method: 'POST',
        data: {show: 'show'}
    }).done(function(response){
        $('#collab_slider .carousel-inner').html(response);
        
        $('#collab_slider .carousel-item').first().addClass('active');
    })
}
function updateTeam(){
    $.getJSON('lib/team.json', function(data){
        $.each(data, function(key, val){
            var objKey = key;
            var objKeyTrim = String(objKey).replace(/=/g, '');
            $.each(val, function (key, val) {
                $('.members').append('<a class="card m-2" style="--this-color: ' + val[2] + '" id="' + objKeyTrim + '-tab" data-toggle="tab" href="#' + objKeyTrim + '" role="tab" aria-controls="' + objKeyTrim + '" aria-selected="false" onclick="scrollToMember()"><div class="card-body"><h2 class="card-title">' + decryptData(objKey, false) + '</h2></div></a>');
                $('#members_tab').append('<div class="tab-pane container p-5 fade rounded-pill" id="' + objKeyTrim + '" role="tabpanel" aria-labelledby="' + objKeyTrim + '-tab"><div class="row"><div class="col-md-3 d-flex"><img src="' + val[1] + '" alt="' + decryptData(objKey, false) + '" class="img-fluid rounded-circle align-self-center"></div><div class="col-md-7 text-center"><h2 class="mt-5">' + decryptData(objKey, false) + '</h2><h3>' + decryptData(key, false) + '</h3><p class="p-3">' + decryptData(val[0], true) + '</p></div></div></div>');
            })
        })
    });
}
function updateEvents(){
    $.ajax({
        url: 'lib/events.php',
        method: 'POST',
        data: {show: 'show'}
    }).done(function(response){
        $('#eventsDisplay').append(response);
    })
}
function showCollabSlides(element){
    $.ajax({
        url: "lib/collabs.php",
        method: 'POST',
        data: {slides: 'slides', item: element[0].id.replace('collab_', '')}
    }).done(function(response){
        $('#console').modal('show');
        $('#console .carousel-inner').append(response);
        $('#console .carousel-item').first().addClass('active');
    });
}

function updateMainpageAssets(items) {
    items.forEach(function(elem, num){
        $.ajax({
            url: 'lib/assets.php',
            method: 'POST',
            data: {show: 'show', item: elem}
        }).done(function(response) {
            var appendTo = $('#' + elem);
            if (elem == 'main_banner') {
                appendTo.css({'background-image': 'url(lib/' + response + ')'});
            } else {
                appendTo.children('img')[0].src = 'lib/' + response;
            }
        })
    })
}
$('#console').on('hide.bs.modal', function(){
    $('#console .carousel-inner').empty();
});