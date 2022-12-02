<a href=" " class="brand-link">
    {{-- <img src=" " alt="Logo" class="w-100"
      style="height: 70px"  > --}}
    {{-- Service --}}
    <h3>App Name</h3>
</a>
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        {{-- <img  src="{{ auth()->user()->image? asset('uploads/profile'.'/'.auth()->user()->image): 'https://cdn-icons-png.flaticon.com/512/149/149071.png'}}" class="img-circle elevation-2" alt="User Image"> --}}
    </div>
    <div class="info text-white text-capitalize">
        Welcome, admin
    </div>

</div>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link {{ request()->is('admin/dashboard') ? 'active' : null }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard

                </p>
            </a>

        </li>

         

        {{-- <li class="nav-item">
            <a href="{{ route('users.index') }}"
                class="nav-link {{ request()->is('admin/users') ? 'active' : null }}">
                <i class="nav-icon fa fa-users"></i>
                <p>
                    Users
                </p>
            </a>

        </li> --}}
        <li class="nav-item">
            <a href="{{ route('team_member') }}"
                class="nav-link {{ request()->is('admin/team-members') ? 'active' : null }}">
                <i class="nav-icon fa fa-users"></i>
                <p>
                    Team Members
                </p>
            </a>

        </li>
        <li class="nav-item">
            <a href="{{ route('projects') }}"
                class="nav-link {{ request()->is('admin/projects') ? 'active' : null }}">
                <i class="nav-icon fa fa-book"></i>
                <p>
                    Projects
                </p>
            </a>

        </li>

        <li class="nav-item">
            <a href="{{ route('project.spent_hours') }}"
                class="nav-link {{ request()->is('admin/projects/spent_hours') ? 'active' : null }}">
                <i class="nav-icon fa  fa-clock"></i>
                <p>
                    Project Tracking
                </p>
            </a>

        </li>
        <li class="nav-item">
            <a href="" class="nav-link">
                <i class="fa fa-cogs nav-icon"></i>
                Logout
            </a>
        </li>


    </ul>
</nav>
