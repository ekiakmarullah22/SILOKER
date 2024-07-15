<header class="app-header" style="z-index: 1">
    <nav class="navbar navbar-expand-lg navbar-light" style="z-index: 1">
      <ul class="navbar-nav">
        <li class="nav-item d-block d-xl-none">
          <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
            <i class="ti ti-menu-2"></i>
          </a>
        </li>
          <h4>Welcome Back!, {{ Auth::guard('web')->user()->email }}</h4>
          
        </li>
      </ul>
      <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
          <li class="nav-item dropdown">
            <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
              aria-expanded="false">
              @if ($profil)
              <img src="{{ asset('profil_admin/'.$profil->avatar) }}" alt="" width="35" height="35" class="rounded-circle" style="max-width: 35px !important; max-height:35px !important;">
              @else
              <img src="{{ asset('master/src//assets/images/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle">
              @endif
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2" style="right: 0%;">
              <div class="message-body">
                <a href="{{ route('profil_admin.create') }}" class="d-flex align-items-center gap-2 dropdown-item">
                  <i class="ti ti-user fs-6"></i>
                  <p class="mb-0 fs-3">My Profile</p>
                </a>
                <center>
                  <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <input type="submit" class="btn btn-danger" value="Logout">
                </form>
                </center>
                
              </div>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </header>