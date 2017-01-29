(function(App, $) {
    
    "use strict";
    
    App.functions = App.functions || {};
    
    var fn = App.functions;
    
    fn.ajaxSubmitForm = {
        onDomReady: true,
        _config: {
            formSelector: 'form.ajax-submit',
            btnSelector: 'button.submit-form',
            inputGroupSelector: '.form-field-group',
            validationSelector: '.validation-error',
            alertSelector: '.alert-container',
            errorClass: 'error',
            hiddenClass: 'hidden'
        },
        _setConfig: function(config) {
            if (typeof config !== "undefined") {
                $.extend(this._config, config);
            }
        },
        _setCurrentSelectors: function(btn) {
            var obj = this;
            obj._config._btn = btn;
            obj._config._form = btn.parents(obj._config.formSelector);
        },
        _submit: function() {
            var obj = this,
                form = obj._config._form,
                btn = obj._config._btn;
            btn.prop('disabled', true);
            $.post(form.attr('action'), form.serializeArray(), function(response) {
                obj._handleSuccess(response);
            }).fail(function(error) {
                obj._handleError(error);
            });
        },
        _handleSuccess: function(response) {
            var obj = this,
                $form = obj._config._form,
                $btn = obj._config._btn,
                $alertContainer = $(obj._config.alertSelector);
            $btn.prop('disabled', false);
            obj._clearValidationErrors();
            if ($form.data('submit') === true) {
                $form.submit();
            } else {
                if ($form.data('reset') === true) {
                    $form.trigger('reset');
                }
                $alertContainer.replaceWith(response);
                fn.scrollToElement.init($(obj._config.alertSelector), 0);
            }
        },
        _handleError: function(error) {
            var obj = this,
                btn = obj._config._btn;
            btn.prop('disabled', false);
            if (error.status === 400 || error.status === 422) {
                obj._handleValidationError(error.responseJSON);
            } else {
                alert(error.responseText);
            }
        },
        _handleValidationError: function(errors) {
            var obj = this,
                form = obj._config._form;
            obj._clearValidationErrors();
            for (var index in errors) {
                var $field = form.find('#' + index),
                    errorArray = errors[index],
                    errorText = null;
                for (var i in errorArray) {
                    errorText = (errorText === null) ? errorArray[i] : errorText + "<br />" + errorArray[i];
                }
                obj._addValidationError($field, errorText);
            }
        },
        _clearValidationErrors: function() {
            var obj = this,
                form = obj._config._form;
            form.find(obj._config.inputGroupSelector).removeClass(obj._config.errorClass).find(obj._config.validationSelector).empty().addClass(obj._config.hiddenClass);
        },
        _addValidationError: function(input, errorText) {
            var obj = this;
            input.parents(obj._config.inputGroupSelector).addClass(obj._config.errorClass).find(obj._config.validationSelector).html(errorText).removeClass(obj._config.hiddenClass);
        },
        init: function(params) {
            var obj = this;
            obj._setConfig(params);
            $(obj._config.formSelector).each(function() {
                var $form = $(this),
                    $btn = $form.find(obj._config.btnSelector),
                    $input = $form.find('input');
                $input.bind('keypress', function(event) {
                    if (event.which === 13) {
                        event.preventDefault();
                        $btn.click();
                    }
                });
                $btn.click(function() {
                    obj._setCurrentSelectors($(this));
                    obj._submit();
                });
            });
        }
    };
    
})(App, jQuery);
