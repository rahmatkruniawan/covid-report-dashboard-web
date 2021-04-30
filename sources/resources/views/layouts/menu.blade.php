<li class="nav-item">
    <a class="nav-link" href="{{route('user')}}"><i class="bx bx-user"></i><span data-i18n="Data Petugas">Data Petugas</span></a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{route('report')}}"><i class="bx bx-list-ul"></i><span data-i18n="Daftar Laporan">Daftar Laporan</span></a>
</li>
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
