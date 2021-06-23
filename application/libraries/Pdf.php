<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// ------------------------------------------------------------------------

class Pdf {

    public function __construct() {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }

    function load($params = false) {

        include_once APPPATH . '/third_party/mpdf/mpdf.php';

        if (!$params) {
            $params = array('width' => 300, 'height' => 600,);
        }

        //return new mPDF($params);
        return new mPDF('utf-8', // mode - default ''
                'A4', // format - A4, for example, default ''
                0, // font size - default 0
                '', // default font family
                10, // margin_left
                10, // margin right
                20, // margin top
                10, // margin bottom
                10, // margin header
                10, // margin footer
                'p'); // L - landscape, P - portrait
    }

}

// END My_Mpdf  class

/* End of file Mpdf.php */
/* Location: ./application/libraries/Mpdf.php */