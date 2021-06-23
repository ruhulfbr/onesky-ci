<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if (!function_exists('pr')) {

    function pr($params) {
        echo "<pre>";
        print_r($params);
        die;
    }

}

// check admin user login return true or false
if (!function_exists('loginCheck')) {

    function loginCheck() {
        // get the codeigniter instance
        $CI = &get_instance();
        // check if user data to thfe session
        if ($CI->session->userdata('user_id')) {
            // load the specific model
            $CI->load->model('admin/user_model');
            // get the specific user information
            $userInfo = $CI->user_model->getSingleUserInfo($CI->session->userdata('user_id'));
            // if found then set the user data to the session
            if (!empty($userInfo)) {
                $user_data = array(
                    'user_id'    => $userInfo->user_id,
                    'user_name'  => $userInfo->user_name,
                    'first_name' => $userInfo->first_name,
                    'last_name'  => $userInfo->last_name,
                    'user_level' => $userInfo->level_id,
                    'status'     => $userInfo->status,
                    'email'      => $userInfo->email,
                    'photo'      => $userInfo->photo
                );
                $CI->session->set_userdata($user_data);

                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

}

// check authentic login
if (!function_exists('check_auth_login')) {

    function check_auth_login() {

        // get codeigniter instance
        $CI = &get_instance();

        // check user data to session
        if (isset($CI->session->userdata('login_user_info')['user_logged_in'])) {
            return TRUE;
        }

        return FALSE;
    }

}

if (!function_exists('admin_url')) {

    function admin_url($uri = '') {
        $CI = & get_instance();
        return $CI->config->base_url('admin/' . $uri);
    }

}

if (!function_exists('frontend_url')) {

    function frontend_url($uri = '') {
        $CI = & get_instance();
        return $CI->config->site_url('main/' . $uri);
    }

}

// generate the password and secret
if (!function_exists('geneSecurePass')) {

    function geneSecurePass($password, $secret = FALSE) {

        if ($secret) {
            // create the salt using secret
            list( $salt1, $salt2 ) = str_split($secret, ceil(strlen($secret) / 2));
            $code = md5($salt1 . $password . $salt2);
        } else {
            // generate the randomcode
            $code['secret']   = $secret           = rand(100000, 999999);
            // create the salt using secret
            list( $salt1, $salt2 ) = str_split($secret, ceil(strlen($secret) / 2));
            // generate the password
            $code['password'] = md5($salt1 . $password . $salt2);
        }

        return $code;
    }

}

//Get all media images
if (!function_exists('getAllMedia')) {

    function getAllMedia($table, $id, $type = FALSE) {
        // get the CI instanse
        $CI      = &get_instance();
        //Get image
        $results = $CI->global_model->get($table, array('type_id' => $id, 'type' => $type), false, array('filed' => 'created', 'order' => 'desc'));

        return $results;
    }

}


// get settings value
if (!function_exists('get_settings_value')) {

    function get_settings_value($setting_key = '', $default_value = 10) {
        // get the codeigniter instance
        $CI   = &get_instance();
        $info = $CI->global_model->get_data('settings', array('setting_key' => $setting_key));
        if ($info) {
            return $info['setting_value'];
        } else {
            return $default_value;
        }
    }

}

// Get Media Cover Photo
if (!function_exists('getCoverPhoto')) {

    function getCoverPhoto($projectId, $imgSize = 'natural') {
        // get the CI instanse
        $CI         = &get_instance();
        // get image
        $mediaImage = $CI->global_model->get_data('media', array('type_id' => $projectId, 'type' => 'committee_member', 'is_home' => 1));

        if (!empty($mediaImage['images'])) {
            $imagePath = 'assets/media/committee_member/product';
            $imageName = base_url($imagePath . '/' . $mediaImage['images']);
            return $imageName;
        }

        return ''; // return zero incase of no images.
    }

}


// get media url
if (!function_exists('getMediaUrl')) {

    function getMediaUrl($mediaType, $mediaSize, $imageName) {
        // get the CI instanse
        $CI = &get_instance();
        // getLink
        return base_url('assets/media/' . $mediaType . '/' . $mediaSize . '/' . $imageName);
    }

}

if (!function_exists('get')) {

    function get($table, $where = FALSE, $limit = FALSE, $order_by = FALSE) {
        $CI = &get_instance();
        return $CI->global_model->get($table, $where, $limit, $order_by);
    }

}

// image resize
function img_resize($ini_path, $dest_path, $params = array()) {

    $width        = !empty($params['width']) ? $params['width'] : null;
    $height       = !empty($params['height']) ? $params['height'] : null;
    $constraint   = !empty($params['constraint']) ? $params['constraint'] : FALSE;
    $rgb          = !empty($params['rgb']) ? $params['rgb'] : 0xFFFFFF;
    $quality      = !empty($params['quality']) ? $params['quality'] : 100;
    $aspect_ratio = isset($params['aspect_ratio']) ? $params['aspect_ratio'] : TRUE;
    $crop         = isset($params['crop']) ? $params['crop'] : TRUE;

    if (!file_exists($ini_path)) {
        return FALSE;
    }

    if (!is_dir($dir = dirname($dest_path))) {
        mkdir($dir);
    }

    $img_info = getimagesize($ini_path);

    if ($img_info === FALSE) {
        return FALSE;
    }


    $ini_p = $img_info[0] / $img_info[1];
    if ($constraint) {
        $con_p  = $constraint['width'] / $constraint['height'];
        $calc_p = $constraint['width'] / $img_info[0];

        if ($ini_p < $con_p) {
            $height = $constraint['height'];
            $width  = $height * $ini_p;
        } else {
            $width  = $constraint['width'];
            $height = $img_info[1] * $calc_p;
        }
    } else {
        if (!$width && $height) {
            $width = ( $height * $img_info[0] ) / $img_info[1];
        } else if (!$height && $width) {
            $height = ( $width * $img_info[1] ) / $img_info[0];
        } else if (!$height && !$width) {
            $width  = $img_info[0];
            $height = $img_info[1];
        }
    }

    preg_match('/\.([^\.]+)$/i', basename($dest_path), $match);
    $ext           = strtolower($match[1]);
    $output_format = ( $ext == 'jpg' ) ? 'jpeg' : $ext;

    $format = strtolower(substr($img_info['mime'], strpos($img_info['mime'], '/') + 1));
    $icfunc = "imagecreatefrom" . $format;

    $iresfunc = "image" . $output_format;

    if (!function_exists($icfunc)) {
        return FALSE;
    }

    $dst_x = $dst_y = 0;
    $src_x = $src_y = 0;
    $res_p = $width / $height;
    if ($crop && !$constraint) {
        $dst_w = $width;
        $dst_h = $height;
        if ($ini_p > $res_p) {
            $src_h = $img_info[1];
            $src_w = $img_info[1] * $res_p;
            $src_x = ( $img_info[0] >= $src_w ) ? floor(( $img_info[0] - $src_w ) / 2) : $src_w;
        } else {
            $src_w = $img_info[0];
            $src_h = $img_info[0] / $res_p;
            $src_y = ( $img_info[1] >= $src_h ) ? floor(( $img_info[1] - $src_h ) / 2) : $src_h;
        }
    } else {
        if ($ini_p > $res_p) {
            $dst_w = $width;
            $dst_h = $aspect_ratio ? floor($dst_w / $img_info[0] * $img_info[1]) : $height;
            $dst_y = $aspect_ratio ? floor(( $height - $dst_h ) / 2) : 0;
        } else {
            $dst_h = $height;
            $dst_w = $aspect_ratio ? floor($dst_h / $img_info[1] * $img_info[0]) : $width;
            $dst_x = $aspect_ratio ? floor(( $width - $dst_w ) / 2) : 0;
        }
        $src_w = $img_info[0];
        $src_h = $img_info[1];
    }

    $isrc  = $icfunc($ini_path);
    $idest = imagecreatetruecolor($width, $height);
    if (( $format == 'png' || $format == 'gif' ) && $output_format == $format) {
        imagealphablending($idest, FALSE);
        imagesavealpha($idest, TRUE);
        imagefill($idest, 0, 0, IMG_COLOR_TRANSPARENT);
        imagealphablending($isrc, TRUE);
        $quality = 0;
    } else {
        imagefill($idest, 0, 0, $rgb);
    }
    imagecopyresampled($idest, $isrc, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
    $res = $iresfunc($idest, $dest_path, $quality);


    //imagedestroy($isrc);
    //imagedestroy($idest);

    return $res;
}

//Add http with given url
if (!function_exists('addhttp')) {

    function addhttp($url) {
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }
        return $url;
    }

}

/**
 * Set Email protocol
 */
if (!function_exists('mail_protocol')) {

    function mail_protocol() {
        $CI     = &get_instance();
        $CI->load->library('email');
        $config = Array(
            'protocol'     => 'smtp',
            'smtp_host'    => 'connectingstartupsbd.net',
            'smtp_port'    => '25',
            'smtp_user'    => 'info@connectingstartupsbd.net',
            'smtp_pass'    => 'ZA{xcT=H9T;T',
            'charset'      => 'iso-8859-1',
            'newline'      => '\r\n',
            'mailtype'     => 'html',
            'smtp_timeout' => 15,
            'validation'   => TRUE
        );
        return $CI->email->initialize($config);
    }

}

// get the next order
if (!function_exists('getNextOrder')) {

    function getNextOrder($params = array()) {
        // get the codeigniter instance
        $CI       = &get_instance();
        // load the specific model
        $CI->load->model('admin/' . $params['module'] . '_model', $params['module']);
        // get the order information
        $maxOrder = $CI->{$params['module']}->nextOrder($params);

        $nextOrd = ( $maxOrder->next_order == null ) ? 1 : $maxOrder->next_order + 1;

        return $nextOrd;
    }

}

// create paggination configuratin
if (!function_exists('createPagination')) {

    function createPagination($page_url, $total_rows, $per_page, $uri_segment = 2, $num_links = 3) {
        $CI = &get_instance();
        //load the pagging library
        $CI->load->library('pagination');

        // set the configuration
        $config['base_url']      = $page_url;
        $config['total_rows']    = $total_rows;
        $config['per_page']      = $per_page;
        $config['uri_segment']   = $uri_segment;
        $config['num_links']     = $num_links;
        // pagging design section

        // first tag
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = 'p';

        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        //privious link
        $config['prev_link']  = '&lsaquo;';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        // current  link
        $config['cur_tag_open']  = '<li class="page-item active"><a class="page-link" href="">';
        $config['cur_tag_close'] = '</a></li>';

        //  link
        $config['num_tag_open']  = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        // next link
        $config['next_link'] = '&rsaquo;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        // last link
        $config['last_link']      = '&raquo;';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        // close paggination

        $config['attributes'] = array('class' => 'page-link');

        $CI->pagination->initialize($config);

        return $CI->pagination->create_links();
    }

}

//SMTP Mail Send
if (!function_exists('mailSend')) {

    function mailSend($to_address = array(), $subject = '', $message = '', $attachment = false, $reply_to_mail, $reply_to_user) {

        // get the CI instanse
        $CI = &get_instance();
        // load the email library
        $CI->load->library('email');

        $config = array('protocol'     => 'smtp',
            'smtp_host'    => 'technobd.info',
            'smtp_port'    => '25',
            'smtp_user'    => 'demo@technobd.info',
            'smtp_pass'    => '!t{nfu+g;Uh0',
            'charset'      => 'utf-8',
            'newline'      => '\r\n',
            'mailtype'     => 'html',
            'smtp_timeout' => 45,
            'validation'   => TRUE);
        // clear the mail
        $CI->email->clear();
        $CI->email->initialize($config);
        $CI->email->from($reply_to_mail, $reply_to_user);
        $CI->email->reply_to($reply_to_mail, $reply_to_user);
        $CI->email->to($to_address);

        $CI->email->subject($subject);
        $CI->email->message($message);

        // attach file if found
        if ($attachment) {
            $CI->email->attach($attachment);
        }

        try {
            if ($CI->email->send()) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e->getMessage();
            //return false;
        }
    }

}

//Get media image
if (!function_exists('getMedia')) {

    function getMedia($table, $id) {
// get the CI instanse
        $CI      = &get_instance();
        //Get image
        $results = $CI->global_model->get($table, array('typeid' => $id, 'show_home' => 1));
        return $results;
    }

}

//Get media image
if (!function_exists('getMediaAll')) {

    function getMediaAll($table, $id) {
        // get the CI instanse
        $CI      = &get_instance();
        //Get image
        $results = $CI->global_model->get($table, array('typeid' => $id));
        return $results;
    }

}

//Get media image
if (!function_exists('getAchievementCoverPhoto')) {

    function getAchievementCoverPhoto($type, $imgSize = 'home', $typeId) {

        // get the CI instanse
        $CI = &get_instance();

        $item = $CI->global_model->getMediaDataRandomlyByType($type, $typeId);
        if (!empty($item)) {
            $achievementImagePath = 'assets/media/achievement/';
            $imageName            = base_url($achievementImagePath . $imgSize . '/' . $item->images);
            return $imageName;
        }
        return '';
    }

}


//get total photos
if (!function_exists('getTotalPhotoById')) {

    function getTotalPhotoById($table, $where) {
        $CI    = &get_instance();
        $query = $CI->db->get_where($table, $where);
        if ($data  = $query->row_array()) {
            return $data['total_photo'];
        } else {
            return 0;
        }
    }

}

if (!function_exists('statusCheck')) {

    function statusCheck($status) {
        if ($status == 'active' || ($status == 1)) {
            return '<span class="label label-success">Active</span>';
        } else {
            return '<span class="action label label-danger">Inactive</span>';
        }
    }

}

if (!function_exists('limit_text')) {

    function limit_text($text, $limit) {
        $summary = substr(strip_tags($text), 0, $limit);
        $pos     = strrpos($summary, " ");
        return substr($summary, 0, $pos) . '...';
    }

}

if (!function_exists('generatePagging')) {

    function generatePagging($page_url, $total_rows, $per_page, $uri_segment = 3, $num_links = 2) {

        $CI                    = &get_instance();
        //load the pagging library
        $CI->load->library('pagination');
        // set the configuration
        $config['base_url']    = site_url() . $page_url;
        $config['total_rows']  = $total_rows;
        $config['per_page']    = $per_page;
        $config['uri_segment'] = $uri_segment;
        $config['num_links']   = $num_links;

        // pagging design section
        $config['reuse_query_string'] = TRUE;

        // open full tag
        $config['full_tag_open']  = '<ul class="pagination">';
        // close paggination
        $config['full_tag_close'] = '</ul>';

        // privious tag
        $config['prev_tag_open']  = '<li  class="page-item">';
        $config['prev_tag_close'] = '</li>';
        //privious link
        $config['prev_link']      = '&lsaquo; Prev';

        // first tag
        $config['first_tag_open']  = '<li  class="page-item">';
        $config['first_tag_close'] = '</li>';
        // first link
        $config['first_link']      = '&laquo; First';

        // last tag
        $config['last_tag_open']  = '<li  class="page-item">';
        $config['last_tag_close'] = '</li>';
        // last link
        $config['last_link']      = 'Last &raquo;';

        // next tag
        $config['next_tag_open']  = '<li>';
        $config['next_tag_close'] = '</li>';
        // next link
        $config['next_link']      = 'Next &rsaquo;';

        // current  link
        $config['cur_tag_open']  = '<li class="active"><a href="javascript:void(0)">';
        $config['cur_tag_close'] = '</a></li>';

        // number link
        $config['num_tag_open']  = '<li>';
        $config['num_tag_close'] = '</li>';

        $CI->pagination->initialize($config);
    }

}

// return human readable date time
if (!function_exists('longDateHuman')) {

    function longDateHuman($dateTime, $format = 'datetime') {
        $intTime = (!ctype_digit($dateTime)) ? strtotime($dateTime) : $dateTime;
        if ($intTime) {
            switch ($format) {
                case 'datetime':
                    return date('jS M, Y \a\t h:i:s a', $intTime);
                case 'date_time':
                    return date('j M y, h:i A', $intTime);
                case 'date':
                    return date('jS F, Y', $intTime);
                case 'time':
                    return date('h:i', $intTime);
                case 'short':
                    return date('jS M, y', $intTime);
                case 'MY':
                    return date('F Y', $intTime);
                case 'Y':
                    return date('Y', $intTime);
                case 'M':
                    return date('F', $intTime);
                case 'full':
                    return date('j M Y, h:i A', $intTime);
                case 'md':
                    return date('j M, h:i A', $intTime);

                default:
                    break;
            }
        } else
            return "Not yet";
    }

}


if (!function_exists('breakLongText')) {

    function breakLongText($string, $wrapAt = 35) {

        if (!empty($string)) {
            return wordwrap(trim($string), $wrapAt);
        }
    }

}

if (!function_exists('getYouTubeIdFromURL')) {

    function getYouTubeIdFromURL($url) {

        $url_string = parse_url($url, PHP_URL_QUERY);
        parse_str($url_string, $args);
        return isset($args['v']) ? $args['v'] : false;
    }

}

if (!function_exists('getYouTubeThumbFromURL')) {

    function getYouTubeThumbFromURL($videoURL) {

        if (!empty($videoURL)) {

            $url  = $videoURL;
            $urls = parse_url($url);

            //expect the URL to be http://youtu.be/abcd, where abcd is the video ID
            if ($urls['host'] == 'youtu.be') :
                $imgPath = ltrim($urls['path'], '/');
            //expect the URL to be http://www.youtube.com/embed/abcd
            elseif (strpos($urls['path'], 'embed') == 1) :
                $imgPath = end(explode('/', $urls['path']));
            //expect the URL to be abcd only
            elseif (strpos($url, '/') === false):

                $imgPath = $url;

            //expect the URL to be http://www.youtube.com/watch?v=moon21
            else :
                parse_str($urls['query']);
                $imgPath = $v;
            endif;

            if ($imgPath) {
                // Generate youtube thumbnail url
                $thumbURL = 'http://img.youtube.com/vi/' . $imgPath . '/mqdefault.jpg';
                return $thumbURL;
            }
        }

        return FALSE;
    }

}

if (!function_exists('sendContactMail')) {

    function sendContactMail($toEmail, $subject, $htmlContent, $senderEmail, $senderName) {

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: ' . $senderName . '<' . $senderEmail . '>' . "\r\n";

        // Send email
        if (mail($toEmail, $subject, $htmlContent, $headers)):
            return TRUE;
        else:
            return FALSE;
        endif;
    }

}

//PHP Mail Send
if (!function_exists('sendMailWithAttachment')) {

    function sendMailWithAttachment($toAddress, $subject = '', $messages = '', $attachment, $replyToMail, $replyToUser) {

        //header for sender info
        $headers = "From: $replyToUser" . " <" . $replyToMail . ">";

        //boundary 
        $semiRand     = md5(time());
        $mimeBoundary = "==Multipart_Boundary_x{$semiRand}x";

        //headers for attachment 
        $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mimeBoundary}\"";

        //multipart boundary 
        $message = "--{$mimeBoundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
                "Content-Transfer-Encoding: 7bit\n\n" . $messages . "\n\n";

        //preparing attachment
        if (!empty($attachment) > 0) {
            if (is_file($attachment)) {
                $message .= "--{$mimeBoundary}\n";
                $fp      = @fopen($attachment, "rb");
                $data    = @fread($fp, filesize($attachment));

                @fclose($fp);
                $data    = chunk_split(base64_encode($data));
                $message .= "Content-Type: application/octet-stream; name=\"" . basename($attachment) . "\"\n" .
                        "Content-Description: " . basename($attachment) . "\n" .
                        "Content-Disposition: attachment;\n" . " filename=\"" . basename($attachment) . "\"; size=" . filesize($attachment) . ";\n" .
                        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
            }
        }

        $message .= "--{$mimeBoundary}--";

        // Send E-Mail
        if (mail($toAddress, $subject, $message, $headers)):
            return TRUE;
        else:
            return FALSE;
        endif;
    }

}


if (!function_exists('gotFormError')) {

    function gotFormError($fieldName, $className = 'got_error') {

        $errorClass = '';
        if (form_error($fieldName) != '') {
            $errorClass = $className;
        }
        return $errorClass;
    }

}

// function show the sub string text
if (!function_exists('showText')) {

    function showText($str = '', $length = 0) {
        $string = strip_tags($str);
        if (strlen($string) > ($length + 3)) {
            $substr     = substr($string, 0, $length);
            $new_length = strrpos($substr, " ", -1);
            return substr($substr, 0, $new_length) . '...';
        } else {
            return $string;
        }
    }

}

if (!function_exists('getBanners')) {

    function getBanners() {
        $CI         = &get_instance();
        $getBanners = $CI->global_model->getBannersData();
        if (!empty($getBanners)):
            return $getBanners;
        endif;

        return FALSE;
    }

}

if (!function_exists('checkIsUserApproved')) {

    function checkIsUserApproved($email) {

        $CI = &get_instance();
        $CI->load->model('admin/requests_model');

        $status = $CI->requests_model->checkIsUserApproved($email);
        if ($status) {
            return TRUE;
        }

        return FALSE;
    }

}

if (!function_exists('getMapLocations')) {

    function getMapLocations($getLocations) {
        if (!empty($getLocations) && count($getLocations) > 0):
            foreach ($getLocations as $key => $location):

                $formatAddresses = FormatMapContent($location->contact_address);

                $officeType = !empty($location->office_type) ? $location->office_type . " Office" : "Corporate Office";
                $officeName = !empty($location->contact_title) ? $location->contact_title : $officeType;
                $getAddress = '<strong>' . $officeName . '</strong>' . "<br>" . '<em>' . $formatAddresses . '</em>';
                $getLat     = !empty($location->lat) ? $location->lat : "23.741357";
                $getLon     = !empty($location->lon) ? $location->lon : "90.395047";
                ?>
                ["<?php echo!empty($getAddress) ? $getAddress : ""; ?>", <?php echo $getLat; ?>, <?php echo $getLon; ?>],
                <?php
            endforeach;
        endif;
    }

}

if (!function_exists('FormatMapContent')) {

    function FormatMapContent($str) {
        return str_replace(array('.', "\n", "\t", "\r"), '\n', $str);
    }

}

if (!function_exists('GetMoneyInWord')) {

    function GetMoneyInWord($amount) {

        $amount       = getPlainMoney($amount);
        $numberFormat = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        $inWord       = $numberFormat->format($amount);
        return ucwords($inWord);
    }

}

if (!function_exists('getPlainMoney')) {

    function getPlainMoney($money) {

        if (!empty($money)) {

            $var = intval(preg_replace('/[^\d.]/', '', $money));
            return $var;
        }

        return "0";
    }

}

if (!function_exists('getDistrict')) {

    function getDistrict() {
        $CI = &get_instance();

        $CI->db->select('*')->from('districts');
        $query    = $CI->db->get();
        $response = array('' => '-Choose City-');
        if ($query->num_rows() != 0) {
            foreach ($query->result() as $row) {
                $response[$row->district_name] = $row->district_name;
            }
            return $response;
        }

        return FALSE;
    }

}

if (!function_exists('getGalleryCoverPhoto')) {

    function getGalleryCoverPhoto($type, $imgSize = 'small', $typeId) {

        // get the CI instanse
        $CI = &get_instance();

        $item = $CI->global_model->getMediaDataRandomlyByType($type, $typeId);
        if (!empty($item)) {
            $galleryImagePath = 'assets/media/gallery/';
            $imageName        = base_url($galleryImagePath . $imgSize . '/' . $item->images);
            return $imageName;
        }
        return '';
    }

}

if (!function_exists('getCategoryDropDown')) {

    function getCategoryDropDown() {
        $CI         = &get_instance();
        $categories = $CI->global_model->get('member_category', array('status' => 'active'));
        $response   = array('' => '~~ Choose Category ~~');
        if (!empty($categories)) {
            foreach ($categories as $row) {
                $response[$row->id] = $row->name;
            }
            return $response;
        }

        return FALSE;
    }

}

if (!function_exists('getCommitteeCategoryDropDown')) {

    function getCommitteeCategoryDropDown() {
        $CI         = &get_instance();
        $categories = $CI->global_model->get('committee_category', array('status' => 'active'));
        $response   = array('' => '~~ Choose Category ~~');
        if (!empty($categories)) {
            foreach ($categories as $row) {
                $response[$row->id] = $row->name;
            }
            return $response;
        }

        return FALSE;
    }

}

if (!function_exists('getTypeDropDown')) {

    function getTypeDropDown() {
        $CI         = &get_instance();
        $categories = $CI->global_model->get('project_types', array('type_status' => 1));
        $response   = array('' => '~~ Choose Type ~~');
        if (!empty($categories)) {
            foreach ($categories as $row) {
                $response[$row->project_type_id] = $row->type_name;
            }
            return $response;
        }

        return FALSE;
    }

}

if (!function_exists('getLocationDropDown')) {

    function getLocationDropDown() {
        $CI         = &get_instance();
        $categories = $CI->global_model->get('project_locations', array('location_status' => 1), FALSE, array('filed' => 'location_name', 'order' => 'ASC'));
        $response   = array('' => '-- Choose Location --');
        if (!empty($categories)) {
            foreach ($categories as $row) {
                $response[$row->location_id] = $row->location_name;
            }
            return $response;
        }

        return FALSE;
    }

}

if (!function_exists('getProjectName')) {

    function getProjectName() {
        $CI         = &get_instance();
        $categories = $CI->global_model->get('projects', array('project_status' => 1));
        $response   = array('' => '~~ Choose Project ~~');
        if (!empty($categories) && count($categories) != 0) {
            foreach ($categories as $row) {
                $response[$row->project_id] = $row->project_title;
            }
            return $response;
        }

        return FALSE;
    }

}

if (!function_exists('getLocationNameById')) {

    function getLocationNameById($id) {
        $CI         = &get_instance();
        $categories = $CI->global_model->get('project_locations', array('location_id' => $id));

//        $response = array('' => '-- Choose Project --');
        if (!empty($categories) && count($categories) != 0) {
            return $categories[0]->location_name;
        }
        return 'n/a';
    }

}


if (!function_exists('getTypeNameById')) {

    function getTypeNameById($id) {
        $CI         = &get_instance();
        $categories = $CI->global_model->get('project_types', array('project_type_id' => $id));

//        $response = array('' => '-- Choose Project --');
        if (!empty($categories) && count($categories) != 0) {
            return $categories[0]->type_name;
        }
        return 'n/a';
    }

}

if (!function_exists('getProjectSlider')) {

    function getProjectSlider() {
        $CI     = &get_instance();
        $slider = $CI->global_model->getProjectSlider();
        return $slider;
    }

}

if (!function_exists('getMediaRandomly')) {

    function getMediaRandomly($type = 'projects', $imgSize = 'small', $typeId) {

        // get the CI instance
        $CI   = &get_instance();
        $item = $CI->global_model->getMediaDataRandomlyByType($type, $typeId);
        if (!empty($item)) {
            $imagePath = 'assets/media/' . $type . '/';
            $imageName = base_url($imagePath . $imgSize . '/' . $item->images);
            return $imageName;
        }

        return '';
    }

}

if (!function_exists('getNiceUrl')) {

    function getNiceUrl($siteUrl, $urlId, $urlTitle) {

        if (!empty($siteUrl) && !empty($urlId) && !empty($urlTitle)) {
            return site_url($siteUrl . $urlId . '/' . url_title($urlTitle, '-', TRUE));
        }
        return '';
    }

}

if (!function_exists('truncate_words')) {

    function truncate_words($text, $limit, $ellipsis = '...') {

        $words = preg_split("/[\n\r\t ]+/", $text, $limit + 1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_OFFSET_CAPTURE);
        if (count($words) > $limit) {
            end($words); //ignore last element since it contains the rest of the string
            $last_word = prev($words);

            $text = substr($text, 0, $last_word[1] + strlen($last_word[0])) . $ellipsis;
        }
        return $text;
    }

}

if (!function_exists('getProjectImages')) {

    function getProjectImages($projectId, $type = 'projects', $size = 'thumbs') {

        $coverImage = getCoverPhoto($projectId, $size);
        $getMedia   = getMediaRandomly($type, $size, $projectId);

        $images = !empty($coverImage) ? $coverImage : !empty($getMedia) ? $getMedia : "";
        return $images;
    }

}

if (!function_exists('downloadFile')) {

    function downloadFile($filename = NULL, $type = 'pdf') {

        $CI   = &get_instance();
        // load download helder
        $CI->load->helper('download');
        // read file contents
        $path = $CI->config->base_url('assets/media/projects/' . $type . '/' . $filename);
        $data = file_get_contents($path);
        force_download($filename, $data);
    }

}

if (!function_exists('downloadPDFFile')) {

    function downloadPDFFile($filename = '', $type = 'pdf') {

        $CI   = &get_instance();
        $path = $CI->config->base_url('assets/media/projects/' . $type . '/' . $filename);

        return $path;
    }

}

if (!function_exists('getPhotoNameOnly')) {

    function getPhotoNameOnly($projectId, $imgSize = 'original') {

        // get the CI instance
        $CI         = &get_instance();
        // get image
        $mediaImage = $CI->global_model->get_data('media', array('type_id' => $projectId, 'type' => 'projects', 'is_home' => 1));
        if (!empty($mediaImage['images'])) {
            return $mediaImage['images'];
        }
    }

}

if (!function_exists('getProjectMenus')) {

    function getProjectMenus() {

        // get the CI instance
        $CI = &get_instance();

        $categories = $CI->global_model->getAllData('project_category');
        if (!empty($categories) && count($categories) > 0) {
            foreach ($categories as $category) {
                ?>    
                <li class=""> 
                    <a href="<?php echo site_url('projects/' . $category->project_category_id . '/' . url_title($category->category_name, 'dash', true)); ?>"> <?php echo $category->category_name; ?></a> 
                </li>
                <?php
            }
        }
    }

}

if (!function_exists('getAllProjectInSearch')) {

    function getAllProjectInSearch() {

        // get the CI instance
        $CI       = &get_instance();
        $CI->load->model('global_model');
        $projects = $CI->global_model->getProjectsBySearch();
        if (!empty($projects) && count($projects) > 0) {
            return $projects;
        }

        return FALSE;
    }

}

if (!function_exists('countAlbumPhoto')) {

    function countAlbumPhoto($albumId) {

        $CI    = &get_instance();
        $CI->load->model('gallery_model');
        $count = $CI->gallery_model->countAlbumPhoto($albumId);
        return $count;
    }

}
if (!function_exists('getMemberCategory')) {

    function getMemberCategory() {

        $CI = &get_instance();
        $CI->load->model('global_model');
        $result = $CI->global_model->getMemberCategory();
        return $result;
    }

}

if (!function_exists('getCommitteeCategory')) {

    function getCommitteeCategory() {

        $CI = &get_instance();
        $CI->load->model('global_model');
        $result = $CI->global_model->getCommitteeCategory();
        return $result;
    }

}

if (!function_exists('getCategoryName')) {

    function getCategoryName($id) {

        // get the CI instance
        $CI = &get_instance();

        $categories = $CI->global_model->get_result('member_category',"id= $id");
       
        if (!empty($categories) && count($categories) > 0) {
            foreach ($categories as $category) {
               echo $category->name;
               
            }
        }
    }

}
if (!function_exists('getImportantLinks')) {

    function getImportantLinks() {

        $CI = &get_instance();
        $CI->load->model('global_model');
        $result = $CI->global_model->getLinks();
        return $result;
    }

}
if (!function_exists('getNews')) {

    function getNews($limit = '') {

        $CI = &get_instance();
        $CI->load->model('global_model');
        $result = $CI->global_model->getNews($limit);
        return $result;
    }

}

if (!function_exists('getJobTileById')) {

    function getJobTileById($id) {
        $CI = &get_instance();
        $job = $CI->global_model->get('jobs', array('id' => $id));
        if (!empty($job) && (count($job))) {
            return $job[0]->title;
        }
        return '';
    }

}
// get media url
if (!function_exists('getCvUrl')) {

    function getCvUrl($imageName) {
// get the CI instanse
        $CI = &get_instance();
// getLink
        return base_url('assets/media/career/' . $imageName);
    }

}
/* End of file global_helper.php */
/* Location: ./application/helpers/global_helper.php */