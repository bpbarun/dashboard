<?php

header("Access-Control-Allow-Origin: *");

/**
 * This class is used for Calling api of Album 
 *
 * @package         Displayfort-dashboard
 * @subpackage      Controllers/Dashboard/Event
 * @category        Dashboard
 * @author          Barun Pandey
 * @date            11 April, 2020, 07:09:00 PM
 * @version         1.0.0
 */
class Offer extends MX_Controller {

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
        $this->load->model('mOffer');
    }

    public function index() {
        if ($this->checkAuth()) {
            $data['offer'] = $this->mOffer->getAllOffer();
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $this->load->view('offer',$data);
            $this->load->view('common/footer');
        }
    }

    /**
     * Insert the given Data from this method.
     *
     * @return Response
     */
    public function addData() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $postedData = json_encode($postedData);
            $this->mOffer->addOffer($postedData);
        }
    }


 


    /**
     * fetch Data from this method.
     *
     * @return Response
     */
    public function allEventCounter() {
        if ($this->checkAuth()) {
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $data['counterData'] = $this->mEvent->getCounter();
            $data['subCounterData'] = $this->mEvent->getSubCounter();
            $this->load->view('allSubCounter', $data);
            $this->load->view('common/footer');
        }
    }

    
    /**
     * Get All Data from this method.
     *
     * @return Response
     */
    public function allEvent() {
        if ($this->checkAuth()) {
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $data['offerData'] = $this->mOffer->getAllOffer();
            $this->load->view('allEvent', $data);
            $this->load->view('common/footer');
        }
    }

   public function toDelete() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
           // $path = "uploads/images/1/" . $postedData['delete_file'];
            //$deleteSuccess = unlink($path);
//        if ($deleteSuccess) {
            $this->mOffer->deleteAssets($postedData['offer_id']);
//        }
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

public function resize_image($image_data){
$this->load->library('image_lib');
// print_r($image_data); die;
$w = $image_data['width']; // original image's width

// $hg = print_r($image_data['imageName']);
$h = $image_data['height']; // original images's height

// print_r($w); 
// print_r($h);die;
$n_w = 1920; // destination image's width
$n_h = 1080; // destination image's height
$new_ratio = $n_w / $n_h;

$source_ratio =($w / $h);

// print_r($source_ratio);die;

if($source_ratio != $new_ratio){

    $config['image_library'] = 'gd2';
    $config['source_image'] = $image_data['imageName'];
    $config['maintain_ratio'] = false;
    if($new_ratio > $source_ratio || (($new_ratio == 1) && ($source_ratio < 1))){
        $config['width'] = $w;
        $config['height'] = round($w/$new_ratio);
        $config['y_axis'] = round(($h - $config['height'])/2);
        $config['x_axis'] = 0;

    } else {

        $config['width'] = round($h * $new_ratio);
        $config['height'] = $h;
        $size_config['x_axis'] = round(($w - $config['width'])/2);
        $size_config['y_axis'] = 0;

    }

    $this->image_lib->initialize($config);
    $this->image_lib->crop();
    $this->image_lib->clear();
}

$config['image_library'] = 'gd2';
$config['source_image'] =  $image_data['imageName'];
$config['new_image'] =  $image_data['imageName'];
$config['maintain_ratio'] = TRUE;
$config['width'] = $n_w;
$config['height'] = $n_h;
$this->image_lib->initialize($config);

if (!$this->image_lib->resize()){

   echo $this->image_lib->display_errors();

} else {

  //  echo "done";

}}








    public function singleUpload() {
        if ($this->checkAuth()) {
            $assetsName = array();
            $insertedData = array();
            $postedData = $this->input->post();
            $uploaddir = './assets/offer/';
            $imgType = $_FILES['mediafile']['type'];
            $imgType = explode('/', $_FILES['mediafile']['type']);
            $imgType = $imgType[1];
            $_FILES['mediafile']['name'] = time() . '.' . $imgType;
            $uploadfile = $uploaddir . basename($_FILES['mediafile']['name']);
            array_push($assetsName, $_FILES['mediafile']['name']);
            if (move_uploaded_file($_FILES['mediafile']['tmp_name'], $uploadfile)) {
//            $postedData['asset_name'] = $_FILES['mediafile']['name'];
                // print_r($assetsName); die;


list($width,$height,)=getimagesize($uploadfile);
$imgData =array('width' =>$width,'height' =>$height,'imageName'=>$uploadfile);


                $insertedData['image'] = $assetsName[0]; 
                // print_r($insertedData);
                $assetRes = $this->mOffer->addOffer($insertedData);
                // print_r($assetRes); die;
                // $assetRes = implode(',', $assetRes);
                // $postedData['assets_id'] = $assetRes;
//              $postedData = json_encode($postedData);
                // $this->mEvent->updateAlbum($postedData);
                $this->resize_image($imgData);

            } else {
                echo "Upload failed";
            }
//        die;
        }
    }

    public function addToken() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $postedData = json_encode($postedData);
            $this->mToken->addToken($postedData);
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
