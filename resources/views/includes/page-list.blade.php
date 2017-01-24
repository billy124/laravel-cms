<ul class="dropdown-menu">
    @foreach($pages as $page)
    <li class="{{ isActivePaths($page->slug, 'active') }}">
        <a href="{{ route('view.cms.page', $page->slug) }}">{{ $page->title }}</a>
        @if(count($page->children) > 0)
            @include('includes.page-list', ['pages' => $page->children])
        @endif
    </li>
    @endforeach
</ul>