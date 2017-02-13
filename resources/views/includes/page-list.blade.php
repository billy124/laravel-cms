@if(count($pages) > 0)
    @if(!isset($hideHeader) || $hideHeader === true)
    <li class="dropdown {{ isActiveRoute('view.cms.page', 'active') }}">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages <span class="caret"></span></a>
    @endif

        <ul class="dropdown-menu">
            @foreach($pages as $page)
            <li class="{{ isActivePaths($page->slug, 'active') }}">
                <a href="{{ route('view.cms.page', $page->slug) }}">{{ $page->title }}</a>
                @if(count($page->children) > 0)
                    @include('includes.page-list', ['pages' => $page->children, 'hideHeader' => true])
                @endif
            </li>
            @endforeach
        </ul>

    @if(!isset($hideHeader) || $hideHeader === true)
    </li>
    @endif
@endif