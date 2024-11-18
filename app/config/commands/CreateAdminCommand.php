<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class CreateAdminCommand {
    private $LAVA;

    public function __construct() {
        $this->LAVA =& lava_instance();
        $this->LAVA->call->database();
    }

    public function run() {
        $this->LAVA->call->model('User_model');

        // Create the default admin account
        $admin_data = [
            'username' => 'admin',
            'email' => 'chronicallyoccurring@gmail.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'role' => 'admin',
            'is_verified' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Check if admin already exists
        $existing_admin = $this->LAVA->User_model->get_by_email($admin_data['email']);
        if (!$existing_admin) {
            if ($this->LAVA->User_model->create($admin_data)) {
                echo "Default admin account created successfully.\n";
            } else {
                echo "Failed to create default admin account.\n";
            }
        } else {
            echo "Default admin account already exists.\n";
        }
    }
}

// Execute the command
$command = new CreateAdminCommand();
$command->run();