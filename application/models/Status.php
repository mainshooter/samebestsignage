<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 6-2-2018
 * Time: 13:17
 */

class Status extends CI_Model
{
    public function get_all_entries(){
        $query = $this->db->query('SELECT * FROM status_types ');
        return $query->result_array();
    }

    public function get_single_entry($id){
        $query = $this->db->query('SELECT * FROM status_types WHERE status_id = '.$this->db->escape($id));
        return $query->result_array();
    }

    public function get_enum(){
        $query = $this->db->query('
            SELECT COLUMN_TYPE 
            FROM INFORMATION_SCHEMA.COLUMNS 
            WHERE TABLE_SCHEMA = "ticket"
            AND TABLE_NAME = "status_types" 
            AND COLUMN_NAME = "status_level"');
        $x = $query->result_array();
        $x = $x[0]['COLUMN_TYPE'];
        $x = str_replace('enum(', '', $x);
        $x = str_replace(')', '', $x);
        $x = str_replace('\'', '', $x);
        $x = explode(','. '', $x);
        return $x;
    }

    public function insert_entry($nam, $lvl, $inf){
        $query = $this->db->query('
          INSERT INTO status_types (status_name, status_level, status_info)
          VALUES (
          '.$this->db->escape($nam).',
           '.$this->db->escape($lvl).',
            '.$this->db->escape($inf).')
           ');
        return $query;
    }

    public function update_entry($id, $nam, $lvl, $inf){
        $query = $this->db->query('UPDATE status_types
            SET 
             status_name = '.$this->db->escape($nam).',
             status_info = '.$this->db->escape($lvl).',
             status_level = '.$this->db->escape($inf).'
            WHERE 
             status_id = '.$this->db->escape($id));
        return $query;
    }
}