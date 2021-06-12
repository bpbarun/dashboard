<?php

header("Access-Control-Allow-Origin: *");

/**
 * This class is used for Calling api of token 
 *
 * @package         Displayfort-dashboard
 * @subpackage      Controllers/Api/Court
 * @category        Api
 * @author          Barun Pandey
 * @date            03 MArch, 2021, 05:30:00 PM
 * @version         1.0.0
 */
class Court extends MX_Controller
{

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        if (empty($this->session->userdata('name'))) {
            header('Location: ' . base_url());
            exit;
        }
        $this->load->database();
        $this->load->model('court/mCourt');
    }

    public function index()
    {
        if ($this->checkAuth()) {
            $data['courtData'] =   $this->mCourt->allCourt();
            $data['caseData'] =  $this->allCase();
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $this->load->view('court', $data);
            $this->load->view('common/footer');
        }
    }
    /**
     * Insert the given Data from this method.
     *
     * @return Response
     */
    public function addCase()
    {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $postedData = json_encode($postedData);
            $this->mCourt->addCase($postedData);
        }
    }

    /**
     * Update the given Data from this method.
     *
     * @return Response
     */
    public function updateCase()
    {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $this->mCourt->updateCase($postedData);
        }
    }

    /**
     * Delete the given Data from this method.
     *
     * @return Response
     */
    public function deleteCase()
    {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $this->mCourt->deleteCase($postedData);
        }
    }

    /**
     * Fetch Data from this method.
     *
     * @return Response
     */
    public function fetchCourtCase()
    {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $this->mCourt->fetchCase($postedData);
        }
    }

    /**
     * Fetch Data from this method.
     *
     * @return Response
     */
    public function allCourt() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $this->mCourt->allCourt();
        }
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function allCase()
    {
        if ($this->checkAuth()) {
            return   $this->mCourt->getCase();
        }
    }

    public function runningCase() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $this->mCourt->fetchRunningCase($postedData);
        }
    }

    public function updateRunningCase() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $this->mCourt->updateRunningCase($postedData);
        }
    }

    public function serveCases() {
        if ($this->checkAuth()) {
            $data['court'] =  $this->mCourt->allCourt();
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $this->load->view('viewCase', $data);
            $this->load->view('common/footer');
        }
    }

    public function checkAuth()
    {
        $CI = get_instance();
        if ($CI->input->is_cli_request() === TRUE) {
            // block the access from terminal
            echo "###################################################################
            #                 Welcome to dv - Displayfort Dashboard                 #
            #           All connections are monitored and recorded                  #
            #    Disconnect IMMEDIATELY if you are not an authorized user!          #
            ###################################################################\n\n
            Access denied.
            You can't access this application through CLI/Terminal !!\n\n";
            exit;
        }
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
