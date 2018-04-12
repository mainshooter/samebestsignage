<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 10-4-2018
 * Time: 09:31
 */

class Page extends CI_Model
{
    public function get_all_entries(){
        $query = $this->db->query('SELECT * FROM pages_list');
        return $query->result_array();
    }

    public function get_all_entries_by_type($type){
        $query = $this->db->query('SELECT * FROM pages_list WHERE page_type = '.$this->db->escape($type));
        return $query->result_array();
    }

    public function get_entry($id){
        $query = $this->db->query('SELECT * FROM pages_list WHERE page_id = '.$id);
        return $query->row_array();
    }

    public function get_entry_by_name($name){
        $query = $this->db->query('SELECT page_level FROM pages_list WHERE page_name = '.$this->db->escape($name));
        return $query->row_array();
    }

    public function get_enum(){
        $type = $this->db->query( "SHOW COLUMNS FROM pages_list WHERE Field = 'page_type'" )->row( 0 )->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enum = explode("','", $matches[1]);
        return $enum;
    }

    public function insert_entry($name, $type, $link, $level){
        $query = $this->db->query('
            INSERT INTO
             pages_list (
              page_name,
              page_type,
              page_link,
              page_level
             )
            VALUES (
             '.$this->db->escape($name).',
             '.$this->db->escape($type).',
             '.$this->db->escape($link).',
             '.$this->db->escape($level).'
            )
        ');

        if($query){
            $this->logs->insert_entry("INSERT", "Page created", ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
        }

        return $query;
    }

    public function update_entry($id, $name, $type, $link, $level){
        $query = $this->db->query('
            UPDATE
             pages_list 
            SET
              page_name = '.$this->db->escape($name).',
              page_type = '.$this->db->escape($type).',
              page_link = '.$this->db->escape($link).',
              page_level = '.$this->db->escape($level).'
            WHERE
             page_id = '. $id);

        if($query){
            $this->logs->insert_entry("UPDATE", "Page no.".$id." updated", ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
        }

        return $query;
    }
}