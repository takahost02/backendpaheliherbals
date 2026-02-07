@php
    $sideBarLinks = json_decode($sidenav);
@endphp

<div class="sidebar bg--dark">
    <button class="res-sidebar-close-btn">
        <i class="las la-times"></i>
    </button>

    <div class="sidebar__inner">

        {{-- LOGO --}}
        <div class="sidebar__logo">
            <a href="{{ route('admin.dashboard') }}" class="sidebar__main-logo">
                <img src="{{ siteLogo('dark') }}" alt="logo">
            </a>
        </div>

        {{-- MENU --}}
        <div class="sidebar__menu-wrapper">
            <ul class="sidebar__menu">

                {{-- =========================
                   AUTO SIDENAV (JSON / DB)
                ========================== --}}
                @foreach($sideBarLinks as $data)

                    {{-- HEADER --}}
                    @if(!empty($data->header))
                        <li class="sidebar__menu-header">
                            {{ __($data->header) }}
                        </li>
                    @endif

                    {{-- DROPDOWN MENU --}}
                    @if(!empty($data->submenu))
                        <li class="sidebar-menu-item sidebar-dropdown">
                            <a href="javascript:void(0)"
                               class="{{ menuActive($data->menu_active ?? null, 3) }}">
                                <i class="menu-icon {{ $data->icon }}"></i>
                                <span class="menu-title">{{ __($data->title) }}</span>

                                {{-- COUNTER --}}
                                @foreach($data->counters ?? [] as $counter)
                                    @if(isset($$counter) && $$counter > 0)
                                        <span class="menu-badge bg--warning ms-auto">
                                            <i class="fas fa-exclamation"></i>
                                        </span>
                                        @break
                                    @endif
                                @endforeach
                            </a>

                            <div class="sidebar-submenu {{ menuActive($data->menu_active ?? null, 2) }}">
                                <ul>
                                    @foreach($data->submenu as $menu)

                                        @php
                                            $submenuParams = [];
                                            if (!empty($menu->params)) {
                                                foreach ($menu->params as $p) {
                                                    $submenuParams[] = array_values((array)$p)[0];
                                                }
                                            }
                                        @endphp

                                        @if(Route::has($menu->route_name))
                                            <li class="sidebar-menu-item {{ menuActive($menu->menu_active ?? null) }}">
                                                <a href="{{ route($menu->route_name, $submenuParams) }}" class="nav-link">
                                                    <i class="menu-icon las la-dot-circle"></i>
                                                    <span class="menu-title">{{ __($menu->title) }}</span>

                                                    @php $counter = $menu->counter ?? null; @endphp
                                                    @if(isset($$counter) && $$counter > 0)
                                                        <span class="menu-badge bg--info ms-auto">
                                                            {{ $$counter }}
                                                        </span>
                                                    @endif
                                                </a>
                                            </li>
                                        @endif

                                    @endforeach
                                </ul>
                            </div>
                        </li>

                    {{-- SINGLE MENU --}}
                    @else
                        @php
                            $mainParams = [];
                            if (!empty($data->params)) {
                                foreach ($data->params as $p) {
                                    $mainParams[] = array_values((array)$p)[0];
                                }
                            }
                        @endphp

                        @if(Route::has($data->route_name))
                            <li class="sidebar-menu-item {{ menuActive($data->menu_active ?? null) }}">
                                <a href="{{ route($data->route_name, $mainParams) }}" class="nav-link">
                                    <i class="menu-icon {{ $data->icon }}"></i>
                                    <span class="menu-title">{{ __($data->title) }}</span>

                                    @php $counter = $data->counter ?? null; @endphp
                                    @if(isset($$counter) && $$counter > 0)
                                        <span class="menu-badge bg--info ms-auto">
                                            {{ $$counter }}
                                        </span>
                                    @endif
                                </a>
                            </li>
                        @endif
                    @endif

                @endforeach

                {{-- =========================
                   CUSTOM STATIC MENUS
                ========================== --}}

                @if(Route::has('admin.rewards.index'))
<li class="sidebar-menu-item">
    <a href="{{ route('admin.rewards.index') }}">
        <i class="las la-gift"></i>
        <span>@lang('Rewards Income')</span>
    </a>
</li>
@endif


                @if(Route::has('admin.matrix.index'))
                <li class="sidebar-menu-item {{ menuActive('admin.matrix.index') }}">
                    <a href="{{ route('admin.matrix.index') }}">
                        <i class="las la-sitemap"></i>
                        <span>@lang('Matrix Income')</span>
                    </a>
                </li>
                @endif

            </ul>
        </div>
    </div>
</div>

@push('script')
<script>
    const activeItem = document.querySelector('.sidebar__menu .active');
    if (activeItem) {
        document.querySelector('.sidebar__menu-wrapper').scrollTop =
            activeItem.offsetTop - 250;
    }
</script>
@endpush
