/**
 * App user list
 */

"use strict";

// Datatable (jquery)
$(function () {
    var dtUserTable = $(".datatables-users"),
        statusObj = {
            1: { title: "Pending", class: "bg-label-warning" },
            2: { title: "Active", class: "bg-label-success" },
            3: { title: "Inactive", class: "bg-label-secondary" },
        };

    var userView = baseUrl + "app/user/view/account";

    // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            dom:
                '<"row mx-2"' +
                '<"col-sm-12 col-md-4 col-lg-6" l>' +
                '<"col-sm-12 col-md-8 col-lg-6"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center align-items-center flex-sm-nowrap flex-wrap me-1"<"me-3"f><"user_role w-px-200 pb-3 pb-sm-0">>>' +
                ">t" +
                '<"row mx-2"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                ">",
            language: {
                sLengthMenu: "_MENU_",
                search: "Search",
                searchPlaceholder: "Search..",
            },
            initComplete: function () {
                // Adding role filter once table initialized
                this.api()
                    .columns(2)
                    .every(function () {
                        var column = this;
                        var select = $(
                            '<select id="UserRole" class="form-select text-capitalize"><option value=""> Select Role </option></select>'
                        )
                            .appendTo(".user_role")
                            .on("change", function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                column
                                    .search(
                                        val ? "^" + val + "$" : "",
                                        true,
                                        false
                                    )
                                    .draw();
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (d, j) {
                                select.append(
                                    '<option value="' +
                                        d +
                                        '" class="text-capitalize">' +
                                        d +
                                        "</option>"
                                );
                            });
                    });
            },
        });
    }

    // Filter form control to default size
    // ? setTimeout used for multilingual table initialization
    setTimeout(() => {
        $(".dataTables_filter .form-control").removeClass("form-control-sm");
        $(".dataTables_length .form-select").removeClass("form-select-sm");
    }, 300);

    // add
    $(document).on("click", "#addRoleSubmit", function () {
        $.easyAjax({
            container: "#addRoleForm",
            type: "POST",
            disableButton: true,
            buttonSelector: "#addRoleSubmit",
            reload: true,
            blockUI: true,
            disableButton: true,
        });
    });

    // render edit data
    $(document).on("click", ".editRole", function () {
        var url = $(this).data("url");
        $.easyAjax({
            url: url,
            type: "GET",
            appendHtmlModal: "#editRoleContent",
            showModal: "#editRoleModal",
            blockUI: true,
            disableButton: true,
        });
    });

    // update
    $("body").on("click", "#editRoleSubmit", function (event) {
        $.easyAjax({
            container: "#editRoleForm",
            type: "PATCH",
            disableButton: true,
            buttonSelector: "#editRoleSubmit",
            reload: true,
            blockUI: true,
            disableButton: true,
        });
    });

    // render assign role data
    $(document).on("click", ".assignRole", function () {
        var url = $(this).data("url");
        $.easyAjax({
            url: url,
            type: "GET",
            appendHtmlModal: "#assignRoleContent",
            showModal: "#assignRoleModal",
            blockUI: true,
            disableButton: true,
        });
    });

    // assign role
    $("body").on("click", "#assignRoleSubmit", function (event) {
        $.easyAjax({
            container: "#assignRoleForm",
            type: "PATCH",
            disableButton: true,
            buttonSelector: "#assignRoleSubmit",
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
