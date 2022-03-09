<header class="main-heading">
    <nav class="top-nav shadow-2dp navbar-collapse collapse" id="top-nav-list">
        <!-- BEGIN: nav-content -->
        <ul class="metismenu nav nav-inverse nav-bordered nav-inline nav-hoverable is-center" data-plugin="metismenu">

            <li>
                <a href="{{ route('dasbor') }}" class="{{ $path === 'dasbor' ? 'active' : '' }}">
                    <span class="nav-icon">
                        <i class="fa fa-fw fa-bar-chart-o "></i>
                    </span>
                    <span class="nav-title">Dasbor</span>
                </a>
            </li>

            <!-- BEGIN: Rekening -->
            @hasrole('Super Admin')
            <li>
                <a href="{{ route('account') }}" class="{{ $path === 'rekening' ? 'active' : '' }}">

                    <span class="nav-icon"><i class="fa fa-fw fa-credit-card"></i></span>
                    <span class="nav-title">Setup Rekening</span>
                    <span class="nav-tools visible-xs"><i class="fa fa-fw arrow"></i></span>
                </a>
            </li>
            @endhasrole
            <!-- END: Rekening -->

            <!-- BEGIN: Setup Pengguna -->
            @hasrole('Super Admin')
            <li>
                <a href="{{ route('users') }}" class="{{ $path === 'pengguna' ? 'active' : '' }}">
                    <span class="nav-icon"><i class="fa fa-fw fa-users"></i></span>
                    <span class="nav-title">Setup Pengguna</span>
                    <span class="nav-tools visible-xs"><i class="fa fa-fw arrow"></i></span>
                </a>
            </li>
            @endhasrole
            
            <!-- END: Setup Pengguna -->

            <!-- BEGIN: Peristiwa Keuangan -->
            @hasanyrole('Super Admin|Bendahara')
            <li>
                <a href="{{ route('finance') }}" class="{{ $path === 'keuangan' ? 'active' : '' }}">
                    <span class="nav-icon"><i class="fa fa-fw fa-calendar"></i></span>
                    <span class="nav-title">Peristiwa Keuangan</span>
                    <span class="nav-tools visible-xs"><i class="fa fa-fw arrow"></i></span>
                </a>
            </li>
            @endhasanyrole
            <!-- END: Peristiwa Keuangan -->

            <!-- BEGIN: Kegiatan -->
            @hasanyrole('Super Admin|Bendahara')
            <li>
                <a href="{{ route('events') }}" class="{{ $path === 'kegiatan' ? 'active' : '' }}">
                    <span class="nav-icon"><i class="fa fa-fw fa-child"></i></span>
                    <span class="nav-title">Kegiatan</span>
                    <span class="nav-tools visible-xs"><i class="fa fa-fw arrow"></i></span>
                </a>
            </li>
            @endhasanyrole
            <!-- END: Kegiatan -->
        </ul>
        <!-- END: nav-content -->
    </nav>
</header>