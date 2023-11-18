/**
 * Page Register
 */

"use strict";

$(function () {
    // register
    $(document).on("click", "#register", function () {
        $.easyAjax({
            type: "POST",
            buttonSelector: $(this),
            data: $("#register-form").serialize(),
        });
    });
});
