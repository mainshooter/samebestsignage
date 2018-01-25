<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 24-1-2018
 * Time: 13:24
 */

class Ajax extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->library('DX_Auth');
        if (! $this->dx_auth->is_logged_in()){
            $this->session->sess_destroy();
            redirect('auth/login');
        }

        $this->load->helper('main_helper');
        $this->load->database();
    }

    public function addTicket(){
       if ( ! $query = $this->db->query('
          INSERT INTO tickets (ticket_type, ticket_status, ticket_importance, ticket_problem)
          VALUES (
          '.$this->db->escape($_POST['category']).',
           '.$this->db->escape($_POST['status']).',
            '.$this->db->escape($_POST['importance']).',
             '.$this->db->escape($_POST['problem']).')
           '))
        {
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
           echo check('check-success', 'check', '/home');
        }
    }

    public function addCategory(){
       if ( ! $query = $this->db->query('
          INSERT INTO alert_types (alert_name, alert_info)
          VALUES (
          '.$this->db->escape($_POST['name']).',
           '.$this->db->escape($_POST['info']).')
           '))
        {
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
           echo check('check-success', 'check', '/settings/category');
        }
    }

    public function editCategory($id){
       if ( ! $query = $this->db->query('UPDATE alert_types
            SET alert_name = '.$this->db->escape($_POST['name']).',
             alert_info = '.$this->db->escape($_POST['info']).'
            WHERE alert_id = '.$this->db->escape($id)))
        {
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
           echo check('check-success', 'check', '/settings/category');
        }
    }

    public function addStatus(){
       if ( ! $query = $this->db->query('
          INSERT INTO status_types (status_name, status_level, status_info)
          VALUES (
          '.$this->db->escape($_POST['name']).',
           '.$this->db->escape($_POST['level']).',
            '.$this->db->escape($_POST['info']).')
           '))
        {
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
           echo check('check-success', 'check', '/settings/status');
        }
    }

    public function editStatus($id){
       if ( ! $query = $this->db->query('UPDATE status_types
            SET 
             status_name = '.$this->db->escape($_POST['name']).',
             status_info = '.$this->db->escape($_POST['info']).',
             status_level = '.$this->db->escape($_POST['level']).'
            WHERE 
             status_id = '.$this->db->escape($id)))
        {
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
           echo check('check-success', 'check', '/settings/status');
        }
    }

    public function addImportance(){
       if ( ! $query = $this->db->query('
          INSERT INTO importance_types (importance_name, importance_info, importance_color, importance_level)
          VALUES (
          '.$this->db->escape($_POST['name']).',
           '.$this->db->escape($_POST['info']).',
            '.$this->db->escape($_POST['color']).',
             '.$this->db->escape($_POST['level']).')
           '))
        {
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
           echo check('check-success', 'check', '/settings/importance');
        }
    }

    public function editImportance($id){
       if ( ! $query = $this->db->query('UPDATE importance_types
            SET 
             importance_name = '.$this->db->escape($_POST['name']).',
             importance_info = '.$this->db->escape($_POST['info']).',
             importance_color = '.$this->db->escape($_POST['color']).',
             importance_level = '.$this->db->escape($_POST['level']).'
            WHERE 
             importance_id = '.$this->db->escape($id)))
        {
            echo alert('danger', 'DATABASE::ERROR!!!!', var_dump($this->db->error()));
        } else{
            echo check('check-success', 'check', '/settings/importance');
        }
    }
}