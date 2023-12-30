/**
 * Page Account Setting
 */

"use strict";

$(function () {
    // save Account Setting
    $(document).on("click", "#saveAccount", function () {
        var url = $('#saveAccountForm').attr('action');
        $.easyAjax({
            url: url,
            type: "POST",
            data: $("#saveAccountForm").serialize(),
            buttonSelector: "#saveAccount",
            blockUI: true,
            blockUIMessage: 'Submitting the form please wait...',
            disableButton: true,
            isSuccessToast: true,
            reload:true,
        });
    });
});
