@can('security')
<li class="nav-item dropdown" data-menu="dropdown">
    <a onclick="window.location.href = this.getAttribute('href')" class="dropdown-toggle nav-link" href="#"><i class="bx bx-cog"></i><span data-i18n="Security Data">Security Data</span></a>
    <ul class="dropdown-menu">
        @can('user')
        <li >
            <a  class="dropdown-item align-items-center " href="{{route('user')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="User">User</span></a>
        </li>
        @endcan
    </ul>
</li>
@endcan
{{-- @can('master')
<li class="nav-item dropdown" data-menu="dropdown">
    <a onclick="window.location.href = this.getAttribute('href')" class="dropdown-toggle nav-link" href="#"><i class="bx bx-cog"></i><span data-i18n="Master Data">Master Data</span></a>
    <ul class="dropdown-menu">
        @can('city')
        <li >
            <a  class="dropdown-item align-items-center " href="{{route('city')}}"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="City">City</span></a>
        </li>
        @endcan
    </ul>
</li>
@endcan --}}
