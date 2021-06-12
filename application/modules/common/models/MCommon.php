<?php

header("Access-Control-Allow-Origin: *");

/**
 * This class is used for Crud operation over album 
 *
 * @package         Displayfort-dashboard
 * @subpackage      Controllers/api/album
 * @category        common to all
 * @author          Barun Pandey
 * @date            24 July, 2019, 05:23:00 PM
 * @version         1.0.0
 */
class mCommon extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $response = array('status' => FALSE, 'error' => '', 'data' => array(), 'response_tag' => 220);
    }

    /**
     * Get All Token Data from this method.
     *
     * @return Response
     */
    public function getLogin($catID = 0) {
        $result = $this->callCurlWO('GET', '', 'http://localhost/displayfort-api/api/login/login/');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            return($result);
        }
    }

    /**
     * add Counter Data from this method.
     *
     * @return Response
     */
    public function login($data) {
        $result = $this->callCurlWO('POST', json_encode($data), 'http://localhost/displayfort-api/api/login/login/');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            return($result);
        }
    }

    /**
     * add Counter Data from this method.
     *
     * @return Response
     */
    public function roleManage($data) {
        $result = $this->callCurl('GET', '', 'http://localhost/displayfort-api/api/role/Role/' . $data);
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            return($result);
        }
    }

    /**
     * add Counter Data from this method.
     *
     * @return Response
     */
    public function changePassword($data) {
        $id = $data['user_id'];
        unset($data['user_id']);
        $result = $this->callCurl('PUT', json_encode($data), 'http://localhost/displayfort-api/api/auth/auth/' . $id);
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            return($result);
        }
    }

    public function callCurlWO($method, $data = '', $url) {
        //if (!empty($this->session->userdata('name')->token_code)) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $buffer = curl_exec($ch);
        curl_close($ch);
        if (empty($buffer)) {
            echo "something get error please try after some time";
        } else {
            return($buffer);
        }
//        }
    }

    public function callCurl($method, $data = '', $url) {
        if (!empty($this->session->userdata('name')->token_code)) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'token_code:' . $this->session->userdata('name')->token_code));
            $buffer = curl_exec($ch);
            curl_close($ch);
            if (empty($buffer)) {
                echo "something get error please try after some time";
            } else {
                return($buffer);
            }
        }
    }

}
