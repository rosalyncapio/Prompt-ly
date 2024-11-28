<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UserPage_model extends Model {
    
    public function get_user_by_id($user_id) {
        return $this->db->table('users')
            ->where('user_id', $user_id)
            ->get();
    }
    
    public function get_user_prompts($user_id) {
        return $this->db->table('prompts')
            ->where('user_id', $user_id)
            ->order_by('created_at', 'DESC')
            ->get_all();
    }
    
    public function get_user_entries($user_id) {
        return $this->db->table('entries')
            ->where('user_id', $user_id)
            ->order_by('created_at', 'DESC')
            ->get_all();
    }
    
    public function get_user_votes($user_id) {
        return $this->db->table('votes')
            ->where('user_id', $user_id)
            ->join('entries', 'votes.entry_id = entries.id')
            ->order_by('votes.created_at', 'DESC')
            ->get_all();
    }
}