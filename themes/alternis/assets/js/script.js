(function ($, window, document, undefined) {
  "use strict";

  new Swiper(".alternis-swiper-post .swiper", {
    centeredSlides: true,
    grabCursor: true,
    loop: true,
    autoplay: {
      delay: 3000,
    },
    speed: 1000,
    breakpoints: {
      1024: {
        slidesPerView: 2,
        loopedSlides: 2,
        spaceBetween: 30,
      },
      768: {
        slidesPerView: 1,
        loopedSlides: 1,
        spaceBetween: 10,
      },
      675: {
        slidesPerView: 1,
        loopedSlides: 1,
        spaceBetween: 20,
      },
    },
  });

  new Swiper(".alternis-footer__inst-wrap .swiper", {
    breakpoints: {
      1199: {
        slidesPerView: 7,
      },
      768: {
        slidesPerView: 4,
      },
      576: {
        slidesPerView: 3,
      },
      320: {
        slidesPerView: 2,
        spaceBetween: 10,
      },
    },
  });

  $("#alternis-search-btn").click(function () {
    const popup = $("#alternis-search-popup");
    const overlay = $("#alternis-overlay");

    popup.toggleClass("active");
    overlay.toggleClass("active");
  });

  $("#alternis-overlay").click(function () {
    const popup = $("#alternis-search-popup");
    const th = $(this);

    if (th.hasClass("active")) {
      th.removeClass("active");
      popup.removeClass("active");
    }
  });

  $(window).on("load scroll resize", function () {
    const th = $(this);
    const width = th.width();
    const spaceTop = th.scrollTop();

    const header = $("#alternis-header");
    const headerHeight = header.height();

    if (spaceTop > headerHeight - 40) {
      header.css("height", headerHeight);
      header.addClass("header-sticky");
    } else {
      header.removeClass("header-sticky");
    }

    if (spaceTop == 0) {
      header.removeAttr("style");
    }
  });
})(jQuery, window, document);
