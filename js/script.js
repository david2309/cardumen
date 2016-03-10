$('#scene').parallax();

$( document ).ready(function() {


 	/*========= SCROLL =========*/
	var scroll_num = $(window).scrollTop();
	var position_top;
	var scroll_actual = 0;
	//$('#burbuja').hide();

	$(window).scroll(function(){
        scroll_num = $(window).scrollTop();
        position_top = $('#burbuja').position().top;


        if (scroll_num <= scroll_actual) {
        	$('#burbuja').css('top', position_top + 10);
        	scroll_actual = scroll_num;
        }

        if (scroll_num > scroll_actual) {
        	$('#burbuja').css('top', position_top - 10);
        	scroll_actual = scroll_num;
        }

    });

	/*========= VIDEO =========*/
	$('#btn_verVideo').click(function(e){
            e.preventDefault();
            if ($('#slide_contentImagen').is(':visible')){
                $('#slide_contentImagen').hide();
                $('#slide_contentVideo').show();
                var myVideo = document.getElementById("videoSlide"); 
                if (myVideo.paused){
                    myVideo.play();
                };

            }
            else if($('#slide_contentVideo').is(':visible')){
                $('#slide_contentVideo').hide();
                $('#slide_contentImagen').show();
                var myVideo = document.getElementById("videoSlide"); 
                if (myVideo.played){
                    myVideo.pause();
                };
            }
            
        });

        $('#btn_verSlide').click(function(e){
            e.preventDefault();
            if ($('#slide_contentImagen').is(':visible')){
                $('#slide_contentImagen').hide();
                $('#slide_contentVideo').show();
                var myVideo = document.getElementById("videoSlide"); 
                if (myVideo.paused){
                    myVideo.play();
                };

            }
            else if($('#slide_contentVideo').is(':visible')){
                $('#slide_contentVideo').hide();
                $('#slide_contentImagen').show();
                var myVideo = document.getElementById("videoSlide"); 
                if (myVideo.played){
                    myVideo.pause();
                };
            }
            
        });

	
	/*========= SLIDER HEADER =========*/
	var slides_header = $(".slideItem_header").length;
	var active_slide_header;
	
	$(".slideItem_header.active").css("display","block");

	$('#btn_header_next').click(function () {
		active_slide_header = $(".slideItem_header.active").index();
		active_slide_header = active_slide_header - 2;
		var next_slide_header = active_slide_header+1;

		if(next_slide_header >= slides_header ){
			next_slide_header = 0;
		}

		$(".slideItem_header").fadeOut(300);
		$(".slideItem_header").removeClass("active");

		$(".slideItem_header").eq(next_slide_header).delay(300).fadeIn(300);
		$(".slideItem_header").eq(next_slide_header).addClass("active");
	});



	/*========= SLIDER LUGARES =========*/
	var slides_lugar = $(".playa_slide").length;
	var active_slide_lugar;
	
	$(".playa_slide.active").css("display","block");

	$('#btn_playaSlide_next').click(function () {
		active_slide_lugar = $(".playa_slide.active").index();
		active_slide_lugar = active_slide_lugar - 2;
		var next_slide_lugar = active_slide_lugar+1;

		if(next_slide_lugar >= slides_lugar ){
			next_slide_lugar = 0;
		}

		$(".playa_slide").fadeOut(200);
		$(".playa_slide").removeClass("active");

		$(".playa_slide").eq(next_slide_lugar).delay(200).fadeIn(200);
		$(".playa_slide").eq(next_slide_lugar).addClass("active");
	});


	/*========= RESERVACIONES =========*/
	$('#btnTicket').click(function () {

		if ($('.reservacion').hasClass("open")) {
			$('.reservacion').css("width","4%");
			$('.reservacion').removeClass("open");
			$('.reservacion_item').css("display","none");
		}else{
			$('.reservacion').css("width","90%");
			$('.reservacion_item').css("display","inline-block");
			$('.reservacion').addClass("open");
		}
		

		
	});

	$('#goto_home').click(function(a){
		a.preventDefault();
		a.stopImmediatePropagation();

		$("html, body").stop().animate({ scrollTop: $('.main').offset().top -72}, 1000, 'easeInOutCubic');
	});


});