<?php

header("Access-Control-Allow-Origin: *");

/**
 * This class is used for Crud operation over token 
 *
 * @package         Displayfort-dashboard
 * @subpackage      Controllers/api/Dfort
 * @category        Dfort website
 * @author          Barun Pandey
 * @date            15 January, 2020, 02:50:00 PM
 * @version         1.0.0
 */
class mDfort extends CI_Model {

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
     * add Counter Data from this method.
     *
     * @return Response
     */
    public function addBlog($data) {
        $result = $this->callCurl('POST', $data, 'http://localhost/displayfort-api/api/dfort/dfort/');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
            return($result);
        }
    }

    /**
     * update Counter Data from this method.
     *
     * @return Response
     */
    public function updateToken($data) {
        $id = $data['token_id'];
        unset($data['token_id']);
        $data = json_encode($data);
        $result = $this->callCurl('PUT', $data, 'http://localhost/displayfort-api/api/token/token/' . $id . '');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
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
     * add Counter Data from this method.
     *
     * @return Response
     */
    public function addCounter($data) {
        $result = $this->callCurl('POST', $data, 'http://localhost/displayfort-api/api/token/counter/');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
            return($result);
        }
    }

    /**
     * update Counter Data from this method.
     *
     * @return Response
     */
    public function updateCounter($data) {
        $id = $data['counter_id'];
        $data = json_encode($data);
        $result = $this->callCurl('PUT', $data, 'http://localhost/displayfort-api/api/token/counter/' . $id . '');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
            return($result);
        }
    }

    /**
     * delete Counter Data from this method.
     *
     * @return Response
     */
    public function deleteCounter($data) {
        $id = $data['counter_id'];
        $result = $this->callCurl('DELETE', $data, 'http://localhost/displayfort-api/api/token/counter/' . $id . '');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
            return($result);
        }
    }

    /**
     * select Counter Data from this method.
     *
     * @return Response
     */
    public function fetchCounter($data) {
        $id = $data['counter_id'];
        $result = $this->callCurl('GET', $data, 'http://localhost/displayfort-api/api/token/counter/' . $id . '');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
            return($result);
        }
    }

    /**
     * Insert Given Data from this method.
     *
     * @return Response
     */
    public function insertData($input) {
        $result = $this->callCurl('POST', '', 'http://localhost/displayfort-api/api/token/token/');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            return($result);
        }
    }

    /**
     * Update Data from this method.
     *
     * @return Response
     */
    public function updateData($id, $input) {
        $result = $this->callCurl('PUT', '', 'http://localhost/displayfort-api/index.php/api/token/token/');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            return($result);
        }
    }

    /**
     * Delete given Record from this method.
     *
     * @return Response
     */
    public function deleteData($id) {
        $result = $this->callCurl('DELETE', '', 'http://localhost/displayfort-api/index.php/api/token/token/');
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
    public function getSubCounter() {
        $result = $this->callCurl('GET', '', 'http://localhost/displayfort-api/api/token/subcounter/');
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
    public function getSubCounterRefresh() {
        $result = $this->callCurl('GET', '', 'http://localhost/displayfort-api/api/token/subcounter/');
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
    public function addSubCounter($data) {
        $result = $this->callCurl('POST', $data, 'http://localhost/displayfort-api/api/token/subcounter/');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
            return($result);
        }
    }

    /**
     * update Counter Data from this method.
     *
     * @return Response
     */
    public function updateSubCounter($data) {
        $id = $data['subcounter_id'];
        $data = json_encode($data);
        $result = $this->callCurl('PUT', $data, 'http://localhost/displayfort-api/api/token/subcounter/' . $id . '');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
            return($result);
        }
    }

    /**
     * delete Counter Data from this method.
     *
     * @return Response
     */
    public function deleteSubCounter($data) {
        $id = $data['subcounter_id'];
        $result = $this->callCurl('DELETE', $data, 'http://localhost/displayfort-api/api/token/subcounter/' . $id . '');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
            return($result);
        }
    }

    /**
     * select Counter Data from this method.
     *
     * @return Response
     */
    public function fetchSubCounter($data) {
        if (!empty($data['subcounter_id'])) {
            $result = $this->callCurl('GET', $data, 'http://localhost/displayfort-api/api/token/subcounter/' . $data['subcounter_id'] . '');
        } else if (!empty($data['counter_id'])) {
            $result = $this->callCurl('GET', $data, 'http://localhost/displayfort-api/api/token/subcounter/counter_id:' . $data['counter_id'] . '');
        }

        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
            return($result);
        }
    }

    /**
     * select Running token Data from this method.
     *
     * @return Response
     */
    public function fetchRunningToken($data) {
        $id = $data['subcounter_id'];
        $result = $this->callCurl('GET', $data, 'http://localhost/displayfort-api/api/token/token/subcounter_id:' . $id . ':is_active:1');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
            return($result);
        }
    }

    /**
     * Cehck Another Running token Data from this method.
     *
     * @return Response
     */
    public function checkToken($data) {
        $id = $data['subcounter_id'];
        $result = $this->callCurl('GET', $data, 'http://localhost/displayfort-api/api/token/token/subcounter_id:' . $id . ':is_active:2');
        if (!empty($result)) {
            $result = json_decode($result);
            if (!empty($result->data)) {
                $tokenData = $result->data;
                foreach ($tokenData as $token) {
                    $updateData = array();
                    $updateData['is_active'] = "4";
                    $resultData = $this->callCurl('PUT', json_encode($updateData), 'http://localhost/displayfort-api/api/token/token/' . $token->token_id . '');
                }
            }
        }
    }

    /**
     * select  token Data from this method.
     *
     * @return Response
     */
    public function goToToken($data) {
        $id = $data['token_id'];
        $result = $this->callCurl('GET', $data, 'http://localhost/displayfort-api/api/token/token/token_id:' . $id . '');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
            return($result);
        }
    }

    /**
     * delete Counter Data from this method.
     *
     * @return Response
     */
    public function deleteToken($data) {
        $id = $data['token_id'];
        $result = $this->callCurl('DELETE', $data, 'http://localhost/displayfort-api/api/token/token/' . $id . '');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
            return($result);
        }
    }

    /**
     * delete Counter Data from this method.
     *
     * @return Response
     */
    public function uploadMedia($data) {
        if (!empty($data['file_name'])) {
            $inputdata['config_value'] = $data['file_name'];
        }
        $inputdata['is_active'] = 1;
        $id = ($data['config_type'] === 'image') ? 1 : 2;
        $result = $this->callCurl('PUT', json_encode($inputdata), 'http://localhost/displayfort-api/api/token/config/' . $id);
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            return($result);
        }
    }

    public function activeMedia($data = 0) {
        $result = $this->callCurl('GET', '', 'http://localhost/displayfort-api/api/token/config');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
//            print_r($result);
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
        } else {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'token_code:a1cb9fd3902802a8'));
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
