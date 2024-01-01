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

    $('body').on('change', '#country', function (event) {
        var id = $(this).val();
        $.easyAjax({
            url: getStateByCountry_url,
            data: {'id':id},
            type: "POST",
            appendHtml: "#state_content",
        });
        // initSelect2('#saveAccountForm');
        /* $.ajax({
            url: getStateByCountry_url,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {'id':id},
            success : function(data) {
                if(data.success){
                    $('#state_content').html(data.data);
                    // $(".select").select2();
                }else if(data.error){
                    toastr.error(data.error);
                }else if(data.info){
                    toastr.info(data.info);
                }
            }
        }); */
    });

    $( document ).ready(function() {
        var id = $('#country').val();
        if(id){
            $.easyAjax({
                url: getStateByCountry_url,
                data: {'id':id},
                type: "POST",
                appendHtml: "#state_content",
            });
        }
        /* $.ajax({
            url: getStateByCountry_url,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {'id':id},
            success : function(data) {
                if(data.success){
                    $('#state_content').html(data.data);
                    // $(".select").select2();
                }else if(data.error){
                    toastr.error(data.error);
                }else if(data.info){
                    toastr.info(data.info);
                }
            }
        }); */
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
        $('.profile_photo').val('');
    });
});
