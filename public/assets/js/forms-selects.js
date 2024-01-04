/**
 * Selects & Tags
 */

'use strict';

$(function () {
    const selectPicker = $('.selectpicker'),
        select2 = $('.select2'),
        select2Icons = $('.select2-icons');

    // Bootstrap Select
    // --------------------------------------------------------------------
    if (selectPicker.length) {
        selectPicker.selectpicker();
    }

    // Select2
    // --------------------------------------------------------------------

    // Default
    if (select2.length) {
        select2.each(function () {
            var $this = $(this),
                r = {
                    AllowClear: $this.data("data-allow-clear") ? $this.data("data-allow-clear") : false,
                    dropdownParent: $this.parent(),
                    placeholder: $this.data("placeholder") ? $this.data("placeholder") : false,
                };
            $this.wrap('<div class="position-relative"></div>').select2(r);
        });
    }

    // Select2 Icons
    if (select2Icons.length) {
        // custom template to render icons
        function renderIcons(option) {
            if (!option.id) {
                return option.text;
            }
            var $icon = "<i class='" + $(option.element).data('icon') + " me-2'></i>" + option.text;

            return $icon;
        }
        select2Icons.wrap('<div class="position-relative"></div>').select2({
            templateResult: renderIcons,
            templateSelection: renderIcons,
            escapeMarkup: function (es) {
                return es;
            }
        });
    }
});

//init select2
function initSelect2(id) {
    if ($('select.select2').length) {
        $('select.select2').each(function () {
            var $this = $(this),
                r = {
                    dropdownParent: $(id + " .modal-content"),
                    AllowClear: $this.data("data-allow-clear") ? $this.data("data-allow-clear") : false,
                    placeholder: $this.data("placeholder") ? $this.data("placeholder") : false,
                };
            $this.select2(r);
        });
    }
}

//init select2 inside modal on ajax call
function initAjaxDropdownModal(id) {
    if ($('select.select2').length) {
        $('select.select2').each(function () {
            var $this = $(this),
                r = {
                    dropdownParent: $(id + " .modal-content"),
                    AllowClear: $this.data("data-allow-clear") ? $this.data("data-allow-clear") : false,
                    placeholder: $this.data("placeholder") ? $this.data("placeholder") : false,
                };
            $this.select2(r);
        });
    }
}
