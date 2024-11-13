<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Auth extends Controller {
    public function __construct() {
        parent::__construct();
        $this->call->model('User_model');    
    }

    public function goregister() {
        $this->call->view('auth/register');
    }

    public function gologin() {
        $this->call->view('auth/login');
    }

    public function login() {
        // Check if already logged in
        if ($this->session->userdata('user_id')) {
            $this->redirect_based_on_role();
        }

        if ($this->form_validation->submitted()) {
            $this->form_validation->name('email')->required()->valid_email();
            $this->form_validation->name('password')->required();

            if ($this->form_validation->run()) {
                $email = $this->io->post('email');
                $password = $this->io->post('password');

                $user = $this->User_model->get_by_email($email);

                if ($user && password_verify($password, $user['password']) && $user['is_verified']) {
                    // Set session data
                    $this->session->set_userdata([
                        'user_id' => $user['user_id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'role' => $user['role'],
                        'is_logged_in' => true
                    ]);

                    $this->session->set_flashdata('success', 'Welcome back, ' . $user['username']);
                    $this->redirect_based_on_role();
                } else {
                    $this->session->set_flashdata('error', 'Invalid email, password, or unverified account');
                }
            }
        }

        $this->call->view('auth/login');
    }

    private function redirect_based_on_role() {
        if ($this->session->userdata('role') == 'admin') {
            redirect('admin/dashboard');
        } else {
            redirect('user/userpage');
        }
    }

    public function register() {
        if ($this->form_validation->submitted()) {
            $this->form_validation->name('username')->required();
            $this->form_validation->name('email')->required()->valid_email();
            $this->form_validation->name('password')->required()->min_length(6);
            $this->form_validation->name('confirm_password')->required()->matches('password');

            if ($this->form_validation->run()) {
                $email = $this->io->post('email');
                $verification_code = md5(uniqid(rand(), true));

                $data = array(
                    'username' => $this->io->post('username'),
                    'email' => $email,
                    'password' => password_hash($this->io->post('password'), PASSWORD_DEFAULT),
                    'verification_code' => $verification_code,
                    'is_verified' => 0, // User is not verified initially
                    'role' => 'user' // Default role as 'user', you can add logic to set roles
                );

                if ($this->User_model->create($data)) {
                    // Send verification email
                    $this->send_verification_email($email, $verification_code);
                    $this->session->set_flashdata('success', 'Registration successful. Please check your email to verify your account.');
                    redirect('login');
                } else {
                    $this->session->set_flashdata('error', 'Registration failed. Please try again.');
                }
            }
        }
        $this->call->view('auth/register');
    }

    private function send_verification_email($email, $verification_code) {
        $verification_link = site_url('auth/verify_email/' . $verification_code);
        $subject = "Account Verification";
        $message = "Please click the following link to verify your account: " . $verification_link;

        // Use your mail function here. Replace with actual email-sending code.
        mail($email, $subject, $message);
    }

    public function verify_email($verification_code) {
        $user = $this->User_model->get_by_verification_code($verification_code);

        if ($user) {
            $this->User_model->verify_user($user['user_id']);
            $this->session->set_flashdata('success', 'Email verified successfully. You can now log in.');
            redirect('login');
        } else {
            $this->session->set_flashdata('error', 'Invalid verification link.');
            redirect('register');
        }
    }

    public function logout() {
        // Destroy the session and redirect to login page
        session_destroy();
        redirect('login');
    }
}
