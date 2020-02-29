$(function () {
    /*Burger menu*/
    let nav = $("#nav-in");
    let head = $("#head-navi-wrap");
    $("#navToggle").on("click", function (event) {
        nav.toggleClass("navigation__show");
        head.toggleClass("header__navi-on-click")
        $(".sub-navigation__inner").removeClass("sub-navigation__show");
        $(".sub-navigation__link").removeClass("sub-navigation__bg");
        $(".sub-navigation").removeClass("sub-navigation__move");
    });
    /*Sub-navigation*/
    $(".sub-navigation__link").on("click", function (event) {
        $(this).next().toggleClass("sub-navigation__show");
        $(this).toggleClass("sub-navigation__bg");
        $(this).parent().toggleClass("sub-navigation__move");
    });
    /*Form's checker*/
    $(".authorization-field").on('blur', function () {
        var $this = $(this),
            val = $this.val();

        if (val.length >= 1) {
            $(this).addClass("authorization-field__filled");
        } else {
            $(this).removeClass("authorization-field__filled");
        }
    });
});
