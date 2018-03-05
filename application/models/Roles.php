<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 6-2-2018
 * Time: 13:46
 */

class Roles extends CI_Model
{
    public function get_all_entries(){
        $query = $this->db->query('SELECT * FROM roles');
        return $query->result_array();
    }

    public function get_entry($id){
        $query = $this->db->query('SELECT * FROM roles WHERE role_id = '.$id);
        return $query->row_array();
    }

    public function insert_entry($nam, $inf){
        $query = $this->db->query('
            INSERT INTO
             roles (
              role_name,
              role_info
             )
            VALUES (
             '.$this->db->escape($nam).',
             '.$this->db->escape($inf).'
            )
        ');

        if($query){
            $this->logs->insert_entry("INSERT", "Right level created", ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
        }

        return $query;
    }

    public function update_entry($id, $nam, $inf){
        $query = $this->db->query('
            UPDATE
             roles 
            SET
              role_name = '.$this->db->escape($nam).',
              role_info = '.$this->db->escape($inf).'
            WHERE
             role_id = '. $id);

        if($query){
            $this->logs->insert_entry("UPDATE", "Right level updated", ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
        }

        return $query;
    }
}