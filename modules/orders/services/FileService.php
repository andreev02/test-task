<?php

namespace orders\services;

class FileService
{
    public static function SendCsvFile($filename, $body)
    {        
        header('Content-type: text/csv');
        header('Content-Disposition: attachment; filename="'. $filename .'.csv"');
        header('Content-Transfer-Encoding: binary'); 
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Description: File Transfer');
        
        echo $body;

        exit();
    }
}