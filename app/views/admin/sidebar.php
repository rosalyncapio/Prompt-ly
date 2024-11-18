<?php
include APP_DIR . 'views/templates/header.php';
?>
<style>
    :root {
        --main-bg-color: #009d63;
        --main-text-color: #009d63;
        --second-text-color: #bbbec5;
        --second-bg-color: #c1efde;
    }

    .primary-text {
        color: var(--main-text-color);
    }

    .second-text {
        color: var(--second-text-color);
    }

    .primary-bg {
        background-color: var(--main-bg-color);
    }

    .secondary-bg {
        background-color: var(--second-bg-color);
    }

    .rounded-full {
        border-radius: 100%;
    }

    #wrapper {
        overflow-x: hidden;
        background-image: linear-gradient(to right, #baf3d7, #c2f5de, #cbf7e4, #d4f8ea, #ddfaef);
    }

    #sidebar-wrapper {
        min-height: 100vh;
        margin-left: -15rem;
        transition: margin 0.25s ease-out;
    }

    #sidebar-wrapper .sidebar-heading {
        padding: 0.875rem 1.25rem;
        font-size: 1.2rem;
    }

    #sidebar-wrapper .list-group {
        width: 15rem;
    }

    #page-content-wrapper {
        min-width: 100vw;
    }

    #wrapper.toggled #sidebar-wrapper {
        margin-left: 0;
    }

    #menu-toggle {
        cursor: pointer;
    }

    .list-group-item {
        border: none;
        padding: 20px 30px;
    }

    .list-group-item.active {
        background-color: transparent;
        color: var(--main-text-color);
        font-weight: bold;
        border: none;
    }

    @media (min-width: 768px) {
        #sidebar-wrapper {
            margin-left: 0;
        }

        #page-content-wrapper {
            min-width: 0;
            width: 100%;
        }

        #wrapper.toggled #sidebar-wrapper {
            margin-left: -15rem;
        }
    }
</style>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
                <i class="fas fa-user-secret me-2" aria-label="Admin Icon"></i>Admin Panel
            </div>
            <div class="list-group list-group-flush my-3">
                <a href="<?= site_url('admin/dashboard') ?>" class="list-group-item list-group-item-action bg-transparent second-text <?= $active_page == 'dashboard' ? 'active' : '' ?>">
                    <i class="fas fa-tachometer-alt me-2" aria-label="Dashboard Icon"></i>Dashboard
                </a>
                <a href="<?= site_url('admin/prompts') ?>" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= $active_page == 'prompts' ? 'active' : '' ?>">
                    <i class="fas fa-project-diagram me-2" aria-label="Prompts Icon"></i>Prompts
                </a>
                <a href="<?= site_url('admin/users') ?>" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= $active_page == 'users' ? 'active' : '' ?>">
                    <i class="fas fa-users me-2" aria-label="Users Icon"></i>Users
                </a>
                <a href="<?= site_url('admin/entries') ?>" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= $active_page == 'entries' ? 'active' : '' ?>">
                    <i class="fas fa-file-alt me-2" aria-label="Entries Icon"></i>Entries
                </a>
                <a href="<?= site_url('admin/votes') ?>" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= $active_page == 'votes' ? 'active' : '' ?>">
                    <i class="fas fa-vote-yea me-2" aria-label="Votes Icon"></i>Votes
                </a>
                <a href="<?= site_url('auth/logout') ?>" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold">
                    <i class="fas fa-power-off me-2" aria-label="Logout Icon"></i>Logout
                </a>
            </div>
        </div>
        
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <!-- Add your page content here -->
        </div>
    </div>
</body>

</html>