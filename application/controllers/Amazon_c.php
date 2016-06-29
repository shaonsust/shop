<?php
class Amazon_c extends CI_Controller
{
    function check_format()
    {
        if (isset ( $_FILES ['read']['name'] ) && ! empty ( $_FILES ['read']['name'] ))
        {
            $path_parts = pathinfo ( $_FILES ['read'] ['name'] );
            $file = $path_parts ['dirname'] . '/' . $path_parts ['basename'];

            $this->load->library('upload');
            $config['upload_path'] ='./upload/';
            $config['allowed_types'] = '*';
            $config['remove_spaces'] = TRUE;
            $this->upload->initialize($config);
            $upload=$this->upload->do_upload('read');
            $images_file = $this->upload->data();
            $file = $images_file['full_path'];

            if(!$upload)
            {
                $this->upload->display_errors();
            }
            if ($path_parts['extension'] == "csv")
            {
                $this->read_csv($pid, $file, $status);
            }
            else if($path_parts['extension'] == "xlsx" || $path_parts['extension'] == "xls" || $path_parts['extension'] == "ods")
            {
                $this->read_excel($file);
            }
        }
    }
    function read_excel($path_parts)
    {
        //load the excel library
        $file = $path_parts;
        $this->load->library('excel');
        $this->load->model('Amazon_model');
        try {
            $objPHPExcel = PHPExcel_IOFactory::load($file);
        } catch(Exception $e) {
            die("Error loading file :" . $e->getMessage());
        }

        $shipment = "";
        //get only the Cell Collection
        foreach ( $objPHPExcel->getWorksheetIterator () as $worksheet )
        {
            $worksheetTitle = $worksheet->getTitle ();
            $highestRow = $worksheet->getHighestRow (); // e.g. 10
            $highestColumn = $worksheet->getHighestDataColumn (); // e.g 'F'
            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString ( $highestColumn );
            $nrColumns = ord ( $highestColumn ) - 64;
            for($row = 1; $row <= 7; ++ $row)
            {
                $cell1 = $worksheet->getCellByColumnAndRow ( 0, $row );
                $header = strtolower($cell1->getValue());
                $cell2 = $worksheet->getCellByColumnAndRow ( 1, $row );
                $h_value = strtolower($cell2->getValue());
                $aproject[$header] = $h_value;
            }

            // Reading header
            for($col = 0; $col < $highestColumnIndex; ++ $col)
            {
                $cell = $worksheet->getCellByColumnAndRow ( $col, 9 );
                $harr[$col] = $cell->getValue();
            }


            // creating and checking amazon project
            $pdata['pick_list'] = 2;
            $pdata['project_name'] = $aproject['plan id'];
            $pdata['status'] = 0;
            $pdata['created_date'] = date("Y-m-d");
            $pdata['updated_date'] = date("Y-m-d");
            $pdata['status'] = 1;
            $pdata['user_id'] = $this->session->userdata('user_id');
            $pid = $this->Amazon_model->check_project('projects', $pdata['project_name'], $pdata);

            // creating and checking sub project
            $sn = substr($aproject['name'], -1);
            $sdata['sub_project_name'] = $aproject['shipment id'] .'-'.$sn;
            $sdata['total_sku'] = $aproject['total skus'];
            $sdata['total_units'] = $aproject['total units'];
            $sdata['pack_list'] = $aproject['pack list'];
            $sdata['user_id'] = $this->session->userdata('user_id');
            $sdata['created_date'] = date("Y-m-d");
            $sdata['updated_date'] = date("Y-m-d");
            $sdata['pid'] = $pid;
            $sdata['status'] = 1;
            $sub_value = $this->Amazon_model->check_sub_project($pid, $sdata['sub_project_name'], $sdata);
            if($sub_value > 0) {
                for ($row = 10; $row <= $highestRow; $row++)
                {
                    for ($col = 0; $col < $highestColumnIndex; $col++)
                    {
                        if(strtolower($harr[$col]) == 'merchant sku')
                        {
                            $cell = $worksheet->getCellByColumnAndRow ( $col, $row );
                            $list['sku'] = $cell->getValue();
                        }
                        else if(strtolower($harr[$col]) == 'fnsku')
                        {
                            $cell = $worksheet->getCellByColumnAndRow ( $col, $row );
                            $list['barcode'] = $cell->getValue();
                        }
                        else if(strtolower($harr[$col]) == 'shipped')
                        {
                            $cell = $worksheet->getCellByColumnAndRow($col, $row);
                            $list['qty'] = $cell->getValue();
                        }
                    }
                    $list['pid'] = $pid;
                    $list['spid'] = $sub_value;
                    $list['user_id'] = $this->session->userdata('user_id');
                    $list['created_date'] = date("Y-m-d");
                    $list['updated_date'] = date("Y-m-d");
                    $list['status'] = 1;
                    $pl = $this->Amazon_model->insert('pick_list', $list);
                }

                unlink($file);
                $flag = 1;
                $this->sub_project($pid, $flag);
//                redirect(base_url().'amazon_c/sub_project/'.$pid.'/'.$flag, refresh);
            }
            else{
                unlink($file);
                $flag = 2;
//                redirect(base_url().'amazon_c/sub_project/'.$pid.'/'.$flag,refresh);
                $this->sub_project($pid, $flag);
            }
        }
    }
    function read_csv($pid, $path_parts, $status)
    {
        $file = $path_parts;
        $head [0] = 'pid';
        $head [1] = 'user_id';
        $head [2] = 'sku';
        $head [3] = 'barcode';
        $head [4] = 'qty';
        $head [5] = 'created_date';
        $head [6] = 'updated_date';
        $head [7] = 'status';
        $head [8] = 'extra';

        $inputFileType = 'CSV';
        $inputFileName = $file;
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);

        $worksheet = $objPHPExcel->getActiveSheet();
        foreach ($worksheet->getRowIterator() as $row)
        {
            $x = 2;
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
            foreach ($cellIterator as $cell)
            {
                if (!is_null($cell))
                {
                    $data[$head[$x++]] = $cell->getValue();
                }
            }
            $data['status'] = 0;
            $data['created_date'] = date("Y-m-d");
            $data['updated_date'] = date("Y-m-d");
            $data['extra'] = 1;
            $data['user_id'] = $this->session->userdata('user_id');
            $data['pid'] = $pid;
            $this->load->model('Super_admin_c_model');
            $this->Super_admin_c_model->insert_pick_list('pick_list',$data);
        }

        $this->Super_admin_c_model->update($pid, $status);
        $dat['list'] = $this->Super_admin_c_model->select_list($pid);
        $dat['pid'] = $pid;
        $this->load->view('Pick_list', $dat);
//     	}
    }
    function sub_project($pid, $flag = 0)
    {
        //echo 'dddddd';
        //exit();
        $data['pid'] = $pid;
        $this->load->model('Amazon_model');
        $data['sub_project'] = $this->Amazon_model->select_all('sub_project', $pid);
        $data['flag'] = $flag;
        $this->load->view("Sub_project_list_v", $data);
    }

    public function item_list($pid, $spid)
    {
        $this->load->model('Amazon_model');
        $data['pid'] = $pid;
        $data['spid'] = $spid;
        $data['list'] = $this->Amazon_model->amazon_item($pid, $spid);
        $this->load->view('Amazon_list_v', $data);
    }

    function box_list($pid, $spid)
    {
        $this->load->model('Amazon_model');
        $dat['list'] = $this->Amazon_model->box_report1($pid, $spid);
        if(empty($dat['list'])) {
            $dat['list'] = $this->Amazon_model->box_report($pid, $spid);
        }
        $box = $this->Amazon_model->box_no($pid, $spid);
        $dat['box_no'] = $box->no;
//     	echo $dat['box_no'];
//     	die();
        $dat['pid'] = $pid;
        $dat['spid'] = $spid;
//     	$dat['barcode'] = $barcode;
        $this->load->view('Amazon_box_list', $dat);
    }

    function box_calculation($pid, $spid)
    {
        $this->load->model('Amazon_model');
        $this->load->model('Super_admin_c_model');
        $data['pid'] = $pid;
        $dat['pid'] = $pid;
        $dat['spid'] = $spid;
        $data['spid'] = $spid;
//     	$data['barcode'] = $barcode;
        $data['box_name'] = $this->input->post('box_name');
        $data['created_date'] = date("Y-m-d");
        $data['updated_date'] = date("Y-m-d");
        $val = $this->Amazon_model->check_box($pid, $data['box_name'], $spid);
        if($val)
        {
            $dat['list'] = $this->Amazon_model->select_list($pid, $spid);
            $dat['pid'] = $pid;
            $dat['spid'] = $spid;
            $dat['msg'] = "Box is already exist. Please try again.";
            $dat['box_list'] = $this->Amazon_model->select_box($pid, $spid);
            $this->load->view('Amazon_list', $dat);
        }
        else
        {
            $bid = $this->Amazon_model->insert('box', $data);
            $dat['bdetails'] = $this->Super_admin_c_model->select_box_id($bid);
            $dat['list'] = $this->Amazon_model->select_list($pid, $spid);
            $dat['box_list'] = $this->Amazon_model->select_box($pid, $spid);
            $this->load->view('Amazon_pick_list', $dat);
        }
//     	$this->box_list($pid, $barcode, 1);
    }

    function box_calculation1($pid, $bid, $spid)
    {
        $dat['pid'] = $pid;
        $dat['spid'] = $spid;
        $this->load->model('Super_admin_c_model');
        $this->load->model('Amazon_model');
        $dat['bdetails'] = $this->Super_admin_c_model->select_box_id($bid);
        $dat['list'] = $this->Amazon_model->select_list($pid, $spid);
        $dat['box_list'] = $this->Amazon_model->select_box($pid, $spid);
        $this->load->view('Amazon_pick_list', $dat);
        //     	$this->box_list($pid, $barcode, 1);
    }

    function barcode_calculation($pid, $bid, $spid)
    {
        $cdata['pid'] = $pid;
        $cdata['spid'] = $spid;
        $cdata['barcode'] = $this->input->post('barcode');
//     	$cdata['bar_no'] = $this->input->post('bar_no');
//     	$cdata['box_id'] = $this->input->post('box_id');
        $cdata['user_id'] = $this->session->userdata('user_id');
        $cdata['created_date'] = date("Y-m-d H:i:s");
        $cdata['updated_date'] = date("Y-m-d H:i:s");
        $cdata['status'] = 1;

        $this->load->model('Super_admin_c_model');
        $this->load->model('Amazon_model');
        $val5 = $this->Amazon_model->picklist($cdata['barcode'], $pid, $spid);
        $dat['box_list'] = $this->Amazon_model->select_box($pid, $spid);
//      	print_r($val);
//     	die();
        if($val5)
        {
            if(($val5->qty) > ($val5->qty_scaned))
            {
                $this->Super_admin_c_model->update_box($bid);
                $this->Amazon_model->update_pick($cdata['barcode'], $spid);
                $val = $this->Amazon_model->count_barcode($cdata['barcode'], $cdata['spid']);
                $val1 = $val->qty_scaned;
                $val2 = $val->qty;
                if($val1 === $val2)
                {
                    $this->Amazon_model->update_picklist_status($cdata['barcode'], $cdata['spid']);
                }
                $dat['pid'] = $pid;
                $dat['spid'] = $spid;
                $dat['flag'] = 0;
                $dat['msg'] = "Data inserted successfully";
                $dat['bdetails'] = $this->Super_admin_c_model->select_box_id($bid);
                $cdata['box_id'] = $bid;
                $cdata['pl_id'] = $val5->id;
                $cdata['box_name'] = $dat['bdetails']->box_name;
                $breport = $this->Amazon_model->insert('box_report', $cdata);
                $dat['list'] = $this->Amazon_model->select_list($pid, $spid);
                $this->load->view('Amazon_pick_list', $dat);
                //echo $val1;
            }
            else
            {
// 	    		echo "too much data inserted";
                $dat['pid'] = $pid;
                $dat['spid'] = $spid;
                $dat['flag'] = 2;
                // 			$dat['msg'] = "Data inserted successfully";
                $dat['bdetails'] = $this->Super_admin_c_model->select_box_id($bid);
                $dat['list'] = $this->Amazon_model->select_list($pid, $spid);
                $this->load->view('Amazon_pick_list', $dat);
            }
        }
        else
        {
// 			echo "Barcode is not found";
            $dat['pid'] = $pid;
            $dat['spid'] = $spid;
            $dat['flag'] = 1;
// 			$dat['msg'] = "Data inserted successfully";
            $dat['bdetails'] = $this->Super_admin_c_model->select_box_id($bid);
            $dat['list'] = $this->Amazon_model->select_list($pid, $spid);
            $this->load->view('Amazon_pick_list', $dat);
        }
    }

    function pick_list($pid, $spid)
    {
        $this->load->model("Amazon_model");
        $dat['list'] = $this->Amazon_model->select_list($pid, $spid);
        $dat['pid'] = $pid;
        $dat['spid'] = $spid;
        $this->load->view('Amazon_list', $dat);
    }

    function select_box_report($pid, $bid, $spid)
    {
//     	echo "working well";
        $this->load->model('Amazon_model');
        $dat['list'] = $this->Amazon_model->box_report2($pid, $bid, $spid);
        $this->load->view('Box_report', $dat);
//     	echo "<pre>";
//     	print_r($dat);
    }

    public function amazon_full_item_report($pid, $flag = 0)
    {
        $data['pid'] = $pid;
        $this->load->model('Amazon_model');
        $data['sub_project'] = $this->Amazon_model->select_all('sub_project', $pid);
        $data['list'] = $this->Amazon_model->amazon_full_report($pid);
        $data['flag'] = $flag;
        $this->load->view("Amazon_full_report_v", $data);
    }

    public function amazon_full_box_report($pid, $flag = 0)
    {
        $data['pid'] = $pid;
        $this->load->model('Amazon_model');
        $data['sub_project'] = $this->Amazon_model->select_all('sub_project', $pid);
        $data['report'] = $this->Amazon_model->amazon_full_box_report($pid);
        $data['flag'] = $flag;
        $this->load->view("Amazon_full_box_report", $data);
    }

    public function sample_amazon_excel()
    {
        // Starting the PHPExcel library
        $this->load->library('excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
        $objPHPExcel->setActiveSheetIndex(0);
        // Field names in the first row
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, 'Shopment ID');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, 'FBA3NHCVCH');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 2, 'Name');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 2, 'FBA (6/1/16 3:23 PM) - 2');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 3, 'Plan ID');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 3, 'PLN9HY3YJ');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 4, 'Ship To');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 4, 'Amazon.com, 705 Boulder Drive, Breinigsville, PA, US, 18031');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 5, 'Total SKUs');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 5, '24');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 6, 'Total Units');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 6, '30');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 7, 'Pack list');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 7, '1 of 1');

        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 9, 'Merchant SKU');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 9, 'Title');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 9, 'ASIN');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, 9, 'FNSKU');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, 9, 'external-id');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, 9, 'Condition');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, 9, 'Who will prep?');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, 9, 'Prep Type');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, 9, 'Who will label?');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, 9, 'Shipped');

        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 10, '1007-L-ST13');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 10, 'Popana Print Tunic Top Large ST13 - Made In USA');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 10, 'B015DF8ETA');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, 10, 'X000UT62HH');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, 10, '');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, 10, 'New');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, 10, '--');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, 10, '--');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, 10, 'Merchant');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, 10, '1');

        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 11, '1007-L-ST17');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 11, 'Popana Print Tunic Top Large ST17 - Made In USA');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 11, 'B015YRK2VU');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, 11, 'X000VLNNML');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, 11, '');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, 11, 'New');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, 11, '--');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, 11, '--');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, 11, 'Merchant');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, 11, '5');

        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 12, '1007-L-ST42');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 12, 'Popana Print Tunic Top Large ST42 - Made In USA');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 12, 'B01881LGUA');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, 12, 'X000WNIO4P');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, 12, '');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, 12, 'New');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, 12, '--');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, 12, '--');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, 12, 'Merchant');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, 12, '4');

        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 13, '1007-L-ST43');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 13, 'Popana Print Tunic Top Large ST43 - Made In USA');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 13, 'B01881LJI4');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, 13, 'X000WNIO4Z');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, 13, '');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, 13, 'New');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, 13, '--');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, 13, '--');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, 13, 'Merchant');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, 13, '2');

        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 14, '1007-M-ST17');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 14, 'Popana Print Tunic Top Medium ST17 - Made In USA');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 14, 'B015YRK18E');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, 14, 'X000VLNNV7');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, 14, '');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, 14, 'New');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, 14, '--');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, 14, '--');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, 14, 'Merchant');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, 14, '7');

        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 15, '1007-S-Black');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 15, 'Popana Print Tunic Top Small Black - Made In USA');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 15, 'B016P3DERQ');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, 15, 'X000VZ55IH');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, 15, '');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(5, 15, 'New');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(6, 15, '--');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(7, 15, '--');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, 15, 'Merchant');
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(9, 15, '6');

        $objPHPExcel->setActiveSheetIndex(0);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Amazon_sample'.'.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }
}