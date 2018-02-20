<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 6-2-2018
 * Time: 13:16
 */

class Clients extends CI_Model
{
    public function get_all_entries(){
        $query = $this->db->query('SELECT client_id, client_name, client_email FROM clients ');
        return $query->result_array();
    }

    public function get_all_entries_full(){
        $query = $this->db->query('SELECT * FROM clients ');
        return $query->result_array();
    }

    public function get_single_entry($id){
        $query = $this->db->query('SELECT * FROM clients WHERE client_id = '.$this->db->escape($id));
        return $query->row_array();
    }

    public function insert_entry($nam, $tel , $ema, $cou, $sta, $tow, $str, $num, $zip){
        $query = $this->db->query('
          INSERT INTO clients ( client_name, client_tel, client_email, client_country, client_state, client_city, client_street, client_street_number, client_zipcode ) 
            VALUES (
            '.$this->db->escape($nam).',
            '.$this->db->escape($tel).',
            '.$this->db->escape($ema).',
            '.$this->db->escape($cou).',
            '.$this->db->escape($sta).',
            '.$this->db->escape($tow).',
            '.$this->db->escape($str).',
            '.$this->db->escape($num).',
            '.$this->db->escape($zip).'
            )
            ');
        return $query;
    }

    public function update_entry($id, $nam, $tel , $ema, $cou, $sta, $tow, $str, $num, $zip){
        $query = $this->db->query('
          UPDATE clients SET 
           client_name = '.$this->db->escape($nam).',
           client_tel = '.$this->db->escape($tel).', 
           client_email = '.$this->db->escape($ema).',
           client_country = '.$this->db->escape($cou).', 
           client_state = '.$this->db->escape($sta).', 
           client_city = '.$this->db->escape($tow).', 
           client_street = '.$this->db->escape($str).', 
           client_street_number = '.$this->db->escape($num).', 
           client_zipcode = '.$this->db->escape($zip).'
          WHERE client_id =  '. $id );
        return $query;
    }
}