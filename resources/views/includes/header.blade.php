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
            <a class="navbar-brand" href="{{ route('view.index') }}">{{ config('app.name') }}</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{{ isActiveRoute('view.index', 'active') }}"><a href="{{ route('view.index') }}">Home</a></li>
                <li class="{{ isActiveRoute('view.contact.us', 'active') }}"><a href="{{ route('view.contact.us') }}">Contact us</a></li>
                {!! getCmsPageNav() !!}
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (!isAuthenticUser())
                <li><a href="{{ url('/login') }}">Login</a></li>
                <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ getAuthenticatedUser()->getFullName() }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        @if(hasRole('admin'))
                        <li class="{{ isActiveRoute('view.admin.dashboard', 'active') }}"><a href="{{ route('view.admin.dashboard') }}">Admin</a></li>
                        @endif
                        <li>
                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

@include('includes.flash')