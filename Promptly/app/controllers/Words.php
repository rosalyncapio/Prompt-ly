<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Words extends Controller {
    public function __construct() {
        parent::__construct();
        $this->call->model('Word_model');
    }

    public function index() {
        $data['words'] = $this->Word_model->get_all_words();
        $data['word_history'] = $this->Word_model->get_word_history();
        $this->call->view('addWord', $data);
    }

    public function add_word() {
        $word = $this->io->post('word');
        $definition = $this->io->post('definition');

        if (empty($word) || empty($definition)) {
            echo json_encode(['status' => 'error', 'message' => 'Word and definition are required']);
            return;
        }

        $result = $this->Word_model->add_word($word, $definition);

        if ($result) {
            $newWord = $this->Word_model->get_word_by_id($result);
            if ($newWord) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Word added successfully',
                    'word' => $newWord
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Word was added but could not retrieve details'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to add word'
            ]);
        }
    }
}