<?php

header("Access-Control-Allow-Origin: *");

/**
 * This class is used for Calling api of Album 
 *
 * @package         Displayfort-dashboard
 * @subpackage      Controllers/dashboard/Multilingual
 * @category        Api
 * @author          Barun Pandey
 * @date            25 September, 2019, 04:19:00 PM
 * @version         1.0.0
 */
class Multilingual extends MX_Controller {

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        if (empty($this->session->userdata('name'))) {
            header('Location: ' . base_url());
            exit;
        }
        $this->load->database();
        $data = array();
        $this->load->model('mMultilingual');
    }

    public function index() {
        if ($this->checkAuth()) {
            $data['multilangualConfigData'] = $this->mMultilingual->getMultiLangualConfigData();
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $this->load->view('Multilingual_1');
//            $this->load->view('Multilingual', $data);
            $this->load->view('common/footer');
        }
    }

    public function getMultiLangualConfigData() {
        if ($this->checkAuth()) {
            $data = $this->mMultilingual->getMultiLangualConfigData();
            print_r($data);
//            $postedData = $this->input->post();
//            if (!empty($data)) {
//                $this->mFeedback->addfeedbckType(json_encode($postedData));
//            }
        }
    }

    public function getMultiLangualModuleData() {
        if ($this->checkAuth()) {
            $input_data = json_decode(trim(file_get_contents('php://input')), true);
            $data = $this->mMultilingual->getMultiLangualModalData($input_data);
//            print_r($data);
        }
    }

    /**
     * Delete the given Data from this method.
     *
     * @return Response
     */
    public function deleteMultiLangualModuleData() {
        if ($this->checkAuth()) {
            $input_data = json_decode(trim(file_get_contents('php://input')), true);
//            print_r($input_data);
            $data = $this->mMultilingual->deleteMultiLangualModuleData($input_data);
        }
    }


    public function addMultiLangualModuleData() {
        if ($this->checkAuth()) {
            $input_data = json_decode(trim(file_get_contents('php://input')), true);
            $data = $this->mMultilingual->addMultiLangualModuleData($input_data);
        }
    }

    public function checkAuth() {
        if (!empty($this->session->userdata('name'))) {
            if ($this->session->userdata('name')->expire_on < date('Y-m-d H:i:s', time())) {
                header('Location: ' . base_url());
                exit;
            } else {
                return true;
            }
        } else {
            header('Location: ' . base_url());
            exit;
        }
    }

}
