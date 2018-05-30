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
    function ajax($method = 'POST', $url, $data = 'null', $id = null, $customHref = null, $customParameters = null){
        $return = '$.ajax({ type: "' . $method . '", url: "'.base_url().'Ajax/'.$url.'/'.$id.'", ' . $customParameters . 'data: '.$data.', dataType: "json", beforeSend: function() { var msg = $("#msg"); msg.html(\'';
        $return .= check('success', 'cached');
        $return .= '\'); animateCheck($(".check"), 0); }, success: function (data) { if (data.error === true){ $(".check, .check-content").css({"display": "none"}); setTimeout(function () { alert(data.msg); }, 100); } else{ if (data.href === "unset"){ alert(data.msg);} else{ window.location = ';
        if ($customHref != null){
            $return .= '"'.$customHref.'"';
        } else{
            $return .= 'data.href';
        }

        $return .= '; }}},';
        $return .= 'error:function(x,e) {if (x.status==0) {alert("You are offline!!\n Please Check Your Network.");} else if(x.status==404) {alert("Requested URL not found.");} else if(x.status==500) {alert("Internal Server Error.");} else if(e=="parsererror") {alert("Error.\nParsing JSON Request failed.");} else if(e=="timeout"){alert("Request Time out.");} else {alert("Unknow Error.\n"+x.responseText);}}';
        $return .= '});';

        return $return;
    }
}

if ( ! function_exists('image'))
{
    /**
     * checkShowOrHide
     */
    function image($method = 'POST', $url, $data, $id = null, $customHref = null, $customParameters = null){
        $return = '$.ajax({ type: "' . $method . '", url: "'.base_url().'Images/'.$url.'/'.$id.'", ' . $customParameters . 'data: '.$data.', dataType: "json", beforeSend: function() { var msg = $("#msg"); msg.html(\'';
        $return .= check('success', 'cached');
        $return .= '\'); animateCheck($(".check"), 0); }, success: function (data) { if (data.error === true){ $(".check, .check-content").css({"display": "none"}); setTimeout(function () { alert(data.msg); }, 100); } else{ if (data.href === "unset"){ alert(data.msg);} else{ window.location = ';
        if ($customHref != null){
            $return .= $customHref;
        } else{
            $return .= 'data.href';
        }

        $return .= '; }}},';
        $return .= 'error:function(x,e) {if (x.status==0) {alert("You are offline!!\n Please Check Your Network.");} else if(x.status==404) {alert("Requested URL not found.");} else if(x.status==500) {alert("Internal Server Error.");} else if(e=="parsererror") {alert("Error.\nParsing JSON Request failed.");} else if(e=="timeout"){alert("Request Time out.");} else {alert("Unknow Error.\n"+x.responseText);}}';
        $return .= '});';

        return $return;
    }
}

if ( ! function_exists('noRightsAjax'))
{
    /**
     * checkShowOrHide
     */
    function noRightsAjax($method = 'POST', $url, $data, $id = null, $customHref = null, $customParameters = null){
        $return = '$.ajax({ type: "' . $method . '", url: "'.base_url().'AjaxLogin/'.$url.'/'.$id.'", ' . $customParameters . 'data: '.$data.', dataType: "json",  beforeSend: function() { var msg = $("#msg"); msg.html(\'';
        $return .= check('success', 'cached');
        $return .= '\'); animateCheck($(".check"), 0); }, success: function (data) { if (data.error == true){ $(".check, .check-content").css({"display": "none"}); setTimeout(function () { alert(data.msg); }, 100);  } else{ if (data.href == "unset"){ alert(data.msg);} else{ window.location = ';
        if ($customHref != null){
            $return .= $customHref;
        } else{
            $return .= 'data.href';
        }

        $return .= '; }}},';
        $return .= 'error:function(x,e) {if (x.status==0) {alert("You are offline!!\n Please Check Your Network.");} else if(x.status==404) {alert("Requested URL not found.");} else if(x.status==500) {alert("Internal Server Error.");} else if(e=="parsererror") {alert("Error.\nParsing JSON Request failed.");} else if(e=="timeout"){alert("Request Time out.");} else {alert("Unknow Error.\n"+x.responseText);}}';
        $return .= '});';

        return $return;
    }
}