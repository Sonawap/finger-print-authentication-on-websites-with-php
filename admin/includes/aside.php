<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block"><?php echo $admin->getUserInfo()['username'] ?></a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link <?php echo ($page == "dashboard" ? "active" : "")?>">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="users.php" class="nav-link <?php echo ($page == "users" ? "active" : "")?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="withPrint.php" class="nav-link <?php echo ($page == "complete" ? "active" : "")?>">
                        <i class="nav-icon fas fa-user-plus"></i>
                        <p>
                            User with fingerprint
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="withoutPrint.php" class="nav-link <?php echo ($page == "uncomplete" ? "active" : "")?>">
                        <i class="nav-icon fas fa-user-minus"></i>
                        <p>
                            User without fingerprint
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="query.php" class="nav-link <?php echo ($page == "query" ? "active" : "")?>">
                        <i class="nav-icon fas fa-question"></i>
                        <p>
                            Query user
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>