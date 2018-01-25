<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 24-1-2018
 * Time: 14:01
 */

class Settings extends CI_Controller
{
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

    public function category(){
        $data['title'] = 'Category Settings';
        $data["page_title"] = 'Category Settings';
        $data["page_title_desc"] = 'Here are all the settings for the category\'s';

        $query = $this->db->query('SELECT * FROM alert_types');
        $data['categorys'] = $query->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('settings/category', $data);
        $this->load->view('templates/footer', $data);
    }

    public function addcategory(){
        $data['title'] = 'Category Settings';
        $data["page_title"] = 'Add Category';
        $data["page_title_desc"] = 'Here you can create a category';

        $this->load->view('templates/header', $data);
        $this->load->view('settings/add/category', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editcategory($id = null){
        if (!is_int($id)){
            $id = $this->uri->segment('4');
        }
        $data['title'] = 'Category Settings';
        $data["page_title"] = 'Edit Category';
        $data["page_title_desc"] = 'Here you can change a category';

        $query = $this->db->query('SELECT * FROM alert_types WHERE alert_id = '.$this->db->escape($id));
        $data['category'] = $query->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('settings/edit/category', $data);
        $this->load->view('templates/footer', $data);
    }

    public function status(){
        $data['title'] = 'Status Settings';
        $data["page_title"] = 'Status Settings';
        $data["page_title_desc"] = 'Here are all the settings for the statuses';

        $query = $this->db->query('SELECT * FROM status_types');
        $data['statuses'] = $query->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('settings/status', $data);
        $this->load->view('templates/footer', $data);
    }

    public function addstatus(){
        $data['title'] = 'Status Settings';
        $data["page_title"] = 'Add Status';
        $data["page_title_desc"] = 'Here you can create a category';

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
        $data['levels'] = $x;

        $this->load->view('templates/header', $data);
        $this->load->view('settings/add/status', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editstatus($id = null){
        if (!is_int($id)){
            $id = $this->uri->segment('4');
        }
        $data['title'] = 'Status Settings';
        $data["page_title"] = 'Edit Status';
        $data["page_title_desc"] = 'Here you can change a category';

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
        $data['levels'] = $x;

        $query = $this->db->query('SELECT * FROM status_types WHERE status_id = '.$this->db->escape($id));
        $data['status'] = $query->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('settings/edit/status', $data);
        $this->load->view('templates/footer', $data);
    }

    public function importance(){
        $data['title'] = 'Importance Settings';
        $data["page_title"] = 'Importance Settings';
        $data["page_title_desc"] = 'Here are all the settings for the importance types';

        $query = $this->db->query('SELECT * FROM importance_types');
        $data['importances'] = $query->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('settings/importance', $data);
        $this->load->view('templates/footer', $data);
    }

    public function addimportance(){
        $data['title'] = 'Status Settings';
        $data["page_title"] = 'Add Status';
        $data["page_title_desc"] = 'Here you can create a category';

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
        $data['levels'] = $x;

        $this->load->view('templates/header', $data);
        $this->load->view('settings/add/importance', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editimportance($id = null){
        if (!is_int($id)){
            $id = $this->uri->segment('4');
        }
        $data['title'] = 'Status Settings';
        $data["page_title"] = 'Edit Status';
        $data["page_title_desc"] = 'Here you can change a category';

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
        $data['levels'] = $x;

        $query = $this->db->query('SELECT * FROM importance_types WHERE importance_id = '.$this->db->escape($id));
        $data['importance'] = $query->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('settings/edit/importance', $data);
        $this->load->view('templates/footer', $data);
    }
}