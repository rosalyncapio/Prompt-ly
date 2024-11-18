<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    $allowed_pages = ['home', 'analytics', 'settings'];

    if (in_array($page, $allowed_pages)) {
        $file = $page . '.php';
        if (file_exists($file)) {
            include $file;
        } else {
            echo "<p>Page not found.</p>";
        }
    } else {
        echo "<p>Invalid page request.</p>";
    }
} else {
    echo "<p>No page specified.</p>";
}
?>