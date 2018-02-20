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
        return $query;
    }

    public function update_entry($id, $nam, $inf){
        $query = $this->db->query('UPDATE categorys
            SET cat_name = '.$this->db->escape($_POST['name']).',
             cat_info = '.$this->db->escape($_POST['info']).'
            WHERE cat_id = '.$this->db->escape($id));
        return $query;
    }
}