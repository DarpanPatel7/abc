/**
 * Page Admin Setting
 */

"use strict";

$(function () {
    // save vertical menu
    $(document).on("click", "#saveVerticalMenu", function () {
        var url = $('#saveVerticalMenuForm').attr('action');
        $.easyAjax({
            url: url,
            type: "POST",
            data: $("#saveVerticalMenuForm").serialize(),
            buttonSelector: "#saveVerticalMenu",
            blockUI: true,
            blockUIMessage: 'Submitting the form please wait...',
            disableButton: true,
            reload:true,
        });
    });

    // save horizontal menu
    $(document).on("click", "#saveHorizontalMenu", function () {
        var url = $('#saveHorizontalMenuForm').attr('action');
        $.easyAjax({
            url: url,
            type: "POST",
            data: $("#saveHorizontalMenuForm").serialize(),
            buttonSelector: "#saveHorizontalMenu",
            blockUI: true,
            blockUIMessage: 'Submitting the form please wait...',
            disableButton: true,
            reload:true,
        });
    });
});
