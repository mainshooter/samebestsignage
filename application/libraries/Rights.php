<?php
/**
 * Created by PhpStorm.
 * User: Jordi
 * Date: 11-4-2018
 * Time: 13:07
 */

class Rights
{
    public function validate_rights($page){
        $CI =& get_instance();

        $rights = $CI->page->get_entry_by_name($page);

        if (!in_array($CI->session->userdata('DX_role_id'), json_decode($rights['page_level'], true))){
            $CI->session->sess_destroy();
            redirect('/login');
        }
    }
}