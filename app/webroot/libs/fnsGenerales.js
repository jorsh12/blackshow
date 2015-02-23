define(function () {
    return fnsGenerales = {
        fnAJAX: function (url, type, data, dataType, callBack, cajaLoading, callBackLoading, contentType) {
            if (contentType === null) {
                contentType = "application/x-www-form-urlencoded; charset=UTF-8";
            }
            $.ajax({
                url: url,
                type: type,
                data: data,
                datatype: dataType,
                cache: false,
                processData: false,
                contentType: contentType,
                beforeSend: function (jqXHR, settings) {
                    if ($.type(cajaLoading) !== "undefined") {
                        fnsGenerales.loading(cajaLoading, "");
                    }
                    if ($.type(callBackLoading) === "function") {
                        callBackLoading(true);
                    }
                },
                success: function (response, textStatus, jqXHR) {
                    if (jqXHR.getResponseHeader('REQUIRES_AUTH') === '1') {
                        window.location.href = jqXHR.getResponseHeader('LOCATION');
                    }
                    if ($.type(callBack) === "function") {
                        callBack(response, true);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status !== 200) {
                        //window.location.href = '/ErrorHandle/Error';
                        //console.log(jqXHR);
                    }
                    if ($.type(callBack) === "function") {
                        callBack(jqXHR.responseText, false);
                    }
                },
                complete: function (jqXHR, textStatus) {
                    if ($.type(cajaLoading) !== "undefined") {
                        cajaLoading.html("");
                    }
                    if ($.type(callBackLoading) === "function") {
                        callBackLoading(false);
                    }
                }
            });
        },
        renderPrompt: function (states, ops, callBack) {

            var opts = {
                classes: {
                    box: '',
                    fade: '',
                    prompt: '',
                    close: '',
                    title: 'lead',
                    message: '',
                    buttons: '',
                    button: 'btn',
                    defaultButton: 'btn-primary'
                }
            };

            opts = $.extend(opts, ops);

            $.prompt(states, opts);

            if ($.type(callBack) === "function") {
                callBack();
            }
        },
        convertObj: function (ob) {
            if ($(ob)) {
                return $(ob);
            } else {
                return ob;
            }
        },
        createDateTimePicker: function (ops, ob) {

            var opts = {
                format: 'Y-m-d H:i',
                //startDate: dateTimeFormat,
                maxDate: 0
            };

            opts = $.extend(opts, ops);

            if (ob === null || $.type(ob) === 'undefined') {
                $('[data-type-field="dateTime"]').datetimepicker(opts);
            } else {
                this.convertObj.datetimepicker(opts);
            }
        },
        removeDateTimePicker: function (ob) {

            if (ob === null || $.type(ob) === 'undefined') {
                $('[data-type-field="dateTime"]').datetimepicker('destroy');
            } else {
                this.convertObj.datetimepicker('destroy');
            }

        }
    };
});