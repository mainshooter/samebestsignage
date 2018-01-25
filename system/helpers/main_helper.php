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
    function check($level = 'check-danger', $icon = 'cross', $href){
        $return = '<div class="check ' . $level . ' rounded-circle"><div class="check-content"><i class="material-icons">';
        $return .= $icon;
        $return .= '</i></div></div>';
        $return .= '<script>animateCheck($(".check"), 200, 200, "px", "' . $href . '");</script>';

        return $return;
    }
}