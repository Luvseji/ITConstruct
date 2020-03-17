$(function () {
    var form = document.querySelector('.form-ch')
    form.addEventListener('submit', function (event) {
        event.preventDefault()
        var fields = $(".field-empty-check");
        var errors = $(".error");
        var labels = $(".label-ch");
        var arr = [];
        var password = $(".password");
        var passwordConfirmation = $(".password-check");
        var email = $(".email");
        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
        fields.removeClass("border-error");
        errors.remove();
        passwordConfirmation.removeClass("border-error")
        email.removeClass("border-error")
        $.each(labels, function (i) {
            arr.push($(labels[i]).text());
        })
        $.each(fields, function (i) {
            if (!fields[i].value) {
                var err = fields[i];
                $(err).addClass("border-error");
                $("<span>", {
                    class: "error",
                    text: "Поле «" + arr[i] + "» должно быть заполнено"
                }).insertAfter(err);
            }
        })
        if (email !== null) {
            if ((!pattern.test((email.val()))) && ((email.val()))) {
                $(email).addClass("border-error");
                $("<span>", {
                    class: "error",
                    text: "Неверный адрес электронной почты"
                }).insertAfter(email);
            }
        }
        if (password !== null) {
            if (((password.val()) !== (passwordConfirmation.val())) && ((password.val()))) {
                passwordConfirmation.addClass("border-error");
                $("<span>", {
                    class: "error",
                    text: "Пароли должны совпадать"
                }).insertAfter(passwordConfirmation);
            }
        }
    })
});
