(function(App, $) {
    
    "use strict";
    
    App.functions = App.functions || {};
    
    var fn = App.functions,
        $document = App.$document,
        routes = App.routes;
    
    fn.ajaxFileUpload = {
        onDomReady: true,
        _config: {
            inputSelector: 'input.ajax-file-upload',
            dataType: "json"
        },
        _setConfig: function(config) {
            if (typeof config !== "undefined") {
                $.extend(this._config, config);
            }
        },
        _setCurrentSelectors: function(thisInput) {
            var obj = this;
            obj._config._fileInput = thisInput;
            obj._config._fileType = thisInput.data('type');
            obj._config._progressElement = thisInput.prev('.upload-progress');
            obj._config._form = thisInput.parents('form');
            obj._config._submitBtn = obj._config._form.find('button[type="submit"]');
            obj._config._previewContainer = $('#' + thisInput.data('preview-container'));
            obj._config._imgElement = obj._config._previewContainer.find('img');
            obj._config._linkElement = obj._config._previewContainer.find('a');
            obj._config._pathInput = obj._config._previewContainer.find('input[type="hidden"]');
        },
        _change: function(event, data) {
            var obj = this;
            obj._config._submitBtn.prop('disabled', true);
        },
        _progress: function(event, data) {
            var obj = this,
                progress = parseInt(data.loaded / data.total * 100, 10);
            obj._config._progressElement.text(progress + '%');
        },
        _success: function(event, data) {
            var obj = this,
                response = data.result;
            obj._config._pathInput.val(response.filePath);
            obj._config._progressElement.empty();
            obj._config._submitBtn.prop('disabled', false);
            if (obj._config._fileType === 'image') {
                if (obj._config._imgElement.length) {
                    obj._config._imgElement.attr('src', routes.baseURL + '/' + response.filePath);
                } else {
                    obj._config._previewContainer.prepend('<img class="materialboxed" src="' + routes.baseURL + '/' + response.filePath + '" alt="Featured Image" />');
                    $document.trigger('refreshMaterialBox');
                }
            } else {
                if (obj._config._linkElement.length) {
                    obj._config._linkElement.attr('href', routes.baseURL + '/' + response.filePath);
                } else {
                    obj._config._previewContainer.prepend('<a href="' + routes.baseURL + '/' + response.filePath + '" target="_blank">View File</a>');
                }
            }
        },
        _error: function(event, data) {
            var obj = this,
                error = data._response.jqXHR;
            obj._config._progressElement.empty();
            obj._config._submitBtn.prop('disabled', false);
            alert(error.responseText);
        },
        init: function(params) {
            var obj = this;
            obj._setConfig(params);
            $(obj._config.inputSelector).each(function() {
                var $this = $(this);
                $this.fileupload({
                    dataType: obj._config.dataType,
                    change: function(event, data) {
                        obj._setCurrentSelectors($this);
                        obj._change(event, data);
                    },
                    progressall: function(event, data) {
                        obj._progress(event, data);
                    },
                    done: function(event, data) {
                        obj._success(event, data);
                    },
                    fail: function(event, data) {
                        obj._error(event, data);
                    }
                });
            });
        }
    };
    
})(App, jQuery);
