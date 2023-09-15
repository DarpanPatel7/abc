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
});
