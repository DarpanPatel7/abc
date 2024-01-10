function configureExport(options, columns) {
    return {
        extend: options.extend,
        text: options.text,
        className: 'dropdown-item',
        exportOptions: {
            columns: columns,
            format: {
                body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                        if (item.classList !== undefined && item.classList.contains('user-name')) {
                            // result = result + item.lastChild.firstChild.textContent;
                            if (item.querySelector('.fw-semibold')) {
                                result = item.querySelector('.fw-semibold').textContent.trim();
                            }
                        } else if (item.innerText === undefined) {
                            result = result + item.textContent;
                        } else result = result + item.innerText;
                    });
                    return result;
                }
            }
        }
       /*  customize: function (win) {
            $(win.document.body)
                .css('color', config.colors.headingColor)
                .css('border-color', config.colors.borderColor)
                .css('background-color', config.colors.bodyBg);
            $(win.document.body)
                .find('table')
                .addClass('compact')
                .css('color', 'inherit')
                .css('border-color', 'inherit')
                .css('background-color', 'inherit');
        } */
    };
}

/* // Example usage:
var printConfig = configureExport({
    extend: 'print',
    text: '<i class="bx bx-printer me-1"></i>Print'
}, [1, 2]);

var csvConfig = configureExport({
    extend: 'csv',
    text: '<i class="bx bx-file me-1"></i>Csv'
}, [1, 2]);

// Similarly, you can create configurations for excel, pdf, and copy
var excelConfig = configureExport({
    extend: 'excel',
    text: '<i class="bx bxs-file-export me-1"></i>Excel'
}, [1, 2]);

var pdfConfig = configureExport({
    extend: 'pdf',
    text: '<i class="bx bxs-file-pdf me-1"></i>Pdf'
}, [1, 2]);

var copyConfig = configureExport({
    extend: 'copy',
    text: '<i class="bx bx-copy me-1"></i>Copy'
}, [1, 2]); */
