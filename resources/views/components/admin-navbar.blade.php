<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-md main-navbar">
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg text-primary"><i class="fas fa-bars"></i></a></li>
    </ul>
  </form>
  <ul class="navbar-nav navbar-right">
    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown" class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell text-dark"></i></a>
      <div class="dropdown-menu dropdown-list dropdown-menu-right">
        <div class="dropdown-header">Notifications
        </div>
          <div class="dropdown-list-content dropdown-list-icons">
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-icon bg-danger text-white">
                    <i class="fas fa-user-tie"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Berhasil menghapus petugas rehan
                    <div class="time text-primary">1 bulan yang lalu</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-icon bg-secondary text-white">
                    <i class="fas fa-book-reader"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Reihan Andika mengedit pinjaman  menjadi Dipinjam
                    <div class="time text-primary">2 bulan yang lalu</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item dropdown-item-unread">
                  <div class="dropdown-item-icon bg-secondary text-white">
                    <i class="fas fa-book"></i>
                  </div>
                  <div class="dropdown-item-desc">
                    Reihan Andika mengedit buku Pendidikan indah
                    <div class="time text-primary">2 bulan yang lalu</div>
                  </div>
                </a>
          </div>
        <div class="dropdown-footer text-center">
          <a href="#" class="link">View All <i class="fas fa-chevron-right"></i></a>
        </div>
      </div>
    </li>
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
      <img alt="image" src="http://reihanpraja.me/assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
      <div class="d-sm-none d-lg-inline-block text-dark">Hi, {{ Auth::guard('siswa')->user() ? Auth::guard('siswa')->user()->nama : Auth::user()->nama_petugas }}</div></a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-divider"></div>
        <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger link">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav>
