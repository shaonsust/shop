<?php
class Report_c extends CI_Controller
{
    public function project_report($pid)
    {
        $this->load->model('Report_model');
        $fields = $this->Report_model->table_field_name('pick_list');
        $value = $this->Report_model->select_list($pid);

        // Starting the PHPExcel library
        $this->load->library('Excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
        $objPHPExcel->setActiveSheetIndex(0);

        // Set Header Name to excel file
        $col = 0;
        foreach ($fields as $field)
        {
            if($field == 'qty_scaned')
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, "Quanty Scanned");
                $col++;
            }
            else if ($field == 'qty')
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, "Quantity");
                $col++;
            }
            else if($field != 'id' && $field != 'status' && $field != 'created_date' && $field != 'updated_date' && $field != 'extra' && $field != 'user_id' && $field != 'pid')
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, ucfirst($field));
                $col++;
            }
        }
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, "Box Name");

        //write value to excel file
        $col = 0;
        $row = 2;
        $name = "";
        foreach ($value as $val)
        {
            foreach ($fields as $field)
            {
                if($field == 'sku' || $field == 'qty' || $field == 'qty_scaned' || $field == 'barcode') {
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $val->$field);
                    $col++;
                    if($field == 'barcode')
                    {
                        $box_name = $this->Report_model->select_box_name($pid, $val->$field);
                    }
                }
            }
            
            foreach ($box_name as $box) {
                $name = $name . $box->box_name . ",";
            }
            $name = trim($name, ',');
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $name);
            $name = "";
            $col = 0;
            $row++;
        }

        $objPHPExcel->setActiveSheetIndex(0);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Project_Report_'.date('dMy').'.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }
}