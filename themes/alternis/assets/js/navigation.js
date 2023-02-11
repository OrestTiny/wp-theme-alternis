(function ($, window, document, undefined) {
  $("#alternis-header__main-burger").is(function () {
    const th = $(this);
    const btn = $(".burger-btn", th);
    const overlay = $("#burger-overlay", th);

    btn.click(function () {
      th.toggleClass("burger-open");
    });

    overlay.click(function () {
      th.toggleClass("burger-open");
    });
  });

  const burgerBuild = () => {
    const bgLogo = $("#burger-menu-logo");
    const bgMain = $("#burger-menu-main");
    const bgSocial = $("#burger-menu-social");

    $(".alternis-header__main-logo")
      .clone()
      .removeAttr("class")
      .appendTo(bgLogo);
    $(".alternis-header__main-menu .menu").each(function () {
      const th = $(this);
      th.clone().appendTo(bgMain);
    });
    $(".alternis-header__top-social")
      .clone()
      .removeAttr("class")
      .appendTo(bgSocial);
  };
  burgerBuild();

  $(window).on("load resize orientationchange", function () {
    const width = $(window).width();

    if (width > 992) {
      if ($("#alternis-header__main-burger").hasClass("burger-open")) {
        $("#alternis-header__main-burger").removeClass("burger-open");
      }
    }
  });
})(jQuery, window, document);
