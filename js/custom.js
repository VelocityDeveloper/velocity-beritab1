jQuery(function($) {
    $(document).on('click','.iklanfloating .close-iklan',function(){
        let pr = $(this).closest('.iklanfloating');
        pr.hide();
    });

    $( ".tombols" ).click(function() {
        $("#searchform").toggle();
        $(".tombols").toggleClass( "collapsed" );
    });

    function iklan_position(){
        let wcon = $('.iklanfloating').data('container');
        let hhed = $('#page > header').height();
        let nmar = wcon/2;
        $('.iklanfloating[data-pos="left"]').css({"margin-right": nmar+"px", "top": hhed+"px"});
        $('.iklanfloating[data-pos="right"]').css({"margin-left": nmar+"px", "top": hhed+"px"});
        console.log(hhed);
    }
    iklan_position();

    $(window).on('resize', function(){
        iklan_position();
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
        prevArrow: '<div class="slick-prev"><i class="fa fa-angle-double-left  bg-white rounded rounded-5" aria-hidden="true"></i></div>',
        nextArrow: '<div class="slick-next"><i class="fa fa-angle-double-right  bg-white rounded rounded-5" aria-hidden="true"></i></div>',
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