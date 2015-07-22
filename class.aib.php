<?php
require_once 'autoload.php';

require_once 'paths.php';

require_once 'Zend/Captcha/Image.php';

require_once 'Zend/Session.php';

require_once 'Zend/View.php';

require_once 'Zend/Pdf.php';

require_once 'Array_Helpers.php';

require_once '/home/edgebps2/public_html/marketing/form/inc/template_upload_limit.php';

require_once ('tcpdf/tcpdf.php');

require_once ('fpdi/fpdi.php');

require_once ('htmlpurifier.php');

date_default_timezone_set('America/Chicago');
set_time_limit(0);
class aib extends TCPDF

{
  public $allowed_exts;

  /* Assigned in constructor */
  public $aib_dir;

  public $aib_url;

  public $pdf_templates_dir;

  public $htm_templates_dir;

  public $pdf_dir;

  public $htm_dir;

  public $zip_dir;

  public $pdf_url;

  public $htm_url;

  public $zip_url;

  public $pdf_user_dir;

  public $htm_user_dir;

  public $zip_user_dir;

  public $pdf_user_url;

  public $htm_user_url;

  public $zip_user_url;

  public $array_helpers;

  public $password;

  /* Assigned on form submit */
  public $htm_logo_name = NULL;

  public $paragraph = NULL;

  public $timestamp_name = NULL;

  public $tid = NULL;

  // tid in save() foreach()
  public $pdf_user_templatename_dir = NULL;

  public $htm_user_templatename_dir = NULL;

  public $zip_user_templatename_dir = NULL;

  public $pdf_user_filepath = NULL;

  public $htm_user_filepath = NULL;

  public $zip_user_filepath = NULL;

  public $htm_user_url_templatename_timestampname = NULL;

  public $template_htm_texts_arr = NULL;

  public $zf_pdf_user_filepath = NULL;

  public $zf_pdf_user_url = NULL;

  public $tcpdf_pdf_user_filepath = NULL;

  public $tcpdf_pdf_user_url = NULL;

  public $generated_ids = NULL;

  public $max_filesize_bytes = NULL;

  public $max_filesize_megabytes = NULL;

  public $memory_limit_megabytes = NULL;

  public $template_placeholder_text = NULL;

  public $purifier = NULL;

  function __construct()
  {
    $this->purifier = SingletonHtmlPurifier::get_instance();
    $this->allowed_exts = array(
      'image/jpeg' => 'jpg',
      'image/pjpeg' => 'jpg',
      'image/x-citrix-jpeg' => 'jpg',
      'image/x-citrix-pjpeg' => 'jpg',
      'image/png' => 'png',
      'image/x-png' => 'png',
      'image/x-citrix-png' => 'png',
    );
    $this->aib_dir = $_SERVER['DOCUMENT_ROOT'] . "/marketing";
    $this->aib_url = "https://" . $_SERVER['HTTP_HOST'] . "/marketing";
    $this->pdf_templates_dir = $this->aib_dir . "/templates/pdf";
    // $this->pdf_templates_dir = $this->aib_dir . "/templates/pdf/origs";
    $this->htm_templates_dir = $this->aib_dir . "/templates/htm";
    $this->pdf_dir = $this->aib_dir . "/pdf";
    $this->htm_dir = $this->aib_dir . "/htm";
    $this->zip_dir = $this->aib_dir . "/zip";
    $this->pdf_url = $this->aib_url . "/pdf";
    $this->htm_url = $this->aib_url . "/htm";
    $this->zip_url = $this->aib_url . "/zip";
    $this->pdf_user_dir = $this->aib_dir . "/pdf/" . trim($_SESSION[id]);
    $this->htm_user_dir = $this->aib_dir . "/htm/" . trim($_SESSION[id]);
    $this->zip_user_dir = $this->aib_dir . "/zip/" . trim($_SESSION[id]);
    $this->array_helpers = new Array_Helpers();
    $this->password = $_SESSION["password"];
    $this->max_filesize_bytes = 2097152;
    // limited to 2M on doteasy
    $this->max_filesize_megabytes = $this->bytes2megabytes($this->max_filesize_bytes);
    $this->memory_limit_megabytes = 128;
    $this->template_placeholder_text = "Lorem ipsum dolor sit amet, vestibulum nam, sapien ac odio nulla. Imperdiet massa, adipiscing et ut nonummy, vitae morbi magna ultrices sit nunc, vel purus pharetra mus id, aliquam fermentum felis condimentum ut. Pellentesque felis nisl consequat malesuada arcu odio, lectus sed, bibendum venenatis consequat quis nisl turpis a. Donec hendrerit vulputate ipsum varius eu, at non nostrum erat, nec elit, fames mattis molestie phasellus leo. Ac etiam ultricies ante ipsum lectus. Elit aenean duis ac leo, sit ligula nibh, aliquam luctus. Imperdiet vel varius. Pede risus vehicula, in luctus eros aliquet morbi egestas, parturient placerat hymenaeos mi nec. Amet at, erat vel feugiat non vehicula quis pellentesque, tristique felis auctor erat. Pretium class ac lacus tellus, ac nec venenatis sed gravida integer, interdum proin id, justo ut phasellus pariatur aenean integer condimentum, eros proin pharetra at nunc risus. Odio parturient lorem nonummy a ullamcorper, proin erat esse vestibulum mauris libero penatibus, facilisis fusce nullam orci, vel enim a eu nec dictum egestas. Amet posuere at, ipsum in ut natoque porttitor, justo mollis viverra vivamus donec sunt. Suspendisse pulvinar felis suspendisse, ante dui ad duis, ultricies tristique et euismod laoreet sem consequat. Volutpat facilisi dolor vestibulum a justo wisi. Sodales quisque, mauris bibendum rutrum pede gravida nisl, nunc ligula vivamus natoque curabitur, nulla eleifend lorem nibh litora justo, porta sagittis. Pulvinar consequat augue blandit assumenda, posuere dui sit felis. Primis vitae hendrerit aenean. Amet in id sit eget. A metus condimentum ornare morbi primis magna, cursus omnis, maecenas scelerisque justo, velit vestibulum integer sem, praesent sapien turpis. Ipsum erat litora pellentesque turpis arcu, pede in quisque sed fermentum porta ut, nunc in suspendisse suspendisse, per suscipit faucibus vel elementum, non venenatis molestie. Leo vehicula porttitor in cursus.";
  }
  public static function topnav()

  {
    return '
<p style="color:#000000;">
<b><a href="/marketing/list/">My iBlasts</a> | <a href="/marketing/form/">Create iBlasts</a> | <a id="help" style="cursor:pointer"><u>Help</u></a> | <a href="/logout/">Logout</a></b>
</p>
';
  }
  public function get_allowed_exts_return_msg()

  {
    // return mesage for user
    $image_extensions_allowed = array_unique($this->allowed_exts);
    $i = 0;
    $str = "";
    foreach($image_extensions_allowed AS $v) {
      if ($i == sizeof($image_extensions_allowed) - 1) {
        $str.= " or ";
      }
      else if ($i > 0) {
        $str.= ", ";
      }
      $str.= $v;
      $i++;
    }
    return $str;
  }
  public function bytes2megabytes($bytes)

  {
    return $bytes / 1048576;
  }
  public function save($password)

  {
    global $_values, $db, $logo_dir;
    $_FILES['logo'] = $_SESSION['logo'];
    $this->generated_ids = array();
    $error_messages = "";
    $logo_dir = $this->aib_dir . "/logos";
    $logo_name_arr = explode('.', sanitize($_FILES['logo']['name']));
    $logo_name = $logo_name_arr[0];
    foreach($_POST['pdf_template_ids'] AS $v) {
      $this->tid = $v;
      $imgData = NULL;
      $imgSize = NULL;
      // rename file type to logo.xyz according to upload file type
      $this->htm_logo_name = "logo." . $this->allowed_exts[$_FILES["logo"]["type"]];
      $logo_data = file_get_contents($_SESSION['tmp_file_upload_path']);
      $logo_size = getimagesize($_SESSION['tmp_file_upload_path']);
      $logo_max_dimensions = $this->get_logo_max_dimensions();
      $max_form_chars = $this->get_vendor_paragraph_form_max_chars();
      $paragraph = preg_replace("/\r\n/i", "\n", $this->purifier->purify($_POST["paragraph"]));
      if (strlen(trim($paragraph)) > $max_form_chars) {
        $this->paragraph = trim(substr($paragraph, 0, $max_form_chars));
      }
      else {
        $this->paragraph = trim($paragraph);
      }
      $insert = "INSERT INTO marketing_responses (
      `password`,
      `paragraph`,
      `logo_data`,
      `logo_name`,
      `logo_filename`
      ) VALUES (
      '" . sanitize($this->password) . "',
      '" . trim(addslashes($this->paragraph)) . "',
      '" . sanitize(addslashes($logo_data)) . "',
      '" . sanitize(addslashes($logo_name)) . "',
      '" . sanitize(addslashes($_FILES['logo']['name'])) . "'
      )";
      $result = $db->sql_query($insert);
      if (!$result) {
        $error_messages.= 'Form could not be saved(1)';
        $error_messages.= "<br />";
      }
      $this->timestamp_name = time();
      $datetime = date('Y-m-d H:i:s', $this->timestamp_name);
      $this->pdf_user_dir = $this->create_directory($this->pdf_user_dir);
      $this->htm_user_dir = $this->create_directory($this->htm_user_dir);
      $this->zip_user_dir = $this->create_directory($this->zip_user_dir);
      $this->pdf_user_templatename_dir = $this->create_directory($this->pdf_user_dir . "/" . $this->tid2templatename());
      $this->zip_user_templatename_dir = $this->create_directory($this->zip_user_dir . "/" . $this->tid2templatename());
      $this->htm_user_templatename_dir = $this->create_directory($this->htm_user_dir . "/" . $this->tid2templatename());
      $this->htm_user_templatename_timestamp_dir = $this->create_directory($this->htm_user_templatename_dir . "/" . $this->timestamp_name);
      $this->pdf_user_filepath = $this->pdf_user_templatename_dir . "/" . $this->timestamp_name . ".pdf";
      $this->htm_user_filepath = $this->htm_user_templatename_dir . "/" . $this->timestamp_name . "/index.html";
      // $this->htmprint_user_filepath = $this->htm_user_templatename_dir."/index-print.html";
      $this->zip_user_filepath = $this->zip_user_templatename_dir . "/" . $this->timestamp_name . ".zip";
      $this->pdf_user_url = $this->pdf_url . "/" . trim($_SESSION['id']) . "/" . $this->tid2templatename() . "/" . $this->timestamp_name . ".pdf";
      $this->htm_user_url = $this->htm_url . "/" . trim($_SESSION['id']) . "/" . $this->tid2templatename() . "/" . $this->timestamp_name;
      // index.html
      // $this->htmprint_user_url = $this->htm_url."/".trim($_SESSION['id']) . "/" . $this->tid2templatename()  . "/" . $this->timestamp_name."/index-print.html";//index.html
      $this->zip_user_url = $this->zip_url . "/" . trim($_SESSION['id']) . "/" . $this->tid2templatename() . "/" . $this->timestamp_name . ".zip";
      $this->htm_user_url_templatename = $this->htm_user_url . "/" . $this->tid2templatename();
      $this->htm_user_url_templatename_timestampname = $this->htm_user_url_templatename . "/" . $this->timestamp_name;
      $this->zf_pdf_user_filepath = $this->pdf_user_filepath = $this->pdf_user_templatename_dir . "/" . $this->timestamp_name . "_zf.pdf";
      $this->zf_pdf_user_url = $this->pdf_url . "/" . trim($_SESSION['id']) . "/" . $this->tid2templatename() . "/" . $this->timestamp_name . "_zf.pdf";
      $this->tcpdf_pdf_user_filepath = $this->pdf_user_filepath = $this->pdf_user_templatename_dir . "/" . $this->timestamp_name . "_tcpdf.pdf";
      $this->tcpdf_pdf_user_url = $this->pdf_url . "/" . trim($_SESSION['id']) . "/" . $this->tid2templatename() . "/" . $this->timestamp_name . "_tcpdf.pdf";
      // remove _tcpdf pre extension for live site
      $this->tcpdf_pdf_user_filepath = $this->pdf_user_filepath = $this->pdf_user_templatename_dir . "/" . $this->timestamp_name . ".pdf";
      $this->tcpdf_pdf_user_url = $this->pdf_url . "/" . trim($_SESSION['id']) . "/" . $this->tid2templatename() . "/" . $this->timestamp_name . ".pdf";
      $this->template_htm_texts_arr = $this->get_template_htm_texts();
      $this->htm_create($logo_data, $logo_max_dimensions);
      file_put_contents($this->htm_user_templatename_timestamp_dir . "/images/" . $_FILES["logo"]["name"], $logo_data);
      $ret_img_resize = $this->image_resize($this->htm_user_templatename_timestamp_dir . "/images/" . $_FILES["logo"]["name"], $this->htm_user_templatename_timestamp_dir . "/images/" . $this->htm_logo_name, $logo_max_dimensions["vendor_logo_max_width_px"], $logo_max_dimensions["vendor_logo_max_height_px"]);
      $this->tcpdf_modify();
      $this->zip_create();
      $sql = "INSERT INTO
      marketing_generated (
      `password`,
      `generated_on`,
      `pdf_path`,
      `htm_path`,
      `zip_path`,
      `pdf_url`,
      `htm_url`,
      `zip_url`,
      `zf_pdf_path`,
      `zf_pdf_url`,
      `tcpdf_pdf_path`,
      `tcpdf_pdf_url`,
      `dompdf_pdf_path`,
      `dompdf_pdf_url`,
      `htmprint_path`,
      `htmprint_url`
      ) VALUES (
      '" . addslashes($this->password) . "',
      '" . $datetime . "',
      '" . addslashes($this->pdf_user_filepath) . "',
      '" . addslashes($this->htm_user_filepath) . "',
      '" . addslashes($this->zip_user_filepath) . "',
      '" . addslashes($this->pdf_user_url) . "',
      '" . addslashes($this->htm_user_url) . "',
      '" . addslashes($this->zip_user_url) . "',
      '" . addslashes($this->zf_pdf_user_filepath) . "',
      '" . addslashes($this->zf_pdf_user_url) . "',
      '" . addslashes($this->tcpdf_pdf_user_filepath) . "',
      '" . addslashes($this->tcpdf_pdf_user_url) . "',
      '" . addslashes($this->dompdf_pdf_user_filepath) . "',
      '" . addslashes($this->dompdf_pdf_user_url) . "',
      '" . addslashes($this->htmprint_user_filepath) . "',
      '" . addslashes($this->htmprint_user_url) . "'
      )";
      $result = $db->sql_query($sql);
      if (!$result) {
        $error_messages.= 'Form could not be saved(3)';
        $error_messages.= "<br />";
      }
      // max_ids for marketing customers table from previous 2 inserts
      $max_response_id = $this->get_max_id("id", "marketing_responses");
      $max_generated_id = $this->get_max_id("id", "marketing_generated");
      // NEW TABLE
      $insert = "INSERT INTO marketing_customers (
      `cid`,
      `tid`,
      `response_id`,
      `generated_id`
      ) VALUES (
      " . sanitize(trim($_SESSION[id])) . ",
      " . addslashes($this->tid) . ",
      " . ($max_response_id) . ",
      " . ($max_generated_id) . ")";
      $this->generated_ids[] = $max_generated_id;
      $result = $db->sql_query($insert);
      if (!$result) {
        $error_messages.= 'Form could not be saved(2)';
        $error_messages.= "<br />";
      }
      $form_id = $this->purifier->purify($_GET['form']);
      if (isset($form_id) && is_numeric($form_id)) {
        $this->deteleInProgress($form_id);
      }
      sleep(1);
      // for slower connections
    }
    // foreach($_POST['pdf_template_ids'] AS $v)
    return $error_messages;
  }
  /**
   Create HTML full and browser print views in user directory for form submit
   */
  public function htm_create($logo_data, $logo_max_dimensions)

  {
    $this->recurse_copy($this->htm_templates_dir . "/" . $this->tid2templatename($this->tid) , $this->htm_user_templatename_timestamp_dir);
    $vendor_htm_fileline = $this->get_template_vendor_htm_fileline();
    $vendor_htm_logo_tag_style = $this->get_template_vendor_htm_logo_tag_style();
    $filename_htm_background = $this->get_template_filename_htm_background();
    // 11/2/2011 update to create from templates_template direwctory for previewing right column template text
    // by using templates/htm/templates_template/index.html file instead of the template index.html file
    // $lines = $this->array_helpers->array_readfile($this->htm_user_templatename_timestamp_dir . "/index.html");
    if (is_file($this->htm_user_templatename_timestamp_dir . "/index.html")) unlink($this->htm_user_templatename_timestamp_dir . "/index.html");
    copy("/home/edgebps2/public_html/marketing/templates/htm/templates_template/index.html", $this->htm_user_templatename_timestamp_dir . "/index.html");
    $lines = $this->array_helpers->array_readfile($this->htm_user_templatename_timestamp_dir . "/index.html");
    // insert lines from lowest to highest
    $logo_tag = '<img id="vendor_logo" style="' . $vendor_htm_logo_tag_style["vendor_htm_logo_tag_style"] . '" src="images/' . $this->htm_logo_name . '" alt="iBlast Vendor Logo" />';
    $lines = $this->array_helpers->array_insert($lines, $logo_tag, $vendor_htm_fileline["vendor_htm_fileline_inserttext"]);
    $vendor_paragraph_tags = $this->get_htm_paragraph_vendor();
    $vendor_open_tag = $vendor_paragraph_tags["vendor_paragraph_htm_open_tag"];
    $vendor_paragraph = (trim($this->paragraph));
    $vendor_close_tag = $vendor_paragraph_tags["vendor_paragraph_htm_close_tag"];
    $vendor_paragraph_htm = $vendor_open_tag . $vendor_paragraph . $vendor_close_tag;
    $paragraph_tag = '  ' . $vendor_paragraph_htm;
    $lines = $this->array_helpers->array_insert($lines, $paragraph_tag, $vendor_htm_fileline["vendor_htm_fileline_inserttext"]);
    // DO NOT DELETE: MOVE TO TEMPLATE CREATE
    for ($i = 0; $i < sizeof($this->template_htm_texts_arr); $i++) {
      /*
      $template_htm_texts =
      $this->template_htm_texts_arr[$i]["template_text_htm_open_tag"].
      $this->template_htm_texts_arr[$i]["template_text"].
      $this->template_htm_texts_arr[$i]["template_text_htm_close_tag"];
      */
      $template_text = substr($this->template_htm_texts_arr[$i]['template_text'], 0, $this->template_htm_texts_arr[$i]['template_text_maxchar']);
      $template_htm_texts = $this->template_htm_texts_arr[$i]["template_text_htm_open_tag"] . $template_text . $this->template_htm_texts_arr[$i]["template_text_htm_close_tag"];
      $lines = $this->array_helpers->array_insert($lines, $template_htm_texts, $vendor_htm_fileline["vendor_htm_fileline_inserttext"]);
    }
    // DO NOTE DELETE: MOVED TO TEMPLATE CREATE, CONTINUE TO USE ON INITIAL ITERATION FOR TIDS 1-10
    // where tids >10 insert background image when creating template using template name
    // 10/31/2011 REMOVED, MANUALLY ADDED TO TEMPLATES IN TEMPLATES DIRECTORY
    // 11/2/2011 READDED FOR PREVIEW, SINCE IT NOW READS FROM TEMPLATES_TEMPLATE DIRECTORY INSTEAD.
    $bacgkround_img_tag = ' <img id="background-img" class="bg" src="images/' . $filename_htm_background[filename_htm_background] . '" alt="iBlast" />';
    $lines = $this->array_helpers->array_insert($lines, $bacgkround_img_tag, $vendor_htm_fileline["vendor_htm_fileline_insertbacgkroundimg"]);
    /*
    if($this->tid<=10) {
    $bacgkround_img_tag = ' <img id="background-img" class="bg" src="images/'.$filename_htm_background[filename_htm_background].'" alt="iBlast" />';
    $lines = $this->array_helpers->array_insert($lines,$bacgkround_img_tag,$vendor_htm_fileline["vendor_htm_fileline_insertbacgkroundimg"]);
    }
    */
    $this->array_helpers->array_writefile($this->htm_user_templatename_timestamp_dir . "/index.html", $lines);
  }
  /**
   Create existing user PDF from HTML
   */
  public function tcpdf_modify()

  {
    // 11/2/2011 update, rebuild template without placeholders
    // $this->pdf_create_template_preview($this->tid2templatename($this->tid),0);
    // $this->save_images_template_add_pdf($this->tid2templatename($this->tid));
    $tcpdf_dimensions = $this->get_tcpdf_dimensions();
    $pdf = & new FPDI();
    // $pdf->setPageUnit("mm"); // this is the default
    $pdf->setPageUnit("pt");
    // $pdf->setPageUnit("in");
    $pdf->setPageOrientation("P", 0, '');
    $pdf->setPDFVersion("1.4");
    $pagecount = $pdf->setSourceFile($this->tid2templatefilename());
    $tplidx = $pdf->importPage(1);
    $pdf->AddPage('P', array(
      $tcpdf_dimensions["tcpdf_width_inches"] * 72,
      $tcpdf_dimensions["tcpdf_height_inches"] * 72
    ));
    $pdf->useTemplate($tplidx, 0, 0, $tcpdf_dimensions["tcpdf_width_inches"] * 72, $tcpdf_dimensions["tcpdf_height_inches"] * 72, false);
    // 11/2 update, for trimming to max char width
    $this->template_htm_texts_arr = array_reverse($this->get_template_htm_texts());
    $html = "";
    $template_htm_texts = "";
    for ($i = 0; $i < sizeof($this->template_htm_texts_arr); $i++) {
      $template_text = substr($this->template_htm_texts_arr[$i]['template_text'], 0, $this->template_htm_texts_arr[$i]['template_text_maxchar']);
      $template_htm_texts = $this->template_htm_texts_arr[$i]["template_text_tcpdf_open_tag"] . $template_text . $this->template_htm_texts_arr[$i]["template_text_tcpdf_close_tag"];
      $html.= $template_htm_texts;
    }
    $vendor_paragraph_form_max_chars = $this->get_vendor_paragraph_form_max_chars();
    $vendor_paragraph_tags = $this->get_tcpdf_paragraph_vendor();
    $this->template_htm_texts_arr = $this->get_template_htm_texts();
    $vendor_open_tag = $vendor_paragraph_tags["vendor_paragraph_tcpdf_open_tag"];
    $vendor_paragraph = (trim($template_text));
    $vendor_paragraph = trim($this->paragraph);
    $vendor_close_tag = $vendor_paragraph_tags["vendor_paragraph_tcpdf_close_tag"];
    $html.= $vendor_open_tag . $vendor_paragraph . $vendor_close_tag;
    list($width, $height, $type, $attr) = getimagesize($this->htm_user_url . '/images/' . $this->htm_logo_name);
    // reduce image to half size for pdf
    $width = $width * .50;
    $height = $height * .50;
    $pdf_template_vendor_arr = $this->get_pdf_template_vendor();
    $pdf->writeHTMLCell($pdf_template_vendor_arr["vendor_paragraph_tcpdf_width"], $pdf_template_vendor_arr["vendor_paragraph_tcpdf_height"], $pdf_template_vendor_arr["vendor_paragraph_tcpdf_left_x"], $pdf_template_vendor_arr["vendor_paragraph_tcpdf_top_y"], $html, 1, 2, 1, true, '', true);
    $pdf->Output($this->tcpdf_pdf_user_filepath, 'F');
    /** ZF for uploaded logo */
    $pdf = Zend_Pdf::load($this->tcpdf_pdf_user_filepath);
    // load then save from template to user path
    $pdf_page = $pdf->pages[0];
    // exit;
    // Vendor image
    $image = Zend_Pdf_Image::imageWithPath($this->htm_user_templatename_timestamp_dir . "/images/" . $this->htm_logo_name);
    // Draw image
    $pdf_page->drawImage($image, $pdf_template_vendor_arr["vendor_logo_pdf_left_x"], $pdf_template_vendor_arr["vendor_logo_pdf_bottom_y"], $pdf_template_vendor_arr["vendor_logo_pdf_left_x"] + $width, $pdf_template_vendor_arr["vendor_logo_pdf_bottom_y"] + $height);
    $pdf->save($this->tcpdf_pdf_user_filepath);
  }
  /**
   Create zip of all existing files in user directory for form submit
   */
  public function zip_create()

  {
    $this->recurse_zip($this->htm_user_templatename_timestamp_dir, $this->zip_user_filepath);
  }
  public function get_max_id($id_name, $tbl_name)

  {
    global $db;
    $q = "SELECT MAX(" . $id_name . ") AS max_id FROM " . $tbl_name;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    if (!isset($rowset[0]["max_id"])) return 1;
    return $rowset[0]["max_id"];
  }
  public function line_wrap_zend_pdf_vendor($pdf_page, $pdf_vendor_arr)

  {
    // i == loop arr index
    $tmp_str = wordwrap($this->paragraph, $pdf_vendor_arr["vendor_paragraph_pdf_wordwrap_charwidth"], '\n');
    $tmp_arr = explode('\n', $tmp_str);
    $tmp_y = $pdf_vendor_arr["vendor_paragraph_tcpdf_top_y"];
    for ($j = 0; $j < sizeof($tmp_arr); $j++) {
      $pdf_page->setFillColor(Zend_Pdf_Color_Html::color($pdf_vendor_arr["vendor_pdf_color_html"]))->drawText($tmp_arr[$j], $pdf_vendor_arr["vendor_paragraph_tcpdf_left_x"], $tmp_y);
      $tmp_y = $tmp_y - $pdf_vendor_arr["vendor_paragraph_pdf_wordwrap_linespace"];
    }
    return $pdf_page;
  }
  public function line_wrap_zend_pdf_template($pdf_page, $pdf_template_arr, $i)

  {
    // i == loop arr index
    $tmp_str = wordwrap($pdf_template_arr[$i]["template_text"], $pdf_template_arr[$i]["template_text_pdf_wordwrap_charwidth"], '\n');
    $tmp_arr = explode('\n', $tmp_str);
    $tmp_y = $pdf_template_arr[$i]["template_text_pdf_bottom_y"];
    for ($j = 0; $j < sizeof($tmp_arr); $j++) {
      $pdf_page->setFillColor(Zend_Pdf_Color_Html::color($pdf_template_arr[$i]["template_text_pdf_color_html"]))->drawText($tmp_arr[$j], $pdf_template_arr[$i]["template_text_pdf_left_x"], $tmp_y);
      $tmp_y = $tmp_y - $pdf_template_arr[$i]["template_text_pdf_wordwrap_linespace"];
    }
    return $pdf_page;
  }
  public function get_pdf_template()

  {
    global $db;
    $q = "
      SELECT
      template_text,
      template_text_pdf_font_name,
      template_text_pdf_font_size,
      template_text_pdf_left_x,
      template_text_pdf_bottom_y,
      template_text_pdf_wordwrap_charwidth,
      template_text_pdf_wordwrap_linespace,
      template_text_pdf_color_html
      FROM marketing_templates_text t
      WHERE t.tid=" . $this->tid;
    $r = $db->sql_query_limit($q, NULL);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset;
  }
  public function get_pdf_template_vendor()

  {
    global $db;
    $q = "
      SELECT
      vendor_logo_pdf_left_x,
      vendor_logo_pdf_bottom_y,
      vendor_paragraph_pdf_font_name,
      vendor_paragraph_pdf_font_size_px,
      vendor_paragraph_tcpdf_left_x,vendor_paragraph_tcpdf_top_y,
      vendor_paragraph_tcpdf_width,vendor_paragraph_tcpdf_height,
      vendor_pdf_color_html,
      vendor_paragraph_pdf_wordwrap_charwidth,
      vendor_paragraph_pdf_wordwrap_linespace
      FROM marketing_templates t
      WHERE t.tid=" . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0];
  }
  public function get_tcpdf_dimensions()

  {
    global $db;
    $q = "
      SELECT
      tcpdf_width_inches,tcpdf_height_inches
      FROM marketing_templates t
      WHERE t.tid=" . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0];
  }
  public function get_htm_paragraph_vendor()

  {
    global $db;
    $q = "
      SELECT
      vendor_paragraph_htm_open_tag,vendor_paragraph_htm_close_tag
      FROM marketing_templates t
      WHERE t.tid=" . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0];
  }
  public function get_tcpdf_paragraph_vendor()

  {
    global $db;
    $q = "
      SELECT
      vendor_paragraph_tcpdf_open_tag,vendor_paragraph_tcpdf_close_tag
      FROM marketing_templates t
      WHERE t.tid=" . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0];
  }
  public function image_resize($src, $dst, $width, $height, $crop = 0)

  {
    // ini_set('memory_limit', $this->memory_limit_megabytes.'M');
    if (!list($w, $h) = getimagesize($src)) return "Unsupported picture type!";
    $type = strtolower(substr(strrchr($src, ".") , 1));
    if ($type == 'jpeg') $type = 'jpg';
    switch ($type) {
    case 'bmp':
      $img = imagecreatefromwbmp($src);
      break;

    case 'gif':
      $img = imagecreatefromgif($src);
      break;

    case 'jpg':
      $img = imagecreatefromjpeg($src);
      break;

    case 'png':
      $img = imagecreatefrompng($src);
      break;

    default:
      return "Unsupported picture type!";
    }
    // resize
    if ($crop) {
      // if($w < $width or $h < $height) return "Picture is too small!";
      if ($w < $width or $h < $height) {
        copy($src, $dst);
        return "Logo is too small.  Logo not resized.";
      }
      $ratio = max($width / $w, $height / $h);
      $h = $height / $ratio;
      $x = ($w - $width / $ratio) / 2;
      $w = $width / $ratio;
    }
    else {
      // if($w < $width and $h < $height) return "Picture is too small!";
      if ($w < $width or $h < $height) {
        copy($src, $dst);
        return "Logo is too small.  Logo not resized.";
      }
      $ratio = min($width / $w, $height / $h);
      $width = $w * $ratio;
      $height = $h * $ratio;
      $x = 0;
    }
    $new = imagecreatetruecolor($width, $height);
    // preserve transparency
    if ($type == "gif" or $type == "png") {
      imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
      imagealphablending($new, false);
      imagesavealpha($new, true);
    }
    imagecopyresampled($new, $img, 0, 0, $x, 0, $width, $height, $w, $h);
    switch ($type) {
    case 'bmp':
      imagewbmp($new, $dst);
      break;

    case 'gif':
      imagegif($new, $dst);
      break;

    case 'jpg':
      imagejpeg($new, $dst);
      break;

    case 'png':
      imagepng($new, $dst);
      break;
    }
    return true;
  }
  public function get_template_vendor_htm_fileline()

  {
    global $db;
    $q = "
      SELECT
      vendor_htm_fileline_inserttext,
      vendor_htm_fileline_insertbacgkroundimg
      FROM marketing_templates
      WHERE tid=" . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0];
  }
  public function get_template_vendor_htm_logo_tag_style()

  {
    global $db;
    $q = "
      SELECT
      vendor_htm_logo_tag_style
      FROM marketing_templates
      WHERE tid=" . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0];
  }
  public function get_template_filename_htm_background()

  {
    global $db;
    $q = "
      SELECT
      filename_htm_background
      FROM marketing_templates
      WHERE tid=" . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0];
  }
  public function get_template_htm_texts()

  {
    global $db;
    $q = "
      SELECT
      template_text,template_text_maxchar,
      template_text_htm_open_tag,template_text_htm_close_tag,
      template_text_tcpdf_open_tag ,template_text_tcpdf_close_tag
      FROM marketing_templates_text
      WHERE tid=" . $this->tid . "
      ORDER BY weight DESC";
    $r = $db->sql_query_limit($q, NULL);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset;
  }
  public function get_vendor_paragraph_form_max_chars()

  {
    global $db;
    $q = "
      SELECT
      vendor_paragraph_form_max_chars
      FROM marketing_templates
      WHERE tid=" . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0]["vendor_paragraph_form_max_chars"];
  }
  public function get_logo_max_dimensions()

  {
    global $db;
    $q = "
      SELECT
      vendor_logo_max_height_px,
      vendor_logo_max_width_px
      FROM marketing_templates
      WHERE tid=" . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0];
  }
  public function generatedid2responseid($generated_id)

  {
    global $db;
    $q = "
      SELECT response_id FROM marketing_customers
      WHERE generated_id=" . $generated_id;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0]['response_id'];
  }
  public function generatedid2dirpaths($generated_id)

  {
    global $db;
    $q = "
      SELECT pdf_path,htm_path,zip_path,
      zf_pdf_path ,tcpdf_pdf_path,dompdf_pdf_path
      FROM marketing_generated
      WHERE id=" . $generated_id;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0];
  }
  public function deleteGenerated($formid)

  {
    global $db;
    $generated_id = $formid;
    // formid is generated_id, id of table _generated
    $response_id = $this->generatedid2responseid($generated_id);
    $dirpaths = $this->generatedid2dirpaths($generated_id);
    if (is_file($dirpaths["zf_pdf_path"])) {
      // from selected, delete from lowest to highest tiers
      unlink($dirpaths["zf_pdf_path"]);
      // delete file
      // delete all empty directories and subdirectories in user account directory
      $this->recurse_delete_empty_directories($this->pdf_user_dir);
      // delete empty dirs in this user account directory
      $this->recurse_delete_empty_directories($this->pdf_dir);
      // delete empty dirs in pdf directory i.e. account dirs
    }
    if (is_file($dirpaths["tcpdf_pdf_path"])) {
      // from selected, delete from lowest to highest tiers
      unlink($dirpaths["tcpdf_pdf_path"]);
      // delete file
      // delete all empty directories and subdirectories in user account directory
      $this->recurse_delete_empty_directories($this->pdf_user_dir);
      // delete empty dirs in this user account directory
      $this->recurse_delete_empty_directories($this->pdf_dir);
      // delete empty dirs in pdf directory i.e. account dirs
    }
    if (is_file($dirpaths["dompdf_pdf_path"])) {
      // from selected, delete from lowest to highest tiers
      unlink($dirpaths["dompdf_pdf_path"]);
      // delete file
      // delete all empty directories and subdirectories in user account directory
      $this->recurse_delete_empty_directories($this->pdf_user_dir);
      // delete empty dirs in this user account directory
      $this->recurse_delete_empty_directories($this->pdf_dir);
      // delete empty dirs in pdf directory i.e. account dirs
    }
    if (is_file($dirpaths["pdf_path"])) {
      // from selected, delete from lowest to highest tiers
      unlink($dirpaths["pdf_path"]);
      // delete file
      // delete all empty directories and subdirectories in user account directory
      $this->recurse_delete_empty_directories($this->pdf_user_dir);
      // delete empty dirs in this user account directory
      $this->recurse_delete_empty_directories($this->pdf_dir);
      // delete empty dirs in pdf directory i.e. account dirs
    }
    if (is_dir(dirname($dirpaths["htm_path"]))) {
      // from selected, delete from lowest to highest tiers
      $this->recurse_delete_directory(dirname($dirpaths["htm_path"]));
      // ts directory
      // delete all empty directories and subdirectories in user account directory
      $this->recurse_delete_empty_directories(dirname($dirpaths["htm_path"]) . "/..");
      // delete empty template name directories
      $this->recurse_delete_empty_directories($this->htm_user_dir);
      // delete empty dirs in this user account directory
      $this->recurse_delete_empty_directories($this->htm_dir);
      // delete empty dirs in pdf directory i.e. account dirs
    }
    if (is_file($dirpaths["zip_path"])) {
      // from selected, delete from lowest to highest tiers
      unlink($dirpaths["zip_path"]);
      // delete file
      // delete all empty directories and subdirectories in user account directory
      $this->recurse_delete_empty_directories($this->zip_user_dir);
      // delete empty dirs in this user account directory
      $this->recurse_delete_empty_directories($this->zip_dir);
      // delete empty dirs in pdf directory i.e. account dirs
    }
    // delete from filesystem htm, pdf, and zips referenced in marketing generated
    $sql = "DELETE FROM marketing_responses WHERE id=" . $response_id;
    $result = $db->sql_query($sql);
    $sql = "DELETE FROM marketing_generated WHERE id=" . $generated_id;
    $result = $db->sql_query($sql);
    $sql = "DELETE FROM marketing_customers WHERE generated_id=" . $generated_id;
    $result = $db->sql_query($sql);
  }
  public function tid2templatefilename()

  {
    global $db;
    $q = "SELECT filename FROM marketing_templates WHERE tid = " . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $this->pdf_templates_dir . "/" . $rowset[0]['filename'];
  }
  public function tid2templatepathfull()

  {
    global $db;
    $q = "SELECT pathfull FROM marketing_templates WHERE tid = " . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $this->pdf_templates_dir . "/" . $rowset[0]['filename'];
  }
  public function tid2templatename()

  {
    global $db;
    $q = "SELECT name FROM marketing_templates WHERE tid = " . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0]['name'];
  }
  public function password2cid()

  {
    global $db;
    $q = "SELECT filename FROM marketing_templates WHERE tid = " . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $this->pdf_templates_dir . "/" . $rowset[0]['filename'];
  }
  public function is_empty_folder($folder)

  {
    $c = 0;
    if (is_dir($folder)) {
      $files = opendir($folder);
      while ($file = readdir($files)) {
        $c++;
      }
      if ($c > 2) {
        return false;
      }
      else {
        return true;
      }
    }
  }
  public function recurse_delete_empty_directories($dir)

  {
    if (is_dir($dir)) {
      $objects = scandir($dir);
      foreach($objects as $object) {
        if ($object != "." && $object != "..") {
          if (filetype($dir . "/" . $object) == "dir" && !$this->is_empty_folder($dir . "/" . $object)) {
            // $this->recurse_delete_empty_directories($dir."/".$object); // recurse for empty subdirs
          }
          else if (filetype($dir . "/" . $object) == "dir" && $this->is_empty_folder($dir . "/" . $object)) {
            rmdir($dir . "/" . $object);
            // remove empty dir
          }
          // ignore files
        }
      }
      reset($objects);
    }
  }
  public function recurse_delete_directory($dir)

  {
    if (is_dir($dir)) {
      $objects = scandir($dir);
      foreach($objects as $object) {
        if ($object != "." && $object != "..") {
          if (filetype($dir . "/" . $object) == "dir") $this->recurse_delete_directory($dir . "/" . $object);
          else unlink($dir . "/" . $object);
        }
      }
      reset($objects);
      rmdir($dir);
    }
  }
  public function create_directory($dir)

  {
    if (!is_dir($dir)) {
      mkdir($dir);
    }
    return $dir;
  }
  public function recurse_copy($src, $dst)

  {
    $dir = opendir($src);
    @mkdir($dst);
    while (false !== ($file = readdir($dir))) {
      if (($file != '.') && ($file != '..')) {
        if (is_dir($src . '/' . $file)) {
          $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
        }
        else {
          copy($src . '/' . $file, $dst . '/' . $file);
        }
      }
    }
    closedir($dir);
  }
  public function recurse_zip($source, $destination)

  {
    if (extension_loaded('zip') === true) {
      if (file_exists($source) === true) {
        $zip = new ZipArchive();
        if ($zip->open($destination, ZIPARCHIVE::CREATE) === true) {
          $source = realpath($source);
          if (is_dir($source) === true) {
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source) , RecursiveIteratorIterator::SELF_FIRST);
            foreach($files as $file) {
              $file = realpath($file);
              if (is_dir($file) === true) {
                // $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                $zip->addEmptyDir($this->tid2templatename() . "/" . str_replace($source . '/', '', $file . '/'));
              }
              else if (is_file($file) === true) {
                // $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                $zip->addFromString($this->tid2templatename() . "/" . str_replace($source . '/', '', $file) , file_get_contents($file));
              }
            }
          }
          else if (is_file($source) === true) {
            // $zip->addFromString(basename($source), file_get_contents($source));
            $zip->addFromString($this->tid2templatename() . "/" . basename($source) , file_get_contents($source));
          }
        }
        // add PDF to zip, $this->tid2templatename()."/".
        // $zip->addFromString(basename($this->tcpdf_pdf_user_filepath), file_get_contents($this->tcpdf_pdf_user_filepath));
        $zip->addFromString($this->tid2templatename() . "/" . $this->tid2templatename() . ".pdf", file_get_contents($this->tcpdf_pdf_user_filepath));
        return $zip->close();
      }
    }
    return false;
  }
  public function generateData($formData, $password, $customerName, &$progbar)

  {
  }
  public function getGeneratedList($password)

  {
    global $db;
    $sql = sprintf("
        SELECT
        g.id,
        g.generated_on,
        g.pdf_url,
        g.htm_url,
        g.htmprint_url,
        g.zip_url,
        g.zf_pdf_url,
        g.tcpdf_pdf_url,
        g.dompdf_pdf_url,
        t.display_name
        FROM
        marketing_generated g
        LEFT JOIN marketing_customers c ON c.generated_id=g.id
        LEFT JOIN marketing_templates t ON t.tid=c.tid
        WHERE g.`password` LIKE '%s'
        ORDER BY g.generated_on desc", $password);
    $result = $db->sql_query($sql);
    if (isset($_GET[sub]) && $_GET[sub] == 1) {
      echo '
        <script type="text/javascript" language="javascript">
        $(document).ready(function() {
          $( "#form-submit-dialog" ).dialog({width:350});
        });
        </script>
        <div id="form-submit-dialog" style="display:none" title="Process complete!">
        <br/><br/>
        <center><p>Your submitted iBlasts can now be downloaded.</p></center>
        </div>
        ';
    }
    if ($result) {
      $i = 0;
      $output = '<ul style="color:#000000;height:450px;overflow-y:scroll">';
      $num_rows = mysql_num_rows($result);
      while ($row = $db->sql_fetchrow($result)) {
        $quarter = ceil(date('m', strtotime($row['generated_on'])) / 3) - 1;
        if ($quarter == 0) {
          $quarter = 4;
        }
        $year = date('Y', strtotime($row['generated_on']));
        if ($quarter == 4) {
          $year = $year - 1;
        }
        if (isset($_GET[gen_ids])) {
          $gen_id_just_submitted = explode(",", $_GET[gen_ids]);
          if (in_array($row['id'], $gen_id_just_submitted)) $highlight_submitted = "background-color:yellow;";
          else $highlight_submitted = "";
        }
        $fileid = $row['id'];
        $generated = date('m/d/Y h:i:s A', strtotime($row['generated_on']));
        $pdf_anchor = "<a target='_blank' href='" . $row['tcpdf_pdf_url'] . "'>PDF</a>";
        $htm_anchor = "<a target='_blank' href='" . $row['htm_url'] . "'>Web</a>";
        $htmprint_anchor = "<a target='_blank' href='" . $row['htmprint_url'] . "'>Web Print</a>";
        $zip_anchor = "<a target='_blank' href='" . $row['zip_url'] . "'>Web Zip</a>";
        $display_name = $row['display_name'];
        $output.= "<li style='padding:5px'>";
        $span_pipe = "<span style='padding-left:5px;padding-right:5px'>|</span>";
        $output.= "<span style='white-space:nowrap;" . $highlight_submitted . "'>";
        $output.= "Generated on $generated ( CST ) " . $span_pipe . " ";
        $output.= $display_name;
        $output.= "</span>";
        $output.= "<br/>";
        $output.= "<span style='white-space:nowrap;" . $highlight_submitted . "'>";
        // $output .= $pdf_anchor." $span_pipe ".$htm_anchor." $span_pipe ".$htmprint_anchor." $span_pipe ".$zip_anchor." $span_pipe ".($num_rows-$i);
        $output.= $pdf_anchor . " $span_pipe " . $htm_anchor . " $span_pipe " . $zip_anchor . " $span_pipe " . ($num_rows - $i);
        $output.= $span_pipe . " <a id='delete-confirm-" . $fileid . "' style='cursor: pointer;'><u>Delete</u></a>";
        $output.= "</span>";
        $output.= "</li>";
        $output.= '
<script type="text/javascript" language="javascript">
$(document).ready(function() {
$( "#delete-confirm-' . $fileid . '-dialog" ).hide();
  $("#delete-confirm-' . $fileid . '").click(function () {
    $( "#delete-confirm-' . $fileid . '-dialog" ).dialog({
      resizable: true,
      height:200,
      width:500,
      bgiframe: true,
      draggable: true,
      position: \'center\',
      modal: true,
      buttons: {
        "Delete ' . $row["display_name"] . '": function() {
          $( this ).dialog( "close" );
          // alert("delete confirmed ' . $fileid . '");
          window.location = "./delete.php?type=pdf&id=' . $fileid . '";
        },
        Cancel: function() {
          $( this ).dialog( "close" );
          // alert("delete cancelled ' . $fileid . '");
        }
      }
    });
  });
});
</script>
<div style="display:none" id="delete-confirm-' . $fileid . '-dialog" class="delete-confirm-' . $fileid . '-dialog"  title="Confirm Delete">
<p>
<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
Please confirm deleting "' . $row["display_name"] . '", generated on ' . $row["generated_on"] . '.
All files and data pertaining to this iBlast will be permanently deleted, and cannot be recovered.
</p>
<br/>
<p>
</p>
</div>
                ';
        // $output .= "<li>".$pdf_anchor." | ".$htm_anchor." | ".$htmprint_anchor." | ".$zip_anchor." | <a href='delete.php?type=pdf&id=$fileid'>Delete</a>  <span style='float:right'>".$display_name." | Generated on $generated</span></li>";
        $i++;
      }
      $output.= '</ul>';
      if ($i == 0) {
        $output = '<div style="padding-left: 20px;color:#000000">No generated iBlasts found.</div>';
      }
    }
    else {
      $output = '<div style="padding-left: 20px;">No generated PDFs found.</div>';
    }
    return $output;
  }
  public function get_prev_upload_count($tid)

  {
    global $db;
    $q = "
  SELECT COUNT( * ) AS cnt
  FROM `marketing_customers` c
  JOIN marketing_templates t ON t.tid = c.tid
  WHERE c.tid = " . $tid . "
  AND c.cid=" . trim($_SESSION['id']);
    $r = $db->sql_query($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return (int)$rowset[0]['cnt'];
  }
  public function get_allowed_exts_list($padded)

  {
    if ($padded != 1) return implode(' , ', array_unique($this->allowed_exts));
    return implode(' , ', array_unique($this->allowed_exts));
  }
  public function get_help_content($template_upload_limit, $get_allowed_exts_return_msg, $max_filesize_megabytes)

  {
    return '
      <h3 class="basic-modal"><b>Anixter Information Blasts</b></h3>
Purpose: Create customized Anixter iBlast product microsites/minisites and PDFs for marketing iBlast products.
<br/><br/>
After logging in, go to
<a href="/marketing/form/index.php">Create iBlasts</a>,
and select product iBlasts you wish to create.
Currently, products are limited to <i><b style="color:#fffff"><span class="template_checkbox_limit"></span>
products per request</b></i>, and <i><b style="color:#fffff">' . $template_upload_limit . ' saved versions per product</b></i>.
<br/><br/>
Add a paragraph describing your company or the product your company offers.  HTML tags are supported.
<br/><br/>
Add a company logo image.
Currently, company logo uploads are limited to
<i><b style="color:#fffff">' . $get_allowed_exts_return_msg . ' image types. </b></i>
within <i><b style="color:#fffff">' . $max_filesize_megabytes . ' MBs</b></i>.
Logo image dimensions are resized after upload.
<br/><br/>
After submitting your iBlast request, go to
<a href="/marketing/list/index.php">My iBlasts</a>
to view or download your iBlasts.
Anixter iBlast product microsites/minisites are styled for web and print views
and are downloaded as a ZIP file.
Previous iBlast downloads can be deleted after download to "unlock" the
<i><b style="color:#fffff">' . $template_upload_limit . ' saved versions per product</b></i> limit.
<br/><br/>
(press ESC or click on the upper right X to close the overlay)
      ';
  }
  public function display_page_form($_iserrors)

  {
    // set the default timezone to use. Available since PHP 5.1
    $aib = new aib();
    global $_values, $_referer, $websiteName, $db, $doc_root;
    $user = new User($_SESSION['password']);
    $user->checkPassword();
    $password = '';
    if (isset($_SESSION)) {
      $password = $_SESSION['password'];
    }
    $self = strip_tags($_SERVER["PHP_SELF"]);
    $paragraph = isset($_values["paragraph"]) ? htmlspecialchars($_values["paragraph"]) : "";
    $paragraph = isset($_values["pdf_template_ids"]) ? htmlspecialchars($_values["pdf_template_ids"]) : "";
    $flashhead1 = getFlashHead(1);
    $flashhead2 = getFlashHead(2);
    if (isset($_GET['form']) && is_numeric($_GET['form'])) {
      $hiddenform = (int)$this->purifier->purify($_GET['form']);
    }
    else {
      $hiddenform = '0';
    }
    $customer = $_SESSION['customer_name'];
    if ($_SESSION[roles][0][rid] == 8) $q_pdf_templates = "SELECT tid,display_name,published FROM `marketing_templates` WHERE 1";
    else $q_pdf_templates = "SELECT tid,display_name,published FROM `marketing_templates` WHERE published=1";
    $r_pdf_templates = $db->sql_query_limit($q_pdf_templates, NULL);
    $rowset = $db->sql_fetchrowset($r_pdf_templates);
    $pdf_templates_str = "";
    $template_upload_limit = TEMPLATE_UPLOAD_LIMIT;
    for ($i = 0; $i < sizeof($rowset); $i++) {
      $checkbox_disable = "";
      $checkbox_italics = "";
      $tid_cnt = $aib->get_prev_upload_count($rowset[$i]['tid']);
      if ($tid_cnt >= $template_upload_limit) {
        $checkbox_disable = "disabled";
        $checkbox_italics = "font-style:italic;";
      }
      if ($_SESSION[roles][0][rid] == 8) {
        if ($rowset[$i]['published'] == 1) {
          $pdf_templates_str.= "<span style='" . $checkbox_italics . "'><nobr><input " . $checkbox_disable . " type='checkbox' name='pdf_template_ids[]' class='pdf_template_ids' value='" . $rowset[$i]['tid'] . "' onchange='reset_para_max_size();' />&nbsp;&nbsp;" . $rowset[$i]['display_name'] . "&nbsp;&nbsp;(" . $tid_cnt . ") [ pub ]</span></nobr><br/>";
        }
        else {
          $pdf_templates_str.= "<span style='" . $checkbox_italics . "'><nobr><input " . $checkbox_disable . " type='checkbox' name='pdf_template_ids[]' class='pdf_template_ids' value='" . $rowset[$i]['tid'] . "' onchange='reset_para_max_size();' />&nbsp;&nbsp;" . $rowset[$i]['display_name'] . "&nbsp;&nbsp;(" . $tid_cnt . ") [ unpub ]</span></nobr><br/>";
        }
      }
      else {
        $pdf_templates_str.= "<span style='" . $checkbox_italics . "'><nobr><input " . $checkbox_disable . " type='checkbox' name='pdf_template_ids[]' class='pdf_template_ids' value='" . $rowset[$i]['tid'] . "' onchange='reset_para_max_size();' />&nbsp;&nbsp;" . $rowset[$i]['display_name'] . "&nbsp;&nbsp;(" . $tid_cnt . ")</span></nobr><br/>";
      }
    }
    $marketing_content_flash_inc = aib::get_include_contents($_SERVER[DOCUMENT_ROOT] . "/marketing/marketing_content-flash.inc");
    $view = new Zend_View();
    $captcha = new Zend_Captcha_Image(array(
      'wordLen' => 5,
      'font' => $doc_root . 'inc/fonts/Tuffy/Tuffy_Bold.ttf',
      'imgDir' => 'inc/images/',
      'imgUrl' => 'inc/images/',
      'width' => 150,
      'height' => 55,
      'dotNoiseLevel' => 40,
      'lineNoiseLevel' => 3
    ));
    $id = $captcha->generate();
    $this_captcha = $captcha->render($view);
    $allowed_exts = $aib->get_allowed_exts_list(1);
    $max_filesize_bytes = $aib->max_filesize_bytes;
    // megabytes
    $max_filesize_megabytes = $aib->max_filesize_megabytes;
    $get_allowed_exts_return_msg = $aib->get_allowed_exts_return_msg();
    $help_content = $aib->get_help_content($template_upload_limit, $get_allowed_exts_return_msg, $max_filesize_megabytes);
    $topnav = aib::topnav();
    $result = <<< END
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>$websiteName</title>
<script type="text/javascript" src="../../js/AC_RunActiveContent.js"></script>
<script type="text/javascript" language="javascript" src="inc/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="inc/js/jquery.form.js"></script>
<script type="text/javascript" language="javascript" src="inc/js/jquery.form-defaults.js"></script>
<script type="text/javascript" language="javascript" src="inc/js/jquery.validate.js"></script>
<script type="text/javascript" language="javascript" src="inc/js/limitMaxlength.js"></script>
<script type="text/javascript" language="javascript" src="inc/js/ajaxfileupload.js"></script>
<script type="text/javascript" language="javascript" src="/js/simplemodal/jquery.simplemodal.js"></script>
<script type="text/javascript" language="javascript" src="/marketing/form/inc/js/template_checkbox_limit.js"></script>
<script type="text/javascript" language="javascript" src="inc/js/marketing.form.js"></script>
<script type="text/javascript" language="javascript" src="inc/js/jquery.jqEasyCharCounter.js"></script>
<link rel="stylesheet" type="text/css" href="/js/jquery-ui/themes/base/jquery.ui.all.css" />
<link rel="stylesheet" type="text/css" href="/js/jquery-ui/demos/demos.css" />
<link rel="stylesheet" type="text/css" href="/marketing/form/css/form.css" />
<link rel="stylesheet" type="text/css" href="/js/simplemodal/basic/css/basic.css" />
<!-- IE6 "fix" for the close png image -->
<!--[if lt IE 7]>
<link rel="stylesheet" type="text/css" href="/js/simplemodal/basic/css/basic_ie.css" />
<![endif]-->
<link type='text/css' rel="stylesheet" href='/js/simplemodal/basic/css/demo.css' rel='stylesheet' media='screen' />
  </head>
  <body>
  <div id="wrapper">
    <!-- modal content -->
    <div id="help-content"  style="display:none">
    <div id="help-content-container">
$help_content
    </div>
    </div>
    <!-- preload the images -->
    <div style="display:none" >
      <img src="https://www.edgebps.com/js/simplemodal/basic/img/basic/x.png"  />
    </div>
  <div  id="content">
$marketing_content_flash_inc
<div style="position:absolute;left:100px;left:300px;top:85px;height:540px;" id="aib_form">
$topnav
    <form id="form1" name="form1" method="post" action="process/index.php" enctype="multipart/form-data">
      <input style="display: none;" type="submit"></input>
      <!--$is_errors-->
      <input type="hidden" name="_referer" value="$_referer"></input>
      <input type="hidden" name="_next_page" value="1"></input>
      <table>
        <tr>
          <td style="width:500px;color:#000000;">
            <b>Create Anixter iBlasts for $customer</b>
          </td>
        </tr>
      </table>
      <table>
        <tr>
          <td><span style="color:#000000;"><b>Paragraph:</b></span><span style="float:right;color:#000000;padding:0 10px 0 0" class="charcount_limit_top"></span></td>
          <td><span style="color:#000000;" align="left"><b>Products:</b></span><span style="float:right;color:#000000;padding:0 10px 0 0" class="template_upload_limit">Product Limit: $template_upload_limit</span></td>
        </tr>
        <tr>
          <td>
            <textarea maxlength="5000" name="paragraph" style="color:#000000;width:350px;height:350px;overflow-y: scroll;" id="paragraph" class="required">$paragraph</textarea>
              <span class="charsRemaining"></span>
          </td>
          <td valign="top" style="color:#000000;width:285px;height:325px;">
          <div style="color:#000000; color:#000000;width:285px;height:225px;overflow-x: scroll;overflow-y: scroll;">
          $pdf_templates_str
          </div>
          <div style="color:#000000;float:right;width:75%;text-align:right;padding:0 10px 0 0">
          Products Limit: <span id="template_checkbox_limit_count"></span>/<span class="template_checkbox_limit"></span>
          </div>
<div style="float:right;width:75%">
<br/><br/>
$this_captcha</center> <br/><br/>
<input type='hidden' name='captcha[id]'  id='captcha-id' value='$id' >
<input type='text' name='captcha[input]' id='captcha-input' value='' onkeypress='return noenter();' tabindex='21'><br/><br/>
</div>
          </td>
        </tr>
        <tr>
          <td><span style="color:#000000;margin-top:0px"><b>Logo:</b></span></td>
          <td rowspan="15" align="left" valign="top" style="">
          </td>
        </tr>
        <tr>
          <td colspan="2"  style="">
            <div style="color:#000000;">$logo_upload_label</div><nobr style="color:#000000">
            <input type="hidden" name="MAX_FILE_SIZE" value="$max_filesize_bytes" />
            <input id="logo" type="file" name="logo" class="required logo_elements"><span class="logo_elements"> $max_filesize_megabytes MB Max ( $allowed_exts )</span>
            <img id="loading" class="logo_processing" src="loading.gif" style="float:left;" >
            </nobr>
          </td>
          <td>
          </td>
        </tr>
        <tr>
          <td align="left">
            <input type="hidden" name="form" id="form" value="$hiddenform" />
            <input type="hidden" name="accountPassword" id="accountPasswrd" value="$password" />
            <input class="btn logo_elements" type="button" name="iblast_submit" id="iblast_submit"  value="Submit"/>
          </td>
        </tr>
      </table>
    </form>
    </div>
<div style="position:absolute;left:100px;left:300px;top:85px;height:540px;display:none;color:red" id="aib_form_errors">
<p style="margin-top:100px;margin-left:50px;width:600px;">
<div class="prompt" id="paragraph_error_required" style="padding:5px;width:600px;">
A paragraph is required.
</div >
<div class="prompt" id="paragraph_error_size" style="padding:5px;width:600px;">
A paragraph must be at least 25 characters.
</div >
<div class="prompt" id="paragraph_error_exceedsmaxsize" style="padding:5px;width:600px;">
</div >
<div class="prompt" id="logoupload_error_required" style="padding:5px;width:600px;">
A logo image upload is required.
</div >
<div class="prompt" id="logoupload_error_type" style="padding:5px;width:600px;">
A jpg, png, or bmp logo image upload is required
</div >
<div class="prompt" id="checkbox_error_required" style="padding:5px;width:600px;">
Must select at least one iBlast
</div >
<div class="prompt" id="captcha_error_required" style="padding:5px;width:600px;">
Invalid response to captcha.
</div >
<div class="prompt" id="uploadlimit_error_required" style="padding:5px;width:600px;">
</div >
<div class="prompt" id="ajax_upload_error" style="padding:5px;width:600px;">
</div >
<br/><br/><br/>
<div style="color:#000000" style="padding:5px;width:600px;">
<a onclick="backToForm();" style="cursor: pointer;"><b><u>Back to form</u></b></a>
</div >
</p>
</div>
<div style="position:absolute;left:100px;left:300px;top:85px;height:540px;display:none;color:#000000" id="aib_form_upload_response">
</div>
</div>
</div>
  </body>
</html>
END;
    echo $result;
  }
  public function display_thankyou()

  {
  }
  public function display_default()

  {
  }
  public function redirect_to()

  {
  }
  /* Build email body */
  public function BuildBody($body, $html, $num)

  {
  }
  public function SendEmails()

  {
  }
  public static function get_include_contents($filename)

  {
    $pagename = "Anixter iBlast";
    $flashfile = 'marketing';
    $height = '768';
    $width = '1024';
    if (is_file($filename)) {
      ob_start();
      include $filename;

      return ob_get_clean();
    }
    return false;
  }
  /* Template Create, Read, Update, Delete Operations / Views */
  public function template_add_form($edit = 0)

  {
    if ($edit == 1) {
      $form_id = "template_edit_form";
      $this->tid = strip_tags(trim($_GET["tid"]));
      $template_name = trim($this->tid2templatename());
      $cmd = "edit_template";
      $button_value = "Edit Template";
      $tab_index_value = 2;
      $product_id = "product_image_edit";
      $manufacturer_id = "manufacturer_image_edit";
      $suffix = "_edit";
      $displaynone_template_name = "style='display:none'";
      $tid_input_element = "<input type='hidden' name='tid' value='" . $this->tid . "' />";
      $template_name_field = "<span style='color:#fff;vertical-align:middle'>" . $template_name . "</span>";
      $template_name_field.= '<input type="hidden" name="template_name" id="template_name_edit" value="' . $template_name . '" ' . $displaynone_template_name . ' MAXLENGTH="64">';
    }
    else {
      $form_id = "template_add_form";
      $template_name = "";
      $cmd = "add_template";
      $button_value = "Add Template";
      $tab_index_value = 1;
      $product_id = "product_image";
      $manufacturer_id = "manufacturer_image";
      $suffix = "";
      $tid_input_element = "";
      $template_name_field = '<input type="text" name="template_name" id="template_name" value="' . $template_name . '"  MAXLENGTH="64">';
    }
    $allowed_exts = $this->get_allowed_exts_list(1);
    $max_filesize_bytes = $this->max_filesize_bytes;
    // megabytes
    $max_filesize_megabytes = $this->max_filesize_megabytes;
    return '
<form id="' . $form_id . '" method="POST">
<p>
<label for="template_name" style="color:#fff">TEMPLATE NAME</label>
</p>
<br/>
<p>
' . $template_name_field . '
</p>
<br/><br/><br/><br/>
<p>
<label for="' . $product_id . '" style="color:#fff">PRODUCT IMAGE</label>
</p>
<p>
<input type="file" name="' . $product_id . '" id="' . $product_id . '" value="" class="upload_elements">
            <img id="loading_product' . $suffix . '" class="upload_processing" src="ajax/loading.gif" style="float:left;" >
</p>
<br/><br/><br/><br/><br/><br/>
<p><br class="upload_processing" />
<label for="' . $manufacturer_id . '" style="color:#fff">MANUFACTURER LOGO</label>
</p>
<p>
<input type="file" name="' . $manufacturer_id . '" id="' . $manufacturer_id . '" value="" class="upload_elements">
            <img id="loading_manufacturer' . $suffix . '" class="upload_processing" src="ajax/loading.gif" style="float:left;" >
</p>
<br/><br/><br/><br/><br/><br/>
<p>
<input type="hidden" name="' . $cmd . '" value="1">
<input type="hidden" name="sub" value="1">
<input type="hidden" name="tab_index" value="' . $tab_index_value . '">
' . $tid_input_element . '
<input type="button" value="' . $button_value . '" id="' . $cmd . '" class="upload_elements"/>
<br/><br/><br/>
<span  id="upload_specs" class="upload_elements" style="color:#ffffff">&nbsp;&nbsp;' . $max_filesize_megabytes . ' MB Max Upload Filesize ( ' . $allowed_exts . ' )</span>
</p>
</form>
<br/><br/>
      ';
  }
  public function get_template_product_image($template_name)

  {
    global $db;
    $q = "
      SELECT
      template_product_max_width_px,
      template_product_max_height_px,
      template_product_max_width_px_pdf,
      template_product_max_height_px_pdf,
      template_product_pdf_left_x,
      template_product_pdf_bottom_y,
      template_product_htm_left_x,
      template_product_htm_top_y
      FROM marketing_templates t
      WHERE t.name LIKE '" . $template_name . "'";
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0];
  }
  public function get_template_manufacturer_image($template_name)

  {
    global $db;
    $q = "
      SELECT
      template_manufacturer_max_width_px,
      template_manufacturer_max_height_px,
      template_manufacturer_max_width_px_pdf,
      template_manufacturer_max_height_px_pdf,
      template_manufacturer_pdf_left_x,
      template_manufacturer_pdf_bottom_y,
      template_manufacturer_htm_left_x,
      template_manufacturer_htm_top_y
      FROM marketing_templates t
      WHERE t.name LIKE '" . $template_name . "'";
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0];
  }
  /*
  TODO:
  UPDATE FOR product_image_edit and manufacturer_image_edit image uploads,
  or in another function
  */
  public function save_images_template_add($password, $edit = 0)

  {
    global $doc_root;
    if ($edit == 1) $edit_suffix = "_edit";
    else $edit_suffix = "";
    // valid file has been uploaded at this point
    $tid = $this->get_template_tid($this->purifier->purify($_REQUEST['template_name']));
    $file_uploads_tmp = $doc_root . "marketing/templates/file_uploads_tmp";
    // save images onto htm background image
    $jpg_path = "htm/" . $this->purifier->purify($_REQUEST['template_name']) . "/images/" . $this->purifier->purify($_REQUEST['template_name']) . ".jpg";
    $product_image = $this->get_template_product_image($this->purifier->purify($_REQUEST['template_name']));
    $manufacturer_image = $this->get_template_manufacturer_image($this->purifier->purify($_REQUEST['template_name']));
    foreach(array_unique($this->allowed_exts) AS $k => $v) {
      $file_path_orig = $file_uploads_tmp . "/manufacturer_image" . $edit_suffix . "." . $v;
      $file_path = $file_uploads_tmp . "/manufacturer_image_resized." . $v;
      if (is_file($file_path_orig)) {
        // resize manufacturer image to max dimensions
        $ret_img_resize = $this->image_resize($file_path_orig, $file_path, $manufacturer_image["template_manufacturer_max_width_px"], $manufacturer_image["template_manufacturer_max_height_px"]);
        // embed image on pdf background
        // embed image on htm background
        $dest = imagecreatefromjpeg($jpg_path);
        if ($v == "jpeg" || $v == "jpg") $src = imagecreatefromjpeg($file_path);
        if ($v == "png") $src = imagecreatefrompng($file_path);
        list($width, $height, $type, $attr) = getimagesize($file_path);
        // Copy and merge
        imagecopymerge($dest, $src, $manufacturer_image["template_manufacturer_htm_left_x"], $manufacturer_image["template_manufacturer_htm_top_y"], 0, 0, $width, $height, 100);
        imagejpeg($dest, $jpg_path);
        imagedestroy($dest);
        imagedestroy($src);
      }
      $file_path_orig = $file_uploads_tmp . "/product_image" . $edit_suffix . "." . $v;
      $file_path = $file_uploads_tmp . "/product_image_resized." . $v;
      if (is_file($file_path_orig)) {
        // resize productimage to max dimensions
        $ret_img_resize = $this->image_resize($file_path_orig, $file_path, $product_image["template_product_max_width_px"], $product_image["template_product_max_height_px"]);
        // embed image on pdf background
        // embed image on htm background
        $dest = imagecreatefromjpeg($jpg_path);
        if ($v == "jpeg" || $v == "jpg") $src = imagecreatefromjpeg($file_path);
        if ($v == "png") $src = imagecreatefrompng($file_path);
        list($width, $height, $type, $attr) = getimagesize($file_path);
        // Copy and merge
        imagecopymerge($dest, $src, $product_image["template_product_htm_left_x"], $product_image["template_product_htm_top_y"], 0, 0, $width, $height, 100);
        imagejpeg($dest, $jpg_path);
        imagedestroy($dest);
        imagedestroy($src);
      }
    }
    $img_background_line_number = $this->get_template_background_image_position($tid);
    // add background image tag without offseting lines
    $lines = $this->array_helpers->array_readfile("htm/" . $this->purifier->purify($_REQUEST['template_name']) . "/index.html");
    $bacgkround_img_tag = '    <div id="container"><img id="background-img" class="bg" src="images/' . $this->purifier->purify($_REQUEST["template_name"]) . '.jpg" alt="iBlast" />' . "\n";
    $lines = $this->array_helpers->array_replace($lines, $bacgkround_img_tag, ($img_background_line_number - 1));
    $this->array_helpers->array_writefile("htm/" . $this->purifier->purify($_REQUEST['template_name']) . "/index.html", $lines);
  }
  public function save_images_template_add_pdf($template_name, $edit = 0)

  {
    global $doc_root;
    if ($edit == 1) $edit_suffix = "_edit";
    else $edit_suffix = "";
    // valid file has been uploaded at this point
    $tid = $this->get_template_tid($template_name);
    $file_uploads_tmp = $doc_root . "marketing/templates/file_uploads_tmp";
    // save images onto htm background image
    $jpg_path = $doc_root . "marketing/templates/htm/" . $template_name . "/images/" . $template_name . ".jpg";
    $product_image = $this->get_template_product_image($template_name);
    $manufacturer_image = $this->get_template_manufacturer_image($template_name);
    // save images onto pdf background image
    $pdf_path = $doc_root . "marketing/templates/pdf/" . $template_name . ".pdf";
    $pdf = Zend_Pdf::load($pdf_path);
    // load then save from template to user path
    foreach(array_unique($this->allowed_exts) AS $k => $v) {
      $file_path_orig = $file_uploads_tmp . "/manufacturer_image" . $edit_suffix . "." . $v;
      $file_path = $file_uploads_tmp . "/manufacturer_image_resized." . $v;
      if (is_file($file_path_orig)) {
        // resize manufacturer image to max dimensions
        $ret_img_resize = $this->image_resize($file_path_orig, $file_path, $manufacturer_image["template_manufacturer_max_width_px_pdf"], $manufacturer_image["template_manufacturer_max_height_px_pdf"]);
        $pdf_page = $pdf->pages[0];
        // manufacturer image
        $image = Zend_Pdf_Image::imageWithPath($file_path);
        // Draw image
        list($width, $height, $type, $attr) = getimagesize($file_path);
        $pdf_page->drawImage($image, $manufacturer_image["template_manufacturer_pdf_left_x"], $manufacturer_image["template_manufacturer_pdf_bottom_y"], $manufacturer_image["template_manufacturer_pdf_left_x"] + $width, $manufacturer_image["template_manufacturer_pdf_bottom_y"] + $height);
      }
      $file_path_orig = $file_uploads_tmp . "/product_image" . $edit_suffix . "." . $v;
      $file_path = $file_uploads_tmp . "/product_image_resized." . $v;
      if (is_file($file_path_orig)) {
        // resize productimage to max dimensions
        $ret_img_resize = $this->image_resize($file_path_orig, $file_path, $product_image["template_product_max_width_px_pdf"], $product_image["template_product_max_height_px_pdf"]);
        $pdf_page = $pdf->pages[0];
        // manufacturer image
        $image = Zend_Pdf_Image::imageWithPath($file_path);
        list($width, $height, $type, $attr) = getimagesize($file_path);
        // Draw image
        $pdf_page->drawImage($image, $product_image["template_product_pdf_left_x"], $product_image["template_product_pdf_bottom_y"], $product_image["template_product_pdf_left_x"] + $width, $product_image["template_product_pdf_bottom_y"] + $height);
      }
    }
    $pdf->save($pdf_path);
    foreach(array_unique($this->allowed_exts) AS $k => $v) {
      $file_path = $file_uploads_tmp . "/manufacturer_image" . $edit_suffix . "." . $v;
      if (is_file($file_path)) unlink($file_path);
      $file_path = $file_uploads_tmp . "/product_image" . $edit_suffix . "." . $v;
      if (is_file($file_path)) unlink($file_path);
      $file_path = $file_uploads_tmp . "/manufacturer_image_resized." . $v;
      if (is_file($file_path)) unlink($file_path);
      $file_path = $file_uploads_tmp . "/product_image_resized." . $v;
      if (is_file($file_path)) unlink($file_path);
    }
  }
  // FOR ADDING TEMPLATE TEXT, as well as UPDATING AFTER EDITING ANY WIDGETS
  public function template_add()

  {
    global $db;
    // parse whitespace out of name and non alphamnumeric
    $template_name = preg_replace("/(\W)/i", "", $this->purifier->purify($_REQUEST["template_name"]));
    // file/directory naming convention (both cases, underscore)
    if (file_exists("htm/" . $template_name) || is_dir("htm/" . $template_name)) {
      return "htm/" . $template_name . " already exists.";
    }
    $template_key = strtolower($template_name);
    // name field, underscores all lower case
    $template_name = $template_key;
    $template_display_name = ucwords(preg_replace("/_/i", " ", $template_name));
    // both cases, spaces
    /* Update database with default settings */
    $q = "
    INSERT INTO `marketing_templates` (
    `name`,
    `display_name`,
    `pathfull`,
    `pathdir`,
    `filename`,
    `filename_htm_background`,
    `vendor_paragraph_htm_open_tag`,
    `vendor_paragraph_htm_close_tag`,
    `vendor_paragraph_tcpdf_open_tag`,
    `vendor_paragraph_tcpdf_close_tag`
    ) VALUES
    (
    '" . $template_key . "',
    '" . $template_display_name . "',
    'templates/pdf/" . $template_name . ".pdf',
    'templates/pdf',
    '" . $template_name . ".pdf',
    '" . $template_name . ".jpg',
    '<p style=\"color:#000000;font-size:16px;font:''News Gothic MT'';\">',
    '</p>',
    '<p style=\"color:#000000;font-size:9px;font:''News Gothic MT'';\">',
    '</p>'
    )
    ";
    $r = $db->sql_query($q, 1);
    // 1958 chars default maxwidth
    // ~50 chars default
    // $lorem_ipsum_short = "Lorem ipsum dolor sit amet ... ";
    // get max id
    $this->tid = $this->get_max_id("tid", "marketing_templates");
    $q = "
INSERT INTO marketing_templates_text
(tid,     weight,   template_text,          template_text_maxchar,  template_text_htm_open_tag,                   template_text_htm_close_tag,  template_text_tcpdf_open_tag,                   template_text_tcpdf_close_tag,  template_text_pdf_font_name,  template_text_pdf_font_size,  template_text_pdf_left_x,   template_text_pdf_bottom_y,   template_text_pdf_color_html,   template_text_pdf_wordwrap_charwidth,   template_text_pdf_wordwrap_linespace)
VALUES
(" . $this->tid . ",  1,    'Right Column header: " . $this->template_placeholder_text . "',  50,     '<p style=\"color:#8CA1C0;font-size:27px;font:''News Gothic MT Bold'';font-weight:700;\">', ' </p>',        '<p style=\"color:#8CA1C0;font-size:18px;font:''News Gothic MT Bold'';font-weight:700;\">',   '</p>',       'Helvetica',      14,         50,         600,        '#000000',      5,          10),
(" . $this->tid . ",  101,    'Right Column body: " . $this->template_placeholder_text . "',    1958,     '<p style=\"color:#000000;font-size:16px;font:''News Gothic MT'';\">',        '</p>',       '<p style=\"color:#000000;font-size:9px;font:''News Gothic MT''\">',        '</p>',       'Helvetica',      14,         50,         50,         '#000000',      5,          10),
(" . $this->tid . ",  201,    'Right Column footer: " . $this->template_placeholder_text . "',  50,     '<p style=\"color:#000000;font-size:16px;font:''News Gothic MT''\">',         '</p>',       '<p style=\"color:#000000;font-size:9px;font:''News Gothic MT''\">',        '</p>',       'Helvetica',      14,         50,         500,        '#000000',      5,          10)
      ";
    $r = $db->sql_query($q, 1);
    // $this->htm_update_name($template_name);
    $this->htm_create_template_preview($template_name, 1, 1, 0);
    $this->pdf_create_template_preview($template_name, 1, 0);
    return "Your new iBlast template <i>" . $this->purifier->purify($_REQUEST['template_name']) . "</i> can now be edited and published";
  }
  public function template_edit()

  {
    global $db;
    // parse whitespace out of name and non alphamnumeric
    $template_name = preg_replace("/(\W)/i", "", $this->purifier->purify($_REQUEST["template_name"]));
    // file/directory naming convention (both cases, underscore)
    if (file_exists("htm/" . $template_name) || is_dir("htm/" . $template_name)) {
      // return "htm/".$template_name. " already exists.";
      // delete background images (embedded with product and manufacturer) : pdf preview, pdf, htm image
    }
    $template_key = strtolower($template_name);
    // name field, underscores all lower case
    $template_name = $template_key;
    $template_display_name = ucwords(preg_replace("/_/i", " ", $template_name));
    // both cases, spaces
    $this->tid = strip_tags(trim($_REQUEST["tid"]));
    /* Update database with default settings */
    $q = "
    UPDATE `marketing_templates`
    SET
    `name`='" . $template_key . "',
    `pathfull`='templates/pdf/" . $template_name . ".pdf',
    `filename`='" . $template_name . ".pdf',
    `filename_htm_background`='" . $template_name . ".jpg'
    WHERE tid=" . $this->tid;
    $r = $db->sql_query($q, 1);
    // $this->htm_update_name($template_name);
    $this->htm_create_template_preview($template_name, 1, 1, 1);
    // param 4 is edit command for editing backgroun manufacturer and product images
    $this->pdf_create_template_preview($template_name, 1, 1);
    return "Your iBlast template <i>" . $this->purifier->purify($_REQUEST['template_name']) . "</i> has been edited";
  }
  // DELETE AND RECREATE HTM FILE, AFTER ADDING OR UPDATING TEMPLATES
  function htm_create_template_preview($template_name, $include_user_placeholders = 1, $new_background = 1, $edit = 0)
  {
    /* Create htm file structure */
    if (!is_dir($this->aib_dir . "/templates/htm/" . $template_name)) mkdir($this->aib_dir . "/templates/htm/" . $template_name);
    if (!is_dir($this->aib_dir . "/templates/htm/" . $template_name . "/images")) mkdir($this->aib_dir . "/templates/htm/" . $template_name . "/images");
    if (is_file($this->aib_dir . "/templates/htm/" . $template_name . "/index.html")) unlink($this->aib_dir . "/templates/htm/" . $template_name . "/index.html");
    copy($this->aib_dir . "/templates/htm/templates_template/index.html", $this->aib_dir . "/templates/htm/" . $template_name . "/index.html");
    // only rebuild jpg background image from templates directory
    // if($include_user_placeholders==1) {
    if ($new_background == 1) {
      if (is_file($this->aib_dir . "/templates/htm/" . $template_name . "/images/" . $template_name . ".jpg")) unlink($this->aib_dir . "/templates/htm/" . $template_name . "/images/" . $template_name . ".jpg");
      copy($this->aib_dir . "/templates/htm/templates_template/images/Customer iBlast Template.JPG", $this->aib_dir . "/templates/htm/" . $template_name . "/images/" . $template_name . ".jpg");
      $this->save_images_template_add($template_name, $edit);
    }
    // }
    // 11/2/2011: ADD TEMPLATE TEXTS AND EXTERNAL USER PLACEHOLDER TEXT AND LOGO,
    // EXTERNAL USERS STILL WRITE TO FILE, BUT AFTER DELETING AND USING TEMPLATES_TEMPLATES INDEX.HTML FILE
    $vendor_htm_fileline = $this->get_template_vendor_htm_fileline();
    $lines = $this->array_helpers->array_readfile($this->aib_dir . "/templates/htm/" . $template_name . "/index.html");
    if ($include_user_placeholders == 1) {
      $logo_max_dimensions = $this->get_logo_max_dimensions();
      if (is_file("logo.jpg")) unlink("logo.jpg");
      $ret_img_resize = $this->image_resize("templates_template_logo_placeholder.jpg", "logo.jpg", $logo_max_dimensions["vendor_logo_max_width_px"], $logo_max_dimensions["vendor_logo_max_height_px"]);
      copy("logo.jpg", "htm/" . $template_name . "/images/logo.jpg");
      $vendor_htm_logo_tag_style = $this->get_template_vendor_htm_logo_tag_style();
      $logo_tag = '<img id="vendor_logo" style="' . $vendor_htm_logo_tag_style["vendor_htm_logo_tag_style"] . '" src="images/logo.jpg" alt="iBlast Vendor Logo" />';
      $lines = $this->array_helpers->array_insert($lines, $logo_tag, $vendor_htm_fileline["vendor_htm_fileline_inserttext"]);
      $vendor_paragraph_tags = $this->get_htm_paragraph_vendor();
      $vendor_paragraph_form_max_chars = $this->get_vendor_paragraph_form_max_chars();
      $vendor_open_tag = $vendor_paragraph_tags["vendor_paragraph_htm_open_tag"];
      $vendor_paragraph_prefix = '[' . $vendor_paragraph_form_max_chars . ' char limit] User Placeholder Text : ';
      $vendor_paragraph = substr($vendor_paragraph_prefix . $this->template_placeholder_text, 0, $vendor_paragraph_form_max_chars + strlen($vendor_paragraph_prefix));
      $vendor_close_tag = $vendor_paragraph_tags["vendor_paragraph_htm_close_tag"];
      $vendor_paragraph_htm = $vendor_open_tag . $vendor_paragraph . $vendor_close_tag;
      $paragraph_tag = '  ' . $vendor_paragraph_htm;
      $lines = $this->array_helpers->array_insert($lines, $paragraph_tag, $vendor_htm_fileline["vendor_htm_fileline_inserttext"]);
    }
    $this->template_htm_texts_arr = $this->get_template_htm_texts();
    for ($i = 0; $i < sizeof($this->template_htm_texts_arr); $i++) {
      $template_text_prefix = "[ " . $this->template_htm_texts_arr[$i]['template_text_maxchar'] . " char limit ] ";
      $template_text = substr($template_text_prefix . $this->template_htm_texts_arr[$i]['template_text'], 0, ($this->template_htm_texts_arr[$i]['template_text_maxchar'] + strlen($template_text_prefix)));
      $template_htm_texts = $this->template_htm_texts_arr[$i]["template_text_htm_open_tag"] . $template_text . $this->template_htm_texts_arr[$i]["template_text_htm_close_tag"];
      $lines = $this->array_helpers->array_insert($lines, $template_htm_texts, $vendor_htm_fileline["vendor_htm_fileline_inserttext"]);
    }
    $img_background_line_number = $this->get_template_background_image_position($this->tid);
    // add background image tag without offseting lines
    // $lines = $this->array_helpers->array_readfile("htm/".$this->purifier->purify($_REQUEST['template_name']) . "/index.html");
    $bacgkround_img_tag = '    <div id="container"><img id="background-img" class="bg" src="images/' . $template_name . '.jpg" alt="iBlast" />' . "\n";
    $lines = $this->array_helpers->array_replace($lines, $bacgkround_img_tag, ($img_background_line_number - 1));
    // $this->array_helpers->array_writefile("htm/".$this->purifier->purify($_REQUEST['template_name']) . "/index.html",$lines);
    $this->array_helpers->array_writefile($this->aib_dir . "/templates/htm/" . $template_name . "/index.html", $lines);
  }
  /*
  MUST USE ANOTHER SEPARATE FILE FOR EMBEDDING PRODUCT AND MANUFACTURER IMAGES
  SINCE PRODUCT AND MANUFACTURER IMAGES ARE DELETED AFTER UPLOADING IN TEMPLATES DIREC TORY
  */
  public function pdf_create_template_preview($template_name, $new_background = 1, $edit = 0)

  {
    global $doc_root;
    if ($new_background == 1) {
      // marketing
      if (is_file($this->aib_dir . "/templates/pdf/" . $template_name . ".pdf")) unlink($this->aib_dir . "/templates/pdf/" . $template_name . ".pdf");
      if (is_file($this->aib_dir . "/templates/pdf/" . $template_name . "_preview.pdf")) unlink($this->aib_dir . "/templates/pdf/" . $template_name . "_preview.pdf");
      /* Create blank pdf, includes background image */
      copy($this->aib_dir . "/templates/pdf/templates_template/Customer iBlast Template.pdf", $this->aib_dir . "/templates/pdf/" . $template_name . ".pdf");
    }
    else {
      if (is_file($this->aib_dir . "/templates/pdf/" . $template_name . "_preview.pdf")) unlink($this->aib_dir . "/templates/pdf/" . $template_name . "_preview.pdf");
    }
    $this->save_images_template_add_pdf($template_name, $edit);
    /* save_images_template_add_pdf, must copy to preview since manufaturer and product images are deleted during */
    copy($this->aib_dir . "/templates/pdf/" . $template_name . ".pdf", $this->aib_dir . "/templates/pdf/" . $template_name . "_preview.pdf");
    // ONLY UPDATE PREVIEW FILE
    $tcpdf_dimensions = $this->get_tcpdf_dimensions();
    // =============================
    $pdf = & new FPDI();
    // $pdf->setPageUnit("mm"); // this is the default
    $pdf->setPageUnit("pt");
    // $pdf->setPageUnit("in");
    $pdf->setPageOrientation("P", 0, '');
    $pdf->setPDFVersion("1.4");
    // $pagecount = $pdf->setSourceFile($this->tid2templatefilename());
    // $pagecount = $pdf->setSourceFile($this->aib_dir."/templates/pdf/templates_template/Customer iBlast Template.pdf");
    $pagecount = $pdf->setSourceFile($this->aib_dir . "/templates/pdf/" . $template_name . "_preview.pdf");
    $tplidx = $pdf->importPage(1);
    $pdf->AddPage('P', array(
      $tcpdf_dimensions["tcpdf_width_inches"] * 72,
      $tcpdf_dimensions["tcpdf_height_inches"] * 72
    ));
    $pdf->useTemplate($tplidx, 0, 0, $tcpdf_dimensions["tcpdf_width_inches"] * 72, $tcpdf_dimensions["tcpdf_height_inches"] * 72, false);
    $this->template_htm_texts_arr = array_reverse($this->get_template_htm_texts());
    $html = "";
    $template_htm_texts = "";
    for ($i = 0; $i < sizeof($this->template_htm_texts_arr); $i++) {
      $template_text_prefix = "[ " . $this->template_htm_texts_arr[$i]['template_text_maxchar'] . " char limit ] ";
      $template_text = substr(($template_text_prefix . $this->template_htm_texts_arr[$i]['template_text']) , 0, ($this->template_htm_texts_arr[$i]['template_text_maxchar'] + strlen($template_text_prefix)));
      $template_htm_texts = $this->template_htm_texts_arr[$i]["template_text_tcpdf_open_tag"] . $template_text . $this->template_htm_texts_arr[$i]["template_text_tcpdf_close_tag"];
      $html.= $template_htm_texts;
    }
    $vendor_paragraph_form_max_chars = $this->get_vendor_paragraph_form_max_chars();
    $vendor_paragraph_tags = $this->get_tcpdf_paragraph_vendor();
    // =============================
    $this->template_htm_texts_arr = $this->get_template_htm_texts();
    /*
    $template_text =
    "[ ".
    $vendor_paragraph_form_max_chars.
    " char limit ] ".
    $this->template_htm_texts_arr[0]['template_text'];
    */
    $template_text_prefix = "[ " . $vendor_paragraph_form_max_chars . " char limit ]  User Placeholder Text: ";
    $template_text = substr(($$template_text_prefix . $this->template_placeholder_text) , 0, $vendor_paragraph_form_max_chars + strlen($template_text_prefix));
    $vendor_open_tag = $vendor_paragraph_tags["vendor_paragraph_tcpdf_open_tag"];
    $vendor_paragraph = trim($template_text);
    // ===========================TRIM TO MAX CHAR SIZE
    $vendor_close_tag = $vendor_paragraph_tags["vendor_paragraph_tcpdf_close_tag"];
    $html.= $vendor_open_tag . $vendor_paragraph . $vendor_close_tag;
    list($width, $height, $type, $attr) = getimagesize($this->aib_dir . "/templates/htm/" . $template_name . "/images/logo.jpg");
    // reduce image to half size for pdf
    $width = $width * .50;
    $height = $height * .50;
    $pdf_template_vendor_arr = $this->get_pdf_template_vendor();
    // =============================
    $pdf->writeHTMLCell($pdf_template_vendor_arr["vendor_paragraph_tcpdf_width"], $pdf_template_vendor_arr["vendor_paragraph_tcpdf_height"], $pdf_template_vendor_arr["vendor_paragraph_tcpdf_left_x"], $pdf_template_vendor_arr["vendor_paragraph_tcpdf_top_y"], $html, 1, 2, 1, true, '', true);
    // $pdf->Output($this->tcpdf_pdf_user_filepath, 'F');
    // $pdf->Output($this->aib_dir."/templates/pdf/".$template_name.".pdf", 'F');
    $pdf->Output($this->aib_dir . "/templates/pdf/" . $template_name . "_preview.pdf", 'F');
    /** ZF for uploaded logo */
    $pdf = Zend_Pdf::load($this->aib_dir . "/templates/pdf/" . $template_name . "_preview.pdf");
    // load then save from template to user path
    $pdf_page = $pdf->pages[0];
    // Vendor image
    // $image = Zend_Pdf_Image::imageWithPath($this->htm_user_templatename_timestamp_dir . "/images/" . $this->htm_logo_name );
    $image = Zend_Pdf_Image::imageWithPath($this->aib_dir . "/templates/htm/" . $template_name . "/images/logo.jpg");
    // Draw image
    $pdf_page->drawImage($image, $pdf_template_vendor_arr["vendor_logo_pdf_left_x"], $pdf_template_vendor_arr["vendor_logo_pdf_bottom_y"], $pdf_template_vendor_arr["vendor_logo_pdf_left_x"] + $width, $pdf_template_vendor_arr["vendor_logo_pdf_bottom_y"] + $height);
    $pdf->save($this->aib_dir . "/templates/pdf/" . $template_name . "_preview.pdf");
    // add template text
    // add vendor text
    // add vendor logo
  }
  public function template_edit_get_list()

  {
    global $db;
    $q_pdf_templates = "SELECT tid,display_name,name,published FROM `marketing_templates` WHERE 1";
    $r_pdf_templates = $db->sql_query_limit($q_pdf_templates, NULL);
    $rowset = $db->sql_fetchrowset($r_pdf_templates);
    $pdf_templates_str = "";
    $list_str = "";
    $list_str.= "<table>";
    for ($i = 0; $i < sizeof($rowset); $i++) {
      // $list_str .= "<p style='padding:5px 0px 0 0 ;color:#fff'>";
      $list_str.= "<tr>";
      $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'><a href='" . $_SERVER['PHP_SELF'] . "?tab_index=2&update=1&tid=" . $rowset[$i]['tid'] . "' style='color:#fff'>EDIT</a></td>";
      if ($rowset[$i]['published'] == 1) $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'><a href='" . $_SERVER['PHP_SELF'] . "?tab_index=0&publish=0&tid=" . $rowset[$i]['tid'] . "' style='color:#fff'>UNPUBLISH</a></td>";
      if ($rowset[$i]['published'] == 0) $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'><a href='" . $_SERVER['PHP_SELF'] . "?tab_index=0&publish=1&tid=" . $rowset[$i]['tid'] . "' style='color:#fff'>PUBLISH</a></td>";
      if (is_file('htm/' . $rowset[$i]["name"] . '/index.html')) $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'><a href='htm/" . ($rowset[$i]['name']) . "/index.html' target='_blank' style='color:#fff'>HTM</a></td>";
      else $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'>HTM</td>";
      if (is_file('pdf/' . $rowset[$i]["name"] . '.pdf')) $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'><a href='pdf/" . ($rowset[$i]['name']) . ".pdf' target='_blank' style='color:#fff'>PDF</a></td>";
      else $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'>PDF</td>";
      if (is_file('pdf/' . $rowset[$i]["name"] . '_preview.pdf')) $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'><a href='pdf/" . ($rowset[$i]['name']) . "_preview.pdf' target='_blank' style='color:#fff'>PDF PREVIEW</a></td>";
      else $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'>PDF PREVIEW</td>";
      $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'>" . strtoupper($rowset[$i]['display_name']) . "</td>";
      if ($rowset[$i]['published'] == 0) $list_str.= "<td style='padding:0px 30px 30px 30px ;color:#fff'><a href='" . $_SERVER['PHP_SELF'] . "?tab_index=0&delete=1&tid=" . $rowset[$i]['tid'] . "' style='color:#fff'>DELETE</a></td>";
      $list_str.= "</tr>";
      // $list_str .= "</p>";
      // $list_str .= "<br/>";
    }
    $list_str.= "</table>";
    return $list_str;
  }
  public function template_edit_delete_template()

  {
    global $db;
    if (isset($_REQUEST["delete"]) && $_REQUEST["delete"] == 1) {
      if (!isset($_REQUEST["tid"]) && $_REQUEST["tid"] != "") {
        return;
      }
      $template_name = $this->get_template_name($this->purifier->purify($_REQUEST['tid']));
      $notify_str = "Deleted " . $this->get_template_display_name($this->purifier->purify($_REQUEST['tid']));
      // delete htm, pdf files
      $htm_path = "htm/" . $template_name;
      $pdf_path = "pdf/" . $template_name . ".pdf";
      $pdf_preview_path = "pdf/" . $template_name . "_preview.pdf";
      if (is_file($htm_path . "/index.html")) unlink($htm_path . "/index.html");
      if (is_file($htm_path . "/images/" . $template_name . ".jpg")) unlink($htm_path . "/images/" . $template_name . ".jpg");
      if (is_file($htm_path . "/images/manufacturer.jpg")) unlink($htm_path . "/images/manufacturer.jpg");
      if (is_file($htm_path . "/images/product.jpg")) unlink($htm_path . "/images/product.jpg");
      if (is_file($htm_path . "/images/logo.jpg")) unlink($htm_path . "/images/logo.jpg");
      if (is_dir($htm_path . "/images")) rmdir($htm_path . "/images");
      if (is_dir($htm_path)) rmdir($htm_path);
      if (is_file($pdf_path)) unlink($pdf_path);
      if (is_file($pdf_preview_path)) unlink($pdf_preview_path);
      $q = "
    DELETE FROM marketing_templates
    WHERE tid = " . $this->purifier->purify($_REQUEST['tid']) . "
          AND published = 0 ";
      $db->sql_query_limit($q, 1);
      $q = "
    DELETE FROM marketing_templates_text
    WHERE tid = " . $this->purifier->purify($_REQUEST['tid']);
      $db->sql_query_limit($q, NULL);
      return $notify_str;
    }
    return "";
  }
  public function template_edit_update_template()

  {
    global $db;
    if (isset($_REQUEST["update"]) && $_REQUEST["update"] == 2) {
      if (!isset($_REQUEST["tid"]) || trim($_REQUEST["tid"]) == "") {
        return "error: tid not set";
      }
      if (isset($_REQUEST["ttid"])) {
        // return "error: ttid is set";
      }
      $this->tid = trim(strip_tags($_REQUEST['tid']));
      $template_name = $this->get_template_name($this->tid);
      $notify_str = "Updated " . $this->get_template_display_name($this->tid);
      // $template_name_new = preg_replace('/\W/','',$this->purifier->purify($_REQUEST['name']));
      // $template_name_new = $_REQUEST['name'];
      $columns = $this->get_columns_marketing_templates();
      $columns_str = "";
      $i = 0;
      foreach($_REQUEST AS $k => $v) {
        if (!in_array($k, $columns)) continue;
        if ($k == 'tid' || $k == 'ttid') continue;
        if (trim($v) == "") continue;
        if ($i > 0) $columns_str.= ",";
        // if($k =="name") $v = $template_name_new;
        // $v= preg_replace("/".$template_name."/",$template_name_new,$v);
        if (is_numeric($v)) $columns_str.= $k . "=" . $v;
        else $columns_str.= $k . "='" . $v . "'";
        $i++;
      }
      $pathfull = "templates/pdf/" . $template_name . ".pdf";
      $filename = $template_name . ".pdf";
      $filename_htm_background = $template_name . ".jpg";
      $q = "
    UPDATE marketing_templates
    SET " . $columns_str . ",
    pathfull='" . $pathfull . "',
    filename='" . $filename . "',
    filename_htm_background='" . $filename_htm_background . "'
    WHERE tid = " . $this->purifier->purify($_REQUEST['tid']);
      $db->sql_query_limit($q, 1);
      // INCLUDE IMAGE UPLOADS?  no use another form for only updating embeded background images
      // REBUILD HTM AND PDFS FILES INSTEAD OF RENAME
      $this->tid = $this->purifier->purify($_REQUEST['tid']);
      $this->htm_create_template_preview($template_name, 1, 0, 0);
      $this->pdf_create_template_preview($template_name, 0, 0);
      return $notify_str;
      /*
      $htm_path_new = "htm/".$template_name_new;
      $pdf_path_new = "pdf/".$template_name_new.".pdf";
      $htm_path = "htm/".$template_name;
      $pdf_path = "pdf/".$template_name.".pdf";
      if(is_file($pdf_path)) {
      rename($pdf_path,$pdf_path_new);
      }
      if(is_dir($htm_path)) {
      $this->recurse_copy($htm_path,$htm_path_new);
      // sleep(2);
      if(is_file($htm_path."/images/".$template_name.".jpg")) unlink($htm_path."/images/".$template_name.".jpg");
      if(is_dir($htm_path."/images")) rmdir($htm_path."/images");
      if(is_file($htm_path."/index.html")) unlink($htm_path."/index.html");
      if(is_dir($htm_path)) rmdir($htm_path);
      if(is_file($pdf_path)) unlink($pdf_path);
      }
      if(is_file($htm_path_new."/images/".$template_name.".jpg")){
      rename($htm_path_new."/images/".$template_name.".jpg",$htm_path_new."/images/".$this->purifier->purify($_REQUEST['name']).".jpg");
      }
      */
      return $notify_str;
    }
    return "error: template_edit_update_template";
  }
  public function htm_update_name($newname)

  {
    // update background image name
    // $img_background_line_number=$this->get_template_background_image_position($this->purifier->purify($_REQUEST['tid']));
    $img_background_line_number = $this->get_template_background_image_position($this->tid);
    $lines = $this->array_helpers->array_readfile("htm/" . $newname . "/index.html");
    $bacgkround_img_tag = ' <img id="background-img" class="bg" src="images/' . $newname . '.jpg" alt="iBlast" />';
    $lines[$img_background_line_number - 1] = $bacgkround_img_tag;
    $this->array_helpers->array_writefile("htm/" . $newname . "/index.html", $lines);
  }
  public function template_edit_update_widget()

  {
    global $db;
    if (isset($_REQUEST["update_widget"]) && $_REQUEST["update_widget"] == 2) {
      if (!isset($_REQUEST["tid"]) || trim($_REQUEST["tid"]) == "") {
        return "error: tid not set";
      }
      if (!isset($_REQUEST["ttid"]) || trim($_REQUEST["ttid"]) == "") {
        return "error: ttid not set";
      }
      $this->tid = trim(strip_tags($_REQUEST['tid']));
      $template_name = $this->get_template_name($this->tid);
      $notify_str = "Updated widget for " . $this->get_template_display_name($this->tid);
      $columns = $this->get_columns_marketing_templates_text();
      $columns_str = "";
      $i = 0;
      foreach($_REQUEST AS $k => $v) {
        if (!in_array($k, $columns)) continue;
        if ($k == 'tid' || $k == 'ttid') continue;
        if (trim($v) == "") continue;
        if ($i > 0) $columns_str.= ",";
        // if($k =="name") $v = $template_name_new;
        if (is_numeric($v)) $columns_str.= $k . "=" . $v;
        else $columns_str.= $k . "='" . $v . "'";
        $i++;
      }
      $q = "
    UPDATE marketing_templates_text
    SET " . $columns_str . "
    WHERE ttid = " . $this->purifier->purify($_REQUEST['ttid']);
      $db->sql_query_limit($q, 1);
      // REBUILD HTM AND PDFS FILES
      $this->tid = $this->purifier->purify($_REQUEST['tid']);
      $this->htm_create_template_preview($template_name, 1, 0, 0);
      $this->pdf_create_template_preview($template_name, 0, 0);
      return $notify_str;
    }
    return "error: template_edit_update_widget";
  }
  public function template_edit_delete_widget()

  {
    global $db;
    if (isset($_REQUEST["delete_widget"]) && $_REQUEST["delete_widget"] == 1) {
      if (!isset($_REQUEST["tid"]) && $_REQUEST["tid"] != "") {
        return "widget not deleted, tid not set";
      }
      if (!isset($_REQUEST["ttid"]) && $_REQUEST["ttid"] != "") {
        return "widget not deleted, ttid not set";
      }
      $template_name = $this->get_template_name($this->purifier->purify($_REQUEST['tid']));
      $notify_str = "Deleted " . $this->get_template_display_name($this->purifier->purify($_REQUEST['tid'])) . " template widget " . $this->purifier->purify($_REQUEST['ttid']);
      $q = "
    DELETE FROM marketing_templates_text
    WHERE ttid = " . $this->purifier->purify($_REQUEST['ttid']);
      $db->sql_query_limit($q, 1);
      // REBUILD HTM AND PDF
      return $notify_str;
    }
    return "widget not deleted";
  }
  public function template_edit_publish()

  {
    global $db;
    if (isset($_REQUEST["publish"]) && $_REQUEST["publish"] == 1) {
      if (!isset($_REQUEST["tid"]) && $_REQUEST["tid"] != "") {
        return;
      }
      $template_name = $this->get_template_name($this->purifier->purify($_REQUEST['tid']));
      $notify_str = "Published " . $this->get_template_display_name($this->purifier->purify($_REQUEST['tid']));
      $q = "
    UPDATE marketing_templates
    SET published = 1
    WHERE tid = " . $this->purifier->purify($_REQUEST['tid']);
      $db->sql_query_limit($q, 1);
    }
    return $notify_str;
  }
  public function template_edit_unpublish()

  {
    global $db;
    if (isset($_REQUEST["publish"]) && $_REQUEST["publish"] == 0) {
      if (!isset($_REQUEST["tid"]) && $_REQUEST["tid"] != "") {
        return;
      }
      $notify_str = "Unpublished " . $this->get_template_display_name($this->purifier->purify($_REQUEST['tid']));
      $q = "
    UPDATE marketing_templates
    SET published = 0
    WHERE tid = " . $this->purifier->purify($_REQUEST['tid']);
      $db->sql_query_limit($q, 1);
    }
    return $notify_str;
  }
  public function get_published_status($tid)

  {
    global $db;
    $q = "
      SELECT publish
      FROM marketing_templates
      WHERE tid = " . $this->purifier->purify($_REQUEST['tid']);
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0]["publish"];
  }
  public function get_template_display_name($tid)

  {
    global $db;
    $q = "
      SELECT display_name
      FROM marketing_templates
      WHERE tid = " . $tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return trim($rowset[0]["display_name"]);
  }
  public function get_template_name($tid)

  {
    global $db;
    $q = "
      SELECT name
      FROM marketing_templates
      WHERE tid = " . $tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return trim($rowset[0]["name"]);
  }
  public function get_template_tid($template_name)

  {
    global $db;
    $q = "
      SELECT tid
      FROM marketing_templates
      WHERE name LIKE '" . $template_name . "'";
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return trim($rowset[0]["tid"]);
  }
  public function get_template_background_image_position($tid)

  {
    global $db;
    $q = "
      SELECT vendor_htm_fileline_insertbacgkroundimg
      FROM marketing_templates
      WHERE tid = " . $tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0]["vendor_htm_fileline_insertbacgkroundimg"];
  }
  public function get_columns_marketing_templates()

  {
    global $db;
    $q = "
      SELECT *
      FROM marketing_templates";
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return array_keys($rowset[0]);
  }
  public function get_columns_marketing_templates_text()

  {
    global $db;
    $q = "
      SELECT *
      FROM marketing_templates_text";
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return array_keys($rowset[0]);
  }
  public function get_data_marketing_templates($tid)

  {
    // returns 1 row
    global $db;
    $q = "
      SELECT *
      FROM marketing_templates
      WHERE tid = " . $tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset;
  }
  public function get_data_marketing_templates_text($tid)

  {
    // returns multiple rows
    global $db;
    $q = "
      SELECT *
      FROM marketing_templates_text
      WHERE tid = " . $tid . "
      ORDER BY ttid,weight";
    $r = $db->sql_query_limit($q, NULL);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset;
  }
  public function get_data_marketing_templates_text_ttids($tid)

  {
    // returns multiple rows
    global $db;
    $q = "
      SELECT ttid
      FROM marketing_templates_text
      WHERE tid = " . $tid . "
      ORDER BY ttid,weight";
    $r = $db->sql_query_limit($q, NULL);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset;
  }
  public function get_form_elements_marketing_templates($tbl_name, $add_form = 0)

  {
    global $db;
    if ($tbl_name == "marketing_templates") $tab_index = 2;
    if ($tbl_name == "marketing_templates_text") $tab_index = 3;
    // if($add_form==1) $tab_index=4   ;
    if ((!isset($_REQUEST['tid']) || trim($_REQUEST['tid']) == "") && $tbl_name != "blank") return;
    $elements_marketing_templates = "";
    // ROWS LOOP
    if ($add_form == 1) {
      $v_data = "";
      if ($tbl_name == "marketing_templates_text") $tab_index = 4;
      $elements_marketing_templates = $this->build_form_elements_marketing_templates($elements_marketing_templates, $tbl_name, $v_data, $tab_index, $form_incr, $add_form);
    }
    else {
      $form_incr = 0;
      if ($tbl_name == "marketing_templates_text") $tab_index = 5;
      foreach($this->{"get_data_" . $tbl_name}($_REQUEST['tid']) AS $k_data => $v_data) {
        $elements_marketing_templates = $this->build_form_elements_marketing_templates($elements_marketing_templates, $tbl_name, $v_data, $tab_index, $form_incr, $add_form);
        $form_incr++;
        $tab_index++;
      }
      // ROWS LOOP
    }
    return $elements_marketing_templates;
  }
  public function build_form_elements_marketing_templates($elements_marketing_templates, $tbl_name, $v_data, $tab_index, $form_incr = 0, $add_form = 0)

  {
    $form_element_maxsize_arr = array(
      'default' => 50
    );
    // always suppressed fields, backend fields
    $displaynone_arr = array(
      'tid',
      'ttid', /*'name',*/
      'published',
      'pathfull',
      'pathdir',
      'filename',
      'filename_htm_background',
      'sub_marketing_templates',
      'cmd',
      'tab_index',
      'weight',
      'template_text_pdf_wordwrap_charwidth',
      'template_text_pdf_wordwrap_linespace',
      'vendor_paragraph_pdf_wordwrap_charwidth',
      'vendor_paragraph_pdf_wordwrap_linespace',
      'vendor_htm_fileline_inserttext',
      'vendor_htm_fileline_insertbacgkroundimg',
    );
    // allow to unsuppress some fields, no toggler for now
    $displaynone_toggle_arr = array( /*tag fields for inline styling*/
      'vendor_paragraph_htm_open_tag',
      'vendor_paragraph_htm_close_tag',
      'vendor_paragraph_tcpdf_open_tag',
      'vendor_paragraph_tcpdf_close_tag',
      'template_text_htm_open_tag',
      'template_text_htm_close_tag',
      'template_text_tcpdf_open_tag',
      'template_text_tcpdf_close_tag', /*charwidth fields*/
      'template_text_maxchar',
      'vendor_paragraph_form_max_chars', /*css inline fields*/
      'template_text_pdf_font_name',
      'template_text_pdf_font_size',
      'template_text_pdf_color_html',
      'vendor_paragraph_pdf_font_name',
      'vendor_paragraph_pdf_font_size_px',
      'vendor_pdf_color_html',
      'vendor_htm_logo_tag_style', /*image dimension fields*/
      'vendor_logo_max_width_px',
      'vendor_logo_max_height_px',
      'vendor_logo_pdf_left_x',
      'vendor_logo_pdf_bottom_y',
      'vendor_paragraph_tcpdf_width',
      'vendor_paragraph_tcpdf_height',
      'tcpdf_width_inches',
      'tcpdf_height_inches', /*positioning fields*/
      'template_product_max_height_px',
      'template_product_max_width_px',
      'template_product_max_width_px_pdf',
      'template_product_max_height_px_pdf',
      'template_product_pdf_left_x',
      'template_product_pdf_bottom_y',
      'template_product_htm_left_x',
      'template_product_htm_top_y',
      'template_manufacturer_max_width_px',
      'template_manufacturer_max_height_px',
      'template_manufacturer_max_width_px_pdf',
      'template_manufacturer_max_height_px_pdf',
      'template_manufacturer_pdf_left_x',
      'template_manufacturer_pdf_bottom_y',
      'template_manufacturer_htm_left_x',
      'template_manufacturer_htm_top_y',
      'template_htm_background_width_px',
      'template_htm_background_height_px',
      'template_pdf_background_width_px',
      'template_pdf_background_height_px',
      'template_text_pdf_left_x',
      'template_text_pdf_bottom_y',
      'vendor_paragraph_tcpdf_left_x',
      'vendor_paragraph_tcpdf_top_y',
    );
    $disabled = "disabled='true'";
    $displaynone = "style='display:none'";
    $displaynone_inline = "display:none";
    if (isset($v_data['ttid']) && $tbl_name == "marketing_templates_text") {
      $elements_marketing_templates.= "<div id='template_edit_template_widget_ttid_" . $v_data['ttid'] . "_form'>";
    }
    else if ($tbl_name == "marketing_templates") {
      $elements_marketing_templates.= "<div id='template_edit_vendor_widget_ttid_form'>";
    }
    else {
      $elements_marketing_templates.= "<div id='template_edit_template_widget_ttid_form'>";
    }
    // _hide/show_ class fields for button, toggle_css_pos_fields for text/textarea elementas
    $toggler_button = "
     <input type='button' onclick='$(\".toggle_css_pos_fields_show\").hide();$(\".toggle_css_pos_fields_hide\").fadeIn();$(\".toggle_css_pos_fields\").toggle();' class='toggle_css_pos_fields_show' value='SHOW CSS/POSITIONING/RESIZING FIELDS' />
     <input type='button' onclick='$(\".toggle_css_pos_fields_hide\").hide();$(\".toggle_css_pos_fields_show\").fadeIn();$(\".toggle_css_pos_fields\").toggle();' class='toggle_css_pos_fields_hide' style='display:none' value='HIDE CSS/POSITIONING/RESIZING FIELDS' />
    ";
    $disable_sumbit = "";
    if ($add_form == 1) $disable_sumbit = "disabled='true'";
    $displaynone = "display:none";
    $elements_marketing_templates.= "
     <form method='POST'>
     <input type='submit' $disable_sumbit>
    ";
    $elements_marketing_templates.= $toggler_button;
    $elements_marketing_templates.= "
      <br/>
      <br/>
    ";
    $elements_marketing_templates.= "
    <table>
    ";
    $i = 0;
    $displaying_incr = 0;
    $element = "";
    foreach($this->{"get_columns_" . $tbl_name}() AS $k => $v) {
      if ($v_data == "") $field_value = "";
      // set values, or no value else $field_value = trim(($v_data[$v]));
      /*
      if(in_array($v,array_keys($form_element_maxsize_arr))) {
      $maxsize_str= 'data-maxsize="'.$form_element_maxsize_arr[$v].'"';
      }else{
      $maxsize_str= 'data-maxsize="'.$form_element_maxsize_arr["default"].'"';
      }
      // ad hoc setting of template text for body to 1900
      if($v=='template_text' && $v_data["weight"]==101 ) {
      $maxsize_str= 'data-maxsize="1900"';
      }
      else if($v=='template_text' && $v_data["weight"]==1 ) {
      $maxsize_str= 'data-maxsize="55"';
      }
      else if($v=='template_text' && $v_data["weight"]==201 ) {
      $maxsize_str= 'data-maxsize="55"';
      }
      */
      if ($v == 'template_text') {
        $maxsize_str = 'data-maxsize="' . $v_data["template_text_maxchar"] . '"';
      }
      else if (is_numeric($v_data[$v])) {
        $maxsize_str = 'data-maxsize="10"';
      }
      else if (preg_match("/_tag/i", $v)) {
        // 256 for "tag" fields
        $maxsize_str = 'data-maxsize="256"';
      }
      else {
        // string, other types
        $maxsize_str = 'data-maxsize="75"';
      }
      // change "toggle" to toggler later?????????????????
      if (in_array($v, $displaynone_arr, true) || in_array($v, $displaynone_toggle_arr, true)) {
        $displaynone_inline = "display:none";
      }
      else {
        $displaynone_inline = "";
        $displaying_incr++;
      }
      if (in_array($v, $displaynone_toggle_arr, true)) {
        $toggle_css_pos_fields_inline = "toggle_css_pos_fields";
      }
      else {
        $toggle_css_pos_fields_inline = "";
      }
      if ($v == 'name') {
        $displaynone_inline = "display:none";
      }
      $field_value = htmlentities($v_data[$v]);
      $element.= "
        <td style='width:650px;padding-bottom:10px;color:#fff;" . $displaynone_inline . "' class='" . $toggle_css_pos_fields_inline . "'>
        <lable for='" . $v . "'/><nobr>" . strtoupper(preg_replace('/_/i', ' ', $v)) . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</nobr><br/>
        <textarea rows='5' cols='75' id='" . $v . "' name='" . $v . "' " . $maxsize_str . ">" . $field_value . "</textarea>
        </td>
        ";
      // if( ($displaying_incr%2==0&&$displaying_incr>0)) {
      $elements_marketing_templates.= "
        <tr>
        " . $element . "
        </tr>
        ";
      $element = "";
      // }
      $i++;
    }
    if ($tbl_name == "marketing_templates_text" && $add_form == 1) {
      $cmd = "add_widget";
    }
    if ($tbl_name == "marketing_templates" && $add_form == 1) {
      $cmd = "add";
    }
    if ($tbl_name == "marketing_templates_text" && $add_form == 0) {
      $cmd = "update_widget";
    }
    if ($tbl_name == "marketing_templates" && $add_form == 0) {
      $cmd = "update";
    }
    $elements_marketing_templates.= "
    <tr>
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    <lable for='sub_" . $tbl_name . "'/><nobr>SUB " . strtoupper(preg_replace('/_/i', ' ', $tbl_name)) . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</nobr><br/>
    <input type='text' id='sub_" . $tbl_name . "' name='sub_" . $tbl_name . "' value='sub_" . $tbl_name . "'/>
    </td>
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    <lable for='sub'/><nobr  >CMD</nobr><br/>
    <input type='text' name='" . $cmd . "' value='2' " . $tbl_name . "  />
    </td>
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    <lable for='sub' " . $tbl_name . "/><nobr>TAB INDEX</nobr><br/>
    <input type='text' name='tab_index' value='" . $tab_index . "' " . $tbl_name . " />
    </td>
    </tr>
    ";
    $elements_marketing_templates.= "
    </table>
     <input type='submit' $disable_sumbit>
    ";
    $elements_marketing_templates.= $toggler_button;
    $elements_marketing_templates.= "
     </form>
    ";
    if ($tbl_name == "marketing_templates_text" && $add_form == 0) {
      $elements_marketing_templates.= "
      <br/>
     <form>
      <table>
    <tr>
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    <lablel for='delete_widget'/><nobr>DELETE TTID</nobr><br/>
     <input type='text' name='delete_widget' value='1' />
    </td>
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    <lable for='tid'/><nobr >TID</nobr><br/>
     <input type='text' name='tid' value='" . $v_data['tid'] . "'/>
    </td>
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    <lable for='ttid'/><nobr >TTID</nobr><br/>
     <input type='text' name='ttid' value='" . $v_data['ttid'] . "'/>
    </td>
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    <lable for='tab_index'/><nobr>TAB INDEX</nobr><br/>
     <input type='text' name='tab_index' value='" . $tab_index . "'/>
    </td>
    </tr>
    <tr>
    <td style='width:650px;padding-bottom:10px;color:#fff;'>
     <input type='submit' value='Delete Widget' disabled='true'>
    </td>
    </tr>
    </table>
    </form>
      ";
    }
    if ($tbl_name == "marketing_templates" && $add_form == 0) {
      $elements_marketing_templates.= "
      <br/>
     <form>
      <table>
    <tr>
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    <lablel for='delete_widget'/><nobr>DELETE </nobr><br/>
     <input type='text' name='delete' value='1' />
    </td>
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    <lable for='tid'/><nobr >TID</nobr><br/>
     <input type='text' name='tid' value='" . $v_data['tid'] . "'/>
    </td>
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    <lable for='tab_index'/><nobr>TAB INDEX</nobr><br/>
     <input type='text' name='tab_index' value='" . $tab_index . "'/>
    </td>
    </tr>
    <tr>
    <td style='width:650px;padding-bottom:10px;color:#fff;'>
     <input type='submit' value='Delete Widget' disabled='true'>
    </td>
    </tr>
    </table>
    </form>
      ";
    }
    $elements_marketing_templates.= "
      </div>
    ";
    return $elements_marketing_templates;
  }
  public function tcpdf_create_blank()

  {
  }
  public function zend_pdf_create_blank($pdf_basename, $pdf_filename)

  {
    $pdf = new Zend_Pdf();
    $inches_x = 9;
    $inches_y = 11;
    $src = "iblast_blank/" . $pdf_filename;
    $dst = "iblast_blank/resized_" . $pdf_filename;
    $tmp = getimagesize($src);
    // set inches from image size rather than predefined pdf size(quality loss?):
    $inches_x = ($tmp[0] / 72) * (8 / 6);
    $inches_y = ($tmp[1] / 72) * (8 / 6);
    $pdf->pages[] = new Zend_Pdf_Page($inches_x * 72, $inches_y * 72);
    $width = $inches_x * 72;
    $height = $inches_y * 72;
    $width_px = $inches_x * 72 * (8 / 6);
    // 6pts==8pxs,9"==648pts=864px
    $height_px = $inches_y * 72 * (8 / 6);
    // 11"==792pts== 1056px
    // quality loose when resizing, auto resized in zend
    // image_resize($src, $dst, $width, $height, $crop=0){
    // $this->image_resize($src, $dst, $width_px, $height_px, 0);
    $image = Zend_Pdf_Image::imageWithPath($src);
    // $dst, no resize so use src
    // $page->drawImage($image, $left, $bottom, $right, $top);
    $pdf->pages[0]->drawImage($image, 0, 0, $width, $height);
    unlink("iblast_blank/" . $pdf_basename . ".pdf");
    $pdf->save("iblast_blank/" . $pdf_basename . ".pdf");
  }
}

