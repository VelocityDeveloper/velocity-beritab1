jQuery(function($) {
    $(document).on('click','.floating-media .dismiss-media',function(){
        let pr = $(this).closest('.floating-media');
        pr.hide();
    });

    $( ".tombols" ).click(function() {
        $("#searchform").toggle();
        $(".tombols").toggleClass("collapsed");
        $(".tombols .search-symbol, .tombols .close-symbol").toggleClass("d-none");
    });

    function positionFloatingMedia(){
        let wcon = $('.floating-media').data('container');
        let hhed = $('#page > header').height();
        let nmar = wcon/2;
        $('.floating-media[data-pos="left"]').css({"margin-right": nmar+"px", "top": hhed+"px"});
        $('.floating-media[data-pos="right"]').css({"margin-left": nmar+"px", "top": hhed+"px"});
    }
    positionFloatingMedia();

    $(window).on('resize', function(){
        positionFloatingMedia();
    });

    $(window).scroll(function() {    
        var scroll = $(window).scrollTop();

        if (scroll >= 100) {
            $(".header-position").addClass("issticky");
        } else {
            $(".header-position").removeClass("issticky");
        }
    });

    $('.carousel-posts').slick({
        dots: true,
        infinite: true,
        autoplay:true,
        speed: 3000,
        dots:false,
        slidesToShow: 3,
        slidesToScroll: 3,
        arrows: true,
        prevArrow: '<button type="button" class="slick-prev" aria-label="Previous"><svg class="bg-white rounded-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0m4 0a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/></svg></button>',
        nextArrow: '<button type="button" class="slick-next" aria-label="Next"><svg class="bg-white rounded-circle" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 0 0 .708L9.293 8l-5.647 5.646a.5.5 0 0 0 .708.708l6-6a.5.5 0 0 0 0-.708l-6-6a.5.5 0 0 0-.708 0m4 0a.5.5 0 0 0 0 .708L13.293 8l-5.647 5.646a.5.5 0 0 0 .708.708l6-6a.5.5 0 0 0 0-.708l-6-6a.5.5 0 0 0-.708 0"/></svg></button>',
        responsive: [
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2
            }
          }
        ]
    });
});
