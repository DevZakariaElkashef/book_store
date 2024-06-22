$(document).ready(function () {
  var currentDir = $("a").css("direction");
  console.log(currentDir);

  if ($(".horizintal_slider").length) {
    $(".horizintal_slider").slick({
      // rtl: currentDir=="rtl" ? true : false
      slidesToShow: 3.3,
      slidesToScroll: 1,
      vertical: true,
      verticalSwiping: true,
      dots: false,
      arrows: false,
      focusOnSelect: true,
      infinite: false,
      asNavFor: '.single_slider',
      responsive: [
        {
          breakpoint: 1920,
          settings: {
            slidesToShow: 2.3,
          },
        },
      ]
    });

    $(".single_slider").slick({
      // rtl: currentDir=="rtl" ? true : false,
      fade: true,
      dots: false,
      arrows: false,
      asNavFor: '.horizintal_slider',
    });
  }

  if ($(".related_product_slider").length) {
    $(".related_product_slider").slick({
      slidesToShow: 3.8,
      arrows: false,
      dots: true,
      slidesToScroll: 1,
      infinite: false,
      rtl: currentDir == "rtl" ? true : false,
      responsive: [
        {
          breakpoint: 1800,
          settings: {
            slidesToShow: 3.3,
          },
        },
        {
          breakpoint: 1100,
          settings: {
            slidesToShow: 2.2,
            slidesToScroll: 1,
            infinite: false,
            dots: false,
          },
        },
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 1.5,
          },
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 1.1,
          },
        },
      ],
    });
  }

  if ($(".buy_basket").length) {
    $(".input-number-increment").on("click", function () {
      let inVal = $(this).parent().find(".numinput").val();
      console.log(inVal);
      inVal = parseInt(inVal);
      inVal += 1;
      $(this).parent().find(".numinput").val(inVal);
    });

    $(".input-number-decrement").on("click", function () {
      let inVal = $(this).parent().find(".numinput").val();
      console.log(inVal);
      inVal = parseInt(inVal);
      inVal -= 1;
      if (inVal <= 0) {
        inVal = 0;
      }
      $(this).parent().find(".numinput").val(inVal);
    });
  }

  AOS.init();
});

$(window).on("load", function () {
  // $("html").removeClass("splash-active");
  var currentDir = $("a").css("direction");
  $(".splashscreen").addClass("splashscreen_none");
  new Mmenu("#menu", {
    offCanvas: {
      slidingSubmenus: false,
      position: currentDir == "rtl" ? "right-front" : "left-front",
    },
    theme: "light",
    counters: {
      add: true,
    },
  });
  $(".mm-navbar__title").text("القائمة");
});

$(window).on("load", function () {
  $("html").removeClass("splash-active");
  $(".splach").addClass("splashscreen-none");
});
