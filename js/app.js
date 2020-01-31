$(function() {
    /*Nav Toggle*/
    let nav = $("#nav-in");
    let head = $("#head-navi-wrap");
    $("#navToggle").on("click", function(event) {
        nav.toggleClass("navigation__show");
        head.toggleClass("header__navi-on-click")
    });

});
