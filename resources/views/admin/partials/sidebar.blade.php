<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <br>
    <div class="d-flex align-items-center justify-content-center">
        <a href="{{ route('dashboard') }}" class="text-logo">
            <span class="light-text"><b>Admin</b></span>
        </a>
    </div>

    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li>
                <a href="{{ route('dashboard') }}">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">Fiture</li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
                    <span>Users</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('user.list') }}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Users List</a>
                    </li>
                    <li>
                        <a href="{{ route('user.create') }}"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Add
                            User</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
                    <span>Students</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('student.list') }}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Students List</a>
                    </li>
                    <li>
                        <a href="{{ route('student.create') }}"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Add
                            Students</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
                    <span>Absence</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('absence.list') }}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Absence List</a>
                    </li>
                    <li>
                        <a href="{{ route('absence.create') }}"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Add
                            Absence</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
                    <span>Barcode</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('barcode.list') }}"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Barcode List</a>
                    </li>
                    <li>
                        <a href="{{ route('barcode.create') }}"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Add
                            Barcode</a>
                    </li>
                </ul>
            </li>
            {{-- <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
                    <span>Event</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ route('event.index') }}"><i
                                class="ri-circle-fill circle-icon text-primary-600 w-auto"></i>
                            Event List</a>
                    </li>
                    <li>
                        <a href="{{ route('event.create') }}"><i
                                class="ri-circle-fill circle-icon text-info-main w-auto"></i> Add
                            Event</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <i class="ri-news-line text-xl me-6 d-flex w-auto"></i>
                    <span>Blog</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="blog.php"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Blog</a>
                    </li>
                    <li>
                        <a href="blog-details.php"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i>
                            Blog Details</a>
                    </li>
                    <li>
                        <a href="add-blog.php"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Add
                            Blog</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="javascript:void(0)">
                    <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
                    <span>Gallery</span>
                </a>
              
            </li>
            <li>
                <a href="{{ route('setting.index') }}">
                    <iconify-icon icon="icon-park-outline:setting-two" class="menu-icon"></iconify-icon>
                    <span>Setting</span>
                </a>
            </li> --}}


        </ul>
    </div>
</aside>
