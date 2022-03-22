<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">E-SPP</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">SPP</a>
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Dashboard</li>
          <li class="nav-item {{ set_active('dashboard') }}">
            <a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
          </li>
          @can('admin')
          <li class="menu-header">Data Master</li>
          <li class="nav-item dropdown {{ set_active(['petugas.index', 'petugas.create', 'petugas.edit', 'siswa.index', 'siswa.create', 'siswa.edit']) }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Data Master</span></a>
            <ul class="dropdown-menu">
              <li class="{{ set_active(['petugas.index', 'petugas.create', 'petugas.edit']) }}"><a href="{{ route('petugas.index') }}" class="nav-link">Petugas</a></li>
              <li class="{{ set_active(['siswa.index', 'siswa.create', 'siswa.edit']) }}"><a class="nav-link" href="{{ route('siswa.index') }}">Siswa</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown {{ set_active(['kelas.index', 'spp.index']) }}">
            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Referensi</span></a>
            <ul class="dropdown-menu">
              <li class="{{ set_active(['kelas.index']) }}"><a class="nav-link" href="{{ route('kelas.index') }}">Kelas</a></li>
              <li class="{{ set_active(['spp.index']) }}"><a class="nav-link" href="{{ route('spp.index') }}">SPP</a></li>
            </ul>
          </li>
          @endcan
          <li class="menu-header">Pembayaran</li>
          @canany(['admin', 'petugas'])
          <li class="nav-item {{ set_active(['transaksi.index', 'transaksi.create', 'transaksi.edit']) }}">
            <a href="{{ route('transaksi.index') }}" class="nav-link"><i class="fas fa-fire"></i><span>Transaksi Pembayaran</span></a>
          </li>
          @endcanany
          <li class="nav-item {{ set_active(['history.index']) }}">
            <a href="{{ route('history.index') }}" class="nav-link"><i class="fas fa-fire"></i><span>History Pembayaran</span></a>
          </li>
          @canany(['admin', 'petugas'])
          <li class="nav-item {{ set_active(['laporan.index']) }}">
            <a href="{{ route('laporan.index') }}" class="nav-link"><i class="fas fa-fire"></i><span>Laporan Pembayaran</span></a>
          </li>
          @endcanany
        </ul>
    </aside>
  </div>
