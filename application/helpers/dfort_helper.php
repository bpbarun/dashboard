<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 7.2 or newer
 * *
 * @package        dispalyfort
 * @author         Barun Pandey
 * @date           23 January, 2020, 01:09:00 PM
 */
if (!function_exists('sessionCheck')) {

    /**
     * sessionCheck is used to check the session 
     */
    function sessionCheck() {
        $CI = & get_instance();
        $CI->load->library('session');
        if (!empty($CI->session->userdata('name'))) {
            if ($CI->session->userdata('name')->expire_on < date('Y-m-d H:i:s', time())) {
                header('Location: ' . base_url());
                exit;
            } else {
                echo "is login";
            }
        } else {
            header('Location: ' . base_url());
            exit;
        }
    }

}