<header class="topbar" data-navbarbg="skin6">
  <nav class="navbar top-navbar navbar-expand-lg">
    <div class="navbar-header" data-logobg="skin6">
      <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)"><i
          class="ti-menu ti-close"></i>
      </a>
      <div class="navbar-brand">
        <a href="{{ route('dashboard') }}">
          <img src="{{ asset('src/assets/images/freedashDark.svg') }}" alt="" class="img-fluid" />
        </a>
      </div>
      <a class="topbartoggler d-block d-lg-none waves-effect waves-light" href="javascript:void(0)"
        data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <i class="ti-more"></i>
      </a>
    </div>
    <div class="navbar-collapse collapse" id="navbarSupportedContent">
      <ul class="navbar-nav float-left me-auto ms-3 ps-1">
      </ul>
      <ul class="navbar-nav float-end">
        <li class="nav-item d-none d-md-block">
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            <i class="fas fa-user"></i>
            <span class="ms-2 d-none d-lg-inline-block">Hello,</span>
            <span class="text-dark">Administrator</span>
            <i data-feather="chevron-down" class="svg-icon"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-right user-dd animated flipInY">
            <a class="dropdown-item" href="javascript:void(0)">
              <i data-feather="settings" class="svg-icon me-2 ms-1"></i>
              Account Setting
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}">
              <i data-feather="power" class="svg-icon me-2 ms-1"></i>
              Logout
            </a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</header>
