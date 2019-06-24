 $(document).ready(function(){
         $(".lds-ellipsis").fadeOut("slow");
         $(".loader").addClass("uprise");
         setTimeout(function(){
             $(".mainbod").removeClass("hide");
             $(".loader").addClass("hide");
         }, 1000);
 });

// height - width index

var vHeight = $(window).height(), vWidth = $(window).width(), cover = $('.full'), halfvh = vHeight/2, thirdvh = vHeight/3, halfvw = vWidth/2.5;
$('.introheading').css({"padding-top": halfvh,});
$('#ldiv').css({"padding-top": halfvh,});
$('.lds-css').css({"padding-left": halfvw,});
$("#timer").css({"width": vWidth/2});
cover.css({"min-height":vHeight,"max-width":vWidth,});
$(document).ready(function(){
    if($(window).width() < 1000) {
        $("#timer").css({"width": "100%"});
        $(".nav").addClass("flex-column");
        $(".date").removeClass("text-right");
        $(".date").addClass("text-center");
    }
});

// loader

// section scroll functions

$(document).on('scroll', function() {
    if($(this).scrollTop() >= halfvh){
        $(".navbar").removeClass("hide");
        $(".navbar").css({"background-color": "rgba(0,0,0,0.3)"});
        $(".navbar a.nav-link.inta").addClass("active");
    } else {
        $(".navbar").addClass("hide");
    }
});
$(document).on('scroll', function() {
    if( $(this).scrollTop() >= $('#about').position().top ){
        $(".navbar").css({"background-color": "rgba(114, 161, 166, .4)"});
        $(".navbar .inta").removeClass("active");
    }
});
$(document).on('scroll', function() {
    if( $(this).scrollTop() >= $('#forms').position().top ){
        $(".navbar").css({"background-color": "rgba(97, 140, 112, .4)"});
    }
});
$(document).on('scroll', function() {
    if( $(this).scrollTop() >= $('#gal').position().top ){
        $(".navbar").css({"background-color": "rgba(85, 130, 134, .4)"});
    }
});
$(document).on('scroll', function() {
    if( $(this).scrollTop() >= $('#con').position().top ){
        $(".navbar").css({"background-color": "rgba(125, 166, 106, .4)"});
    }
});

/// intro animations
$(document).ready(function(){ 
    $(window).scroll(function(){ 
        var i = 0;
        i += $(window).scrollTop() / 2;
        $(".introheading").css({"transform": "translateY("+ i +"px)", "opacity": 1 - $(window).scrollTop() / 1000});
    })
});
/// end

// smooth scroll

$(document).ready(function (){
    $(".navbtn").click(function (){
        $('html, body').animate({
            scrollTop: $("#about").offset().top
        }, 1000);
    });
});
$(document).ready(function (){
    $(".ferrybtn").click(function (){
        $('html, body').animate({
            scrollTop: $("#intro").offset().top
        }, 1000);
    });
});
$(document).ready(function (){
    $(".inta").click(function (){
        $('html, body').animate({
            scrollTop: $("#intro").offset().top
        }, 1000);
    });
});
$(document).ready(function (){
    $(".aboa").click(function (){
        $('html, body').animate({
            scrollTop: $("#about").offset().top
        }, 1000);
    });
});
$(document).ready(function (){
    $(".fora").click(function (){
        $('html, body').animate({
            scrollTop: $("#forms").offset().top
        }, 1000);
    });
});
$(document).ready(function (){
    $(".gala").click(function (){
        $('html, body').animate({
            scrollTop: $("#gal").offset().top
        }, 1000);
    });
});
$(document).ready(function (){
    $(".cona").click(function (){
        $('html, body').animate({
            scrollTop: $("#con").offset().top
        }, 1000);
    });
});

// countdown 
var countDownDate = new Date("Jun 30, 2019 17:00:00");
var x = setInterval(function() {
    var now = new Date().getTime();
    var distance = countDownDate - now;
    var days = Math.floor((distance % (1000 * 60 * 60 * 24 * 31)) / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    document.getElementById("timer").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s "; 
    if (distance < 0) {
        clearInterval(x);
        document.getElementById("timer").innerHTML = "Let's Roll ;)";
    }
}, 1000);
setInterval(function(){
    $("#timer").css('background-color', 'rgba(0, 0, 0, .3)');
    setTimeout(function(){
        $("#timer").css('background-color', 'rgba(0, 0, 0, .2)');
    }, 500)
}, 1000);