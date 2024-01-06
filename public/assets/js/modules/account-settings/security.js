/**
 * Page Security Setting
 */

"use strict";

$(function () {
    let borderColor, bodyBg, headingColor;
    var main = 'Security';

    if (isDarkStyle) {
        borderColor = config.colors_dark.borderColor;
        bodyBg = config.colors_dark.bodyBg;
        headingColor = config.colors_dark.headingColor;
    } else {
        borderColor = config.colors.borderColor;
        bodyBg = config.colors.bodyBg;
        headingColor = config.colors.headingColor;
    }
    // save Account Setting
    $(document).on("click", "#changePassword", function () {
        $.easyAjax({
            container: "#changePasswordForm",
            type: "POST",
            buttonSelector: "#changePassword",
            blockUI: true,
            blockUIMessage: 'Please wait...',
            disableButton: true,
            reload:true,
        });
    });

    $(document).on("click", "#deactivate"+main, function () {
        var url = $('#deactivate'+main+'Form').attr('action');
        $.easyAjax({
            url: url,
            type: "POST",
            data: $('#deactivate'+main+'Form').serialize(),
            buttonSelector: "#deactivate"+main,
            sweetAlert: true,
            blockUI: true,
            blockUIMessage: 'Please wait...',
            disableButton: true,
        });
    });
});
