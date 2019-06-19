var x = document.getElementById("navb");
$(document).ready(function() {
	$('#fullpage').fullpage({
        menu: '#navb',
        scrollOverflow: true,
        recordHistory: false,
        sectionsColor: ['#1D1F1D', '#101A26', '#18272B', '#222'],
        afterRender: function(){
            $(".loader").fadeOut("slow");
            setTimeout(function(){
                $(".mainbod").css('opacity', '1');
                $(".loader").addClass("none");
            }, 1000);
        },
	});
});