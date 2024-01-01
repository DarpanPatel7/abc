/**
 * Page Employee List
 */

"use strict";

// Datatable (jquery)
$(function () {
    let borderColor, bodyBg, headingColor;
    var main = 'Employee';

    if (isDarkStyle) {
        borderColor = config.colors_dark.borderColor;
        bodyBg = config.colors_dark.bodyBg;
        headingColor = config.colors_dark.headingColor;
    } else {
        borderColor = config.colors.borderColor;
        bodyBg = config.colors.bodyBg;
        headingColor = config.colors.headingColor;
    }

    // Variable declaration for table
    var dt_selector = $(".datatable"+main);

    // Users datatable
    if (dt_selector.length) {
        var datatable = dt_selector.DataTable({
            processing: true,
            serverSide: true,
            dom:
                '<"row mx-2"' +
                '<"col-md-2"<"me-3"l>>' +
                '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>' +
                ">t" +
                '<"row mx-2"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                ">",
            // Buttons with Dropdown
            buttons: [
                {
                    text: '<i class="bx bx-plus me-0 me-lg-2"></i><span class="d-none d-lg-inline-block">Add '+main+'</span>',
                    className: "add-new btn btn-primary mx-3",
                    attr: {
                        "data-bs-toggle": "modal",
                        "data-bs-target": "#add"+main+"Modal",
                    },
                },
            ],
            ajax: dt_selector.data('url'),
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'user', name: 'user' },
                { data: 'employee_no', name: 'employee_no' },
                { data: 'designation', name: 'designation' },
                { data: 'date_of_birth', name: 'date_of_birth' },
                { data: 'status', name: 'status' },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    }

    // Delete Record
    $(".datatable"+main+" tbody").on(
        "click",
        ".delete"+main,
        function () {
            datatable = datatable.row($(this).parents("tr"));
            var url = $(this).attr("data-url");
            $.easyAjax({
                url: url,
                type: "DELETE",
                disableButton: true,
                buttonSelector: ".delete"+main,
                datatable: datatable,
            });
        }
    );

    // Filter form control to default size
    // ? setTimeout used for multilingual table initialization
    setTimeout(() => {
        $(".dataTables_filter .form-control").removeClass("form-control-sm");
        $(".dataTables_length .form-select").removeClass("form-select-sm");
    }, 300);

    // add
    $(document).on("click", "#add"+main+"Submit", function () {
        $.easyAjax({
            container: "#add"+main+"Form",
            type: "POST",
            buttonSelector: "#add"+main+"Submit",
            file: true,
            blockUI: true,
            disableButton: true,
            formReset:true,
            datatable: datatable,
        });
    });

    // render edit data
    $(document).on("click", ".edit"+main, function () {
        var url = $(this).data("url");
        $.easyAjax({
            url: url,
            type: "GET",
            appendHtml: "#edit"+main+"Content",
            showModal: "#edit"+main+"Modal",
            blockUI: true,
            disableButton: true,
        });
    });

    // update
    $("body").on("click", "#edit"+main+"Submit", function (event) {
        $.easyAjax({
            container: "#edit"+main+"Form",
            type: "POST",
            buttonSelector: "#edit"+main+"Submit",
            file: true,
            blockUI: true,
            disableButton: true,
            formReset:true,
            datatable: datatable,
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
        $('.profile_photo').val('');
    });
});
