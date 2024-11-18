<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Auth extends Controller
{
    public $LAVA;

    public function __construct()
    {
        parent::__construct();
        $this->call->library('lauth');
        $this->call->library('session');
    }
    public function register()
    {
        if ($this->form_validation->submitted()) {
            $username = $this->io->post('username');
            $email = $this->io->post('email');
            $password = $this->io->post('password');
            $email_token = md5(uniqid(rand(), true)); // Generate a unique token

            $user_id = $this->lauth->register($username, $email, $password, $email_token);

            if ($user_id) {
                // Call the newly added method to send verification email
                $this->send_verification_email($email, $email_token);
                $this->session->set_flashdata('success', 'Registration successful. Please check your email to verify your account.');
                redirect('login');
            } else {
                $this->session->set_flashdata('error', 'Registration failed. Please try again.');
            }
        }

        $this->call->view('auth/register');
    }

    private function send_verification_email($email, $email_token)
    {
        $verification_link = site_url('auth/verify_email/' . $email_token);

        $mail = new PHPMailer(true);
        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'chronicallyoccurring@gmail.com'; // Replace with your SMTP username
            $mail->Password = 'ltox eauw rvzp tlrr'; // Replace with your SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Email headers and content
            $mail->setFrom('chronicallyoccurring@gmail.com', 'Promptly');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Account Verification';
            $mail->Body = 'Please click the following link to verify your account: <a href="' . $verification_link . '">Verify Account</a>';

            $mail->send();
        } catch (Exception $e) {
            $this->session->set_flashdata('error', 'Verification email could not be sent. Mailer Error: ' . $mail->ErrorInfo);
        }
    }

    public function goregister()
    {
        $this->call->view('auth/register');
    }

    public function gologin()
    {
        $this->call->view('auth/login');
    }
    public function login()
    {
        if ($this->form_validation->submitted()) {
            $email = $this->io->post('email');
            $password = $this->io->post('password');
    
            $user = $this->lauth->login($email, $password);
    
            if ($user) {
                $this->lauth->set_logged_in($user['user_id'], $user['role']);
    
                if ($user['role'] === 'admin') {
                    redirect('admin/dashboard');
                } else {
                    redirect('users/userpage');
                }
            } else {
                $this->session->set_flashdata('error', 'Invalid email or password.');
            }
        }
    
        $this->call->view('auth/login');
    }

    public function admin_dashboard()
    {
        // Check if user is logged in and has admin role
        if (!$this->lauth->is_logged_in() || $this->session->userdata('role') !== 'admin') {
            $this->session->set_flashdata('error', 'You do not have permission to access the admin dashboard.');
            redirect('login');
        }

        // Load admin dashboard view
        $this->call->view('admin/dashboard');
    }



    public function verify_email($token)
    {
        $user = $this->lauth->verify_email($token);

        if ($user) {
            $this->lauth->verify_now($token);
            $this->session->set_flashdata('success', 'Email verified successfully. You can now log in.');
            redirect('login');
        } else {
            $this->session->set_flashdata('error', 'Invalid or expired verification link.');
            redirect('register');
        }
    }



    public function logout()
    {
        $this->lauth->set_logged_out();
        redirect('login');
    }
}
