/**
 * Page Currency List
 */

"use strict";

// Datatable (jquery)
$(function () {
    let borderColor, bodyBg, headingColor;
    var main = 'Currency';

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
                    text: '<i class="bx bx-plus me-0 me-lg-2"></i><span class="d-none d-lg-inline-block">Add Currency</span>',
                    className: "add-new btn btn-primary mx-3",
                    attr: {
                        "data-bs-toggle": "modal",
                        "data-bs-target": "#addCurrencyModal",
                    },
                },
            ],
            ajax: dt_selector.data('url'),
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'code', name: 'code' },
                { data: 'rate', name: 'rate' },
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
});
