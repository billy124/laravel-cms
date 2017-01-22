<ul class="dropdown-menu">
    @foreach($pages as $page)
    <li class="{{ isActivePaths($page->slug, 'active') }}"><a href="{{ route('view.cms.page', $page->slug) }}">{{ $page->title }}</a></li>
    @endforeach
</ul>