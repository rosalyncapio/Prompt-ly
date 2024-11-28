<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Promptly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #0a192f;
            color: #e6f1ff;
            min-height: 100vh;
        }

        .dashboard-container {
            padding: 2rem;
        }

        .user-header {
            background-color: #112240;
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .user-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background-color: #112240;
            border-radius: 1rem;
            padding: 1.5rem;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 600;
            color: #64ffda;
        }

        .stat-label {
            color: #8892b0;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .content-section {
            background-color: #112240;
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .section-title {
            color: #64ffda;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card {
            background-color: #1d2d50;
            border: none;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-3px);
        }

        .card-body {
            padding: 1.5rem;
            color: #e6f1ff;
        }

        .card-title {
            color: #64ffda;
            margin-bottom: 0.5rem;
        }

        .card-text {
            color: #8892b0;
            font-size: 0.9rem;
        }

        .btn-primary {
            background-color: #64ffda;
            border: none;
            color: #0a192f;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #4ccea6;
            transform: translateY(-2px);
        }

        .nav-pills .nav-link {
            color: #8892b0;
            border-radius: 0.5rem;
            padding: 0.75rem 1.5rem;
            margin-right: 0.5rem;
            transition: all 0.3s ease;
        }

        .nav-pills .nav-link.active {
            background-color: #64ffda;
            color: #0a192f;
        }

        .tab-content {
            margin-top: 2rem;
        }

        .alert {
            border: none;
            border-radius: 0.5rem;
        }

        .alert-success {
            background-color: rgba(100, 255, 218, 0.1);
            color: #64ffda;
        }

        .alert-danger {
            background-color: rgba(255, 107, 107, 0.1);
            color: #ff6b6b;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- User Header -->
        <div class="user-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-2">Welcome, <?= htmlspecialchars($user['username']) ?>!</h1>
                    <p class="text-muted mb-0">Member since <?= date('F Y', strtotime($user['created_at'])) ?></p>
                </div>
                <a href="<?= site_url('logout') ?>" class="btn btn-primary">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                </a>
            </div>
        </div>

        <!-- User Stats -->
        <div class="user-stats">
            <div class="stat-card">
                <div class="stat-number"><?= count($prompts) ?></div>
                <div class="stat-label">Prompts Created</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= count($entries) ?></div>
                <div class="stat-label">Entries Submitted</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= count($votes) ?></div>
                <div class="stat-label">Votes Cast</div>
            </div>
        </div>

        <!-- Content Tabs -->
        <div class="content-section">
            <ul class="nav nav-pills mb-3" id="userTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="prompts-tab" data-bs-toggle="pill" data-bs-target="#prompts" type="button">
                        <i class="fas fa-lightbulb me-2"></i>My Prompts
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="entries-tab" data-bs-toggle="pill" data-bs-target="#entries" type="button">
                        <i class="fas fa-pen-fancy me-2"></i>My Entries
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="votes-tab" data-bs-toggle="pill" data-bs-target="#votes" type="button">
                        <i class="fas fa-star me-2"></i>My Votes
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="userTabsContent">
                <!-- Prompts Tab -->
                <div class="tab-pane fade show active" id="prompts" role="tabpanel">
                    <?php if (empty($prompts)): ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>You haven't created any prompts yet.
                        </div>
                    <?php else: ?>
                        <?php foreach ($prompts as $prompt): ?>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($prompt['title']) ?></h5>
                                    <p class="card-text"><?= htmlspecialchars($prompt['description']) ?></p>
                                    <small class="text-muted">Created on <?= date('M d, Y', strtotime($prompt['created_at'])) ?></small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Entries Tab -->
                <div class="tab-pane fade" id="entries" role="tabpanel">
                    <?php if (empty($entries)): ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>You haven't submitted any entries yet.
                        </div>
                    <?php else: ?>
                        <?php foreach ($entries as $entry): ?>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($entry['title']) ?></h5>
                                    <p class="card-text"><?= htmlspecialchars($entry['content']) ?></p>
                                    <small class="text-muted">Submitted on <?= date('M d, Y', strtotime($entry['created_at'])) ?></small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Votes Tab -->
                <div class="tab-pane fade" id="votes" role="tabpanel">
                    <?php if (empty($votes)): ?>
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>You haven't voted on any entries yet.
                        </div>
                    <?php else: ?>
                        <?php foreach ($votes as $vote): ?>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?= htmlspecialchars($vote['entry_title']) ?></h5>
                                    <p class="card-text">You voted on <?= date('M d, Y', strtotime($vote['created_at'])) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Initialize Bootstrap tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        // Flash message handling
        <?php if ($this->session->flashdata('success')): ?>
            showAlert('<?= $this->session->flashdata('success') ?>', 'success');
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            showAlert('<?= $this->session->flashdata('error') ?>', 'danger');
        <?php endif; ?>

        function showAlert(message, type) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            `;
            document.querySelector('.dashboard-container').insertBefore(alertDiv, document.querySelector('.user-header'));
            
            setTimeout(() => {
                alertDiv.remove();
            }, 5000);
        }
    </script>
</body>
</html>