<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if ( ! function_exists('asset'))
{
    /**
     * Asset
     *
     * Assets like js and css files
     */
    function asset($asset = '')
    {
        return base_url('public/'. $asset);
    }
}

if ( ! function_exists('checkShowOrHide'))
{
    /**
     * checkShowOrHide
     */
    function checkShowOrHide($level = '', $expected_lvl = "", $data = ''){
        if ($level == $expected_lvl){
            return $data;
        }
    }
}

if ( ! function_exists('alert'))
{
    /**
     * checkShowOrHide
     */
    function alert($level = 'danger', $exlm_msg = null, $msg = 'EMPTY'){
       $return = '<div class="alert alert-' . $level . '" role="alert">';

        if (!empty($exlm_msg)){
            $return .= '<h4 class="alert-heading">' . $exlm_msg . '</h4> ';
        }

        $return .= $msg . '</div>';

        return $return;
    }
}

if ( ! function_exists('check'))
{
    /**
     * checkShowOrHide
     */
    function check($level = 'check-danger', $icon = 'cross'){
        $return = '<div class="check"><div class="check-child check-' . $level . ' rounded-circle loader"></div></div><div class="check-content loader-child"><i class="material-icons">';
        $return .= $icon;
        $return .= '</i></div>';

        return $return;
    }
}

if ( ! function_exists('ajax'))
{
    /**
     * checkShowOrHide
     */
    function ajax($method = 'POST', $url, $data, $id = null, $customHref = null, $customParameters = null){
        $return = '$.ajax({ type: "' . $method . '", url: "'.base_url().'ajax/'.$url.'/'.$id.'", ' . $customParameters . 'data: '.$data.', beforeSend: function() { var msg = $("#msg"); msg.html(\'';
        $return .= check('success', 'cached');
        $return .= '\'); animateCheck($(".check"), 0); }, success: function (data) { window.location = ';
        if ($customHref != null){
            $return .= $customHref;
        } else{
            $return .= 'data';
        }

        $return .= ';}});';

        return $return;
    }
}

if ( ! function_exists('image'))
{
    /**
     * checkShowOrHide
     */
    function image($method = 'POST', $url, $data, $id = null, $customHref = null, $customParameters = null){
        $return = '$.ajax({ type: "' . $method . '", url: "'.base_url().'images/'.$url.'/'.$id.'", ' . $customParameters . 'data: '.$data.', beforeSend: function() { var msg = $("#msg"); msg.html(\'';
        $return .= check('success', 'cached');
        $return .= '\'); animateCheck($(".check"), 0); }, success: function (data) { window.location = ';
        if ($customHref != null){
            $return .= $customHref;
        } else{
            $return .= 'data';
        }

        $return .= ';}});';

        return $return;
    }
}

if ( ! function_exists('login'))
{
    /**
     * checkShowOrHide
     */
    function login($data){
        $return = '$.ajax({ type: "POST", url: "'.base_url().'ajaxlogin/login", data: '.$data.', beforeSend: function() { var msg = $("#msg"); msg.html(\'';
        $return .= check('success', 'cached');
        $return .= '\'); animateCheck($(".check"), 0); }, success: function (data) { window.location = data; }});';

        return $return;
    }
}

if ( ! function_exists('forgot'))
{
    /**
     * checkShowOrHide
     */
    function forgot($data){
        $return = '$.ajax({ type: "POST", url: "'.base_url().'ajaxlogin/forgotpassword", data: '.$data.', beforeSend: function() { var msg = $("#msg"); msg.html(\'';
        $return .= check('success', 'cached');
        $return .= '\'); animateCheck($(".check"), 0); }, success: function (data) { window.location = data; }});';

        return $return;
    }
}

if ( ! function_exists('resetPass'))
{
    /**
     * checkShowOrHide
     */
    function resetPass($id, $data){
        $return = '$.ajax({ type: "POST", url: "'.base_url().'ajaxlogin/resetpassword/'.$id.'", data: '.$data.', beforeSend: function() { var msg = $("#msg"); msg.html(\'';
        $return .= check('success', 'cached');
        $return .= '\'); animateCheck($(".check"), 0); }, success: function (data) { window.location = data; }});';

        return $return;
    }
}