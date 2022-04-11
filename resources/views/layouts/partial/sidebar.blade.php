<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-compact" data-widget="treeview" role="menu"
        data-accordion="false">

        <li class="nav-item">
            <a href="{{ action([App\Http\Controllers\HomeController::class, 'index']) }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        @role('super-admin')
        <li class="nav-item">
            <a href="{{ action('UserController@index') }}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Manajemen Pengguna
                </p>
            </a>
        </li>
        @endrole
        {{-- <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>
                    Bank Soal
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ action('KecerdasanController@index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Kecerdasan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ action('KecermatanController@index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Kecermatan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            kepribadian
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ action('KepribadianController@sesi1') }}" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Sesi 1</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ action('KepribadianController@sesi2') }}" class="nav-link">
                                <i class="far fa-dot-circle nav-icon"></i>
                                <p>Sesi 2</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li> --}}
        @role('super-admin')
        <li class="nav-item">
            <a href="{{ action('UjianController@index') }}" class="nav-link">
                <i class="fas fa-cog nav-icon"></i>
                <p>
                    Token
                </p>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a href="{{ action('PengaturanSoalController@index') }}" class="nav-link">
                <i class="fas fa-wrench nav-icon"></i>
                <p>
                    Pengaturan Soal
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ action('UjianNilaiController@index') }}" class="nav-link">
                <i class="fas fa-book nav-icon"></i>
                <p>
                    Riwayat Ujian
                </p>
            </a>
        </li> --}}
        <li class="nav-item">
            {{-- <a href="#" class="nav-link">
                <i class="nav-icon fas fa-database"></i>
                <p>
                    Master Data
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ action('ProgramAkademikController@index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Program Akademik</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ action('RefOptionController@index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ref Option</p>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="{{ action('KelasController@index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Kelas</p>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="{{ action('MataPelajaranController@index') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Mata Pelajaran</p>
                    </a>
                </li> --}}
            </ul>
        </li>
        @endrole
        {{-- <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Starter Pages
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Active Page</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Inactive Page</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Simple Link
                    <span class="right badge badge-danger">New</span>
                </p>
            </a>
        </li> --}}
    </ul>
</nav>
