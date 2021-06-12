<?php

header("Access-Control-Allow-Origin: *");

/**
 * This class is used for Crud operation over album 
 *
 * @package         Displayfort-dashboard
 * @subpackage      Controllers/dashboard/Multilingual
 * @category        common to all
 * @author          Barun Pandey
 * @date            25 September, 2019, 04:20:00 PM
 * @version         1.0.0
 */
class mMultilingual extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $response = array('status' => FALSE, 'error' => '', 'data' => array(), 'response_tag' => 220);
    }



    /**
     * Get All Counter Data from this method.
     *
     * @return Response
     */
    public function getMultiLangualConfigData($id = 0) {
        $data['table'] = 'multilingual_config';
        $data['select'] = 'config_value';
        $data['where'] = "config_key in('allmodule','active_language')";
        $result = $this->callCurl('POST', json_encode($data), 'http://localhost/displayfort-api/api/multilingual/multilingualConfig/selectR');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
//            print_r($result);
            return($result);
        }
    }

    /**
     * Get All Counter Data from this method.
     *
     * @return Response
     */
    public function getMultiLangualModalData($input) {
        $data['table'] = $input['tableName'];
        $data['select'] = $input['columnName'];
        $result = $this->callCurl('POST', json_encode($data), 'http://localhost/displayfort-api/api/multilingual/multilingual/selectR');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
            return($result);
        }
    }

  public function deleteMultiLangualModuleData($data){
        $moduleDetail = json_decode($data['moduleName']);
        $tableName = key($moduleDetail);
        $table = array();
        foreach ($moduleDetail as $key => $value) {
            array_push($table, $key);
        }
        unset($data['moduleName']);
        $newData['table'] = $moduleDetail;
        $newData['data'] = $data;
        $result = $this->callCurl('POST', json_encode($newData), 'http://localhost/displayfort-api/api/multilingual/Multilingual/delete');
        print_r($result);
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            return($result);
        }
  }


    /**
     * add Album Data from this method.
     *
     * @return Response
     */
    public function addMultiLangualModuleData($data) {
        $moduleDetail = json_decode($data['moduleName']);
        $tableName = key($moduleDetail);
        $table = array();
        foreach ($moduleDetail as $key => $value) {
            array_push($table, $key);
        }
        unset($data['moduleName']);
        $newData['table'] = $moduleDetail;
        $newData['data'] = $data;
        $result = $this->callCurl('POST', json_encode($newData), 'http://localhost/displayfort-api/api/multilingual/multilingual/add');
        print_r($result);
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
