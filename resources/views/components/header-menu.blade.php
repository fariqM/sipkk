<header class="main-heading">
    <nav class="top-nav shadow-2dp navbar-collapse collapse" id="top-nav-list">
        <!-- BEGIN: nav-content -->
        <ul class="metismenu nav nav-inverse nav-bordered nav-inline nav-hoverable is-center" data-plugin="metismenu">


            <!-- BEGIN: Setup Pengguna -->
            @hasrole('Super Admin')
            <li>
                <a href="{{ route('users') }}" class="{{ $path === 'pengguna' ? 'active' : '' }}">
                    <span class="nav-icon"><i class="fa fa-fw fa-users"></i></span>
                    <span class="nav-title">Pengguna</span>
                    <span class="nav-tools visible-xs"><i class="fa fa-fw arrow"></i></span>
                </a>
            </li>
            <li>
                <a href="{{ route('account') }}" class="{{ $path === 'rekening' ? 'active' : '' }}">

                    <span class="nav-icon"><i class="fa fa-fw fa-credit-card"></i></span>
                    <span class="nav-title">Rekening</span>
                    <span class="nav-tools visible-xs"><i class="fa fa-fw arrow"></i></span>
                </a>
            </li>
            <li>
                <a href="{{ route('member.index') }}" class="{{ $path === 'member' ? 'active' : '' }}">
                    <span class="nav-icon"><i class="fa fa-fw fa-users"></i></span>
                    <span class="nav-title">Anggota</span>
                    <span class="nav-tools visible-xs"><i class="fa fa-fw arrow"></i></span>
                </a>
            </li>
            @endhasrole

            @hasanyrole('Super Admin|Bendahara')
            <li>
                <a href="{{ route('finance') }}" class="{{ $path === 'keuangan' ? 'active' : '' }}">
                    <span class="nav-icon"><i class="fa fa-fw fa-calendar"></i></span>
                    <span class="nav-title">Catatan Keuangan</span>
                    <span class="nav-tools visible-xs"><i class="fa fa-fw arrow"></i></span>
                </a>
            </li>
            @endhasanyrole

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

            <li>
                <a href="{{ route('dasbor') }}" class="{{ $path === 'dasbor' ? 'active' : '' }}">
                    <span class="nav-icon">
                        <i class="fa fa-fw fa-bar-chart-o "></i>
                    </span>
                    <span class="nav-title">Laporan Keuangan</span>
                </a>
            </li>


            <!-- END: Kegiatan -->
        </ul>
        <!-- END: nav-content -->
    </nav>
</header>
