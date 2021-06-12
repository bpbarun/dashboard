<?php

header("Access-Control-Allow-Origin: *");

/**
 * This class is used for Crud operation over album 
 *
 * @package         Displayfort-dashboard
 * @subpackage      Controllers/dashboard/event
 * @category        common to all
 * @author          Barun Pandey
 * @date            11 April, 2020, 07:11:00 PM
 * @version         1.0.0
 */
class mEvent extends CI_Model {

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
    public function getOffer($id = 0) {
        $result = $this->callCurl('GET', '', 'http://localhost/displayfort-api/api/offer/offer/' . $id . '');
        $res = json_decode($result);
        $response = array('status' => TRUE, 'data' => array('image_url' => array(), 'image_id' => array()));
        if (!empty($res->data->assets_id)) {
            $resArray = explode(',', $res->data->assets_id);
            foreach ($resArray as $assetData) {
                $assetResult = $this->callCurl('GET', '', 'http://localhost/displayfort-api/api/offer/offer/' . $assetData . '');
                $assetRes = json_decode($assetResult);
                if (!empty($assetRes->data->asset_name)) {
                    array_push($response['data']['image_url'], $assetRes->data->asset_name);
                    array_push($response['data']['image_id'], $assetRes->data->asset_id);
                }
            }
            $response['data']['album_name'] = $res->data->album_name;
        }
        $result = $response;
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
    public function getAllOffer() {
        $result = $this->callCurl('GET', '', 'http://localhost/displayfort-api/api/offer/offer/');
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
    public function addEvent($data) {
        $result = $this->callCurl('POST', json_encode($data), 'http://localhost/displayfort-api/api/offer/offer/');
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
    public function deleteAssets($id) {
        $result = $this->callCurl('DELETE', '', 'http://localhost/displayfort-api/api/offer/offer/' . $id . '');
        if (empty($result)) {
            echo "something get error please try after some time";
        } else {
            print_r($result);
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
