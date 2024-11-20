<aside class="navbar navbar-vertical navbar-expand-lg">
    <div class="container-fluid">
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-brand navbar-brand-autodark">
            <a href=".">
                <img src="./static/smktibazma.svg" height="50" width="200">
            </a>
        </div>
        <div class="navbar-nav flex-row d-lg-none py-2">
            <a class="btn btn-outline-danger btn-icon" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-logout">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                    <path d="M9 12h12l-3 -3" />
                    <path d="M18 15l3 -3" />
                </svg>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        <div class="navbar-collapse collapse" id="sidebar-menu" style="">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
                    <a class="nav-link" href="/">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Home
                        </span>
                    </a>
                </li>
                <li
                    class="nav-item dropdown {{ Route::currentRouteName() == 'tendik' ? 'active' : '' }} {{ Route::currentRouteName() == 'siswa' ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Peserta
                        </span>
                    </a>
                    <div
                        class="dropdown-menu {{ Route::currentRouteName() == 'tendik' ? 'show' : '' }} {{ Route::currentRouteName() == 'siswa' ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ Route::currentRouteName() == 'tendik' ? 'active' : '' }}"
                                    href="tendik">
                                    Tendik
                                </a>
                                <a class="dropdown-item {{ Route::currentRouteName() == 'siswa' ? 'active' : '' }}"
                                    href="siswa">
                                    Siswa
                                </a>
                            </div>
                        </div>
                    </div>
                </li>


                <li class="nav-item dropdown {{ Route::currentRouteName() == 'tendik' ? 'active' : '' }} {{ Route::currentRouteName() == 'siswa' ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Data Card
                        </span>
                    </a>
                    <div class="dropdown-menu {{ Route::currentRouteName() == 'tendik' ? 'show' : '' }} {{ Route::currentRouteName() == 'siswa' ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ Route::currentRouteName() == 'tendik' ? 'active' : '' }}" href="/data-card-tendik">
                                    Tendik
                                </a>
                                <a class="dropdown-item {{ Route::currentRouteName() == 'siswa' ? 'active' : '' }}" href="/data-card-siswa">
                                    Siswa
                                </a>
                                <a class="dropdown-item {{ Route::currentRouteName() == 'siswa' ? 'active' : '' }}" href="/data-card-alert">
                                    Alert
                                </a>
                            </div>
                        </div>
                    </div>
                </li>


                <li class="nav-item {{ str_contains(request()->url(), 'izin') == true ? 'active' : '' }}">
                    <a class="nav-link" href="izin">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-license">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11" />
                                <path d="M9 7l4 0" />
                                <path d="M9 11l4 0" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Izin
                        </span>
                    </a>
                </li>
                <li
                    class="nav-item dropdown {{ Route::currentRouteName() == 'silat' ? 'active' : '' }} {{ Route::currentRouteName() == 'futsal' ? 'active' : '' }} {{ Route::currentRouteName() == 'pramuka' ? 'active' : '' }} {{ Route::currentRouteName() == 'koding' ? 'active' : '' }} {{ Route::currentRouteName() == 'robotik' ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-stretching">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M16 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                <path d="M5 20l5 -.5l1 -2" />
                                <path d="M18 20v-5h-5.5l2.5 -6.5l-5.5 1l1.5 2" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Ekstrakurikuler
                        </span>
                    </a>
                    <div
                        class="dropdown-menu {{ Route::currentRouteName() == 'silat' ? 'show' : '' }} {{ Route::currentRouteName() == 'futsal' ? 'show' : '' }} {{ Route::currentRouteName() == 'pramuka' ? 'show' : '' }} {{ Route::currentRouteName() == 'koding' ? 'show' : '' }} {{ Route::currentRouteName() == 'robotik' ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ Route::currentRouteName() == 'silat' ? 'active' : '' }}"
                                    href="silat">
                                    Silat
                                </a>
                                <a class="dropdown-item {{ Route::currentRouteName() == 'futsal' ? 'active' : '' }}"
                                    href="futsal">
                                    Futsal
                                </a>
                                <a class="dropdown-item {{ Route::currentRouteName() == 'pramuka' ? 'active' : '' }}"
                                    href="pramuka">
                                    Pramuka
                                </a>
                                <a class="dropdown-item {{ Route::currentRouteName() == 'koding' ? 'active' : '' }}"
                                    href="koding">
                                    Koding
                                </a>
                                <a class="dropdown-item {{ Route::currentRouteName() == 'robotik' ? 'active' : '' }}"
                                    href="robotik">
                                    Robotik
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item {{ str_contains(request()->url(), 'jurnal') == true ? 'active' : '' }}">
                    <a class="nav-link" href="jurnal">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-license">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M15 21h-9a3 3 0 0 1 -3 -3v-1h10v2a2 2 0 0 0 4 0v-14a2 2 0 1 1 2 2h-2m2 -4h-11a3 3 0 0 0 -3 3v11" />
                                <path d="M9 7l4 0" />
                                <path d="M9 11l4 0" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            JAK
                        </span>
                    </a>
                </li>
                <li class="nav-item {{ str_contains(request()->url(), 'platform') == true ? 'active' : '' }}">
                    <a class="nav-link" href="platform">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-school">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" />
                                <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            PMM
                        </span>
                    </a>
                </li>
                <li
                    class="nav-item dropdown {{ Route::currentRouteName() == 'rekap-tendik' ? 'active' : '' }} {{ Route::currentRouteName() == 'rekap-siswa' ? 'active' : '' }} {{ str_contains(request()->url(), 'filter') == true ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-user">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 21h-6a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4.5" />
                                <path d="M16 3v4" />
                                <path d="M8 3v4" />
                                <path d="M4 11h16" />
                                <path d="M19 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M22 22a2 2 0 0 0 -2 -2h-2a2 2 0 0 0 -2 2" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Rekap Absen
                        </span>
                    </a>
                    <div
                        class="dropdown-menu {{ Route::currentRouteName() == 'rekap-tendik' ? 'show' : '' }} {{ Route::currentRouteName() == 'rekap-siswa' ? 'show' : '' }} {{ str_contains(request()->url(), 'filter') == true ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ Route::currentRouteName() == 'rekap-tendik' ? 'active' : '' }} {{ str_contains(request()->url(), 'filter-tendik') == true ? 'active' : '' }}"
                                    href="rekap-tendik">
                                    Tendik
                                </a>
                                <a class="dropdown-item {{ Route::currentRouteName() == 'rekap-siswa' ? 'active' : '' }} {{ str_contains(request()->url(), 'filter-siswa') == true ? 'active' : '' }}"
                                    href="rekap-siswa">
                                    Siswa
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li
                    class="nav-item dropdown {{ Route::currentRouteName() == 'rekap-silat' ? 'active' : '' }} {{ Route::currentRouteName() == 'rekap-futsal' ? 'active' : '' }} {{ Route::currentRouteName() == 'rekap-pramuka' ? 'active' : '' }} {{ Route::currentRouteName() == 'rekap-koding' ? 'active' : '' }} {{ Route::currentRouteName() == 'rekap-robotik' ? 'active' : '' }} {{ str_contains(request()->url(), 'filter') == true ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-bolt">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M13.5 21h-7.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v5" />
                                <path d="M16 3v4" />
                                <path d="M8 3v4" />
                                <path d="M4 11h16" />
                                <path d="M19 16l-2 3h4l-2 3" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Rekap Ekstrakurikuler
                        </span>
                    </a>
                    <div
                        class="dropdown-menu {{ Route::currentRouteName() == 'rekap-silat' ? 'show' : '' }} {{ Route::currentRouteName() == 'rekap-futsal' ? 'show' : '' }} {{ Route::currentRouteName() == 'rekap-pramuka' ? 'show' : '' }} {{ Route::currentRouteName() == 'rekap-koding' ? 'show' : '' }} {{ Route::currentRouteName() == 'rekap-robotik' ? 'show' : '' }} {{ str_contains(request()->url(), 'filter') == true ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a class="dropdown-item {{ Route::currentRouteName() == 'rekap-silat' ? 'active' : '' }} {{ str_contains(request()->url(), 'filter-silat') == true ? 'active' : '' }}"
                                    href="rekap-silat">
                                    Silat
                                </a>
                                <a class="dropdown-item {{ Route::currentRouteName() == 'rekap-futsal' ? 'active' : '' }} {{ str_contains(request()->url(), 'filter-siswa') == true ? 'active' : '' }}"
                                    href="rekap-futsal">
                                    Futsal
                                </a>
                                <a class="dropdown-item {{ Route::currentRouteName() == 'rekap-pramuka' ? 'active' : '' }} {{ str_contains(request()->url(), 'filter-siswa') == true ? 'active' : '' }}"
                                    href="rekap-pramuka">
                                    Pramuka
                                </a>
                                <a class="dropdown-item {{ Route::currentRouteName() == 'rekap-koding' ? 'active' : '' }} {{ str_contains(request()->url(), 'filter-siswa') == true ? 'active' : '' }}"
                                    href="rekap-koding">
                                    Koding
                                </a>
                                <a class="dropdown-item {{ Route::currentRouteName() == 'rekap-robotik' ? 'active' : '' }} {{ str_contains(request()->url(), 'filter-siswa') == true ? 'active' : '' }}"
                                    href="rekap-robotik">
                                    Robotik
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item {{ str_contains(request()->url(), 'rekap-jak') == true ? 'active' : '' }}">
                    <a class="nav-link" href="rekap-jak">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-stats">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" />
                                <path d="M18 14v4h4" />
                                <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M15 3v4" />
                                <path d="M7 3v4" />
                                <path d="M3 11h16" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Rekap JAK
                        </span>
                    </a>
                </li>
                <li class="nav-item {{ str_contains(request()->url(), 'rekap-pmm') == true ? 'active' : '' }}">
                    <a class="nav-link" href="rekap-pmm">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-star">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M11 21h-5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v3.5" />
                                <path d="M16 3v4" />
                                <path d="M8 3v4" />
                                <path d="M4 11h11" />
                                <path
                                    d="M17.8 20.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" />
                            </svg>
                        </span>
                        <span class="nav-link-title">
                            Rekap PMM
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
