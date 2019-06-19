/*var x = document.getElementById("navb");
$(document).ready(function() {
	$('#fullpage').fullpage({
        menu: '#navb',
        scrollOverflow: true,
        recordHistory: false,
        sectionsColor: ['#1D1F1D', '#101A26', '#18272B', '#222'],
        afterRender: 
        },
	});
});*/

window.onload = function(){
    $(".loader").fadeOut("slow");
    setTimeout(function(){
        $(".mainbod").css('opacity', '1');
        $(".loader").addClass("none");
    }, 1000);
}
var vHeight = $(window).height(), vWidth = $(window).width(), cover = $('.full'), halfvh = vHeight/2;
cover.css({"height":vHeight,"width":vWidth,});
$('#intro').css({"padding-top": halfvh,});
$(document).on('scroll', function() {
    if( $(this).scrollTop() >= $('#about').position().top ){
        $(".navbar").removeClass("hide");
    } else {
        $(".navbar").addClass("hide");
    }
});