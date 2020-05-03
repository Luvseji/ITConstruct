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
    /*Validator's Form in Contacts*/
    $("#feedback__form").on("submit", function (event) {
        var fields = $("#feedback__form .field-empty-check");
        var errors = $("#feedback__form .error");
        var hasErrors = false;
        fields.removeClass("border-error");
        errors.remove();
        $.each(fields, function (i) {
            if (!fields[i].value) {
                var field = fields[i];
                var label = $(field).siblings("label").text();
                $(field).addClass("border-error");
                $("<span>", {
                    class: "error",
                    text: "Поле «" + label + "» должно быть заполнено"
                }).insertAfter(field);
                hasErrors = true;
            }
        })
        if (hasErrors)
            event.preventDefault();
    });
});
