<header>

    <!-- Sidebar -->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
        <div class="position-sticky">
            <div class="list-group list-group-flush mx-3 mt-4">
                <?php if (in_groups('admin')) : ?>
                    <h5 class="sidebar-heading">
                        Site Management
                    </h5>
                    <a href="<?= base_url('/admin/users'); ?>" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
                        <i class="fas fa-users fa-fw me-3"></i><span>User List</span>
                    </a>
                    <a href="<?= base_url('/admin/labs'); ?>" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
                        <i class="fas fa-network-wired fa-fw me-3"></i><span>Lab List</span>
                    </a>
                    <a href="<?= base_url('/admin/acc'); ?>" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
                        <i class="fas fa-network-wired fa-fw me-3"></i><span>Reserver List</span>
                    </a>
                    <hr>
                <?php endif; ?>
                <h5 class="sidebar-heading">
                    User Menu
                </h5>
                <a href=" <?php echo base_url('/user/index'); ?>" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
                    <i class="fas fa-user-alt fa-fw me-3"></i><span>My Profile</span>
                </a>
                <?php if (!in_groups('admin')) : ?>
                    <a href=" <?php echo base_url('/user/reservation'); ?>" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
                        <i class="fas fa-file-invoice fa-fw me-3"></i><span>Reservation</span>
                    </a>
                    <a href=" <?php echo base_url('/user/labs'); ?>" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
                        <i class="fas fa-network-wired fa-fw me-3"></i><span>Labs</span>
                    </a>
                    <a href=" <?php echo base_url('/user/history'); ?>" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
                        <i class="fas fa-network-wired fa-fw me-3"></i><span>Reservation History</span>
                    </a>
                <?php endif; ?>
                <hr>
                <a href=" <?php echo base_url('logout'); ?>" class="list-group-item list-group-item-action py-2 ">
                    <i class="fas fa-sign-out-alt fa-fw me-3"></i><span>Logout </span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Brand -->
            <a class="navbar-brand" href="#">
                <img src="https://mdbootstrap.com/img/logo/mdb-transaprent-noshadows.png" height="25" alt="" loading="lazy" />
            </a>
            <!-- Search form -->
            <form class="d-none d-md-flex input-group w-auto my-auto">
                <input autocomplete="off" type="search" class="form-control rounded" placeholder='Search (ctrl + "/" to focus)' style="min-width: 225px" />
                <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
            </form>

            <!-- Right links -->
            <ul class="navbar-nav ms-auto d-flex flex-row">
                <h3><?= user()->username; ?></h3>
                <!-- Avatar -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <img src="<?= base_url(); ?>/img/<?= user()->user_image; ?>" class="rounded-circle" height="22" alt="" loading="lazy" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="#">My profile</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('logout'); ?>">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Container wrapper -->
    </nav>
</header>