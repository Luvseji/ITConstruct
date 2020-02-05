$(function() {
    /*Nav Toggle*/
    let nav = $("#nav-in");
    let head = $("#head-navi-wrap");
    $("#navToggle").on("click", function(event) {
        nav.toggleClass("navigation__show");
        head.toggleClass("header__navi-on-click")
        $("#catalog").removeClass("catalog__show");
        $("#head-navi-wrap").removeClass("header__catlog-on-click");
        $("#nav-cat").removeClass("catalog-bg");
        $("#navigation__item-2").removeClass("cat-margin");
    });

    let cat = $("#catalog");
    $("#nav-cat").on("click", function(event) {
        cat.toggleClass("catalog__show");
        $("#head-navi-wrap").toggleClass("header__catlog-on-click");
        $("#nav-cat").toggleClass("catalog-bg");
        $("#navigation__item-2").toggleClass("cat-margin");
    });

    /*Category border become green when hover*/
    $("#cat-title-1").on("mouseover mouseout", function(event) {
        $("#cat-border-1").toggleClass("category__image_border-green");
    });
    $("#cat-title-2").on("mouseover mouseout", function(event) {
        $("#cat-border-2").toggleClass("category__image_border-green");
    });
    $("#cat-title-3").on("mouseover mouseout", function(event) {
        $("#cat-border-3").toggleClass("category__image_border-green");
    });
    $("#cat-title-4").on("mouseover mouseout", function(event) {
        $("#cat-border-4").toggleClass("category__image_border-green");
    });
    $("#cat-title-5").on("mouseover mouseout", function(event) {
        $("#cat-border-5").toggleClass("category__image_border-green");
    });
    $("#cat-title-6").on("mouseover mouseout", function(event) {
        $("#cat-border-6").toggleClass("category__image_border-green");
    });
    $("#cat-title-7").on("mouseover mouseout", function(event) {
        $("#cat-border-7").toggleClass("category__image_border-green");
    });
    $("#cat-title-8").on("mouseover mouseout", function(event) {
        $("#cat-border-8").toggleClass("category__image_border-green");
    });
});
