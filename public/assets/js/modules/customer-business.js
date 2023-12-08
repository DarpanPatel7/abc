/**
 * Page customer business List
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
    var dt_customer_business_table = $(".datatables-customer-businesses");

    // Users datatable
    if (dt_customer_business_table.length) {
        var dt_customer_business = dt_customer_business_table.DataTable({
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
                    text: '<i class="bx bx-plus me-0 me-lg-2"></i><span class="d-none d-lg-inline-block">Add Customer Business</span>',
                    className: "add-new btn btn-primary mx-3",
                    attr: {
                        "data-bs-toggle": "modal",
                        "data-bs-target": "#addCustomerBusinessModal",
                    },
                },
            ],
        });
    }

    // Delete Record
    $(".datatables-customer-businesses tbody").on(
        "click",
        ".deleteCustomerBusiness",
        function () {
            dt_customer_business = dt_customer_business.row($(this).parents("tr"));

            var url = $(this).attr("data-url");
            $.easyAjax({
                url: url,
                type: "DELETE",
                disableButton: true,
                deleteToast: true,
                buttonSelector: ".deleteCustomerBusiness",
                datatable: dt_customer_business,
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
    $(document).on("click", "#addCustomerBusinessSubmit", function () {
        $.easyAjax({
            container: "#addCustomerBusinessForm",
            type: "POST",
            buttonSelector: "#addCustomerBusinessSubmit",
            reload: true,
            blockUI: true,
            disableButton: true,
        });
    });

    // render edit data
    $(document).on("click", ".editCustomerBusiness", function () {
        var url = $(this).data("url");
        $.easyAjax({
            url: url,
            type: "GET",
            appendHtmlModal: "#editCustomerBusinessContent",
            showModal: "#editCustomerBusinessModal",
            blockUI: true,
            disableButton: true,
        });
    });

    // update
    $("body").on("click", "#editCustomerBusinessSubmit", function (event) {
        $.easyAjax({
            container: "#editCustomerBusinessForm",
            type: "PATCH",
            buttonSelector: "#editCustomerBusinessSubmit",
            reload: true,
            blockUI: true,
            disableButton: true,
        });
    });
});
