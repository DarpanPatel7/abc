/**
 * Page Menu List
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
    var dt_menu_table = $(".datatables-menus");

    // Users datatable
    if (dt_menu_table.length) {
        var dt_menu = dt_menu_table.DataTable({
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
                    text: '<i class="bx bx-plus me-0 me-lg-2"></i><span class="d-none d-lg-inline-block">Add Menu</span>',
                    className: "add-new btn btn-primary mx-3",
                    attr: {
                        "data-bs-toggle": "modal",
                        "data-bs-target": "#addMenuModal",
                    },
                },
            ],
        });
    }

    // Delete Record
    $(".datatables-menus tbody").on(
        "click",
        ".deleteMenu",
        function () {
            dt_menu = dt_menu.row($(this).parents("tr"));

            var url = $(this).attr("data-url");
            $.easyAjax({
                url: url,
                type: "DELETE",
                disableButton: true,
                buttonSelector: ".deleteMenu",
                datatable: dt_menu,
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
    $(document).on("click", "#addMenuSubmit", function () {
        $.easyAjax({
            container: "#addMenuForm",
            type: "POST",
            disableButton: true,
            buttonSelector: "#addMenuSubmit",
            reload: true,
        });
    });

    // render edit data
    $(document).on("click", ".editMenu", function () {
        var url = $(this).data("url");
        $.easyAjax({
            url: url,
            type: "GET",
            appendHtmlModal: "#editMenuContent",
            showModal: "#editMenuModal",
        });
    });

    // update
    $("body").on("click", "#editMenuSubmit", function (event) {
        $.easyAjax({
            container: "#editMenuForm",
            type: "PATCH",
            disableButton: true,
            buttonSelector: "#editMenuSubmit",
            reload: true,
        });
    });
});
