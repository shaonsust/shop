<?php
class Report_c extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $user_id = $this->session->userdata('user_id');
        $user_role = $this->session->userdata('user_role');
        $user_name = $this->session->userdata('user_name');
        $this->load->model('Super_admin_c_model');
        $this->load->model('Amazon_model');

        if (empty($user_id) || empty($user_role))
            redirect('login');
    }

    public function project_report_excel($pid)
    {
        $this->load->model('Report_model');
        $report = $this->Report_model->project_report($pid);
        $data['pid'] = $pid;

        // Starting the PHPExcel library
        $this->load->library('Excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
        $objPHPExcel->setActiveSheetIndex(0);

        // Set Header Name to excel file
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, "Box Name");
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, "SKU");
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 1, "Barcode");
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, 1, "Quantity Scanned");

        //write value to excel file
        $row = 2;
        foreach ($report as $val)
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $val->box_name);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $val->sku);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $val->barcode);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $val->cbarcode);
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

    public function amazon_sub_report_excel($pid, $spid)
    {
        $this->load->model('Report_model');
        $report = $this->Report_model->amazon_sub_report($pid, $spid);
        $data['pid'] = $pid;
        $data['spid'] = $spid;

        // Starting the PHPExcel library
        $this->load->library('Excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
        $objPHPExcel->setActiveSheetIndex(0);

        // Set Header Name to excel file
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, "Box Name");
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, 1, "SKU");
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, 1, "Barcode");
        $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, 1, "Quantity Scanned");

        //write value to excel file
        $row = 2;
        foreach ($report as $val)
        {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0, $row, $val->box_name);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $row, $val->sku);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $row, $val->barcode);
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $row, $val->cbarcode);
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

    public function project_report($pid)
    {
        $this->load->model('Report_model');
        $data['report'] = $this->Report_model->project_report($pid);
        $data['pid'] = $pid;
        $this->load->view('Pproject_report', $data);
    }

    public function amazon_sub_report($pid, $spid)
    {
        $this->load->model('Report_model');
        $data['report'] = $this->Report_model->amazon_sub_report($pid, $spid);
        $data['pid'] = $pid;
        $data['spid'] = $spid;
        $this->load->view('Amazon_sub_report', $data);
    }
}