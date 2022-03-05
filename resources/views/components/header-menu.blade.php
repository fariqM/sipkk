<header class="main-heading">
    <nav class="top-nav shadow-2dp navbar-collapse collapse" id="top-nav-list">
        <!-- BEGIN: nav-content -->
        <ul class="metismenu nav nav-inverse nav-bordered nav-inline nav-hoverable is-center" data-plugin="metismenu">

            <li>
                <a href="index.html" class="{{ Request::is('dasbor') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <i class="fa fa-fw fa-bar-chart-o "></i>
                    </span>
                    <span class="nav-title">Dasbor</span>
                </a>
            </li>

            <!-- BEGIN: Rekening -->
            <li>
                <a href="javascript:;" class="{{ Request::is('rekening') ? 'active' : '' }}">

                    <span class="nav-icon"><i class="fa fa-fw fa-credit-card"></i></span>
                    <span class="nav-title">Setup Rekening</span>
                    <span class="nav-tools visible-xs"><i class="fa fa-fw arrow"></i></span>
                </a>
            </li>
            <!-- END: Rekening -->

            <!-- BEGIN: Setup Pengguna -->
            <li>
                <a href="javascript:;" class="{{ Request::is('pengguna') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="fa fa-fw fa-table"></i></span>
                    <span class="nav-title">Setup Pengguna</span>
                    <span class="nav-tools visible-xs"><i class="fa fa-fw arrow"></i></span>
                </a>
                <ul class="nav nav-sub nav-stacked">
                    <li><a href="table-basic.html">Basic</a></li>
                    <li><a href="table-sortable.html">Sortable</a></li>
                    <li><a href="table-datatable.html">Datatables</a></li>
                </ul>
            </li>
            <!-- END: table -->

            <li>
                <a href="javascript:;" class="{{ Request::is('keuangan') ? 'active' : '' }}">
                    <span class="nav-icon"><i class="fa fa-fw fa-calendar"></i></span>
                    <span class="nav-title">Peristiwa Keuangan</span>
                    <span class="nav-tools visible-xs"><i class="fa fa-fw arrow"></i></span>
                </a>
            </li>
        </ul>
        <!-- END: nav-content -->
    </nav>
</header>