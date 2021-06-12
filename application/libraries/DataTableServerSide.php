<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DataTableServerSide {

    public function __construct($data = NULL, $from_type = NULL) {
        $CI = &get_instance();
        $CI->load->database();
//        $this->load->database();
        $CI->load->library('session');
        $response = array('status' => FALSE, 'error' => '', 'data' => '', 'response_tag' => 220);
    }

    public function TableData($input, $tableName, $columns) {
        $CI = &get_instance();
// storing  request (ie, get/post) global array to a variable  
        $requestData = $input;
        $sql = "SELECT *";
        $sql .= " FROM $tableName";
        $tokenCode = $CI->session->userdata('name')->user_id;
        $userName = $CI->session->userdata('name')->user_name;
        if ($tableName == 'v_feedback')
            $sql .= " WHERE created_by = '" . $tokenCode . "'";
//        $query = mysqli_query($conn, $sql) or die("employee-grid-data.php: get employees");
        $query = $CI->db->query($sql);
        $totalData = $query->num_rows($query);
        $totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
        $sql = "SELECT *";
        $sql .= " FROM $tableName WHERE 1=1";
        if (!empty($requestData['search']['value'])) {
            /*             * ********************************************** */
            $pos = strpos($requestData['search']['value'], 'Date:');
            $is_date_special = false;
            if ($pos !== false && $pos === 0) {
                $is_date_special = true;
                $dates = explode('<>', substr($requestData['search']['value'], 5));
                $dates[0] = trim($dates[0]);
                $dates[1] = trim($dates[1]);
                if ($dates[0] != '' && $dates[1] == '') {
                    $sql .= " AND date >='" . $dates[0] . "'";
                } else if ($dates[0] == '' && $dates[1] != '') {
                    $sql .= " AND date >='" . $dates[1] . "'";
                } else if ($dates[0] != '' && $dates[1] != '') {
                    $sql .= " AND date BETWEEN'" . $dates[0] . "'AND'" . $dates[1] . "'";
                }
                unset($requestData['search']['value']);
            }
        }
        if (!empty($requestData['search']['value'])) {
            if ($tableName == 'countobject') {
                $sql .= " AND ( object LIKE '%" . $requestData['search']['value'] . "%' ";
                $sql .= " OR date LIKE '%" . $requestData['search']['value'] . "%' ";
                $sql .= " OR confic LIKE '%" . $requestData['search']['value'] . "%' )";
            } else if ($tableName == 'v_feedback') {
                $sql .= " AND ( rating LIKE '%" . $requestData['search']['value'] . "%'";
//                $sql .= " OR date LIKE '%" . $requestData['search']['value'] . "%' ";
                $sql .= " OR feedback_question_name LIKE '%" . $requestData['search']['value'] . "%' ";
                $sql .= " OR user_comment LIKE '%" . $requestData['search']['value'] . "%' ";
                $sql .= " OR user_mobileno LIKE '%" . $requestData['search']['value'] . "%' ";
                $sql .= " OR user_emailid LIKE '%" . $requestData['search']['value'] . "%' )";
            }
        }
        if (!empty($requestData['date'])) {
            $pos = strpos($requestData['date'], 'Date:');
            $is_date_special = false;
            if ($pos !== false && $pos === 0) {
                $is_date_special = true;
                $dates = explode('<>', substr($requestData['date'], 5));
                $dates[0] = trim($dates[0]);
                $dates[1] = trim($dates[1]);
                if ($dates[0] != '' && $dates[1] == '') {
                    $sql .= " AND date >= '" . $dates[0] . "'";
                } else if ($dates[0] == '' && $dates[1] != '') {
                    $sql .= " AND date >= '" . $dates[1] . "'";
                } else if ($dates[0] != '' && $dates[1] != '') {
                    $sql .= " AND date BETWEEN'" . $dates[0] . "'AND'" . $dates[1] . "'";
                }
                unset($requestData['date']);
            }
            if (!empty($requestData['object'])) {
                $sql .= " AND ( object LIKE '%" . $requestData['object'] . "%' )";
                unset($requestData['object']);
            }
            if (!empty($requestData['rating'])) {
                $sql .= " AND ( rating = '" . $requestData['rating'] . "' )";
                unset($requestData['rating']);
            }
            if (!empty($requestData['user_mobileno'])) {
                $sql .= " AND ( user_mobileno = '" . $requestData['user_mobileno'] . "' )";
                unset($requestData['user_mobileno']);
            }
            if (!empty($requestData['user_emailid'])) {
                $sql .= " AND ( user_emailid = '" . $requestData['user_emailid'] . "' )";
                unset($requestData['user_emailid']);
            }
        }

        if ($tableName == 'v_feedback')
            $sql .= " AND created_by = '" . $tokenCode . "'";
        /*         * ************************************************************************************** */
//        print_r($sql); 
        $query = $CI->db->query($sql);
        $totalFiltered = $query->num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
        if (!empty($requestData['order']) && !empty($requestData['order'])) {
            $sql .= " ORDER BY " . $columns[$requestData['order'][0]['column']] . " " . $requestData['order'][0]['dir'] . " LIMIT " . $requestData['start'] . ", " . $requestData['length'] . " ";
        } else {
            $sql .= " ORDER BY id ASC LIMIT " . $requestData['start'] . ", " . $requestData['length'] . " ";
        }
        $query = $CI->db->query($sql);
        $fetchData = $query->result_array();
        $data = array();
        foreach ($fetchData as $row) {
            $nestedData = array();
            for ($i = 0; $i < COUNT($columns); $i++) {
                $nestedData[$columns[$i]] = $row[$columns[$i]];
            }
            if (!empty($userName)) {
                $nestedData['user_name'] = $userName;
            }
            $data[] = $nestedData;
        }
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );
//        print_r($_POST);
        if (isset($requestData['date']))
            unset($requestData['date']);
        if (isset($requestData['object']))
            unset($requestData['object']);
        if (isset($requestData['rating']))
            unset($requestData['rating']);
        echo json_encode($json_data);  // send data as json format
    }

    public function TableDataExport($data, $table) {
        $CI = &get_instance();
        $query1 = "SELECT * FROM $table";
        $sql = '';
        if (!empty($data['search'])) {
            if ($table == 'countobject') {
                if ($data['search'] != '') {
                    if ($sql == '') {
                        $sql .= " WHERE (object LIKE '%" . $data['search'] . "%')";
                    } else {
                        $sql .= "AND (object LIKE '%" . $data['search'] . "%')";
                    }
                }
            } else if ($table == 'v_feedback') {
                if ($data['search'] != '') {
                    if ($sql == '') {
                        $sql .= " WHERE (rating = '" . $data['search'] . "')";
                    } else {
                        $sql .= "AND ( rating LIKE '%" . $data['search'] . "%'";
                    }
                }
            }
        }
        if (!empty($data['searchVal'])) {
            if ($data['searchVal'] != '') {
                if ($sql == '') {
                    $sql .= " WHERE (rating = '" . $data['searchVal'] . "')";
                    $sql .= " OR feedback_question_name LIKE '%" . $data['searchVal'] . "%' ";
                    $sql .= " OR user_comment LIKE '%" . $data['searchVal'] . "%' ";
                    $sql .= " OR user_mobileno LIKE '%" . $data['searchVal'] . "%' ";
                    $sql .= " OR user_emailid LIKE '%" . $data['searchVal'] . "%' ";
                } else {
                    $sql .= " AND  rating LIKE '%" . $data['searchVal'] . "%'";
                    $sql .= " OR feedback_question_name LIKE '%" . $data['searchVal'] . "%' ";
                    $sql .= " OR user_comment LIKE '%" . $data['searchVal'] . "%' ";
                    $sql .= " OR user_mobileno LIKE '%" . $data['searchVal'] . "%' ";
                    $sql .= " OR user_emailid LIKE '%" . $data['searchVal'] . "%' ";
                }
            }
        }

        //(DATE_FORMAT(`date_time`,'%m/%d/%Y')< '09/03/2015')  AND  (DATE_FORMAT(`date_time`,'%m/%d/%Y')>= '09/02/2015')

        if (!empty($data['from']) && !empty($data['to'])) {

            if ($sql == '') {
                $sql .= " WHERE date >= '" . $data['from'] . "' AND date <= '" . $data['to'] . "'";
            } else {
                $sql .= " AND date >= '" . $data['from'] . "' AND date <= '" . $data['to'] . "'";
            }
        } else if (empty($data['to']) && !empty($data['from'])) {

            if ($sql == '') {
                $sql .= " WHERE date >= '" . $data['from'] . "'";
            } else {
                $sql .= " AND (date >= '" . $data['from'] . "')";
            }
        } else if (!empty($data['to']) && empty($data['from'])) {

            if ($sql == '') {
                $sql .= " WHERE date <= '" . $data['to'] . "'";
            } else {
                $sql .= " AND date <= '" . $data['to'] . "'";
            }
        }
        $tokenCode = $CI->session->userdata('name')->user_id;
        if ($table == 'v_feedback') {
            if ($sql == '') {
                $sql .= " WHERE created_by = '" . $tokenCode . "'";
            } else {
                $sql .= " AND created_by = '" . $tokenCode . "'";
            }
        }
        $query = $query1 . $sql . ' ORDER BY date ASC ';
        $query = $CI->db->query($query);
        $data = $query->result_array();
//        print_r($data);
//        die;
        return $data;
    }

}
