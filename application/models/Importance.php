<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 6-2-2018
 * Time: 13:17
 */

class Importance extends CI_Model
{
    public function get_all_entries(){
        $query = $this->db->query('SELECT * FROM importance_types ');
        return $query->result_array();
    }

    public function get_single_entry($id){
        $query = $this->db->query('SELECT * FROM importance_types WHERE importance_id = '.$this->db->escape($id));
        return $query->row_array();
    }

    public function get_enum(){
        $query = $this->db->query('
            SELECT COLUMN_TYPE 
            FROM INFORMATION_SCHEMA.COLUMNS 
            WHERE TABLE_SCHEMA = "ticket"
            AND TABLE_NAME = "importance_types" 
            AND COLUMN_NAME = "importance_level"');
        $x = $query->result_array();
        $x = $x[0]['COLUMN_TYPE'];
        $x = str_replace('enum(', '', $x);
        $x = str_replace(')', '', $x);
        $x = str_replace('\'', '', $x);
        $x = explode(','. '', $x);
        return $x;
    }

    public function insert_entry($nam, $inf, $col, $lvl){
        $query = $this->db->query('
          INSERT INTO importance_types (importance_name, importance_info, importance_color, importance_level)
          VALUES (
          '.$this->db->escape($nam).',
           '.$this->db->escape($inf).',
            '.$this->db->escape($col).',
             '.$this->db->escape($lvl).')
           ');

        if($query){
            $this->logs->insert_entry("INSERT", "Importance created", ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
        }

        return $query;
    }

    public function update_entry($id, $nam, $inf, $col, $lvl){
        $query = $this->db->query('UPDATE importance_types
            SET 
             importance_name = '.$this->db->escape($nam).',
             importance_info = '.$this->db->escape($inf).',
             importance_color = '.$this->db->escape($col).',
             importance_level = '.$this->db->escape($lvl).'
            WHERE 
             importance_id = '.$this->db->escape($id));

        if($query){
            $this->logs->insert_entry("UPDATE", "Importance no.".$id." updated", ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
        }

        return $query;
    }
}