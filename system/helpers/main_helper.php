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
        ?>
        <div class="check">
            <div class="check-child check-success rounded-circle loader"></div>
        </div>
        <div class="check-content loader-child">
            <i class="material-icons">
                check
            </i>
        </div>
        <?php
        $return = '<div class="check">';
        $return .= '<div class="check-child ' . $level . ' rounded-circle loader"></div>';
        $return .= '</div>';
        $return .= '<div class="check-content loader-child">';
        $return .= '<i class="material-icons">';
        $return .= $icon;
        $return .= '</i>';
        $return .= '</div>';
        $return .= '<script>animateCheck($(".check"), "' . $href . '");</script>';

        return $return;
    }
}