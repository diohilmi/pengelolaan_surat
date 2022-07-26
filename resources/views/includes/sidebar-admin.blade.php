<nav class="sidenav shadow-right sidenav-light">
    <div class="sidenav-menu">
        <div class="nav accordion" id="accordionSidenav">
            <!-- Sidenav Menu Heading (Account)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <div class="sidenav-menu-heading d-sm-none">Account</div>
            <!-- Sidenav Link (Alerts)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <a class="nav-link d-sm-none" href="#!">
                <div class="nav-link-icon"><i data-feather="bell"></i></div>
                Alerts
                <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
            </a>
            <!-- Sidenav Link (Messages)-->
            <!-- * * Note: * * Visible only on and above the sm breakpoint-->
            <a class="nav-link d-sm-none" href="#!">
                <div class="nav-link-icon"><i data-feather="mail"></i></div>
                Messages
                <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
            </a>
            <!-- Sidenav Menu Heading (Core)-->
            <div class="sidenav-menu-heading">Menu</div>
            <!-- Sidenav Link (Dashboard)-->
            <a class="nav-link {{ (request()->is('/dashboard')) ? 'active' : '' }}" href="{{ route('admin-dashboard') }}">
                <div class="nav-link-icon"><i data-feather="activity"></i></div>
                Dashboard
            </a>

            @if (auth()->user()->positions_id == "2")
                <a class="nav-link {{ (request()->is('/disposisi-user-pegawai_unit')) ? 'active' : '' }}" href="{{ route('disposisi-user-pegawai_unit') }}">
                    <div class="nav-link-icon"><i data-feather="send"></i></div>
                    Disposisi User
                </a>
                <a class="nav-link {{ (request()->is('/outgoing')) ? 'active' : '' }}" href="{{ route('outgoing.index') }}">
                    <div class="nav-link-icon"><i data-feather="arrow-right"></i></div>
                    Surat Keluar
                </a>
            @endif

            @if (auth()->user()->positions_id == "3")
                <a class="nav-link {{ (request()->is('/disposisi-user-direktur')) ? 'active' : '' }}" href="{{ route('disposisi-user-direktur') }}">
                    <div class="nav-link-icon"><i data-feather="send"></i></div>
                    Disposisi User
                </a>
                <a class="nav-link {{ (request()->is('/laporan')) ? 'active' : '' }}" href="{{ route('show-laporan-direktur') }}">
                    <div class="nav-link-icon"><i data-feather="database"></i></div>
                    Melihat Laporan
                </a>
                <a class="nav-link {{ (request()->is('/outgoing')) ? 'active' : '' }}" href="{{ route('outgoing.index') }}">
                    <div class="nav-link-icon"><i data-feather="arrow-right"></i></div>
                    Surat Keluar
                </a>
            @endif

            @if (auth()->user()->positions_id == "1")
            <a class="nav-link {{ (request()->is('/disposisi')) ? 'active' : '' }}" href="{{ route('disposisi.index') }}">
                <div class="nav-link-icon"><i data-feather="arrow-up"></i></div>
                Disposisi Surat
            </a>
            <a class="nav-link {{ (request()->is('/disposisi')) ? 'active' : '' }}" href="{{ route('disposisi-user.index') }}">
                <div class="nav-link-icon"><i data-feather="send"></i></div>
                Disposisi User
            </a>
            {{-- <a class="nav-link {{ (request()->is('/letter/create')) ? 'active' : '' }}" href="{{ route('letter.create') }}">
                <div class="nav-link-icon"><i data-feather="mail"></i></div>
                Tambah Surat
            </a> --}}
            <a class="nav-link {{ (request()->is('/letter/import-surat')) ? 'active' : '' }}" href="{{ route('import-surat') }}">
                <div class="nav-link-icon"><i data-feather="arrow-down"></i></div>
                Import Surat
            </a>
            <a class="nav-link {{ (request()->is('/letter/surat-masuk')) ? 'active' : '' }}" href="{{ route('surat-masuk') }}">
                <div class="nav-link-icon"><i data-feather="arrow-left"></i></div>
                Surat Masuk
            </a>
            <a class="nav-link {{ (request()->is('/outgoing')) ? 'active' : '' }}" href="{{ route('outgoing.index') }}">
                <div class="nav-link-icon"><i data-feather="arrow-right"></i></div>
                Surat Keluar
            </a>
            <a class="nav-link {{ (request()->is('/laporan')) ? 'active' : '' }}" href="{{ route('show-laporan') }}">
                <div class="nav-link-icon"><i data-feather="database"></i></div>
                Melihat Laporan
            </a>
            <a class="nav-link {{ (request()->is('/kode-surat*')) ? 'active' : '' }}" href="{{ route('kode-surat.index') }}">
                <div class="nav-link-icon"><i data-feather="book"></i></div>
                Daftar Kode Surat
            </a>
            <a class="nav-link {{ (request()->is('/user*')) ? 'active' : '' }}" href="{{ route('user.index') }}">
                <div class="nav-link-icon"><i data-feather="user"></i></div>
                Data Pengguna
            </a>
            @endif
           
            <a class="nav-link {{ (request()->is('/setting*')) ? 'active' : '' }}" href="{{ route('setting.index') }}">
                <div class="nav-link-icon"><i data-feather="settings"></i></div>
                Profile
            </a>
        </div>
    </div>
    <!-- Sidenav Footer-->
    <div class="sidenav-footer">
        <div class="sidenav-footer-content">
            <div class="sidenav-footer-subtitle">Logged in as:</div>
            <div class="sidenav-footer-title">{{ Auth::user()->name }}</div>
        </div>
    </div>
</nav>
