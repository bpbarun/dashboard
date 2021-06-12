<?php

header("Access-Control-Allow-Origin: *");

/**
 * This class is used for Calling api of Album 
 *
 * @package         Displayfort-dashboard
 * @subpackage      Controllers/Dashboard/Event
 * @category        Dashboard
 * @author          Barun Pandey
 * @date            20 March, 2020, 05:54:00 PM
 * @version         1.0.0
 */
class Event extends MX_Controller {

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
        $this->load->model('mEvent');
    }

    public function index() {
        if ($this->checkAuth()) {
            $data['event'] = $this->mEvent->getAllEvent();
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $this->load->view('event',$data);
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
            $this->mEvent->addEvent($postedData);
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
            $data['eventData'] = $this->mEvent->getAllEvent();
            $this->load->view('allEvent', $data);
            $this->load->view('common/footer');
        }
    }

   public function toDelete() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $this->mEvent->deleteAssets($postedData['event_id']);
//        }
        }
    }

public function resize_image($image_data){
    $this->load->library('image_lib');
    $w = $image_data['width']; // original image's width
    $h = $image_data['height']; // original images's height
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
        
        $this->load->library('image_lib');
        if ($this->checkAuth()) {
            $assetsName = array();
            $insertedData = array();
            $postedData = $this->input->post();
            $date = $postedData['event_date'];
            // echo "date is ====".$date;
            unset($postedData['event_date']);
            // print_r('Event post dat ais ==='.$postedData);
            $uploaddir = './assets/event/';
            $imgType = $_FILES['mediafile']['type'];
            $imgType = explode('/', $_FILES['mediafile']['type']);
            $imgType = $imgType[1];
            $_FILES['mediafile']['name'] = time() . '.' . $imgType;
            $uploadfile = $uploaddir . basename($_FILES['mediafile']['name']);
            array_push($assetsName, $_FILES['mediafile']['name']);
            if (move_uploaded_file($_FILES['mediafile']['tmp_name'], $uploadfile)) {
            list($width,$height,)=getimagesize($uploadfile);
            $imgData =array('width' =>$width,'height' =>$height,'imageName'=>$uploadfile);
                $insertedData['image'] = $assetsName[0];
                $insertedData['event_date'] = $date;
                // print_r($insertedData);
                $assetRes = $this->mEvent->addEvent($insertedData);
               $this->resize_image($imgData);
            } else {
                echo "Upload failed";
            }
//        die;
            
        }
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
                'max_size' => 2048000, // Can be set to particular file size ,
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
