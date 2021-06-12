<?php

header("Access-Control-Allow-Origin: *");

/**
 * This class is used for Calling api of token 
 *
 * @package         Displayfort-dashboard
 * @subpackage      Controllers/Api/Report
 * @category        Api
 * @author          Barun Pandey
 * @date            11 July, 2019, 11:31:00 AM
 * @version         1.0.0
 */
class Report extends MX_Controller {

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
        $this->load->model('report/mReport');
        $this->load->library('DataTableServerSide');
    }

    public function index() {
        if ($this->checkAuth()) {
            $data['counterData'] = $this->mReport->getCounter();
            $data['tokenData'] = $this->mReport->getToken();
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $this->load->view('report', $data);
            $this->load->view('common/footer');
        }
    }

    public function export() {
        if ($this->checkAuth()) {
            $data['exportData'] = $this->mReport->geteExportData();
            $this->load->view('common/navigation');
            $this->load->view('export', $data);
        }
    }

    public function exportAjax() {
        if ($this->checkAuth()) {
            $columns = array(
                0 => 'id',
                1 => 'object',
                2 => 'date',
                3 => 'confic'
            );
            $data = $this->datatableserverside->TableData($_POST, 'countobject', $columns);
        }
    }

    /*     * ************* */

    // create xlsx
    public function createXLS() {
        $filename = 'report-' . time() . '.xlsx';
        $empInfo1 = $this->datatableserverside->TableDataExport($_GET, 'countobject');
        include('C:\xampp\htdocs\displayfort-dashboard\application\third_party/PHPExcel-1.8\Classes\PHPExcel.php');
        include('C:\xampp\htdocs\displayfort-dashboard\application\third_party/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'IDs');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Object');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Confic');
        // set Row
        $rowCount = 2;
        foreach ($empInfo1 as $element) {
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $element['id']);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $element['object']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $element['date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $element['confic']);
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

    public function vehicleReport() {
        if ($this->checkAuth()) {
            $data['vehicleData'] = $this->mReport->getVehicleCount();
            $this->load->view('common/header');
            $this->load->view('common/navigation');
            $this->load->view('vehicleReport', $data);
            $this->load->view('common/footer');
        }
    }

    public function vehicleReportAjax() {
        if ($this->checkAuth()) {
            $data = $this->mReport->getVehicleCount();
            print_r($data);
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
