<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Prompts extends Controller {
    public function __construct() {
        parent::__construct();
        $this->call->model('Prompt_model');    
    }

    public function index() {
        $data['prompts'] = $this->Prompt_model->get_all();
        $this->call->view('admin/prompts/index', $data);
    }

    public function create() {
        if ($this->form_validation->submitted()) {
            $this->form_validation->name('title')->required();
            $this->form_validation->name('description')->required();
            $this->form_validation->name('start_date')->required();
            $this->form_validation->name('end_date')->required();

            if ($this->form_validation->run()) {
                $data = array(
                    'title' => $this->io->post('title'),
                    'description' => $this->io->post('description'),
                    'start_date' => $this->io->post('start_date'),
                    'end_date' => $this->io->post('end_date')
                );
                if ($this->Prompt_model->create($data)) {
                    $this->session->set_flashdata('success', 'Prompt created successfully');
                } else {
                    $this->session->set_flashdata('error', 'Failed to create prompt');
                }
                redirect('prompts');
            }
        }
        $this->call->view('admin/prompts/create');
    }

    public function edit($id) {
        $data['prompt'] = $this->Prompt_model->get($id);
        
        if (!$data['prompt']) {
            $this->session->set_flashdata('error', 'Prompt not found');
            redirect('prompts');
        }

        if ($this->form_validation->submitted()) {
            $this->form_validation->name('title')->required();
            $this->form_validation->name('description')->required();
            $this->form_validation->name('start_date')->required();
            $this->form_validation->name('end_date')->required();

            if ($this->form_validation->run()) {
                $update_data = array(
                    'title' => $this->io->post('title'),
                    'description' => $this->io->post('description'),
                    'start_date' => $this->io->post('start_date'),
                    'end_date' => $this->io->post('end_date')
                );
                if ($this->Prompt_model->edit($id, $update_data)) {
                    $this->session->set_flashdata('success', 'Prompt updated successfully');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update prompt');
                }
                redirect('prompts');
            }
        }
        $this->call->view('admin/prompts/edit', $data);
    }

    public function delete($id) {
        if ($this->Prompt_model->delete($id)) {
            $this->session->set_flashdata('success', 'Prompt deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete prompt');
        }
        redirect('prompts');
    }
}
