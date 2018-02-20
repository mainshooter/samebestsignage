<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 6-2-2018
 * Time: 13:10
 */

class Ticket extends CI_Model
{
    public function get_all_entries(){
        $query = $this->db->query('
          SELECT t.ticket_id, c.client_name, a.cat_name, t.ticket_problem, t.ticket_created_at, t.ticket_completed_at, s.status_name, u.email FROM tickets AS  t
           JOIN categorys AS a ON t.ticket_type = a.cat_id
           JOIN status_types AS s ON t.ticket_status = s.status_id
           JOIN users AS u ON t.ticket_master = u.id
           JOIN clients AS c ON t.client_id = c.client_id
           JOIN importance_types AS i ON t.ticket_importance = i.importance_id');
        return $query;
    }

    public function get_my_entries(){
        $query = $this->db->query('
          SELECT t.ticket_id, c.client_name, a.cat_name, t.ticket_problem, t.ticket_created_at, t.ticket_completed_at, s.status_name FROM tickets AS  t
           JOIN categorys AS a ON t.ticket_type = a.cat_id
           JOIN status_types AS s ON t.ticket_status = s.status_id
           JOIN users AS u ON t.ticket_master = u.id
           JOIN importance_types AS i ON t.ticket_importance = i.importance_id
           JOIN clients AS c ON t.client_id = c.client_id
           WHERE t.ticket_master = '.$this->session->userdata('DX_user_id'));
        return $query;
    }

    public function get_pending_entries(){
        $query = $this->db->query('
          SELECT * FROM tickets AS t 
            JOIN categorys AS a ON t.ticket_type = a.cat_id
            JOIN status_types AS s ON t.ticket_status = s.status_id
            JOIN importance_types AS i ON t.ticket_importance = i.importance_id
            JOIN users AS u ON t.ticket_master = u.id
            JOIN clients AS c ON t.client_id = c.client_id
            WHERE t.ticket_completed_at IS NULL AND s.status_level = "pending"
            ORDER BY i.importance_level ASC');
        return $query->result_array();
    }

    public function get_completed_entries(){
        $query = $this->db->query('
          SELECT * FROM tickets AS t 
           JOIN categorys AS a ON t.ticket_type = a.cat_id
           JOIN status_types AS s ON t.ticket_status = s.status_id
           JOIN importance_types AS i ON t.ticket_importance = i.importance_id
           JOIN clients AS c ON t.client_id = c.client_id
           JOIN users AS u ON t.ticket_master = u.id
           WHERE t.ticket_completed_at IS NOT NULL');
        return $query->result_array();
    }

    public function get_single_entry($id){
        $query = $this->db->query('
          SELECT * FROM tickets AS t
           JOIN categorys AS a ON t.ticket_type = a.cat_id
           JOIN status_types AS s ON t.ticket_status = s.status_id
           JOIN importance_types AS i ON t.ticket_importance = i.importance_id
           JOIN clients AS c ON t.client_id = c.client_id
           JOIN users AS u ON t.ticket_master = u.id
           WHERE t.ticket_id = '.$this->db->escape($id).'
           ');

        return $query->row_array();
    }

    public function get_all_ticket_no_join(){
        $query = $this->db->query('SELECT * FROM tickets');
        return $query->result_array();
    }

    public function get_pie_chart(){
        $query = $this->db->query('SELECT a.cat_name FROM tickets AS t JOIN categorys AS a  ON t.ticket_type = a.cat_id');
        return $query->result_array();
    }

    public function get_pie_chart_client(){
        $query = $this->db->query('SELECT c.client_name FROM tickets AS t JOIN clients AS c  ON t.client_id = c.client_id');
        return $query->result_array();
    }

    public function get_pie_chart_imp(){
        $query = $this->db->query('SELECT i.importance_name FROM tickets AS t JOIN importance_types AS i  ON t.ticket_importance = i.importance_id');
        return $query->result_array();
    }

    public function insert_entry($cli, $cat, $sta, $imp, $pro, $img, $DX_, $use){
        $query = $this->db->query('
          INSERT INTO tickets (client_id, ticket_type, ticket_status, ticket_importance, ticket_problem, ticket_images, ticket_creator, ticket_master)
          VALUES (
          '.$this->db->escape($cli).',
           '.$this->db->escape($cat).',
            '.$this->db->escape($sta).',
             '.$this->db->escape($imp).',
              '.$this->db->escape($pro).',
                '.$this->db->escape($img).',
               '.$this->db->escape($DX_).',
                '.$this->db->escape($use).')
           ');
        return $query;
    }

    public function complete_entry($id, $sol, $sta){
        $query = $this->db->query('
          UPDATE tickets
           SET 
            ticket_solution = '.$this->db->escape($sol).',
            ticket_status = '.$this->db->escape($sta).',
            ticket_completed_at = NOW()
           WHERE ticket_id = '.$this->db->escape($id));
        return $query;
    }

    public function update_entry($id, $pro){
        $query = $this->db->query('
          UPDATE tickets
           SET 
            ticket_problem = '.$this->db->escape($pro).',
            ticket_edited_at = NOW()
           WHERE ticket_id = '.$this->db->escape($id));
        return $query;
    }

    public function update_entry_assign($id, $use, $com){
        $query = $this->db->query('
          UPDATE tickets
           SET 
            ticket_comment = '.$this->db->escape($com).',
            ticket_master = '.$this->db->escape($use).',
            ticket_edited_at = NOW()
           WHERE ticket_id = '.$this->db->escape($id));
        return $query;
    }

    public function restore_entry($id){
        $query = $this->db->query('
          UPDATE tickets
           SET 
            ticket_status = 1, 
            ticket_completed_at = NULL, 
            ticket_edited_at = NOW()
           WHERE ticket_id = '.$this->db->escape($id));
        return $query;
    }
}