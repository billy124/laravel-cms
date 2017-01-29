(function($, window, document, navigator) {
    
    "use strict";
    
    var App = window.App = {
        window: window,
        document: document,
        navigator: navigator,
        $window: $(window),
        $document: $(document),
        isAuthUser: false,
        config: {
            tinymce: {
                mode: "textareas",
                height: 300,
                plugins: "image, link, media, table, code",
                toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | forecolor backcolor",
                relative_urls: false,
                remove_script_host: false
            },
            elFinder: {
                file: "/elFinder/elfinder.html",
                title: "File Manager",
                width: 900,
                height: 450,
                resizable: "yes"
            }
        },
        device: {
            isMobile: false,
            isTablet: false,
            width: {
                mobile: 768,
                tablet: 992,
                desktop: 1200
            }
        },
        ajaxSetup: {cache: false},
        routes: {},
        functions: {},
        widgets: {},
        run: function() {
            var app = this;
            $(function() {
                $.ajaxSetup(app.config.ajaxSetup);
                for (var index in app.functions) {
                    var func = app.functions[index];
                    if (typeof func.onDomReady !== "undefined" && typeof func.init === "function") {
                        func.init();
                    }
                }
                for (var index in app.widgets) {
                    var widget = app.widgets[index];
                    if (typeof widget.onDomReady !== "undefined" && typeof widget.init === "function") {
                        widget.init();
                    }
                }
            });
        }
    };
    
})(jQuery, window, document, navigator);
