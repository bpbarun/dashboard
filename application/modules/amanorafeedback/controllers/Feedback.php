<?php

header("Access-Control-Allow-Origin: *");

/**
 * This class is used for Calling api of Album 
 *
 * @package         Displayfort-dashboard
 * @subpackage      Controllers/Api/Feedback
 * @category        Api
 * @author          Barun Pandey
 * @date            17 September, 2019, 11:00:00 AM
 * @version         1.0.0
 */
class Feedback extends MX_Controller {

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
        $this->load->model('mFeedback');
        $this->load->library('DataTableServerSide');
    }

    public function index() {
        if ($this->checkAuth()) {
            $this->allFeedback();
        }
    }

    public function exportAjax() {
        if ($this->checkAuth()) {
            $inputClm = array(
                0 => 'feedback_id',
                1 => 'rating',
                2 => 'feedback_question_name',
                3 => 'date',
                4 => 'user_comment',
                5 => 'user_mobileno',
                6 => 'user_emailid'
            );
            $data = $this->datatableserverside->TableData($_POST, 'v_feedback', $inputClm);
        }
    }

    public function addfeedbckType() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            if (isset($postedData['feedback_questions'])) {
                $questionData = $postedData['feedback_questions'];
                unset($postedData['feedback_questions']);
            }
            if (!empty($postedData)) {
                $typeData = $this->mFeedback->addfeedbckType(json_encode($postedData));
                if (!empty($typeData)) {
                    $data = json_decode($typeData);
                    if ($data->status) {
                        if (!empty($data->data->string_key_id)) {
                            if (!empty($questionData)) {
                                $newData['feedback_questions'] = $questionData;
                                /*                                 * ******************************** */
                                $question = (explode(",", $newData['feedback_questions']));
                                $newPostedData['feedback_question'] = $question;
                                $newPostedData['feedback_type_id'] = $data->data->string_key_id;
                                if (!empty($newPostedData)) {
                                    $questionData = $this->mFeedback->addfeedbckQuestion(json_encode($newPostedData));
                                    return $questionData;
                                }
                            } else {
                                return $typeData;
                            }
                            /*                             * ******************************** */
                        }
                    }
                }
            }
        }
    }

    /**
     * Fetch Data from this method.
     *
     * @return Response
     */
    public function fetchFeedbackType() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $this->mFeedback->fetchFeedbackType($postedData);
        }
    }

    public function allFeedbackType() {
        if ($this->checkAuth()) {
            $this->load->helper(array('form', 'url'));
            $data['feedbackConfigData'] = $this->mFeedback->getFeedbackConfigData();
//            $data['feedbackHeaderData'] = $this->mFeedback->getFeedbackHeaderData();
            $data['feedbackType'] = $this->mFeedback->getAllFeedbackType();
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $this->load->view('AllFeedbackType', $data);
            $this->load->view('common/footer');
        }
    }

    /**
     * Update the given Data from this method.
     *
     * @return Response
     */
    public function updatefeedbckType() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            if (isset($postedData['feedback_questions'])) {
                $questionData = $postedData['feedback_questions'];
                unset($postedData['feedback_questions']);
            }
            if (isset($postedData['string_key_id'])) {
                $typeStringID = $postedData['string_key_id'];
                unset($postedData['string_key_id']);
            }
            $typeData = $this->mFeedback->updateFeedbackType($postedData);
            if (!empty($questionData)) {
                $newData['feedback_questions'] = $questionData;
                $question = (explode(",", $newData['feedback_questions']));
                $newPostedData['feedback_question'] = $question;
                $newPostedData['feedback_type_id'] = $typeStringID;
                if (!empty($newPostedData)) {
                    $questionDataRes = $this->mFeedback->addfeedbckQuestion(json_encode($newPostedData));
                    return $questionDataRes;
                }
            } else {
                return $typeData;
            }
        }
    }

    /**
     * Delete the given Data from this method.
     *
     * @return Response
     */
    public function deletefeedbckType() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $this->mFeedback->deleteFeedbackType($postedData);
        }
    }

    public function question() {
        if ($this->checkAuth()) {
            $data['feedbackType'] = $this->mFeedback->getAllFeedbackType();
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $this->load->view('feedback-question', $data);
            $this->load->view('common/footer');
        }
    }

    public function getfeedbckQuestion() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post('feedback_type_id');
            $this->mFeedback->getfeedbckQuestion($postedData);
        }
    }

    public function allFeedback() {
        if ($this->checkAuth()) {
            $data['feedback'] = $this->mFeedback->getFeedback();
            $data['feedbackType'] = $this->mFeedback->getAllFeedbackType();
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $this->load->view('/allFeedback', $data);
            $this->load->view('common/footer');
        }
    }

    public function addfeedbckQuestion() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $question = (explode(",", $postedData['feedback_questions']));
            $postedData['feedback_question'] = $question;
            if (!empty($postedData)) {
                $this->mFeedback->addfeedbckQuestion(json_encode($postedData));
            }
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
                'upload_path' => 'assets/img/',
                'allowed_types' => "gif|jpg|jpeg|png|mpeg",
                'overwrite' => TRUE,
                'max_size' => '2048000' // Can be set to particular file size ,
// here it is 2 MB(2048 Kb)
            );
            $postedData = $this->input->post();
            if (!empty($_FILES['userfile']['name'])) {
                $this->load->library('upload', $config);
                if ($this->upload->do_upload()) {
                    $data = array('upload_data' => $this->upload->data());
                    $postData['logo'] = $data['upload_data']['file_name'];
                    $postData['header_text'] = $postedData['header_text'];
                    $postData['sub_header_text'] = $postedData['sub_header_text'];
                    if (isset($postedData['third_party_config_id'])) {
                        $postData['third_party_config_id'] = $postedData['third_party_config_id'];
                        $res = $this->mFeedback->trirdPartyConfigDataUpdate($postData);
                    } else
                        $res = $this->mFeedback->trirdPartyConfigData($postData);
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    echo strip_tags(json_encode($error));
                }
            } else if (!empty($postedData)) {
                $postedData = $this->input->post();
                $postData['header_text'] = $postedData['header_text'];
                $postData['sub_header_text'] = $postedData['sub_header_text'];
                if (isset($postedData['third_party_config_id'])) {
                    $postData['third_party_config_id'] = $postedData['third_party_config_id'];
                    $res = $this->mFeedback->trirdPartyConfigDataUpdate($postData);
                } else
                    $res = $this->mFeedback->trirdPartyConfigData($postData);
            }
        }
    }

    public function getThirdPartyCofig() {
        if ($this->checkAuth()) {
            $postedData = $this->input->post();
            $this->mFeedback->getThirdPartyCofig($postedData);
        }
    }

    // create xlsx
    public function createXLS() {
        $filename = 'report-' . time() . '.xlsx';
        $empInfo1 = $this->datatableserverside->TableDataExport($_GET, 'v_feedback');
        include('C:\xampp\htdocs\displayfort-dashboard\application\third_party/PHPExcel-1.8\Classes\PHPExcel.php');
        include('C:\xampp\htdocs\displayfort-dashboard\application\third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'NO.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Rating');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'User Feedback');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'User Comment');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'User Mobile no');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'User Email id');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Ipad Name');
        // set Row
        $rowCount = 2;
        foreach ($empInfo1 as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['feedback_id']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['rating']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['feedback_question_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $element['user_comment']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $element['user_mobileno']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $element['user_emailid']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $this->session->userdata('name')->user_name);
            if (!empty($userName)) {
                $data['user_name'] = $userName;
            }
            $rowCount++;
        }

        $objPHPExcel->getActiveSheet()->setTitle('Report');
//        print_r($objPHPExcel);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=" . $filename . "");
        header("Cache-Control:max-age=0");
//        ob_clean();
        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'excel2007');
        $writer->save('php://output');
        exit();
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
