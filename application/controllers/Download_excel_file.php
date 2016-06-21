<?php
class Download_excel_file extends CI_Controller
{
    public function download_header($pid)
    {
        $this->load->model('Download_excel_model');
        $fields = $this->Download_excel_model->table_field_name('pick_list');

        // Starting the PHPExcel library
        $this->load->library('Excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
        $objPHPExcel->setActiveSheetIndex(0);
        // Field names in the first row
        $col = 0;
        foreach ($fields as $field)
        {
            if($field != 'id' && $field != 'status' && $field != 'created_date' && $field != 'updated_date' && $field != 'extra' && $field != 'user_id' && $field != 'pid' && $field != 'qty_scaned')
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
                $col++;
            }
        }

        $objPHPExcel->setActiveSheetIndex(0);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Sample_'.date('dMy').'.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }

    public function download_xlsx()
    {
        $this->load->model('Upload_model');
        $fields = $this->Upload_model->table_field_name('product');

        // Starting the PHPExcel library
        $this->load->library('excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
        $objPHPExcel->setActiveSheetIndex(0);
        // Field names in the first row
        $col = 0;
        foreach ($fields as $field)
        {
            if($field != 'id' && $field != 'status' && $field != 'created_date' && $field != 'modified_date')
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
                $col++;
            }
            else if($field == 'supplier_id')
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, 'supplier name');
                $col++;
            }
        }

        $objPHPExcel->setActiveSheetIndex(0);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Sample_'.date('dMy').'.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }
}