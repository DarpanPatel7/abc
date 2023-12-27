/**
 * Page Forgot Password
 */

"use strict";

$(function () {
    // forgot password
    $(document).on("click", "#forgot-password", function () {
        $.easyAjax({
            type: "POST",
            data: $("#forgot-password-form").serialize(),
            buttonSelector: "#forgot-password",
            blockUI: true,
            blockUIMessage: 'Please wait while sending e-mail...',
            disableButton: true,
            isSuccessToast: true,
        });
    });
});
