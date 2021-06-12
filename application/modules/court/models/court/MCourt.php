<?php

header("Access-Control-Allow-Origin: *");

/**
 * This class is used for Crud operation over court 
 *
 * @package         Displayfort-dashboard
 * @subpackage      Controllers/api/court
 * @category        common to all
 * @author          Barun Pandey
 * @date            26 March, 2021, 05:32:00 PM
 * @version         1.0.0
 */
class mCourt extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $response = array('status' => FALSE, 'error' => '', 'data' => array(), 'response_tag' => 220);
    }

    /**
     * Get All Token Data from this method.
     *
     * @return Response
     */
    public function getCase($catID = 0)
    {
        if (!(empty($catID)) && is_numeric($catID)) {
            $result = $this->callCurl('GET', '', 'http://localhost/displayfort-api/api/court/courtCase:' . $catID);
        } else {
            $result = $this->callCurl('GET', '', 'http://localhost/displayfort-api/api/court/courtCase');
        }
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            return ($result);
        }
    }

    public function allCourt()
    {
        if (!(empty($catID)) && is_numeric($catID)) {
            $result = $this->callCurl('GET', '', 'http://localhost/displayfort-api/api/court/court:' . $catID);
        } else {
            $result = $this->callCurl('GET', '', 'http://localhost/displayfort-api/api/court/court');
        }
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            return ($result);
        }
    }

    /**
     * add Counter Data from this method.
     *
     * @return Response
     */
    public function addCase($data)
    {
        $result = $this->callCurl('POST', $data, 'http://localhost/displayfort-api/api/court/courtCase/');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
            return ($result);
        }
    }

    /**
     * update Counter Data from this method.
     *
     * @return Response
     */
    public function updateCase($data)
    {
        $id = $data['case_id'];
        $data = json_encode($data);
        $result = $this->callCurl('PUT', $data, 'http://localhost/displayfort-api/api/court/courtCase/' . $id . '');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
            return ($result);
        }
    }

    public function updateRunningCase($data)
    {
        $caseNO = $data['case_no'];
        $data = json_encode($data);
        $result = $this->callCurlCaseUpdate('PUT', $data, 'http://localhost/displayfort-api/api/court/courtCase/updateRunningCase/',$caseNO);
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
            return ($result);
        }
    }
    
    /**
     * delete Counter Data from this method.
     *
     * @return Response
     */
    public function deleteCase($data)
    {
        $id = $data['case_id'];
        $result = $this->callCurl('DELETE', $data, 'http://localhost/displayfort-api/api/court/courtCase/' . $id . '');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
            return ($result);
        }
    }

    /**
     * select Counter Data from this method.
     *
     * @return Response
     */
    public function fetchCase($data)
    {
        $id = $data['case_id'];
        $result = $this->callCurl('GET', $data, 'http://localhost/displayfort-api/api/court/courtCase/' . $id . '');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
            return ($result);
        }
    }


    /**
     * select Counter Data from this method.
     *
     * @return Response
     */
    public function fetchRunningCase($data)
    {
        $id = $data['court_id'];
        $result = $this->callCurl('GET', $data, 'http://localhost/displayfort-api/api/court/courtCase/getCases/' . $id . '');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
            return ($result);
        }
    }

    public function callCurl($method, $data = '', $url)
    {
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
                return ($buffer);
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
                return ($buffer);
            }
        }
    }

    public function callCurlCaseUpdate($method, $data = '', $url,$caseNo)
    {
        if (!empty($this->session->userdata('name')->token_code)) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'token_code:' . $this->session->userdata('name')->token_code,'case_no:'.$caseNo));
            $buffer = curl_exec($ch);
            curl_close($ch);
            if (empty($buffer)) {
                echo "something get error please try after some time";
            } else {
                return ($buffer);
            }
        } else {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'token_code:a1cb9fd3902802a8','case_no:'.$caseNo));
            $buffer = curl_exec($ch);
            curl_close($ch);
            if (empty($buffer)) {
                echo "something get error please try after some time";
            } else {
                return ($buffer);
            }
        }
    }
}
