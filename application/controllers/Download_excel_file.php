<?php
class Download_excel_file extends CI_Controller
{
    public function download_header($pid)
    {
        echo "Project id is ". $pid;
    }
}