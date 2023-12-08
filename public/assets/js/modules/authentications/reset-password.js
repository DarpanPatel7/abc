/**
 * Page Reset Password
 */

"use strict";

$(function () {
    // reset password
    $(document).on("click", "#reset-password", function () {
        $.easyAjax({
            url: url,
            type: "POST",
            buttonSelector: "#reset-password",
            data: $("#reset-password-form").serialize(),
            disableButton: true,
        });
    });
});
