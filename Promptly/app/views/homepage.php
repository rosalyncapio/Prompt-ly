<?php
include APP_DIR.'views/templates/header.php';
?>
<body class="bg-black text-white min-h-screen flex">
    <div class="flex space-x-4 p-3 bg-black w-screen h-screen">
        <!-- Sidebar -->
        <div class="w-64 border-r border-gray-800 bg-black p-4">
            <div class="mb-8">
                <div class="flex items-center">
                    <span class="font-script text-2xl text-white">Daily</span>
                    <span class="font-bold text-2xl text-cyan-400 relative">
                        PR<span class="relative">O<span class="absolute -top-1 left-1/2 -translate-x-1/2 text-xs">✒️</span></span>MPT
                    </span>
                </div>
            </div>
            <nav class="space-y-2">
                <button data-page="dashboard" class="nav-button w-full flex items-center gap-2 rounded-md p-2 transition-colors duration-200 ease-in-out bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    <div class="grid h-4 w-4 place-items-center rounded bg-indigo-500">
                        <div class="h-2 w-2 rounded-sm bg-white"></div>
                    </div>
                    <span>Dashboard</span>
                </button>
                <button data-page="prompts" class="nav-button w-full flex items-center gap-2 rounded-md p-2 text-gray-400 transition-colors duration-200 ease-in-out hover:bg-indigo-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    <div class="h-4 w-4">
                        <div class="h-3 w-3 border-2 border-current"></div>
                    </div>
                    <span>Prompts</span>
                </button>
                <button data-page="user-entries" class="nav-button w-full flex items-center gap-2 rounded-md p-2 text-gray-400 transition-colors duration-200 ease-in-out hover:bg-indigo-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    <div class="h-4 w-4">
                        <div class="h-3 w-3 rotate-45 border-2 border-current"></div>
                    </div>
                    <span>User Entries</span>
                </button>
                <button data-page="badges" class="nav-button w-full flex items-center gap-2 rounded-md p-2 text-gray-400 transition-colors duration-200 ease-in-out hover:bg-indigo-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    <div class="h-4 w-4">
                        <div class="h-3 w-3 rounded-full border-2 border-current"></div>
                    </div>
                    <span>Badges</span>
                </button>
                <button data-page="analytics" class="nav-button w-full flex items-center gap-2 rounded-md p-2 text-gray-400 transition-colors duration-200 ease-in-out hover:bg-indigo-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    <div class="h-4 w-4">
                        <div class="mt-1 h-2 w-4 border-t-2 border-current"></div>
                    </div>
                    <span>Analytics</span>
                </button>
                <div class="my-4 border-t border-gray-800"></div>
                <button data-page="settings" class="nav-button w-full flex items-center gap-2 rounded-md p-2 text-gray-400 transition-colors duration-200 ease-in-out hover:bg-indigo-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                    <div class="h-4 w-4">
                        <div class="mt-1 h-3 w-3 rounded-full border-2 border-current"></div>
                    </div>
                    <span>Settings</span>
                </button>
            </nav>
        </div>

        <!-- Main Content Area -->
        <div id="content" class="flex-1 p-0 overflow-y-auto" style="scrollbar-width: thin; scrollbar-color: rgba(0, 0, 0, 0.2) transparent;">
            <!-- Dashboard Content -->
            <div id="dashboard-content" class="content-section">
                <?php
                include APP_DIR.'views/dashboard.php';
                ?>
            </div>

            <!-- Prompts Content (Add Word) -->
            <div id="prompts-content" class="content-section hidden container mx-auto p-0">
                <div class="container mx-auto">
                    <?php
                    include APP_DIR.'views/addWord.php';
                    ?>
                </div>
            </div>

            <!-- User Entries Content -->
            <div id="user-entries-content" class="content-section hidden">
                <h2 class="text-2xl font-bold mb-4">User Entries</h2>
                <p>Content for User Entries goes here.</p>
            </div>

            <!-- Badges Content -->
            <div id="badges-content" class="content-section hidden">
                <h2 class="text-2xl font-bold mb-4">Badges</h2>
                <p>Content for Badges goes here.</p>
            </div>

            <!-- Analytics Content -->
            <div id="analytics-content" class="content-section hidden">
                <h2 class="text-2xl font-bold mb-4">Analytics</h2>
                <p>Content for Analytics goes here.</p>
            </div>

            <!-- Settings Content -->
            <div id="settings-content" class="content-section hidden">
                <h2 class="text-2xl font-bold mb-4">Settings</h2>
                <p>Content for Settings goes here.</p>
            </div>
        </div>

        <!-- Recent Activity Sidebar -->
        <div class="w-64 border-l border-gray-800 bg-black p-4">
            <?php
            include APP_DIR.'views/templates/recentActivity.php';
            ?>
        </div>
    </div>

    <div id="notification" class="fixed top-4 right-4 p-4 rounded-md text-white hidden"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Show dashboard content by default
        showContent('dashboard');

        // Handle sidebar button clicks
        $('.nav-button').on('click', function() {
            var page = $(this).data('page');
            showContent(page);

            // Update active state
            $('.nav-button').removeClass('bg-indigo-600 text-white').addClass('text-gray-400');
            $(this).removeClass('text-gray-400').addClass('bg-indigo-600 text-white');
        });

        function showContent(page) {
            // Hide all content sections
            $('.content-section').addClass('hidden');
            
            // Show the selected content section
            $(`#${page}-content`).removeClass('hidden');
        }

        // Handle form submission (for add word form)
        $('#addWordForm').on('submit', function(e) {
            e.preventDefault();
            // Here you would typically send an AJAX request to add the word
            // For demonstration, we'll just log the form data
            console.log({
                word: $('#word').val(),
                definition: $('#definition').val()
            });
            // Clear the form
            this.reset();
            // You could also add the new word to the table here
        });
    });
    </script>
</body>
</html>