<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 6-2-2018
 * Time: 13:17
 */

class Category extends CI_Model
{
    public function get_all_entries(){
        $query = $this->db->query('SELECT * FROM categorys ');
        return $query->result_array();
    }

    public function get_all_entries_active(){
        $query = $this->db->query('SELECT * FROM categorys WHERE cat_active = 1');
        return $query->result_array();
    }

    public function get_single_entry($id){
        $query = $this->db->query('SELECT * FROM categorys WHERE cat_id = '.$this->db->escape($id));
        return $query->row_array();
    }

    public function insert_entry($nam, $inf){
        $query = $this->db->query('
          INSERT INTO categorys (cat_name, cat_info)
          VALUES (
          '.$this->db->escape($nam).',
           '.$this->db->escape($inf).')
           ');

        if($query){
            $this->logs->insert_entry("INSERT", "Category created", ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
        }

        return $query;
    }

    public function update_entry($id, $nam, $inf){
        $query = $this->db->query('UPDATE categorys
            SET cat_name = '.$this->db->escape($nam).',
             cat_info = '.$this->db->escape($inf).'
            WHERE cat_id = '.$this->db->escape($id));

        if($query){
            $this->logs->insert_entry("UPDATE", "Category no.".$id." updated", ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
        }

        return $query;
    }

    public function toggle_category($id){
        $cat = $this->get_single_entry($id);

        $bool = $cat['cat_active'];

        switch ($bool) {
            case 0:
                $bool = 1;
                $msg = 'on';
                break;
            case 1:
                $bool = 0;
                $msg = 'off';
                break;
        }

        $query = $this->db->query('UPDATE categorys
            SET 
             cat_active = '.$bool.'
            WHERE cat_id = '.$this->db->escape($id));

        if($query){
            $this->logs->insert_entry("UPDATE", "Category no.".$id." is turned ". $msg, ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
            return $msg;
        } else{
            return false;
        }
    }
}