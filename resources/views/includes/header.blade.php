<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('view.index') }}">Simple CMS</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{{ isActiveRoute('view.index', 'active') }}"><a href="{{ route('view.index') }}">Home</a></li>
                <li class="{{ isActiveRoute('view.contact.us', 'active') }}"><a href="{{ route('view.contact.us') }}">Contact us</a></li>
                <li class="dropdown {{ isActiveRoute('view.cms.page', 'active') }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages <span class="caret"></span></a>
                    {!! getCmsPageNav() !!}
                </li>
                @if(hasRole('admin'))
                <li class="{{ isActiveRoute('view.contact.us', 'active') }}"><a href="{{ route('view.contact.us') }}">Admin</a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>