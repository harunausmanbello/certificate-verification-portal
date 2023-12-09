<nav class="navbar navbar-light navbar-vertical navbar-expand-xl navbar-card">
    <script>
    var navbarStyle = localStorage.getItem("navbarStyle");
    if (navbarStyle && navbarStyle !== 'transparent') {
        document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
    }
    </script>
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">
            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip"
                data-bs-placement="left" title="Toggle Navigation">
                <span class="navbar-toggle-icon">
                    <span class="toggle-line">
                    </span>
                </span>
            </button>
        </div>
        <a class="navbar-brand" href="">
            <div class="d-flex align-items-center py-3" style="margin-left: -0.6em;">
                <span class="font-sans-serif"><?= 'CVP | Admin' ?></span>
            </div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                <li class="nav-item">
                    <!-- parent pages-->
                    <a class="nav-link <?php if ((($_SERVER['REQUEST_URI']) === "/admin/dashboard")){echo 'bg-light active'; }  ?>"
                        href="/admin/dashboard" role="button" aria-expanded="true" aria-controls="dashboard">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                    class="fas fa-chart-pie"></span></span><span
                                class="nav-link-text ps-1">Dashboard</span></div>
                    </a>

                </li>
                <?php if($auth->role == 'admin') { ?>
                <li class="nav-item">
                    <!-- parent pages-->
                    <a class="nav-link dropdown-indicator " href="#user" role="button" data-bs-toggle="collapse"
                        aria-expanded="false" aria-controls="user">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                    class="fas fa-user"></span></span><span class="nav-link-text ps-1">User</span></div>
                    </a>
                    <ul class="nav <?php echo ((($_SERVER['REQUEST_URI']) === "/admin/user/add" || ($_SERVER['REQUEST_URI']) === "/admin/user/manage") ? '' : 'collapse'); ?>" id="user">
                        <li class="nav-item"><a class="nav-link  <?php if ((($_SERVER['REQUEST_URI']) === "/admin/user/add")){echo 'bg-light active'; }  ?>" href="/admin/user/add">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                            class="fas fa-user-plus"></span></span><span class="nav-link-text ps-1">Add
                                        user</span></div>
                            </a><!-- more inner pages-->
                        </li>
                        <li class="nav-item"><a class="nav-link  <?php if ((($_SERVER['REQUEST_URI']) === "/admin/user/manage")){echo 'bg-light active'; }  ?>" href="/admin/user/manage">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><i
                                            class="fa-solid fa-user-edit"></i></span></span><span
                                        class="nav-link-text ps-1">Manage
                                        user</span></div>
                            </a><!-- more inner pages-->
                        </li>

                    </ul>
                </li>
                <?php } ?>
                <li class="nav-item">
                    <!-- parent pages-->
                    <a class="nav-link dropdown-indicator " href="#student" role="button" data-bs-toggle="collapse"
                        aria-expanded="false" aria-controls="student">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                    class="fas fa-user-graduate"></span></span><span
                                class="nav-link-text ps-1">Student</span></div>
                    </a>
                    <ul class="nav <?php echo ((($_SERVER['REQUEST_URI']) === "/admin/add/student/type" || ($_SERVER['REQUEST_URI']) === "/admin/add/student/bachelor" || ($_SERVER['REQUEST_URI']) === "/admin/add/student/masters" || ($_SERVER['REQUEST_URI']) === "/admin/manage/student/type" || ($_SERVER['REQUEST_URI']) === "/admin/manage/student/bachelor" || ($_SERVER['REQUEST_URI']) === "/admin/manage/student/masters"  ) ? '' : 'collapse'); ?> " id="student">
                        <li class="nav-item"><a class="nav-link <?php echo ((($_SERVER['REQUEST_URI']) === "/admin/add/student/type" || ($_SERVER['REQUEST_URI']) === "/admin/add/student/bachelor" || ($_SERVER['REQUEST_URI']) === "/admin/add/student/masters") ? 'bg-light active' : ''); ?> " href="/admin/add/student/type">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                            class="fas fa-user-plus"></span></span><span class="nav-link-text ps-1">Add
                                        Student</span></div>
                            </a><!-- more inner pages-->
                        </li>
                        <li class="nav-item"><a class="nav-link <?php echo ((($_SERVER['REQUEST_URI']) === "/admin/manage/student/type" || ($_SERVER['REQUEST_URI']) === "/admin/manage/student/bachelor" || ($_SERVER['REQUEST_URI']) === "/admin/manage/student/masters") ? 'bg-light active' : ''); ?> " href="/admin/manage/student/type">
                                <div class="d-flex align-items-center"><span class="nav-link-icon"><i
                                            class="fa-solid fa-user-edit"></i></span></span><span
                                        class="nav-link-text ps-1">Manage Student
                                    </span></div>
                            </a><!-- more inner pages-->
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <!-- parent pages -->
                    <a class="nav-link" href="/admin/profile" role="button">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon">
                                <span class="fas fa-id-card"></span>
                            </span><span class="nav-link-text ps-1">Profile</span>
                        </div>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</nav>