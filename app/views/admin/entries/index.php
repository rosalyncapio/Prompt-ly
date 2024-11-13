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
                <a href="<?= site_url('admin/prompts') ?>" class="list-group-item list-group-item-action bg-transparent second-text fw-bold ">
                    <i class="fas fa-project-diagram me-2" aria-label="Prompts Icon"></i>Prompts
                </a>
                <a href="<?= site_url('admin/users') ?>" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-chart-line me-2" aria-label="Analytics Icon"></i>Users
                </a>
                <a href="<?= site_url('admin/entries') ?>" class="list-group-item list-group-item-action bg-transparent second-text fw-bold active">
                    <i class="fas fa-paperclip me-2" aria-label="Reports Icon"></i>Entries
                </a>
                <a href="<?= site_url('admin/votes') ?>" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-paperclip me-2" aria-label="Reports Icon"></i>Votes
                </a>
                <a href="<?= site_url('logout') ?>" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold">
                    <i class="fas fa-power-off me-2" aria-label="Logout Icon"></i>Logout
                </a>
            </div>
        </div>

        <div class="container mt-4">
    <h1>Entries</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Prompt Title</th>
                <th>Content</th>
                <th>Upvotes</th>
                <th>Downvotes</th>
                <th>Badge</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($entries as $entry): ?>
                <tr>
                    <td><?= htmlspecialchars($entry['username']) ?></td>
                    <td><?= htmlspecialchars($entry['prompt_title']) ?></td>
                    <td><?= substr(htmlspecialchars($entry['content']), 0, 50) . '...' ?></td>
                    <td><?= $entry['upvotes'] ?></td>
                    <td><?= $entry['downvotes'] ?></td>
                    <td>
                        <?= $entry['badge_id'] ? '🏅 Badge' : 'No Badge' ?>
                    </td>
                    <td><?= $entry['created_at'] ?></td>
                    <td>
                        <!-- Button to trigger the View Entry modal -->
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#viewEntryModal"
                            data-id="<?= $entry['entry_id'] ?>"
                            data-username="<?= htmlspecialchars($entry['username']) ?>"
                            data-prompttitle="<?= htmlspecialchars($entry['prompt_title']) ?>"
                            data-content="<?= htmlspecialchars($entry['content']) ?>"
                            data-upvotes="<?= $entry['upvotes'] ?>"
                            data-downvotes="<?= $entry['downvotes'] ?>"
                            data-createdat="<?= $entry['created_at'] ?>">
                            View
                        </button>
                        <a href="<?= site_url('entries/delete/' . $entry['entry_id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- View Entry Modal -->
<div class="modal fade" id="viewEntryModal" tabindex="-1" aria-labelledby="viewEntryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewEntryModalLabel">View Entry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Username:</strong> <span id="view-username"></span></p>
                <p><strong>Prompt Title:</strong> <span id="view-prompt-title"></span></p>
                <p><strong>Content:</strong> <span id="view-content"></span></p>
                <p><strong>Upvotes:</strong> <span id="view-upvotes"></span></p>
                <p><strong>Downvotes:</strong> <span id="view-downvotes"></span></p>
                <p><strong>Created At:</strong> <span id="view-created-at"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JavaScript and Modal Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Event listener to populate the View Entry modal with data
    document.addEventListener('DOMContentLoaded', function() {
        const viewEntryModal = document.getElementById('viewEntryModal');
        viewEntryModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            document.getElementById('view-username').textContent = button.getAttribute('data-username');
            document.getElementById('view-prompt-title').textContent = button.getAttribute('data-prompttitle');
            document.getElementById('view-content').textContent = button.getAttribute('data-content');
            document.getElementById('view-upvotes').textContent = button.getAttribute('data-upvotes');
            document.getElementById('view-downvotes').textContent = button.getAttribute('data-downvotes');
            document.getElementById('view-created-at').textContent = button.getAttribute('data-createdat');
        });
    });
</script>
