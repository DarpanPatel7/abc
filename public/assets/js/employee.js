/**
 * Page User List
 */

"use strict";

// Datatable (jquery)
$(function () {
    let borderColor, bodyBg, headingColor;

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
    var dt_employee_table = $(".datatables-employees");

    // Users datatable
    if (dt_employee_table.length) {
        var dt_employee = dt_employee_table.DataTable({
            // order: [[1, "desc"]],
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
                    text: '<i class="bx bx-plus me-0 me-lg-2"></i><span class="d-none d-lg-inline-block">Add Employee</span>',
                    className: "add-new btn btn-primary mx-3",
                    attr: {
                        "data-bs-toggle": "modal",
                        "data-bs-target": "#addEmployeeModal",
                    },
                },
            ],
        });
    }

    // Delete Record
    $(".datatables-employees tbody").on(
        "click",
        ".deleteEmployee",
        function () {
            dt_employee = dt_employee.row($(this).parents("tr"));
            // dt_employee.row($(this).parents("tr")).remove().draw();

            var url = $(this).attr("data-url");
            $.easyAjax({
                url: url,
                type: "DELETE",
                disableButton: true,
                // reload: true,
                buttonSelector: ".deleteEmployee",
                datatable: dt_employee,
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
    $(document).on("click", "#addEmployeeSubmit", function () {
        $.easyAjax({
            container: "#addEmployeeForm",
            type: "POST",
            disableButton: true,
            buttonSelector: "#addEmployeeSubmit",
            reload: true,
            file: true,
        });
    });

    // render edit data
    $(document).on("click", ".editEmployee", function () {
        var url = $(this).data("url");
        $.easyAjax({
            url: url,
            type: "GET",
            appendHtmlModal: "#editEmployeeContent",
            showModal: "#editEmployeeModal",
        });
    });

    // update
    $("body").on("click", "#editEmployeeSubmit", function (event) {
        $.easyAjax({
            container: "#editEmployeeForm",
            type: "PATCH",
            disableButton: true,
            buttonSelector: "#editEmployeeSubmit",
            reload: true,
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
            $('#preview-profile-image').attr('src', resp);
            $('#cropImagePop').modal('hide');

            return false;


            var id = $('#user_id').val();

            //upload image
            $.ajax({
                type: 'POST',
                url: update_profile_picture,
                data: {'id':id, 'image':resp},
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success : function(data) {
                    if(data.success){
                        $('#preview-profile-image').attr('src', resp);
                        $('#cropImagePop').modal('hide');
                        toastr.success(data.success);
                    }else if(data.error){
                        toastr.error(data.error);
                    }
                }
            });
        });
    });
    // End upload preview image

    // file trigger using anchor tag
    $(document).on("click", "#edit_profile_img", function (ev) {
        ev.preventDefault();
        $("#h_file:file").trigger('click');
    });
});
