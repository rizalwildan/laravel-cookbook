<?php $menus = Menu::get('sidebar')->roots(); ?>
<div class="sidebar">
    <nav class="sidebar-nav ps ps--active-y">
        <ul class="nav">
            <li class="nav-title">Dashboard</li>
            @foreach($menus as $items)
                @if($items->hasChildren())
                    <li class="nav-item nav-dropdown">
                        <a href="#" class="nav-link nav-dropdown-toggle">
                            <i class="{{ $items->attr('icon') }}"></i>
                            {{ $items->title }}
                        </a>
                        <ul class="nav-dropdown-items">
                            @foreach($items->children() as $child)
                            <li class="nav-item">
                                <a href="{{ $child->url() }}" class="nav-link">
                                    <i class="nav-icon cui-puzzle"></i> {{ $child->title }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                <li class="nav-item">
                    <a href="{{ $items->url() }}" class="nav-link">{{ $items->title }}</a>
                </li>
                @endif
            @endforeach
        </ul>
    </nav>
</div>