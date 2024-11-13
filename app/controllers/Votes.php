<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Votes extends Controller {
    public function __construct() {
        parent::__construct();
        $this->call->model('Vote_model');
        $this->call->model('User_model');
        $this->call->model('Prompt_model');
    }

    public function index() {
        // Get all votes with the related user and prompt data
        $data['votes'] = $this->Vote_model->get_all();
        $this->call->view('admin/votes/index', $data);
    }

    public function create() {
        if ($this->form_validation->submitted()) {
            $this->form_validation->name('user_id')->required();
            $this->form_validation->name('prompt_id')->required();
            $this->form_validation->name('vote_type')->required();

            if ($this->form_validation->run()) {
                $data = array(
                    'user_id' => $this->io->post('user_id'),
                    'prompt_id' => $this->io->post('prompt_id'),
                    'vote_type' => $this->io->post('vote_type')
                );
                $this->Vote_model->create($data);
                $this->session->set_flashdata('success', 'Vote created successfully');
                redirect('votes');
            }
        }
        $data['users'] = $this->User_model->get_all();
        $data['prompts'] = $this->Prompt_model->get_all();
        $this->call->view('admin/votes/create', $data);
    }

    public function edit($id) {
        $data['vote'] = $this->Vote_model->get($id);
        if ($this->form_validation->submitted()) {
            $this->form_validation->name('id')->required();
            $this->form_validation->name('prompt_id')->required();
            $this->form_validation->name('vote_type')->required();

            if ($this->form_validation->run()) {
                $data = array(
                    'id' => $this->io->post('id'),
                    'prompt_id' => $this->io->post('prompt_id'),
                    'vote_type' => $this->io->post('vote_type')
                );
                $this->Vote_model->update($id, $data);
                $this->session->set_flashdata('success', 'Vote updated successfully');
                redirect('votes');
            }
        }
        $data['users'] = $this->User_model->get_all();
        $data['prompts'] = $this->Prompt_model->get_all();
        $this->call->view('admin/votes/edit', $data);
    }

    public function delete($id) {
        $this->Vote_model->delete($id);
        $this->session->set_flashdata('success', 'Vote deleted successfully');
        redirect('votes');
    }
}
?>
