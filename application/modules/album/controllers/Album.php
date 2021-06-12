<?php

header("Access-Control-Allow-Origin: *");

/**
 * This class is used for Calling api of Album 
 *
 * @package         Displayfort-dashboard
 * @subpackage      Controllers/Api/Album
 * @category        Api
 * @author          Barun Pandey
 * @date            24 July, 2019, 04:23:00 AM
 * @version         1.0.0
 */
class Album extends MX_Controller {

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
        $this->load->model('mAlbum');
    }

    public function index() {
        if ($this->checkAuth()) {
            $data['albumCommonData'] = $this->mAlbum->commonTable();
            $this->load->view('common/header');
            $this->load->view('common/navigation', $data);
            $this->load->view('album');
            $this->load->view('common/footer');
        }
    }

    public function home() {
        if ($this->checkAuth()) {
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $this->load->view('home');
            $this->load->view('common/footer');
        }
    }

    public function showAlbum($id = 1) {
        if ($this->checkAuth()) {
            $data['albumCommonData'] = $this->mAlbum->commonTable();
            $data['albumData'] = $this->mAlbum->getAlbum($id);
            $this->load->view('common/header');
            $this->load->view('common/navigation', $data);
            $this->load->view('album');
            $this->load->view('common/footer');
        }
    }

    public function albumAdmin($id = 0) {
        if ($this->checkAuth()) {
            $data['albumCommonData'] = $this->mAlbum->commonTable();
            if (!(empty($id)) && is_numeric($id)) {
                $data['albumData'] = $this->mAlbum->getAlbum($id);
            }
            $this->load->helper(array('form', 'url'));
            $this->load->view('common/header');
            $this->load->view('common/navigation', $data);
            $this->load->view('albumAdmin', $data);
            $this->load->view('common/footer');
        }
    }

    public function uploadMedia() {
        if ($this->checkAuth()) {
            $this->load->helper(array('form', 'url'));
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $this->load->view('albumAdmin');
            $this->load->view('common/footer');
        }
    }

    public function editAlbumView() {
        if ($this->checkAuth()) {
            $data['albumData'] = $this->mAlbum->getAllAlbum();
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $this->load->view('editAlbum', $data);
            $this->load->view('common/footer');
        }
    }

    public function do_upload() {
        if ($this->checkAuth()) {
            header('Content-Type: text/plain; charset=utf-8');
            ini_set('upload_max_filesize', '200M');
            ini_set('post_max_size', '201M');
            ini_set('max_input_time', 320);
            ini_set('memory_limit', '256M');
            $url = 'uploads/';
            $this->load->helper(array('form', 'url'));
            $config = array(
                'upload_path' => $url,
                'allowed_types' => "gif|jpg|jpeg|png|mpeg|mp3|mp4|3gp",
                'overwrite' => TRUE,
                'file_name' => time() . '-' . $_FILES['file']['name'],
                'max_size' => '2048000' // Can be set to particular file size ,
                    // here it is 2 MB(2048 Kb)
            );
            if (!empty($_FILES['file']['name'])) {
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('file')) {
                    $data = array('upload_data' => $this->upload->data());
//                $postedData['asset_name'] = $data['upload_data']['file_name'];
//                $postedData['asset_type'] = $data['upload_data']['file_type'];
//                $res = $this->mAlbum->addAssets(json_encode($postedData));
                    print_r($data);
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    echo strip_tags(json_encode($error));
                }
            }
        }
    }

    public function addAlbum() {
        if ($this->checkAuth()) {
//        echo  $_SERVER['DOCUMENT_ROOT']; die;
            $assetsName = array();
            $files = scandir("uploads");
            $source = "uploads/";
            $destination = "uploads/images/1/";
            foreach ($files as $file) {
                if (in_array($file, array(".", ".."))) {
                    continue;
                }
//            $sources = $source . $file;
//            $destination = $destination . $file;
                // If we copied this successfully, mark it for deletion
                if (copy($source . $file, $destination . $file)) {
                    array_push($assetsName, $file);
                    $delete[] = $source . $file;
                }
            }
            foreach ($delete as $file) {
                unlink($file);
            }
            $assetRes = $this->mAlbum->addAssets($assetsName);
            $postedData = $this->input->post();
            $assetRes = implode(',', $assetRes);
            $postedData['assets_id'] = $assetRes;
            $postedData = json_encode($postedData);
            $this->mAlbum->addAlbum($postedData);
        }
    }

    public function toDelete() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $path = "uploads/images/1/" . $postedData['delete_file'];
            $deleteSuccess = unlink($path);
//        if ($deleteSuccess) {
            $this->mAlbum->deleteAssets($postedData['asset_id']);
//        }
        }
    }

    public function singleUpload() {
        if ($this->checkAuth()) {
            $assetsName = array();
            $postedData = $this->input->post();
            $uploaddir = 'uploads/images/1/';
            $imgType = $_FILES['mediafile']['type'];
            $imgType = explode('/', $_FILES['mediafile']['type']);
            $imgType = $imgType[1];
            $_FILES['mediafile']['name'] = time() . '.' . $imgType;
            $uploadfile = $uploaddir . basename($_FILES['mediafile']['name']);
            array_push($assetsName, $_FILES['mediafile']['name']);
            if (move_uploaded_file($_FILES['mediafile']['tmp_name'], $uploadfile)) {
//            $postedData['asset_name'] = $_FILES['mediafile']['name'];
                $assetRes = $this->mAlbum->addAssets($assetsName);
                $assetRes = implode(',', $assetRes);
                $postedData['assets_id'] = $assetRes;
//            $postedData = json_encode($postedData);
                $this->mAlbum->updateAlbum($postedData);
            } else {
                echo "Upload failed";
            }
//        die;
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
