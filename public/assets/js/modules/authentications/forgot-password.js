/**
 * Page Forgot Password
 */

"use strict";

$(function () {
    // forgot password
    $(document).on("click", "#forgot-password", function () {
        $.easyAjax({
            type: "POST",
            buttonSelector: $(this),
            data: $("#forgot-password-form").serialize(),
        });
    });
});
