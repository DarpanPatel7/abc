/**
 * Page Login
 */

"use strict";

$(function () {
    // login
    $(document).on("click", "#login", function () {
        $.easyAjax({
            type: "POST",
            buttonSelector: $(this),
            data: $("#login-form").serialize(),
        });
    });
});
