/**
 * Page Account Setting
 */

"use strict";

$(function () {
    let borderColor, bodyBg, headingColor;
    var main = 'Account';

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
    $(document).on("click", "#save"+main, function () {
        $.easyAjax({
            container: "#save"+main+"Form",
            type: "POST",
            buttonSelector: "#save"+main,
            file: true,
            blockUI: true,
            blockUIMessage: 'Submitting the form please wait...',
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

    $('body').on('change', '#country', function (event) {
        var id = $(this).val();
        $.easyAjax({
            url: getStateByCountry_url,
            data: { 'id': id },
            type: "POST",
            appendHtml: "#stateContent",
            initSelect2: '#save'+main+'Form',
        });
    });

    // Start upload,crop,preview image - croppie plugin
    var $uploadCrop,
    tempFilename,
    rawImg,
    imageId;
    function readFile(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.upload-demo').addClass('ready');
                $('#cropImagePop').modal('show');
                rawImg = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
            input.value = null;
        }
        else {
            console.log("Sorry - you're browser doesn't support the FileReader API");
        }
    }

    $uploadCrop = $('#upload-demo').croppie({
        viewport: {
            width: 105,
            height: 105,
            type: 'circle'
        },
        enforceBoundary: false,
        enableExif: true
    });

    $('#cropImagePop').on('shown.bs.modal', function(){
        $uploadCrop.croppie('bind', {
            url: rawImg
        }).then(function(){
            console.log('jQuery bind complete');
        });
    });

    $('.item-img').on('change', function () { imageId = $(this).data('id'); tempFilename = $(this).val();
    $('#cancelCropBtn').data('id', imageId); readFile(this); });
    $('#cropImageBtn').on('click', function (ev) {
        $uploadCrop.croppie('result', {
            type: 'base64',
            format: 'png',
            size: {width: 105, height: 105}
        }).then(function (resp) {
            $('.preview-profile-image').attr('src', resp);
            $('.profile_photo').val(resp);
            $('#cropImagePop').modal('hide');
        });
    });
    // End upload preview image

    // file trigger using anchor tag
    $(document).on("click", "#select_image", function (ev) {
        ev.preventDefault();
        $("#h_file:file").trigger('click');
    });

    // clear image event
    $(document).on("click", "#clear_image", function (ev) {
        ev.preventDefault();
        $('.preview-profile-image').attr('src', defaultImage);
        $('.profile_photo').val(defaultImageBase64);
    });
});
