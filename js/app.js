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
    $(".authorization-field").on("blur", function () {
        var $this = $(this),
            val = $this.val();
        if (val.length >= 1) {
            $(this).addClass("authorization-field__filled");
        } else {
            $(this).removeClass("authorization-field__filled");
        }
    });
    /*Count display*/
    $(".counter__number-display").on("input", function () {
        if ($(this).val() > 99)
            $(this).val(99);
        if ($(this).val() < 1)
            $(this).val(1);
    });
    /*Count*/
    $(".counter__minus").click(function () {
        var $input = $(this).siblings("input");
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $(".counter__plus").click(function () {
        var $input = $(this).siblings("input");
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;
    });
    /*Validator's Form in Header*/
    $("#header__form").on("submit", function (event) {
        var fields = $("#header__form .field-empty-check");
        var hasErrors = false;
        fields.removeClass("border-error");
        $.each(fields, function (i) {
            if (!fields[i].value) {
                var field = fields[i];
                $(field).addClass("border-error");
                hasErrors = true;
            }
        })
        if (hasErrors)
            event.preventDefault();
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
    /*Validator's Form in Registration*/
    $("#registration__form").on('submit', function (event) {
        var fields = $("#registration__form .field-empty-check");
        var errors = $("#registration__form .error");
        var password = $("#registration__form .password");
        var passwordConfirmation = $("#registration__form .password-check");
        var email = $("#registration__form .email");
        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
        var hasErrors = false;
        fields.removeClass("border-error");
        errors.remove();
        passwordConfirmation.removeClass("border-error")
        email.removeClass("border-error")
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
        if (email !== null) {
            if ((!pattern.test((email.val()))) && ((email.val()))) {
                $(email).addClass("border-error");
                $("<span>", {
                    class: "error",
                    text: "Неверный адрес электронной почты"
                }).insertAfter(email);
                hasErrors = true;
            }
        }
        if (password !== null) {
            if (((password.val()) !== (passwordConfirmation.val())) && ((passwordConfirmation.val()) !== "")) {
                passwordConfirmation.addClass("border-error");
                $("<span>", {
                    class: "error",
                    text: "Пароли должны совпадать"
                }).insertAfter(passwordConfirmation);
                hasErrors = true;
            }
        }
        if (hasErrors)
            event.preventDefault();
    });
});
