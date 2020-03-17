$(function () {
    var form = document.querySelector(".form-ch");
    form.addEventListener("submit", function (event) {
        event.preventDefault();
        var fields = $(".field-empty-check");
        var errors = $(".error");
        var labels = $(".label-ch");
        var arr = [];
        fields.removeClass("border-error");
        errors.remove();
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
    })
});
