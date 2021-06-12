<?php

header("Access-Control-Allow-Origin: *");

/**
 * This class is used for Crud operation over token 
 *
 * @package         Displayfort-dashboard
 * @subpackage      Controllers/api/token
 * @category        common to all
 * @author          Barun Pandey
 * @date            20 June, 2019, 02:50:00 PM
 * @version         1.0.0
 */
class mReport extends CI_Model {

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
     public function getToken($catID = 0) {
         if (!(empty($catID)) && is_numeric($catID)) {
             $result = $this->callCurl('GET', '', 'http://localhost/displayfort-api/api/token/token/counter_id:' . $catID);
         } else {
             $result = $this->callCurl('GET', '', 'http://localhost/displayfort-api/api/token/token/');
         }
         if (empty($result)) {
             echo "something get error please try after some time";
         } else {
             return($result);
         }
     }
    /**
     * Get All Counter Data from this method.
     *
     * @return Response
     */
    public function getCounter() {
        $result = $this->callCurl('GET', '', 'http://localhost/displayfort-api/api/token/counter/');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            return($result);
        }
    }

    /**
     * Get All Counter Data from this method.
     *
     * @return Response
     */
    public function geteExportData() {
        $result = $this->callCurl('GET', '', 'http://localhost/displayfort-api/api/export/export/');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            return($result);
        }
    }

    /**
     * Get All Counter Data from this method.
     *
     * @return Response
     */
    public function getVehicleCount() {
        $result = $this->callCurl('GET', '', 'http://localhost/displayfort-api/api/report/report');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            return($result);
        }
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
