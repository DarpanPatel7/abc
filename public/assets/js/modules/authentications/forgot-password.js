/**
 * Page Forgot Password
 */

"use strict";

$(function () {
    // forgot password
    $(document).on("click", "#forgot-password", function () {
        $.easyAjax({
            type: "POST",
            buttonSelector: "#forgot-password",
            data: $("#forgot-password-form").serialize(),
            blockUI: true,
            blockUIMessage: 'Please wait while sending e-mail...',
            disableButton: true,
        });
    });
});
