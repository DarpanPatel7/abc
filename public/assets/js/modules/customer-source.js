/**
 * Page customer source List
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
    var dt_customer_source_table = $(".datatables-customer-sources");

    // Users datatable
    if (dt_customer_source_table.length) {
        var dt_customer_source = dt_customer_source_table.DataTable({
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
                    text: '<i class="bx bx-plus me-0 me-lg-2"></i><span class="d-none d-lg-inline-block">Add Customer Source</span>',
                    className: "add-new btn btn-primary mx-3",
                    attr: {
                        "data-bs-toggle": "modal",
                        "data-bs-target": "#addCustomerSourceModal",
                    },
                },
            ],
        });
    }

    // Delete Record
    $(".datatables-customer-sources tbody").on(
        "click",
        ".deleteCustomerSource",
        function () {
            dt_customer_source = dt_customer_source.row($(this).parents("tr"));

            var url = $(this).attr("data-url");
            $.easyAjax({
                url: url,
                type: "DELETE",
                disableButton: true,
                deleteToast: true,
                buttonSelector: ".deleteCustomerSource",
                datatable: dt_customer_source,
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
    $(document).on("click", "#addCustomerSourceSubmit", function () {
        $.easyAjax({
            container: "#addCustomerSourceForm",
            type: "POST",
            disableButton: true,
            buttonSelector: "#addCustomerSourceSubmit",
            reload: true,
        });
    });

    // render edit data
    $(document).on("click", ".editCustomerSource", function () {
        var url = $(this).data("url");
        $.easyAjax({
            url: url,
            type: "GET",
            appendHtmlModal: "#editCustomerSourceContent",
            showModal: "#editCustomerSourceModal",
        });
    });

    // update
    $("body").on("click", "#editCustomerSourceSubmit", function (event) {
        $.easyAjax({
            container: "#editCustomerSourceForm",
            type: "PATCH",
            disableButton: true,
            buttonSelector: "#editCustomerSourceSubmit",
            reload: true,
        });
    });
});