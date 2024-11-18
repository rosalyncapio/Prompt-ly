<?php
// Database configuration
$db_config = [
    'host' => 'localhost',
    'dbname' => 'promptly',
    'username' => 'root',
    'password' => ''
];

try {
    // Create a PDO instance
    $pdo = new PDO(
        "mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset=utf8mb4",
        $db_config['username'],
        $db_config['password'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // Create the default admin account
    $admin_data = [
        'username' => 'admin',
        'email' => 'chronicallyoccurring@gmail.com',
        'password' => password_hash('admin123', PASSWORD_DEFAULT),
        'role' => 'admin',
        'is_verified' => 1,
        'created_at' => date('Y-m-d H:i:s'),
    ];

    // Check if admin already exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $admin_data['email']]);
    $existing_admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$existing_admin) {
        // Insert the new admin user
        $sql = "INSERT INTO users (username, email, password, role, is_verified, created_at) 
                VALUES (:username, :email, :password, :role, :is_verified, :created_at)";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute($admin_data)) {
            echo "Default admin account created successfully.\n";
        } else {
            echo "Failed to create default admin account.\n";
        }
    } else {
        echo "Default admin account already exists.\n";
    }

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}