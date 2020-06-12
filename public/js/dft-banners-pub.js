jQuery(function($) {
    $('.dft-banner').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        fade: true,
        speed: 500,
        autoplay: true,
        autoplaySpeed: 6000,
        arrows: true,
        infinite: true,
        prevArrow: '<button class="slick-prev"><img src="' + DRIF_BANNER_ARROW + '" /></button>',
        nextArrow: '<button class="slick-next"><img src="' + DRIF_BANNER_ARROW + '" /></button>',
        responsive: [
          {
            breakpoint: 1000,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              infinite: true,
              dots: true,
              arrows: false,
            }
          }
        ]      
    });
})