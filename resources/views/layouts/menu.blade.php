<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
          ProMina
        </a>
    </div>

    <ul class="c-sidebar-nav">

        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.album.index") }}"
               class="c-sidebar-nav-link {{ request()->is("admin/album") || request()->is("admin/album/*") ? "c-active" : "" }}">
                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                </i>
             Albums
            </a>
        </li>

        <li class="c-sidebar-nav-item">
            <a href="{{url('admin/logout')}}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">
                </i>
               Logout
            </a>
        </li>
    </ul>

</div>
