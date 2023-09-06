/**
 * Page User List
 */

'use strict';

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
  var dt_user_table = $('.datatables-designations');



  // Users datatable
  if (dt_user_table.length) {
    var dt_user = dt_user_table.DataTable({
      order: [[1, 'desc']],
      dom:
        '<"row mx-2"' +
        '<"col-md-2"<"me-3"l>>' +
        '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>' +
        '>t' +
        '<"row mx-2"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>',

      // Buttons with Dropdown
      buttons: [
        {
          text: '<i class="bx bx-plus me-0 me-lg-2"></i><span class="d-none d-lg-inline-block">Add Designation</span>',
          className: 'add-new btn btn-primary mx-3',
          attr: {
            'data-bs-toggle': 'offcanvas',
            'data-bs-target': '#offcanvasAddDesignation'
          }
        }
      ]
    });
  }

  // Delete Record
  $('.datatables-designations tbody').on('click', '.delete-record', function () {
    dt_user.row($(this).parents('tr')).remove().draw();
  });

  // Filter form control to default size
  // ? setTimeout used for multilingual table initialization
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);
});

// Validation & Phone mask
// (function () {
//   const addEmployeeForm = document.getElementById('addEmployeeForm');

//   // Add New User Form Validation
//   const fv = FormValidation.formValidation(addEmployeeForm, {
//     plugins: {
//       trigger: new FormValidation.plugins.Trigger(),
//       bootstrap5: new FormValidation.plugins.Bootstrap5({
//         // Use this for enabling/changing valid/invalid class
//         eleValidClass: '',
//         rowSelector: function (field, ele) {
//           // field is the field name & ele is the field element
//           return '.mb-3';
//         }
//       }),
//       submitButton: new FormValidation.plugins.SubmitButton(),
//       // Submit the form when all fields are valid
//       // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
//       autoFocus: new FormValidation.plugins.AutoFocus()
//     }
//   });
// })();
