<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Word_model extends Model {
    public function __construct() {
        parent::__construct();
        $this->call->database();
    }

    public function get_all_words() {
        return $this->db->table('words')->order_by('created_at', 'DESC')->get_all();
    }

    public function get_word_history() {
        return $this->db->table('words')->order_by('created_at', 'DESC')->limit(10)->get_all();
    }

    public function add_word($word, $definition) {
        $data = [
            'word' => $word,
            'definition' => $definition,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->transaction();
        
        try {
            $this->db->table('words')->insert($data);
            $result = $this->db->raw('SELECT LAST_INSERT_ID() as id');
            $lastId = $result->fetch(PDO::FETCH_ASSOC)['id'];
            $this->db->commit();
            return $lastId;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function get_word_by_id($id) {
        return $this->db->table('words')->where('id', $id)->get();
    }
}