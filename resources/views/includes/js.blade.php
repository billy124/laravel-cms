<script type="text/javascript" src="{{ asset(elixir('js/libs.js')) }}"></script>
<script type="text/javascript" src="{{ asset(elixir('js/app.js')) }}"></script>

<script type="text/javascript" src="{{ asset('js/jquery.cookie.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.imgpreload.min.js') }}"></script>

<script type="text/javascript" src="{{ asset('js/jquery.ui.touch-punch.min.js') }}"></script>

<script type="text/javascript">
    App.config.csrfToken = "{{ csrf_token() }}";
    App.routes.baseURL = "{{ route('view.index') }}";
    App.isAuthUser = "{{ isAuthenticUser() }}";
    App.run();
</script>