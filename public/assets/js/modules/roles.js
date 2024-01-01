/**
 * App Role list
 */

"use strict";

// Datatable (jquery)
$(function () {
    let borderColor, bodyBg, headingColor;
    var main = 'Role';

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

    // Users List datatable
    if (dt_selector.length) {
        var datatable = dt_selector.DataTable({
            processing: true,
            serverSide: true,
            dom:
                '<"row mx-2"' +
                '<"col-sm-12 col-md-4 col-lg-6" l>' +
                '<"col-sm-12 col-md-8 col-lg-6"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center align-items-center flex-sm-nowrap flex-wrap me-1"<"me-3"f>>>' +
                ">t" +
                '<"row mx-2"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                ">",
            ajax: dt_selector.data('url'),
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'user', name: 'user' },
                { data: 'role', name: 'role' },
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
        setTimeout( function(){
            $.when( $.ready, $.get($(this).data("url")) ).done(function() {
                checkedEditAllPermission();
            })
        });
    });

    // update
    $("body").on("click", "#edit"+main+"Submit", function (event) {
        $.easyAjax({
            container: "#edit"+main+"Form",
            type: "POST",
            buttonSelector: "#edit"+main+"Submit",
            blockUI: true,
            disableButton: true,
            formReset:true,
            datatable: datatable,
        });
    });

    // render assign role data
    $(document).on("click", ".assign"+main, function () {
        var url = $(this).data("url");
        $.easyAjax({
            url: url,
            type: "GET",
            appendHtml: "#assign"+main+"Content",
            showModal: "#assign"+main+"Modal",
            blockUI: true,
            disableButton: true,
        });
    });

    // assign role
    $("body").on("click", "#assign"+main+"Submit", function (event) {
        $.easyAjax({
            container: "#assign"+main+"Form",
            type: "PATCH",
            buttonSelector: "#assign"+main+"Submit",
            blockUI: true,
            disableButton: true,
            formReset:true,
            datatable: datatable,
        });
    });


    function checkedEditAllPermission(){
        $("body .editpermission").each(function () {
            if ($("input.editpermission[data-val="+$(this).data("val")+"]:checked").length == $("input.editpermission[data-val="+$(this).data("val")+"]").length) {
                $(".editmodule_all_permissions[data-key="+$(this).data("val")+"]").prop('checked',true);
            }else{
                $(".editmodule_all_permissions[data-key="+$(this).data("val")+"]").prop('checked',false);
            }
        });

        if ($('.editmodule_all_permissions:checked').length == $('.editmodule_all_permissions').length) {
            $('#editall_permissions').prop('checked',true);
        }else{
            $('#editall_permissions').prop('checked',false);
        }
    }

    // Handle click on "Select all" control for edit
    $('body').on('click', '#editall_permissions', function (event) {
        $('.editmodule_all_permissions').prop('checked', this.checked);
        $("body .editmodule_all_permissions").each(function () {
            $("input.editpermission[data-val="+$(this).data("key")+"]").prop('checked', this.checked);
        });
    });
    $('body').on('click', '.editmodule_all_permissions', function (event) {
        $('.'+$(this).data('key')).prop('checked', this.checked);
        checkedEditAllPermission();
    });
    $('body').on('click', '.editpermission', function (event) {
        if ($("input.editpermission[data-val="+$(this).data("val")+"]:checked").length == $("input.editpermission[data-val="+$(this).data("val")+"]").length) {
            $(".editmodule_all_permissions[data-key="+$(this).data("val")+"]").prop('checked',true);
        }else{
            $(".editmodule_all_permissions[data-key="+$(this).data("val")+"]").prop('checked',false);
        }
        if ($('.editpermission:checked').length == $('.editpermission').length) {
            $('#editall_permissions').prop('checked',true);
        }else{
            $('#editall_permissions').prop('checked',false);
        }

        //  Select list permission if edit pr delete is checked
        var p_type = $(this).data("type").split('-').pop();

        if($("input.editpermission[data-type="+$(this).data("val").toLowerCase()+'-'+p_type+"]:checked") && (p_type == 'edit' || p_type == 'delete' || p_type == 'create')) {
            $("input.editpermission[data-type="+$(this).data("val").toLowerCase()+"-list]").prop('checked',true);
        }

        if($("input.editpermission[data-type="+$(this).data("val").toLowerCase()+"-list]").is(':checked') == false && p_type == 'list') {
            $("input.editpermission[data-type="+$(this).data("val").toLowerCase()+"-create]").prop('checked',false);
            $("input.editpermission[data-type="+$(this).data("val").toLowerCase()+"-edit]").prop('checked',false);
            $("input.editpermission[data-type="+$(this).data("val").toLowerCase()+"-delete]").prop('checked',false);
        }
    });

    // Handle click on "Select all" control for add
    $('body').on('click', '#addall_permissions', function (event) {
        $('.addmodule_all_permissions').prop('checked', this.checked);
        $("body .addmodule_all_permissions").each(function () {
            $("input.addpermission[data-val="+$(this).data("key")+"]").prop('checked', this.checked);
        });
    });
    $('body').on('click', '.addmodule_all_permissions', function (event) {
        $('.'+$(this).data('key')).prop('checked', this.checked);
        if ($('.addmodule_all_permissions:checked').length == $('.addmodule_all_permissions').length) {
            $('#addall_permissions').prop('checked',true);
        }else{
            $('#addall_permissions').prop('checked',false);
        }
    });
    $('body').on('click', '.addpermission', function (event) {
        if ($("input.addpermission[data-val="+$(this).data("val")+"]:checked").length == $("input.addpermission[data-val="+$(this).data("val")+"]").length) {
            $(".addmodule_all_permissions[data-key="+$(this).data("val")+"]").prop('checked',true);
        }else{
            $(".addmodule_all_permissions[data-key="+$(this).data("val")+"]").prop('checked',false);
        }
        if ($('.addmodule_all_permissions:checked').length == $('.addmodule_all_permissions').length) {
            $('#addall_permissions').prop('checked',true);
        }else{
            $('#addall_permissions').prop('checked',false);
        }

        //  Select list permission if edit pr delete is checked
        var p_type = $(this).data("type").split('-').pop();

        if($("input.addpermission[data-type="+$(this).data("val").toLowerCase()+'-'+p_type+"]:checked") && (p_type == 'edit' || p_type == 'delete' || p_type == 'create')) {
            $("input.addpermission[data-type="+$(this).data("val").toLowerCase()+"-list]").prop('checked',true);
        }

        if($("input.addpermission[data-type="+$(this).data("val").toLowerCase()+"-list]").is(':checked') == false && p_type == 'list') {
            $("input.addpermission[data-type="+$(this).data("val").toLowerCase()+"-create]").prop('checked',false);
            $("input.addpermission[data-type="+$(this).data("val").toLowerCase()+"-edit]").prop('checked',false);
            $("input.addpermission[data-type="+$(this).data("val").toLowerCase()+"-delete]").prop('checked',false);
        }
    });
});
