<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// ------------------------------------------------------------------------

/**
 * CodeIgniter File_processing Class
 *
 * This class enables the creation of calendars
 *
 * @package       CodeIgniter
 * @subpackage    file processing
 * @category      Libraries
 * @author        aditya
 * @email       aditya.cse04@gmail.com
 */
class File_processing {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
        log_message('debug', 'MY File Processing Class Initialized');
    }

    /**
     * @param     $fieldName
     * @param     $path
     * @param     $type
     * @param     $file_name
     * @param int $width
     * @param int $height
     *
     * @return array
     */
    public function make_upload($fieldName, $path, $type, $file_name, $width = 0, $height = 0, $fileSize = '5120') {
       // print_r($type); exit();
        $config['file_name'] = $file_name;
        $config['upload_path'] = $path;
        $config['allowed_types'] = $type;
        $config['max_size'] = $fileSize;
        $config['max_width'] = $width; // 0 for no limit
        $config['max_height'] = $height; // 0 for no limit
        $this->CI->load->library('upload');
        $this->CI->upload->initialize($config);
        unset($config);
        if (!$this->CI->upload->do_upload($fieldName)) {
            return array('status' => 0,
                'error' => $this->CI->upload->display_errors());
        } else {
            return array('status' => 1,
                'upload_data' => $this->CI->upload->data());
        }
    }

    /**
     * @param        $sourcePath
     * @param string $width
     * @param string $height
     * @param string $desPath
     *
     * @return bool
     */
    public function resize_image($sourcePath, $width = '100', $height = '100', $desPath = '') {
        // load the image libraby
        $this->CI->load->library('image_lib');

        // clear the privios configuration
        $this->CI->image_lib->clear();

        // set the new configuration
        $config['image_library'] = 'gd2';
        $config['source_image'] = $sourcePath;
        $config['new_image'] = $desPath;
        $config['quality'] = '100%';
        $config['maintain_ratio'] = TRUE;
        $config['width'] = $width;
        $config['height'] = $height;
        // initlize the image library
        $this->CI->image_lib->initialize($config);

        // make the image to specific size
        if ($this->CI->image_lib->resize()) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * custom image uploading configuration
     *
     * @param        $fieldName
     * @param        $path
     * @param string $size
     * @param string $type
     * @param string $file_name
     *
     * @return mixed
     */
    public function image_upload($fieldName, $path, $size = '', $type = '', $file_name = '', $fileSize = '5120') {
        // check the file path and make sure the is current or not
        // get all size that user want
        if ($size != '') {
            $sizeParams = str_replace(']', '', str_replace('size[', '', $size));
            $allSize = explode('|', $sizeParams);
        } else {
            $allSize = array('800,600');
        } // default size
        // check the is set or not
        if ($type == '') {
            $type = 'jpg|png|gif|jpeg';
        }

        // check file name is set or not
        if ($file_name == '') {
            $file_name = time();
        }

        // first upload the row file
        $result = $this->make_upload($fieldName, $path, $type, $file_name, $fileSize);
        
        // if upload then then resize
        if ($result['status'] != 0) {

            foreach ($allSize as $key => $size) {
                $reSize = explode(',', $size);
                // set the main image path then set the thumbs path
                if ($key == 0) {
                    $savePath = '';
                } else {
                    if ($key == 1) { // check the first thumbs folder
                        $folder = 'thumbs';
                    } else {
                        $folder = 'thumbs' . $key;
                    }

                    $savePath = $result['upload_data']['file_path'] . $folder . "/";

                    // if folder is exists then create it
                    if (!is_dir($savePath)) {
                        mkdir($savePath, 0755);
                    }

                    $savePath .= $result['upload_data']['file_name'];
                }

                $this->resize_image($result['upload_data']['full_path'], $reSize[0], $reSize[1], $savePath);
            }

            return $result['upload_data']['file_name'];
        } else {
            $data['error_msg'] = $result['error'];
            return $data;
        }
    }

    /**
     * @param $filename
     * @param $path
     *
     * @return bool
     */
    public function delete_file($filename, $path) {
        if (!empty($filename)) {
            if (file_exists($path . $filename)) {
                return unlink($path . $filename);
            } else {
                return TRUE;
            }
        } else {
            return TRUE;
        }
    }

    /**
     * Delete file
     *
     * @param $filename
     * @param $path
     *
     * @return bool
     */
    public function delete_multiple($filename, $path) {
        $delImage = FALSE;

        $delImage = $this->delete_file($filename, $path);
        $delImage = $this->delete_file($filename, $path . "thumbs/");

        return $delImage;
    }

}

// END MY_File_processing  class

/* End of file File_processing.php */
/* Location: ./application/libraries/File_processing.php */