<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 6-2-2018
 * Time: 13:16
 */

class User extends CI_Model
{
    public function get_all_entries(){
        $query = $this->db->query('SELECT id, username, email FROM users ');
        return $query->result_array();
    }

    public function get_all_entries_table(){
        $query = $this->db->query('
          SELECT
           u.id AS user_id,
           u.username,
           u.email,
           l.id AS login_id,
           l.date,
           u.created,
           r.role_name
          FROM users AS u
          JOIN roles as r ON u.role_id = r.role_id
          LEFT JOIN logins AS l ON
           l.id = (
            SELECT l2.id FROM logins AS l2
            WHERE u.id = l2.user_id
            ORDER BY l2.id DESC LIMIT 1
          )
          GROUP BY u.id');
        return $query->result_array();
    }

    public function get_single_entry($id){
        $query = $this->db->query('
          SELECT 
           * 
          FROM 
           users AS u 
          JOIN 
           roles as r 
          ON 
           u.role_id = r.role_id 
          LEFT JOIN logins AS l ON
           l.id = (
            SELECT l2.id FROM logins AS l2
            WHERE u.id = l2.user_id
            ORDER BY l2.id DESC LIMIT 1
          )
          WHERE 
           u.id = '.$this->db->escape($id));
        return $query->row_array();
    }

    public function get_single_entry_id($id){
        $query = $this->db->query('
          SELECT 
           * 
          FROM 
           users
          WHERE 
           id = '.$this->db->escape($id));
        return $query->row_array();
    }

    public function get_single_entry_mail($id){
        $query = $this->db->query('SELECT username, email FROM users WHERE id = '.$this->db->escape($id));
        return $query->row_array();
    }

    public function get_single_entry_by_email($email){
        $query = $this->db->query('
          SELECT * FROM users as u
           JOIN roles as r ON u.role_id = r.role_id WHERE u.email = '.$this->db->escape($email));
        return $query->row_array();
    }

    public function get_single_entry_by_hash($hash){
        $query = $this->db->query('SELECT * FROM users WHERE hash = '.$this->db->escape($hash));
        return $query->row_array();
    }

    public function insert_entry($nam, $ema, $pas, $rol){
        $query = $this->db->query('
            INSERT INTO users (username, email, password, role_id) 
             VALUES (
              '.$this->db->escape($nam).', 
              '.$this->db->escape($ema).', 
              '.$this->db->escape($pas).', 
              '.$this->db->escape($rol).'
              ) 
        ');

        if($query){
            $this->logs->insert_entry("INSERT", "User created", ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
        }

        return $query;
    }

    public function insert_super_admin(){
        //pass = AdminPassIdsignage1!
        $query = $this->db->query('
            INSERT INTO users (id, username, email, password, role_id) 
             VALUES (
              1,
              "Super Admin",
              "info@idsignage.nl",
              "$1$nOWlv7hD$FkFIdTI6I82TvAR5N.hD./",
              3
              ) 
        ');

        if($query){
            $this->logs->insert_entry("INSERT", "User created", ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
        }

        return $query;
    }

    public function update_entry($id, $nam, $ema, $rol){
        $query = $this->db->query('
          UPDATE users
           SET 
            username = '.$this->db->escape($nam).',
            email = '.$this->db->escape($ema).',
            role_id = '.$this->db->escape($rol).'
           WHERE 
            id = '.$this->db->escape($id));

        if($query){
            $this->logs->insert_entry("UPDATE", "User no.".$id." updated", ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
        }

        return $query;
    }

    public function update_entry_user($id, $nam, $ema){
        $query = $this->db->query('
          UPDATE users
           SET 
            username = '.$this->db->escape($nam).',
            email = '.$this->db->escape($ema).'
           WHERE 
            id = '.$this->db->escape($id));

        if($query){
            $this->logs->insert_entry("UPDATE", "User no.".$id." updated", ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
        }

        return $query;
    }

    public function _set_last_ip_and_last_login($id){
        $query = $this->db->query('INSERT INTO logins (user_id, ip_address, date) VALUES (' . $this->db->escape($id) . ', "'.$this->input->ip_address().'", NOW())');

        $query = $this->db->query('
          UPDATE users
           SET 
            last_ip = "'.$this->input->ip_address().'"
           WHERE 
            id = '.$this->db->escape($id));

        if($query){
            $this->logs->insert_entry("LOGIN", "User no.".$id." logged in", ($this->session->userdata('DX_user_id') != null)? $this->session->userdata('DX_user_id') : $this->input->ip_address());
        }

        return $query;
    }

    public function update_password($id, $pass){
        $query = $this->db->query('
          UPDATE users
           SET 
            password = '.$this->db->escape($pass).'
           WHERE 
            id = '.$this->db->escape($id));
        return $query;
    }

    public function forgot_password($email, $hash){
        $query = $this->db->query('
          UPDATE users
           SET 
            hash = "'.$hash.'"
           WHERE 
            email = '.$this->db->escape($email));
        return $query;
    }

    public function remove_salt($id){
        $query = $this->db->query('
          UPDATE users
           SET 
            hash = null
           WHERE 
            id = '.$this->db->escape($id));
        return $query;
    }
}