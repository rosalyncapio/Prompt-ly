<?php
include APP_DIR . 'views/templates/header.php';
$current_page = basename($_SERVER['REQUEST_URI']); // Get the current page name
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
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text">
                    <i class="fas fa-tachometer-alt me-2" aria-label="Dashboard Icon"></i>Dashboard
                </a>
                <a href="<?= site_url('admin/prompts') ?>" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-project-diagram me-2" aria-label="Prompts Icon"></i>Prompts
                </a>
                <a href="<?= site_url('admin/users') ?>" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-chart-line me-2" aria-label="Analytics Icon"></i>Users
                </a>
                <a href="<?= site_url('admin/entries') ?>" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-paperclip me-2" aria-label="Reports Icon"></i>Entries
                </a>
                <a href="<?= site_url('admin/votes') ?>" class="list-group-item list-group-item-action bg-transparent second-text fw-bold active">
                    <i class="fas fa-paperclip me-2" aria-label="Reports Icon"></i>Votes
                </a>
                <a href="<?= site_url('logout') ?>" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold">
                    <i class="fas fa-power-off me-2" aria-label="Logout Icon"></i>Logout
                </a>
            </div>
        </div>

   <!-- Page Content -->
<div class="container mt-4">
    <table class="table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Prompt Content</th>
                <th>Vote Type</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($votes as $vote): ?>
                <tr>
                    <td><?= htmlspecialchars($vote['username']); ?></td>
                    <td><?= htmlspecialchars(substr($vote['content'], 0, 50)) . '...'; ?></td>
                    <td><?= ucfirst(htmlspecialchars($vote['vote_type'])); ?></td>
                    <td><?= htmlspecialchars($vote['created_at']); ?></td>
                    <td>

                        <a href="<?= site_url('votes/delete/' . $vote['vote_id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editVoteModal = document.getElementById('editVoteModal');
        editVoteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const user_id = button.getAttribute('data-user_id');
            const entry_id = button.getAttribute('data-entry_id');
            const vote_type = button.getAttribute('data-vote_type');

            const form = document.getElementById('editVoteForm');
            form.action = `<?= site_url('votes/edit/') ?>${id}`;

            document.getElementById('editUser').value = user_id;
            document.getElementById('editPrompt').value = prompt_id;
            document.getElementById('editVoteType').value = vote_type;
        });
    });
</script>
