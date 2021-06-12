<?php

header("Access-Control-Allow-Origin: *");

/**
 * This class is used for Calling api of Album 
 *
 * @package         Displayfort-dashboard
 * @subpackage      Controllers/Common
 * @category        Api
 * @author          Barun Pandey
 * @date            17 August, 2019, 11:50:00 AM
 * @version         1.0.0
 */
class Common extends MX_Controller {

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
//        if (empty($this->session->userdata('name'))) {
//            header('Location: ' . base_url());
//            exit;
//        }
        $this->load->database();
        $data = array();
        $this->load->model('mCommon');
    }

    public function index() {
        $this->load->view('login');
    }

    public function login() {
        $postData = $this->input->post();
        $res = $this->mCommon->login($postData);
        print_r($res);
        $resData = json_decode($res);
        $this->session->set_userdata('name', $resData->data);
        if (!empty($resData->data->user_id)) {
            $roleData = $this->mCommon->roleManage($resData->data->user_id);
            $this->session->set_userdata('userRole', $roleData);
        }
    }

    public function logOut() {
        $this->session->unset_userdata('name');
        $response = array('status' => TRUE, 'error' => '', 'data' => array('success'), 'response_tag' => 220);
        echo json_encode($response);
    }

    public function changePassword() {
        $postData = $this->input->post();
        $res = $this->mCommon->changePassword($postData);
        print_r($res);
        $resData = json_decode($res);
//        $this->session->set_userdata('name', $resData->data);
//        if (!empty($resData->data->user_id)) {
//            $roleData = $this->mCommon->roleManage($resData->data->user_id);
//            $this->session->set_userdata('userRole', $roleData);
//        }
    }
    
     public function checkSession() {
         sessionCheck();  
     }

}
