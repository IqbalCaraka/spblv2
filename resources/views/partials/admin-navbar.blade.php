<nav
class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
id="layout-navbar"
>
<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
    <i class="bx bx-menu bx-sm"></i>
    </a>
</div>

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <ul class="navbar-nav flex-row align-items-center ms-auto">
    <!-- Place this tag where you want the button to render. -->
    <li class="nav-item lh-1 me-3">
        <a  class="" href="{{route('menu.index')}}" data-icon="{{asset ('admin/img/SIPERMATA.jpg')}}" data-size="large" data-show-count="true" aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
        >Menu</a>
    </li>

    <!-- User -->
    <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
        <div class="avatar avatar-online">
            <img src="https://xsgames.co/randomusers/avatar.php?g=pixel" />
        </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item" href="#">
            <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                <div class="avatar avatar-online">
                    <img src="https://xsgames.co/randomusers/avatar.php?g=pixel" />
                </div>
                </div>
                <div class="flex-grow-1">
                <span class="fw-semibold d-block">{{Auth::user()->name}}</span>
                <small class="text-muted">{{Auth::user()->peran->peran}}</small>
                </div>
            </div>
            </a>
        </li>
        <li>
            <div class="dropdown-divider"></div>
        </li>
        <li>
            <a class="dropdown-item" href="{{route('menu.index')}}">
            <i class="bx bx-store me-2"></i>
            <span class="align-middle"> Go To Menu</span>
            </a>
        </li>
        <!-- <li>
            <a class="dropdown-item" href="auth-login-basic.html">
            <i class="bx bx-user me-2"></i>
            <span class="align-middle">Profile</span>
            </a>
        </li> -->
        <li>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                <i class="bx bx-power-off me-2"></i>
                <span class="align-middle">Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
        </ul>
    </li>
    <!--/ User -->
    </ul>
</div>
</nav>