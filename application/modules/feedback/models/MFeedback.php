<?php

header("Access-Control-Allow-Origin: *");

/**
 * This class is used for Crud operation over album 
 *
 * @package         Displayfort-dashboard
 * @subpackage      Controllers/dashboard/Feedback
 * @category        common to all
 * @author          Barun Pandey
 * @date            17 September, 2019, 11:05:00 AM
 * @version         1.0.0
 */
class mFeedback extends CI_Model {

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
    public function getFeedback($id = 0) {
        if (!(empty($id)) && is_numeric($id)) {
            $result = $this->callCurl('GET', '', 'http://localhost/displayfort-api/api/feedback/feedback/' . $catID);
        } else {
            $result = $this->callCurl('GET', '', 'http://localhost/displayfort-api/api/feedback/feedback/');
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
    public function getFeedbackConfigData() {
        $result = $this->callCurl('GET', '', 'http://localhost/displayfort-api/api/feedback/feedbackConfig/');
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
    public function getFeedbackHeaderData() {
        $result = $this->callCurl('POST', '', 'http://localhost/displayfort-api/api/feedback/feedbackConfig/headerData/');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            return($result);
        }
    }

    /**
     * select Feedback Type Data from this method.
     *
     * @return Response
     */
    public function fetchFeedbackType($data) {
        $id = $data['feedback_type_id'];
        $result = $this->callCurl('GET', $data, 'http://localhost/displayfort-api/api/feedback/feedbackType/' . $id . '');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
            return($result);
        }
    }

    /**
     * update Feedback Data from this method.
     *
     * @return Response
     */
    public function updateFeedbackType($data) {
        $id = $data['feedback_type_id'];
        $data = json_encode($data);
        $result = $this->callCurl('PUT', $data, 'http://localhost/displayfort-api/api/feedback/feedbackType/' . $id . '');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            $result = array('status' => TRUE, 'error' => '', 'data' => array(), 'response_tag' => 220);
            echo json_encode($result);
            return(json_encode($result));
        }
    }

    /**
     * get Feedback Question Data from this method.
     *
     * @return Response
     */
    public function getfeedbckQuestion($id = 0) {
        if (!(empty($id)) && is_numeric($id)) {
            $result = $this->callCurl('GET', '', 'http://localhost/displayfort-api/api/feedback/feedbackQuestion/feedback_type_id:' . $id);
        } else {
            $result = $this->callCurl('GET', '', 'http://localhost/displayfort-api/api/feedback/feedbackQuestion/');
        }
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
    public function deleteFeedbackType($data) {
        $id = $data['feedback_type_id'];
        $result = $this->callCurl('DELETE', $data, 'http://localhost/displayfort-api/api/feedback/feedbackType/' . $id . '');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
            return($result);
        }
    }

    /**
     * add Album Data from this method.
     *
     * @return Response
     */
    public function addfeedbckType($data) {
        $results = $this->callCurl('POST', $data, 'http://localhost/displayfort-api/api/feedback/feedbackType');
        if (empty($results)) {
            echo "something get error please try after some time";
        } else {
            print_r($results);
            return($results);
        }
    }

    /**
     * add Album Data from this method.
     *
     * @return Response
     */
    public function getAllFeedbackType() {
        $results = $this->callCurl('GET', '', 'http://localhost/displayfort-api/api/feedback/feedbackType/lang:en');
        if (empty($results)) {
            echo "something get error please try after some time";
        } else {
//            print_r($results);
            return($results);
        }
    }

    /**
     * add Album Data from this method.
     *
     * @return Response
     */
    public function addfeedbckQuestion($data) {
        $results = $this->callCurl('POST', $data, 'http://localhost/displayfort-api/api/feedback/feedbackQuestion');
        if (empty($results)) {
            echo "something get error please try after some time";
        } else {
//            print_r($results);exit();
            return($results);
        }
    }

    /**
     * add Data from this method.
     *
     * @return Response
     */
    public function trirdPartyConfigData($data) {
      
//        print_r($data); 
//        die;
        $results = $this->callCurl('POST', json_encode($data), 'http://localhost/displayfort-api/api/feedback/feedbackConfig/headerDataUpdate/');
        if (empty($results)) {
            echo "something get error please try after some time";
        } else {
            print_r($results);
            return($results);
        }
    }

    /**
     * add Data from this method.
     *
     * @return Response
     */
    public function trirdPartyConfigDataUpdate($data) {
      
//        print_r($data); die;
        $id = $data['third_party_config_id'];
        $result = $this->callCurl('POST', json_encode($data), 'http://localhost/displayfort-api/api/feedback/feedbackConfig/headerDataUpdate/');
//        $results = $this->callCurl('PUT', json_encode($data), 'http://localhost/displayfort-api/api/auth/Config/' . $id);
        if (empty($results)) {
            echo "something get error please try after some time";
        } else {
            print_r($results);
            return($results);
        }
    }

    /**
     * add Data from this method.
     *
     * @return Response
     */
    public function getThirdPartyCofig($data = 0) {
        /*         * ********** */
        $result = $this->callCurl('POST', '', 'http://localhost/displayfort-api/api/feedback/feedbackConfig/headerData/');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
            return($result);
        }
        /*         * *********** */

//        $data['table'] = 'third_party_config';
//        $data['select'] = '*';
//        $data['where'] = "module =  'feedback' AND lang='en'";
//        if (!(empty($id)) && is_numeric($id)) {
//            $results = $this->callCurl('POST', '', 'http://localhost/displayfort-api/api/feedback/feedbackConfig/headerData');
//        } else {
//            $results = $this->callCurl('GET', '', 'http://localhost/displayfort-api/api/auth/Config/');
//        }
//        if (empty($results)) {
//            echo "something get error please try after some time";
//        } else {
//            print_r($results);
//            return($results);
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
