//particlesJS("particles-js", {
//    "particles": {
//        "number": {
//            "value": 80,
//            "density": {
//                "enable": true,
//                "value_area": 1800
//            }
//        },
//        "color": {
//            "value": "#d7bb3b"
//        },
//        "shape": {
//            "type": "circle",
//            "stroke": {
//                "width": 0,
//                "color": "#000000"
//            },
//            "polygon": {
//                "nb_sides": 5
//            },
//            "image": {
//                "src": "img/github.svg",
//                "width": 100,
//                "height": 100
//            }
//        },
//        "opacity": {
//            "value": 0.5,
//            "random": false,
//            "anim": {
//                "enable": false,
//                "speed": 1,
//                "opacity_min": 0.1,
//                "sync": false
//            }
//        },
//        "size": {
//            "value": 2,
//            "random": true,
//            "anim": {
//                "enable": false,
//                "speed": 40,
//                "size_min": 0.1,
//                "sync": false
//            }
//        },
//        "line_linked": {
//            "enable": true,
//            "distance": 200,
//            "color": "#d7bb3b",
//            "opacity": 0.1,
//            "width": 1
//        },
//        "move": {
//            "enable": true,
//            "speed": 10,
//            "direction": "none",
//            "random": false,
//            "straight": false,
//            "out_mode": "out",
//            "bounce": false,
//            "attract": {
//                "enable": false,
//                "rotateX": 600,
//                "rotateY": 1200
//            }
//        }
//    },
//    "interactivity": {
//        "detect_on": "canvas",
//        "events": {
//            "onhover": {
//                "enable": true,
//                "mode": "grab"
//            },
//            "onclick": {
//                "enable": true,
//                "mode": "push"
//            },
//            "resize": true
//        },
//        "modes": {
//            "grab": {
//                "distance": 400,
//                "line_linked": {
//                    "opacity": 0.4
//                }
//            },
//            "bubble": {
//                "distance": 400,
//                "size": 40,
//                "duration": 2,
//                "opacity": 8,
//                "speed": 3
//            },
//            "repulse": {
//                "distance": 200,
//                "duration": 0.4
//            },
//            "push": {
//                "particles_nb": 4
//            },
//            "remove": {
//                "particles_nb": 2
//            }
//        }
//    },
//    "retina_detect": true
//});

if($('#journal_banner').css('background-image') == 'none'){
    $('#journal_banner').addClass('d-none');
}
$.ajax({
    url: 'lib/journal.php',
    method: 'POST',
    data: {show: 'show'}
}).done(function (response) {
    if (response == "Coming Soon"){
        $('#documentRender').addClass('d-flex justify-content-center align-items-center').append('<h1 class="display-4">' + response + '</h1>');
    } else {
        if (!window.navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
            var pdfjsLib = window['pdfjs-dist/build/pdf'];
            pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://mozilla.github.io/pdf.js/build/pdf.worker.js';
            var loadingPDFDoc = pdfjsLib.getDocument(response);
            loadingPDFDoc.promise.then(function (doc) {
                for (var i = 1; i <= doc._pdfInfo.numPages; i++) {
                    $("#documentRender").append('<canvas id="' + i + '" class="img-fluid"></canvas>');
                    canvas = document.getElementById(i);
                    renderPage(i, canvas);
                };

                function renderPage(pageNumber, canvas) {
                    doc.getPage(pageNumber).then(function (page) {
                        var viewport;
                        if ($(window).width() < 400) {
                            viewport = page.getViewport({
                                scale: .3
                            });
                        } else if ($(window).width() < 600) {
                            viewport = page.getViewport({
                                scale: .5
                            });
                        } else {
                            viewport = page.getViewport({
                                scale: 1
                            });
                        }
                        canvas.height = viewport.height;
                        canvas.width = viewport.width;
                        var ctx = canvas.getContext("2d");
                        ctx.font = "30px Futura";
                        ctx.fillStyle = "#fff";
                        ctx.textAlign = 'center';
                        ctx.fillText("Loading...", canvas.width/2, canvas.height/2);
                        var renderTask = page.render({
                            canvasContext: canvas.getContext('2d'),
                            viewport: viewport
                        })
    //                    renderTask.promise.then(function(e){
    //                        console.log('done');
    //                    });
                    });
                };
            });
        } else {
            $('#documentRender').addClass('d-flex justify-content-center align-items-center').html('<h3  style="color: #ccc">Sorry! The view is currently unavailable for your device.</h3>')
        }
        $('#documentRender').after('<div class="d-flex justify-content-center w-100 py-3"><a class="btn btnCustom" href="' + response + '"><i class="fa fa-download"></i> Download Journal</a></div>');
    }
})