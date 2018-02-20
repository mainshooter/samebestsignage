<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 6-2-2018
 * Time: 13:41
 */

class Mail extends CI_Model
{
    public function get_all_entries(){
        $query = $this->db->query('SELECT * FROM mail_config WHERE id = 1');
        return $query->row_array();
    }

    public function get_default_entry(){
        $query = $this->db->query('SELECT * FROM mail_config WHERE id = 0');
        return $query->row_array();
    }

    public function update_entry($key, $item){
        $query = $this->db->query('UPDATE mail_config SET ' . $key . ' = ' . $this->db->escape($item) . ' WHERE id = 1');
        return $query;
    }
}