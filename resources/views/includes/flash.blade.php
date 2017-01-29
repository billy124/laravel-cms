<div class="alert-container">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{!! $error !!}</li>
            @endforeach
        </ul>
    </div>
    @elseif (session('error'))
    <div class="alert alert-danger">{!! session('error') !!}</div>
    @elseif (isset($flashError))
    <div class="alert alert-danger">{!! $flashError !!}</div>
    @elseif (session('status'))
    <div class="alert alert-success">{!! session('status') !!}</div>
    @elseif (isset($flashStatus))
    <div class="alert alert-success">{!! $flashStatus !!}</div>
    @endif
</div>