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
                <a href="<?= site_url('admin/prompts') ?>" class="list-group-item list-group-item-action bg-transparent second-text fw-bold active">
                    <i class="fas fa-project-diagram me-2" aria-label="Prompts Icon"></i>Prompts
                </a>
                <a href="<?= site_url('admin/users') ?>" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
                    <i class="fas fa-chart-line me-2" aria-label="Analytics Icon"></i>Users
                </a>
                <a href="<?= site_url('admin/entries') ?>" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">
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

  
<!-- Page Content -->
<div class="container mt-4">
    <h1>Prompts</h1>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createPromptModal">
        Create New Prompt
    </button>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($prompts as $prompt): ?>
                <tr>
                    <td><?= $prompt['prompt_id'] ?></td>
                    <td><?= $prompt['title'] ?></td>
                    <td><?= substr($prompt['description'], 0, 50) . '...' ?></td>
                    <td><?= $prompt['start_date'] ?></td>
                    <td><?= $prompt['end_date'] ?></td>
                    <td><?= $prompt['created_at'] ?></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editPromptModal"
                            data-id="<?= $prompt['prompt_id'] ?>"
                            data-title="<?= htmlspecialchars($prompt['title'], ENT_QUOTES) ?>"
                            data-description="<?= htmlspecialchars($prompt['description'], ENT_QUOTES) ?>"
                            data-start_date="<?= $prompt['start_date'] ?>"
                            data-end_date="<?= $prompt['end_date'] ?>">
                            Edit
                        </button>
                        <a href="<?= site_url('prompts/delete/' . $prompt['prompt_id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Structure -->
<div class="modal fade" id="createPromptModal" tabindex="-1" aria-labelledby="createPromptModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPromptModalLabel">Create Prompt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('prompts/create') ?>" method="post">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date">
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Prompt Modal -->
<div class="modal fade" id="editPromptModal" tabindex="-1" aria-labelledby="editPromptModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPromptModalLabel">Edit Prompt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editPromptForm" action="" method="post">
                    <div class="mb-3">
                        <label for="editTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="editTitle" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="editDescription" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editStartDate" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="editStartDate" name="start_date">
                    </div>
                    <div class="mb-3">
                        <label for="editEndDate" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="editEndDate" name="end_date">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editPromptModal = document.getElementById('editPromptModal');
        editPromptModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const title = button.getAttribute('data-title');
            const description = button.getAttribute('data-description');
            const startDate = button.getAttribute('data-start_date');
            const endDate = button.getAttribute('data-end_date');

            // Set form action to include the prompt ID
            const form = document.getElementById('editPromptForm');
            form.action = `<?= site_url('prompts/edit/') ?>${id}`;

            // Populate the modal fields with the prompt data
            document.getElementById('editTitle').value = title;
            document.getElementById('editDescription').value = description;
            document.getElementById('editStartDate').value = startDate;
            document.getElementById('editEndDate').value = endDate;
        });
    });
</script>
