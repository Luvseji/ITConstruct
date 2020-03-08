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

    var form = document.querySelector('.form-ch')
    var fields = form.querySelectorAll('.field-empty-check')
    var validateBtn = form.querySelector('.submit-ch')
    var password = form.querySelector('.password')
    var passwordConfirmation = form.querySelector('.password-check')
    var email = form.querySelector('.email')

    form.addEventListener('submit', function (event) {
        event.preventDefault()

        var errors = form.querySelectorAll('.error')
        for (var i = 0; i < errors.length; i++) {
            errors[i].remove()
            fields[i].classList.remove("border-error")
            if (passwordConfirmation !== null)
                passwordConfirmation.classList.remove("border-error")
            if (email !== null)
            email.classList.remove("border-error")
        }

        var labels = $(".label-ch");
        var arr = [];
        for (var i = 0; i < labels.length; i++) {
            arr.push(labels[i].innerHTML);
        }

        for (var i = 0; i < fields.length; i++) {
            if (!fields[i].value) {
                fields[i].classList.add("border-error")
                var error = document.createElement('span')
                error.className = 'error'
                error.innerHTML = 'Поле «' + arr[i].substr(0, arr[i].length) + '» должно быть заполнено';
                fields[i].parentElement.append(error)
            }
        }

        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;

        if (email !== null) {
            if ((!pattern.test(email.value)) && (email.value)) {
                email.classList.add("border-error")
                var error = document.createElement('span')
                error.className = 'error'
                error.innerHTML = 'Неверный адрес электронной почты'
                email.parentElement.append(error)
            }
        }

        if (password !== null) {
            if ((password.value !== passwordConfirmation.value) && (passwordConfirmation.value)) {
                passwordConfirmation.classList.add("border-error")
                var error = document.createElement('span')
                error.className = 'error'
                error.innerHTML = 'Пароли должны совпадать'
                passwordConfirmation.parentElement.append(error)
            }
        }
    })
});
