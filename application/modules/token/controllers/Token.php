<?php

header("Access-Control-Allow-Origin: *");

require_once("PrintIPP.php");

/**
 * This class is used for Calling api of token 
 *
 * @package         Displayfort-dashboard
 * @subpackage      Controllers/Api/token
 * @category        Api
 * @author          Barun Pandey
 * @date            11 June, 2019, 05:55:00 AM
 * @version         1.0.0
 */
class Token extends MX_Controller {

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
        $this->load->model('token/mToken');
    }

    public function index() {
        if ($this->checkAuth()) {
//        $this->allToken();
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $this->load->view('token');
            $this->load->view('common/footer');
        }
    }

    /**
     * Fetch Data from this method.
     *
     * @return Response
     */
    public function allCounter() {
        if ($this->checkAuth()) {
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $data['counterData'] = $this->mToken->getCounter();
            $this->load->view('allCounter', $data);
            $this->load->view('common/footer');
        }
    }

    /**
     * Insert the given Data from this method.
     *
     * @return Response
     */
    public function addCounter() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $postedData = json_encode($postedData);
            $this->mToken->addCounter($postedData);
        }
    }

    /**
     * Update the given Data from this method.
     *
     * @return Response
     */
    public function updateCounter() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $this->mToken->updateCounter($postedData);
        }
    }

    /**
     * Delete the given Data from this method.
     *
     * @return Response
     */
    public function deleteCounter() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $this->mToken->deleteCounter($postedData);
        }
    }

    /**
     * Fetch Data from this method.
     *
     * @return Response
     */
    public function fetchCounter() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $this->mToken->fetchCounter($postedData);
        }
    }

    /**
     * fetch Data from this method.
     *
     * @return Response
     */
    public function allSubCounter() {
        if ($this->checkAuth()) {
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $data['counterData'] = $this->mToken->getCounter();
            $data['subCounterData'] = $this->mToken->getSubCounter();
            $this->load->view('allSubCounter', $data);
            $this->load->view('common/footer');
        }
    }

    /**
     * fetch Data from this method.
     *
     * @return Response
     */
    public function roomsMapping() {
        if ($this->checkAuth()) {
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $data['counterData'] = $this->mToken->getCounter();
            $data['subCounterData'] = $this->mToken->getSubCounter();
            $this->load->view('roomsMapping', $data);
            $this->load->view('common/footer');
        }
    }

    /**
     * Insert the given Data from this method.
     *
     * @return Response
     */
    public function addSubCounter() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $postedData = json_encode($postedData);
            $this->mToken->addSubCounter($postedData);
        }
    }

    /**
     * Update the given Data from this method.
     *
     * @return Response
     */
    public function updateSubCounter() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $this->mToken->updateSubCounter($postedData);
        }
    }

    /**
     * Delete the given Data from this method.
     *
     * @return Response
     */
    public function deleteSubCounter() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $this->mToken->deleteSubCounter($postedData);
        }
    }

    /**
     * Fetch Data from this method.
     *
     * @return Response
     */
    public function fetchSubCounter() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $this->mToken->fetchSubCounter($postedData);
        }
    }

    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function allToken() {
        if ($this->checkAuth()) {
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $data['tokenData'] = $this->mToken->getToken();
            $this->load->view('allToken', $data);
            $this->load->view('common/footer');
        }
    }

    /**
     * Create new token from this method.
     *
     * @return Response
     */
    public function addNewToken() {
        if ($this->checkAuth()) {
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $data['allCounters'] = $this->mToken->getSubCounter();
            exec("lpstat -a | cut -f1 -d' '", $available_printers);
            $data['available_printers'] = $available_printers;
            $this->load->view('addNewTokenTable', $data);
            $this->load->view('common/footer');
        }
    }

    /**
     * Create new token from this method.
     *
     * @return Response
     */
    public function addNewTokenRefresh() {
        if ($this->checkAuth()) {
//            $this->load->view('common/header');
//            $this->load->view('common/navigation');
            $data = $this->mToken->getSubCounter();
            print_r($data);
//            $this->load->view('addNewTokenTable', $data);
//            $this->load->view('common/footer');
        }
    }

    /**
     * Create token slip.
     *
     * @return Response
     */
    public function tokenSlipLayout() {
        if ($this->input->server('REQUEST_METHOD') == 'POST'){$data = $this->input->post();}
        if ($this->input->server('REQUEST_METHOD') == 'GET'){$data = $this->input->get();}
        $html = $this->load->view('tokenSlip', $data, TRUE);

        // Load pdf library
        $this->load->library('pdf');
        // Load HTML content
        $this->pdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation
        $this->pdf->setPaper('A7', 'portrait');
        // Render the HTML as PDF
        $this->pdf->render();
        // Output the generated PDF (1 = download and 0 = preview)
        $this->pdf->stream("welcome.pdf", array("Attachment"=>0));
    }

    public function addToken() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            if (isset($postedData['printerName'])) {
                $printerName = $postedData['printerName'];
                unset($postedData['printerName']);
            }
            $postedData = json_encode($postedData);
            $addedToken = $this->mToken->addToken($postedData);
            $addedTokenJson = json_decode($addedToken);

            $tokenForCounter = $this->mToken->getSubCounter($postedData);
            $room = json_decode($tokenForCounter)->data;

            $post = [
                'token' => $addedTokenJson->data->token_display_name,
                'room_no' => $room[0]->room_no,
                'subcounter_name'   => $room[0]->subcounter_name,
                'time' => $addedTokenJson->data->created_on
            ];
            $ch = curl_init('http://localhost/displayfort-dashboard/token/tokenSlipLayout');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            $tokenSlip = curl_exec($ch);
            curl_close($ch);

            if (!empty($printerName)) {
                $path ="/printers/".$printerName;
                $ipp = new PrintIPP();
                $ipp->setHost("localhost");
                $ipp->setPrinterURI($path);
                $ipp->setMimeMediaType($mime_media_type='application/pdf');
                $ipp->setData($tokenSlip);
                $ipp->printJob();
            }
        }
    }

    public function viewScreen($screenID = 0) {
//        if ($this->checkAuth()) {
        $data['tokenData'] = $this->mToken->getToken($screenID);
        $data['activeMedia'] = $this->mToken->activeMedia();
//        print_r($data); 
        $this->load->view('viewScreen', $data);
//        $this->load->view('common/footer');
//        }
    }

    public function viewScreenRefresh($screenID) {
//        if ($this->checkAuth()) {
        $data = $this->mToken->getToken($screenID);
        print_r($data);
//        }
    }

    public function serveToken() {
        if ($this->checkAuth()) {
            $data['subCounterData'] = $this->mToken->getSubCounter();
            $data['counterData'] = $this->mToken->getCounter();
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $this->load->view('serveToken', $data);
            $this->load->view('common/footer');
        }
    }

    public function runningToken() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $this->mToken->checkToken($postedData);
            $this->mToken->fetchRunningToken($postedData);
        }
    }

    public function goToToken() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $this->mToken->goToToken($postedData);
        }
    }

    public function updateToken() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $this->mToken->updateToken($postedData);
        }
    }

    /**
     * Delete the given Token Data from this method.
     *
     * @return Response
     */
    public function deleteToken() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $this->mToken->deleteToken($postedData);
        }
    }

    /**
     * Change advertisement from this method.
     *
     * @return Response
     */
    public function changeAdv() {
        if ($this->checkAuth()) {
            $this->load->helper(array('form', 'url'));
            $data['activeMedia'] = $this->mToken->activeMedia();
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $this->load->view('changeAdv', $data);
            $this->load->view('common/footer');
        }
    }

    /**
     * Change advertisement from this method.
     *
     * @return Response
     */
    public function viewScreenNew() {
        $data['tokenData'] = $this->mToken->getToken($screenID);
        $data['activeMedia'] = $this->mToken->activeMedia();
        $this->load->view('viewScreenNew', $data);
    }

    /**
     * Media upload from this method.
     *
     * @return Response
     */
    public function do_upload() {
        if ($this->checkAuth()) {
            $this->load->helper(array('form', 'url'));
            $config = array(
                'upload_path' => 'uploads/',
                'allowed_types' => "gif|jpg|jpeg|png|mpeg|mp3|mp4|3gp",
                'overwrite' => TRUE,
                'max_size' => '2048000' // Can be set to particular file size ,
                    // here it is 2 MB(2048 Kb)
            );
            $postedData = $this->input->post();
            if (!empty($_FILES['userfile']['name'])) {
                $this->load->library('upload', $config);
                if ($this->upload->do_upload()) {
                    $data = array('upload_data' => $this->upload->data());
                    $data['upload_data']['config_type'] = $postedData['config_type'];
                    $res = $this->mToken->uploadMedia($data['upload_data']);
                    print_r($res);
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    echo strip_tags(json_encode($error));
                }
            } else if (!empty($postedData)) {
                $postedData = $this->input->post();
                $res = $this->mToken->uploadMedia($postedData);
                print_r($res);
            }
        }
    }

    public function checkAuth() {
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
