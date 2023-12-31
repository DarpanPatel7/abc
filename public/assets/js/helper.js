(function ($) {
    "use strict";
    $.easyAjax = function (options) {
        var defaults = {
            type: "GET",
            container: "body",
            blockUI: false,
            disableButton: false,
            buttonSelector: "[type='submit']",
            dataType: "json",
            csrfToken: $('meta[name="csrf-token"]').attr("content"),
            messagePosition: "toastr",
            errorPosition: "field",
            redirect: false,
            reload: false,
            data: {},
            file: false,
            formReset: false,
            async: true,
            historyPush: false,
            appendHtml: false,
            showModal: false,
            hideModal: true,
            sweetAlert: false,
            restrictPopupClose: false,
            blockUIMessage:"",
            datatable: false,
            isSuccessToast: false,
            initSelect2: false,
        };

        var opt = defaults;

        // Extend user-set options over defaults
        if (options) {
            opt = $.extend(defaults, options);
        }

        // Methods if not given in option
        if (typeof opt.beforeSend != "function") {
            opt.beforeSend = function () {
                if (opt.historyPush) {
                    historyPush(opt.url);
                }

                if (opt.blockUI) {
                    $.easyBlockUI(opt.container, opt.blockUIMessage);
                }

                if (opt.disableButton) {
                    loadingButton(opt.buttonSelector);
                }

                if (opt.restrictPopupClose) {
                    blockPopupClose(
                        "#" + $(opt.container).parents("div.modal").attr("id")
                    );
                }
            };
        }

        if (typeof opt.complete != "function") {
            opt.complete = function (jqXHR, textStatus) {
                if (opt.blockUI) {
                    $.easyUnblockUI(opt.container);
                }

                if (opt.disableButton) {
                    unloadingButton(opt.buttonSelector);
                }

                if (opt.restrictPopupClose) {
                    unblockPopupClose(
                        "#" + $(opt.container).parents("div.modal").attr("id")
                    );
                }

                if (opt.initSelect2) {
                    if (typeof initSelect2 == "function") {
                        initSelect2(opt.initSelect2);
                    }
                }

                if (opt.showModal) {
                    if (typeof initDatePicker == "function") {
                        initDatePicker();
                    }
                }

            };
        }

        // Default error handler
        if (typeof opt.error != "function") {
            opt.error = function (jqXHR, textStatus, errorThrown) {
                try {
                    var response = JSON.parse(jqXHR.responseText);
                    if (typeof response == "object") {
                        if (opt.type == "DELETE" || opt.sweetAlert) {
                            $(".sweet-alert .confirm")
                                .removeClass("is-loading")
                                .prop("disabled", false);
                        }

                        handleFail(response, opt);
                    } else {
                        var msg =
                            "A server side error occurred. Please try again after sometime.";

                        if (textStatus == "timeout") {
                            msg =
                                "Connection timed out! Please check your internet connection";
                        }
                        // showResponseMessage(msg, "error");
                        $.showToastr(msg, "error");
                    }
                } catch (e) {
                    if (opt.type == "DELETE" || opt.sweetAlert) {
                        $(".sweet-alert .confirm")
                            .removeClass("is-loading")
                            .prop("disabled", false);
                    }
                    // when session expire then it reload user to login page
                    // window.location.reload();
                }
            };
        }

        function showSweetAlert(button) {
            !(function st(n) {
                var e = {
                    title:
                        void 0 !== n.data("swal-title")
                            ? n.data("swal-title")
                            : "Are you sure?",
                    text: n.data("swal-text")
                        ? n.data("swal-text")
                        : "You won't be able to revert this!",
                    icon:
                        void 0 !== n.data("swal-type")
                            ? n.data("swal-type")
                            : "warning",
                    showCancelButton: n.data("swal-show-cancel-button")
                        ? n.data("swal-show-cancel-button")
                        : true,
                    confirmButtonText: n.data("swal-confirm-button-text")
                        ? n.data("swal-confirm-button-text")
                        : "Yes, delete it!",
                    backdrop: true,
                    allowOutsideClick: false,
                };
                Swal.fire(e).then((result) => {
                    if (result["isConfirmed"]) {
                        loadAjax();
                    }
                });
            })($(button));
        }

        function showResponseMessage(msg, type, toastrOptions) {
            var typeClasses = {
                error: "danger",
                success: "success",
                primary: "primary",
                warning: "warning",
                info: "info",
            };

            var iconClasses = {
                error: "error",
                success: "success",
                warning: "warning",
                info: "info",
            };

            var headingClasses = {
                error: "",
                success: "",
                warning: "",
                info: "",
            };

            if (opt.messagePosition == "toastr") {
                Swal.fire({
                    icon: type,
                    text: msg,

                    toast: true,
                    position: "top-end",
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,

                    customClass: {
                        confirmButton: "btn btn-primary",
                    },
                    showClass: {
                        popup: "swal2-noanimation",
                        backdrop: "swal2-noanimation",
                    },
                });
            } else if (opt.messagePosition == "pop") {
                Swal.fire({
                    icon: type,
                    text: msg,

                    customClass: {
                        confirmButton: "btn btn-primary",
                    },
                    showClass: {
                        popup: "swal2-noanimation",
                        backdrop: "swal2-noanimation",
                    },
                    buttonsStyling: false,
                });
            } else {
                var ele = $(opt.container).find("#alert");
                var html =
                    '<div class="alert alert-' +
                    typeClasses[type] +
                    '">' +
                    msg +
                    "</div>";
                if (ele.length == 0) {
                    $(opt.container)
                        .find(".form-group:first")
                        .before('<div id="alert">' + html + "</div>");
                } else {
                    ele.html(html);
                }
            }
        }

        // Execute ajax request
        if (opt.type == "DELETE" || opt.sweetAlert) {
            showSweetAlert(opt.buttonSelector);
        } else {
            loadAjax();
        }

        function loadAjax() {
            //set post data based on file object //if file upload is set to true then it will set to formdata format
            var post_data = {};
            if (typeof opt.data !== "undefined" && Object.keys(opt.data).length > 0) {
                post_data = opt.data;
            } else {
                if (opt.file == true) {

                    var data = new FormData($(opt.container)[0]);
                    var keys = Object.keys(opt.data);

                    for (var i = 0; i < keys.length; i++) {
                        data.append(keys[i], opt.data[keys[i]]);
                    }

                    post_data = data;
                } else {
                    post_data = $(opt.container).serializeArray();
                }
            }

            $.ajax({
                type: opt.type,
                async: opt.async,
                url: opt.url ? opt.url : $(opt.container).prop("action"),
                dataType: opt.dataType,
                headers: {
                    "X-CSRF-TOKEN": opt.csrfToken,
                },
                data: post_data,
                beforeSend: opt.beforeSend,
                contentType: opt.file
                    ? false
                    : "application/x-www-form-urlencoded; charset=UTF-8",
                processData: !opt.file,
                error: opt.error,
                complete: opt.complete,
                cache: false,
                success: function (response) {
                    if (typeof response !== "undefined") {
                        // Show success message
                        if (typeof opt.success == "function") {
                            opt.success(response);
                        } else {
                            if (response.success) {
                                if (typeof response.redirect_url != "undefined") {
                                    window.location.href = response.redirect_url;
                                }
                                if (opt.redirect) {
                                    if (response.url) {
                                        window.location.href = response.url;
                                    }
                                }
                                if (response.data) {
                                    if (opt.appendHtml) {
                                        $(opt.appendHtml).html(
                                            response.data
                                        );
                                    }
                                }
                                if (opt.showModal) {
                                    $(opt.showModal).modal("show");
                                }
                                if (opt.formReset == true) {
                                    $(opt.container)[0].reset();
                                }
                                if (opt.reload) {
                                    window.location.reload();
                                }
                                if (opt.datatable) {
                                    opt.datatable.draw();
                                    $('.modal').modal("hide");
                                    $.showToastr(response.success, "success");
                                }
                                if (opt.isSuccessToast) {
                                    $.showToastr(response.success, "success");
                                }
                            }
                            if (response.error) {
                                if (typeof response.error != "undefined") {
                                    $.showToastr(response.error, "error");
                                }
                            }
                            if (response.info) {
                                if (typeof response.info != "undefined") {
                                    $.showToastr(response.info, "info");
                                }
                            }
                        }
                        if (opt.type == "DELETE" || opt.sweetAlert) {
                            $(".sweet-alert .confirm")
                                .removeClass("is-loading")
                                .prop("disabled", false);
                        }
                    }
                },
            });
        }

        function loadingButton(selector) {
            var button = $(opt.container).find(selector);

            button.prepend('<span class="spinner-border me-1" role="status" aria-hidden="true"></span>');
            button.prop("disabled", true);
        }

        function unloadingButton(selector) {
            var button = $(opt.container).find(selector);

            button.children("span.spinner-border").remove();
            button.prop("disabled", false);
        }

        function blockPopupClose(selector) {
            var $modal = $(selector);
            var keyboard = false; // Prevent to close by ESC
            var backdrop = "static"; // Prevent to close on click outside the modal

            if (typeof $modal.data("bs.modal") === "undefined") {
                // Modal did not open yet
                $modal.modal({
                    keyboard: keyboard,
                    backdrop: backdrop,
                });
            } else {
                // Modal has already been opened
                $modal.data("bs.modal")._config.keyboard = keyboard;
                $modal.data("bs.modal")._config.backdrop = backdrop;

                if (keyboard === false) {
                    $modal.off("keydown.dismiss.bs.modal"); // Disable ESC
                } else {
                    //
                    $modal.data("bs.modal").escape(); // Resets ESC
                }
            }
        }

        function unblockPopupClose(selector) {
            var $modal = $(selector);
            var keyboard = true; // Prevent to close by ESC
            var backdrop = false; // Prevent to close on click outside the modal

            if (typeof $modal.data("bs.modal") === "undefined") {
                // Modal did not open yet
                $modal.modal({
                    keyboard: keyboard,
                    backdrop: backdrop,
                });
            } else {
                // Modal has already been opened
                $modal.data("bs.modal")._config.keyboard = keyboard;
                $modal.data("bs.modal")._config.backdrop = backdrop;
            }
        }
    };

    function handleFail(response, opt) {
        if (typeof response.message != "undefined" && response.message != "") {
            $.showToastr(response.message, "error");
        } else {
            $.showToastr(
                "A server side error occurred. Please try again after sometime.",
                "error"
            );
        }

        if (typeof response.errors != "undefined") {
            var keys = Object.keys(response.errors);

            $(opt.container).find(".invalid-feedback").remove();
            $(opt.container).find(".is-invalid").removeClass("is-invalid");

            if (opt.errorPosition == "field") {
                for (var i = 0; i < keys.length; i++) {
                    // Escape dot that comes with error in array fields
                    var key = keys[i].replace(".", "\\.");
                    var formarray = keys[i];
                    // If the response has form array
                    if (formarray.indexOf(".") > 0) {
                        var array = formarray.split(".");
                        response.errors[keys[i]] = response.errors[keys[i]];
                        key = array[0] + "[]";
                    }

                    var ele = $(opt.container).find("[name='" + key + "']");

                    // If cannot find by name, then find by id
                    if (ele.length == 0) {
                        ele = $(opt.container).find("#" + key);
                    }

                    if (ele.closest(".inp-group").length == 0) {
                        var grp = ele.closest(".form-group");
                    } else {
                        var grp = ele.closest(".inp-group");
                    }
                    $(grp).find(".invalid-feedback").remove();

                    // var helpBlockContainer = $(grp).find("div:first");
                    if ($(ele).is(":radio")) {
                        helpBlockContainer = $(grp).find("div:eq(2)");
                    }

                    // if (helpBlockContainer.length == 0) {
                    //     helpBlockContainer = $(grp);
                    // }

                    var helpBlockContainer = $(grp);

                    helpBlockContainer.append(
                        '<div class="invalid-feedback">' +
                        response.errors[keys[i]] +
                        "</div>"
                    );
                    ele.addClass("is-invalid");

                    $(grp).find(".select2").parent().addClass("is-invalid");
                    $(grp).find(".bootstrap-select").addClass("is-invalid");
                }

                if (keys.length > 0) {
                    var element = $("[name='" + keys[0] + "']");
                    if (element.length > 0) {
                        $("html, body").animate(
                            { scrollTop: element.offset().top - 150 },
                            200
                        );
                    }
                }
            } else {
                var errorMsg = "<ul>";
                for (var i = 0; i < keys.length; i++) {
                    errorMsg += "<li>" + response.errors[keys[i]] + "</li>";
                }
                errorMsg += "</ul>";

                var errorElement = $(opt.container).find("#alert");
                var html =
                    '<div class="alert alert-danger">' + errorMsg + "</div>";
                if (errorElement.length == 0) {
                    $(opt.container)
                        .find(".form-group:first")
                        .before('<div id="alert">' + html + "</div>");
                } else {
                    errorElement.html(html);
                }
            }
        }
    }

    $.easyBlockUI = function (container, message) {
        if (message != '') {
            message = '<div class="d-flex justify-content-center"><p class="mb-0">'+message+'</p> <div class="sk-wave m-0"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div> </div>';
        }else{
            message = '<div class="spinner-border text-white" role="status"></div>';
        }

        if (container != undefined) {
            // element blocking
            var el = $(container);
            var centerY = false;
            if (el.height() <= $(window).height()) {
                centerY = true;
            }
            el.block({
                message: message,
                baseZ: 999999,
                centerX: true,
                centerY: centerY,
                css: {
                    backgroundColor: 'transparent',
                    border: '0'
                },
                overlayCSS: {
                    opacity: 0.5,
                    cursor: "wait",
                }
            });
        } else {
            // page blocking
            $.blockUI({
                message: '<div class="spinner-border text-white" role="status"></div>',
                baseZ: 999999,
                css: {
                    backgroundColor: 'transparent',
                    border: '0'
                },
                overlayCSS: {
                    opacity: 0.5,
                    cursor: "wait",
                }
            });
        }
    };

    $.easyUnblockUI = function (container) {
        $(container).unblock();

        $.unblockUI();
    };

    $.showToastr = function (toastrMessage, toastrType, options) {
        var defaults = {
            closeButton: false,
            debug: false,
            positionClass: "toast-top-right",
            onclick: null,
            showDuration: "1000",
            hideDuration: "1000",
            timeOut: "5000",
            extendedTimeOut: "1000",
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut",
        };

        var opt = defaults;

        if (typeof options == "object") {
            opt = $.extend(defaults, options);
        }

        toastr.options = opt;

        toastrType = typeof toastrType !== "undefined" ? toastrType : "success";

        toastr[toastrType](toastrMessage);
    };

    $.ajaxModal = function (selector, url, onLoad) {
        $(selector + " .modal-content").load(url);

        $(selector).removeData("bs.modal").modal({
            remote: url,
            show: true,
        });

        // Trigger to do stuff with form loaded in modal
        $(document).trigger("ajaxPageLoad");

        // Call onload method if it was passed in function call
        if (typeof onLoad != "undefined") {
            onLoad();
        }

        // Reset modal when it hides
        $(selector).on("hidden.bs.modal", function () {
            $(this).find(".modal-body").html("Loading...");
            $(this)
                .find(".modal-footer")
                .html(
                    '<button type="button" data-dismiss="modal" class="btn dark btn-outline">Cancel</button>'
                );
            $(this).data("bs.modal", null);
        });
    };

    $.showErrors = function (object) {
        var keys = Object.keys(object);

        $(".invalid-feedback").remove();
        $(".is-invalid").removeClass("is-invalid");

        for (var i = 0; i < keys.length; i++) {
            var ele = $("[name='" + keys[i] + "']");
            if (ele.length == 0) {
                ele = $("#" + keys[i]);
            }
            var grp = ele.closest(".form-group");
            $(grp).find(".invalid-feedback").remove();
            // var helpBlockContainer = $(grp).find("div:first");

            // if (helpBlockContainer.length == 0) {
            //     helpBlockContainer = $(grp);
            // }
            var helpBlockContainer = $(grp);
            console.log(helpBlockContainer);

            helpBlockContainer.append(
                '<div class="invalid-feedback">' + object[keys[i]] + "</div>"
            );
            ele.addClass("is-invalid");
        }
    };
})(jQuery);

//history pushstate
const historyPush = (url) => {
    window.history.pushState({ id: url }, url, url);
};

// when session expire then it reload user to login page
$(document).ajaxError(function (event, jqxhr, settings, thrownError) {
    if (jqxhr.status == 401) {
        window.location.reload();
    }
});

// Prevent submit of ajax form
$(document).on("click", ".sweet-alert .confirm", function (e) {
    $(".sweet-alert .confirm").addClass("is-loading").prop("disabled", true);
});
$(document).on("ready", function () {
    $(".ajax-form").on("submit", function (e) {
        e.preventDefault();
    });
});
$(document).on("ajaxPageLoad", function () {
    $(".ajax-form").on("submit", function (e) {
        e.preventDefault();
    });
});

!(function () {
    "use strict";
    function e(e) {
        function t(t, n) {
            var s,
                h,
                k = t == window,
                y = n && void 0 !== n.message ? n.message : void 0;
            if (
                ((n = e.extend({}, e.blockUI.defaults, n || {})),
                    !n.ignoreIfBlocked || !e(t).data("blockUI.isBlocked"))
            ) {
                if (
                    ((n.overlayCSS = e.extend(
                        {},
                        e.blockUI.defaults.overlayCSS,
                        n.overlayCSS || {}
                    )),
                        (s = e.extend({}, e.blockUI.defaults.css, n.css || {})),
                        n.onOverlayClick && (n.overlayCSS.cursor = "pointer"),
                        (h = e.extend(
                            {},
                            e.blockUI.defaults.themedCSS,
                            n.themedCSS || {}
                        )),
                        (y = void 0 === y ? n.message : y),
                        k && p && o(window, { fadeOut: 0 }),
                        y && "string" != typeof y && (y.parentNode || y.jquery))
                ) {
                    var m = y.jquery ? y[0] : y,
                        v = {};
                    e(t).data("blockUI.history", v),
                        (v.el = m),
                        (v.parent = m.parentNode),
                        (v.display = m.style.display),
                        (v.position = m.style.position),
                        v.parent && v.parent.removeChild(m);
                }
                e(t).data("blockUI.onUnblock", n.onUnblock);
                var g,
                    I,
                    w,
                    U,
                    x = n.baseZ;
                (g = e(
                    r || n.forceIframe
                        ? '<iframe class="blockUI" style="z-index:' +
                        x++ +
                        ';display:none;border:none;margin:0;padding:0;position:absolute;width:100%;height:100%;top:0;left:0" src="' +
                        n.iframeSrc +
                        '"></iframe>'
                        : '<div class="blockUI" style="display:none"></div>'
                )),
                    (I = e(
                        n.theme
                            ? '<div class="blockUI blockOverlay ui-widget-overlay" style="z-index:' +
                            x++ +
                            ';display:none"></div>'
                            : '<div class="blockUI blockOverlay" style="z-index:' +
                            x++ +
                            ';display:none;border:none;margin:0;padding:0;width:100%;height:100%;top:0;left:0"></div>'
                    )),
                    n.theme && k
                        ? ((U =
                            '<div class="blockUI ' +
                            n.blockMsgClass +
                            ' blockPage ui-dialog ui-widget ui-corner-all" style="z-index:' +
                            (x + 10) +
                            ';display:none;position:fixed">'),
                            n.title &&
                            (U +=
                                '<div class="ui-widget-header ui-dialog-titlebar ui-corner-all blockTitle">' +
                                (n.title || "&nbsp;") +
                                "</div>"),
                            (U +=
                                '<div class="ui-widget-content ui-dialog-content"></div>'),
                            (U += "</div>"))
                        : n.theme
                            ? ((U =
                                '<div class="blockUI ' +
                                n.blockMsgClass +
                                ' blockElement ui-dialog ui-widget ui-corner-all" style="z-index:' +
                                (x + 10) +
                                ';display:none;position:absolute">'),
                                n.title &&
                                (U +=
                                    '<div class="ui-widget-header ui-dialog-titlebar ui-corner-all blockTitle">' +
                                    (n.title || "&nbsp;") +
                                    "</div>"),
                                (U +=
                                    '<div class="ui-widget-content ui-dialog-content"></div>'),
                                (U += "</div>"))
                            : (U = k
                                ? '<div class="blockUI ' +
                                n.blockMsgClass +
                                ' blockPage" style="z-index:' +
                                (x + 10) +
                                ';display:none;position:fixed"></div>'
                                : '<div class="blockUI ' +
                                n.blockMsgClass +
                                ' blockElement" style="z-index:' +
                                (x + 10) +
                                ';display:none;position:absolute"></div>'),
                    (w = e(U)),
                    y &&
                    (n.theme
                        ? (w.css(h), w.addClass("ui-widget-content"))
                        : w.css(s)),
                    n.theme || I.css(n.overlayCSS),
                    I.css("position", k ? "fixed" : "absolute"),
                    (r || n.forceIframe) && g.css("opacity", 0);
                var C = [g, I, w],
                    S = e(k ? "body" : t);
                e.each(C, function () {
                    this.appendTo(S);
                }),
                    n.theme &&
                    n.draggable &&
                    e.fn.draggable &&
                    w.draggable({
                        handle: ".ui-dialog-titlebar",
                        cancel: "li",
                    });
                var O =
                    f &&
                    (!e.support.boxModel ||
                        e("object,embed", k ? null : t).length > 0);
                if (u || O) {
                    if (
                        (k &&
                            n.allowBodyStretch &&
                            e.support.boxModel &&
                            e("html,body").css("height", "100%"),
                            (u || !e.support.boxModel) && !k)
                    )
                        var E = d(t, "borderTopWidth"),
                            T = d(t, "borderLeftWidth"),
                            M = E ? "(0 - " + E + ")" : 0,
                            B = T ? "(0 - " + T + ")" : 0;
                    e.each(C, function (e, t) {
                        var o = t[0].style;
                        if (((o.position = "absolute"), 2 > e))
                            k
                                ? o.setExpression(
                                    "height",
                                    "Math.max(document.body.scrollHeight, document.body.offsetHeight) - (jQuery.support.boxModel?0:" +
                                    n.quirksmodeOffsetHack +
                                    ') + "px"'
                                )
                                : o.setExpression(
                                    "height",
                                    'this.parentNode.offsetHeight + "px"'
                                ),
                                k
                                    ? o.setExpression(
                                        "width",
                                        'jQuery.support.boxModel && document.documentElement.clientWidth || document.body.clientWidth + "px"'
                                    )
                                    : o.setExpression(
                                        "width",
                                        'this.parentNode.offsetWidth + "px"'
                                    ),
                                B && o.setExpression("left", B),
                                M && o.setExpression("top", M);
                        else if (n.centerY)
                            k &&
                                o.setExpression(
                                    "top",
                                    '(document.documentElement.clientHeight || document.body.clientHeight) / 2 - (this.offsetHeight / 2) + (blah = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "px"'
                                ),
                                (o.marginTop = 0);
                        else if (!n.centerY && k) {
                            var i =
                                n.css && n.css.top
                                    ? parseInt(n.css.top, 10)
                                    : 0,
                                s =
                                    "((document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + " +
                                    i +
                                    ') + "px"';
                            o.setExpression("top", s);
                        }
                    });
                }
                if (
                    (y &&
                        (n.theme
                            ? w.find(".ui-widget-content").append(y)
                            : w.append(y),
                            (y.jquery || y.nodeType) && e(y).show()),
                        (r || n.forceIframe) && n.showOverlay && g.show(),
                        n.fadeIn)
                ) {
                    var j = n.onBlock ? n.onBlock : c,
                        H = n.showOverlay && !y ? j : c,
                        z = y ? j : c;
                    n.showOverlay && I._fadeIn(n.fadeIn, H),
                        y && w._fadeIn(n.fadeIn, z);
                } else
                    n.showOverlay && I.show(),
                        y && w.show(),
                        n.onBlock && n.onBlock.bind(w)();
                if (
                    (i(1, t, n),
                        k
                            ? ((p = w[0]),
                                (b = e(n.focusableElements, p)),
                                n.focusInput && setTimeout(l, 20))
                            : a(w[0], n.centerX, n.centerY),
                        n.timeout)
                ) {
                    var W = setTimeout(function () {
                        k ? e.unblockUI(n) : e(t).unblock(n);
                    }, n.timeout);
                    e(t).data("blockUI.timeout", W);
                }
            }
        }
        function o(t, o) {
            var s,
                l = t == window,
                a = e(t),
                d = a.data("blockUI.history"),
                c = a.data("blockUI.timeout");
            c && (clearTimeout(c), a.removeData("blockUI.timeout")),
                (o = e.extend({}, e.blockUI.defaults, o || {})),
                i(0, t, o),
                null === o.onUnblock &&
                ((o.onUnblock = a.data("blockUI.onUnblock")),
                    a.removeData("blockUI.onUnblock"));
            var r;
            (r = l
                ? e("body").children().filter(".blockUI").add("body > .blockUI")
                : a.find(">.blockUI")),
                o.cursorReset &&
                (r.length > 1 && (r[1].style.cursor = o.cursorReset),
                    r.length > 2 && (r[2].style.cursor = o.cursorReset)),
                l && (p = b = null),
                o.fadeOut
                    ? ((s = r.length),
                        r.stop().fadeOut(o.fadeOut, function () {
                            0 === --s && n(r, d, o, t);
                        }))
                    : n(r, d, o, t);
        }
        function n(t, o, n, i) {
            var s = e(i);
            if (!s.data("blockUI.isBlocked")) {
                t.each(function () {
                    this.parentNode && this.parentNode.removeChild(this);
                }),
                    o &&
                    o.el &&
                    ((o.el.style.display = o.display),
                        (o.el.style.position = o.position),
                        (o.el.style.cursor = "default"),
                        o.parent && o.parent.appendChild(o.el),
                        s.removeData("blockUI.history")),
                    s.data("blockUI.static") && s.css("position", "static"),
                    "function" == typeof n.onUnblock && n.onUnblock(i, n);
                var l = e(document.body),
                    a = l.width(),
                    d = l[0].style.width;
                l.width(a - 1).width(a), (l[0].style.width = d);
            }
        }
        function i(t, o, n) {
            var i = o == window,
                l = e(o);
            if (
                (t || ((!i || p) && (i || l.data("blockUI.isBlocked")))) &&
                (l.data("blockUI.isBlocked", t),
                    i && n.bindEvents && (!t || n.showOverlay))
            ) {
                var a =
                    "mousedown mouseup keydown keypress keyup touchstart touchend touchmove";
                t ? e(document).bind(a, n, s) : e(document).unbind(a, s);
            }
        }
        function s(t) {
            if (
                "keydown" === t.type &&
                t.keyCode &&
                9 == t.keyCode &&
                p &&
                t.data.constrainTabKey
            ) {
                var o = b,
                    n = !t.shiftKey && t.target === o[o.length - 1],
                    i = t.shiftKey && t.target === o[0];
                if (n || i)
                    return (
                        setTimeout(function () {
                            l(i);
                        }, 10),
                        !1
                    );
            }
            var s = t.data,
                a = e(t.target);
            return (
                a.hasClass("blockOverlay") &&
                s.onOverlayClick &&
                s.onOverlayClick(t),
                a.parents("div." + s.blockMsgClass).length > 0
                    ? !0
                    : 0 === a.parents().children().filter("div.blockUI").length
            );
        }
        function l(e) {
            if (b) {
                var t = b[e === !0 ? b.length - 1 : 0];
                t && t.focus();
            }
        }
        function a(e, t, o) {
            var n = e.parentNode,
                i = e.style,
                s =
                    (n.offsetWidth - e.offsetWidth) / 2 -
                    d(n, "borderLeftWidth"),
                l =
                    (n.offsetHeight - e.offsetHeight) / 2 -
                    d(n, "borderTopWidth");
            t && (i.left = s > 0 ? s + "px" : "0"),
                o && (i.top = l > 0 ? l + "px" : "0");
        }
        function d(t, o) {
            return parseInt(e.css(t, o), 10) || 0;
        }
        e.fn._fadeIn = e.fn.fadeIn;
        var c = e.noop || function () { },
            r = /MSIE/.test(navigator.userAgent),
            u =
                /MSIE 6.0/.test(navigator.userAgent) &&
                !/MSIE 8.0/.test(navigator.userAgent),
            f =
                (document.documentMode || 0,
                    e.isFunction(
                        document.createElement("div").style.setExpression
                    ));
        (e.blockUI = function (e) {
            t(window, e);
        }),
            (e.unblockUI = function (e) {
                o(window, e);
            }),
            (e.growlUI = function (t, o, n, i) {
                var s = e('<div class="growlUI"></div>');
                t && s.append("<h1>" + t + "</h1>"),
                    o && s.append("<h2>" + o + "</h2>"),
                    void 0 === n && (n = 3e3);
                var l = function (t) {
                    (t = t || {}),
                        e.blockUI({
                            message: s,
                            fadeIn:
                                "undefined" != typeof t.fadeIn ? t.fadeIn : 700,
                            fadeOut:
                                "undefined" != typeof t.fadeOut
                                    ? t.fadeOut
                                    : 1e3,
                            timeout:
                                "undefined" != typeof t.timeout ? t.timeout : n,
                            centerY: !1,
                            showOverlay: !1,
                            onUnblock: i,
                            css: e.blockUI.defaults.growlCSS,
                        });
                };
                l();
                s.css("opacity");
                s.mouseover(function () {
                    l({ fadeIn: 0, timeout: 3e4 });
                    var t = e(".blockMsg");
                    t.stop(), t.fadeTo(300, 1);
                }).mouseout(function () {
                    e(".blockMsg").fadeOut(1e3);
                });
            }),
            (e.fn.block = function (o) {
                if (this[0] === window) return e.blockUI(o), this;
                var n = e.extend({}, e.blockUI.defaults, o || {});
                return (
                    this.each(function () {
                        var t = e(this);
                        (n.ignoreIfBlocked && t.data("blockUI.isBlocked")) ||
                            t.unblock({ fadeOut: 0 });
                    }),
                    this.each(function () {
                        "static" == e.css(this, "position") &&
                            ((this.style.position = "relative"),
                                e(this).data("blockUI.static", !0)),
                            (this.style.zoom = 1),
                            t(this, o);
                    })
                );
            }),
            (e.fn.unblock = function (t) {
                return this[0] === window
                    ? (e.unblockUI(t), this)
                    : this.each(function () {
                        o(this, t);
                    });
            }),
            (e.blockUI.version = 2.7),
            (e.blockUI.defaults = {
                message: "<h1>Please wait...</h1>",
                title: null,
                draggable: !0,
                theme: !1,
                css: {
                    padding: 0,
                    margin: 0,
                    width: "30%",
                    top: "40%",
                    left: "35%",
                    textAlign: "center",
                    color: "#000",
                    border: "3px solid #aaa",
                    backgroundColor: "#fff",
                    cursor: "wait",
                },
                themedCSS: { width: "30%", top: "40%", left: "35%" },
                overlayCSS: {
                    backgroundColor: "#000",
                    opacity: 0.6,
                    cursor: "wait",
                },
                cursorReset: "default",
                growlCSS: {
                    width: "350px",
                    top: "10px",
                    left: "",
                    right: "10px",
                    border: "none",
                    padding: "5px",
                    opacity: 0.6,
                    cursor: "default",
                    color: "#fff",
                    backgroundColor: "#000",
                    "-webkit-border-radius": "10px",
                    "-moz-border-radius": "10px",
                    "border-radius": "10px",
                },
                iframeSrc: /^https/i.test(window.location.href || "")
                    ? "javascript:false"
                    : "about:blank",
                forceIframe: !1,
                baseZ: 1e3,
                centerX: !0,
                centerY: !0,
                allowBodyStretch: !0,
                bindEvents: !0,
                constrainTabKey: !0,
                fadeIn: 200,
                fadeOut: 400,
                timeout: 0,
                showOverlay: !0,
                focusInput: !0,
                focusableElements: ":input:enabled:visible",
                onBlock: null,
                onUnblock: null,
                onOverlayClick: null,
                quirksmodeOffsetHack: 4,
                blockMsgClass: "blockMsg",
                ignoreIfBlocked: !1,
            });
        var p = null,
            b = [];
    }
    "function" == typeof define && define.amd && define.amd.jQuery
        ? define(["jquery"], e)
        : e(jQuery);
})();
