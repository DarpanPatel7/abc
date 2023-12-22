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
            appendHtmlModal: "#edit"+main+"Content",
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

    // render assign role data
    $(document).on("click", ".assign"+main, function () {
        var url = $(this).data("url");
        $.easyAjax({
            url: url,
            type: "GET",
            appendHtmlModal: "#assign"+main+"Content",
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
            disableButton: true,
            buttonSelector: "#assign"+main+"Submit",
            reload: true,
            blockUI: true,
            disableButton: true,
        });
    });

    // Handle click on "Select all" control for add
    // $("body").on("click", "#addall_permissions", function (event) {
    //     $(".addmodule_all_permissions").prop("checked", this.checked);
    //     $("body .addmodule_all_permissions").each(function () {
    //         $("input.addpermission[data-val=" + $(this).data("key") + "]").prop(
    //             "checked",
    //             this.checked
    //         );
    //     });
    // });
});

(function () {
    // On edit role click, update text
    var roleEditList = document.querySelectorAll(".role-edit-modal"),
        roleAdd = document.querySelector(".add-new-role"),
        roleTitle = document.querySelector(".role-title");

    roleAdd.onclick = function () {
        roleTitle.innerHTML = "Add New Role"; // reset text
    };
    if (roleEditList) {
        roleEditList.forEach(function (roleEditEl) {
            roleEditEl.onclick = function () {
                roleTitle.innerHTML = "Edit Role"; // reset text
            };
        });
    }
})();
