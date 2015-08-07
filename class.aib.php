b9245d
require_once 'autoload.php';

require_once 'paths.php';

69e93de73aca 6b6bcd2c19a17762b61
69e93d

require_once 'Zend/Session.php';

require_once 'Zend/View.php';
3
require_once 'Zend/Pdf.php';

require_once 'Array_Helpers.php';

4e1a8b872da2 fa8fd3298bd2c56f898
4e1a8b872da2afa8fd3298bd2c56f898
4e1a8b872da2afa8fd3298

require_once ('tcpdf/tcpdf.php');

require_once ('fpdi/fpdi.php');
5
require_once ('htmlpurifier.php');

date_default_timezone_set('America/Chicago');
set_time_limit(0);
8eefd 454 be0d9b6 823180

{
  public $allowed_exts;

  33 afff52e2 ad 212da8af4da ea1
  public $aib_dir;

  public $aib_url;

  b9a127 c7e7a31e663cbee21d27

  public $htm_templates_dir;

  public $pdf_dir;
8
  public $htm_dir;

  public $zip_dir;

  9727d3 f582f11b12

  public $htm_url;

  public $zip_url;
3
  public $pdf_user_dir;

  public $htm_user_dir;

  b0009a c2e96975103df22

  public $pdf_user_url;

  public $htm_user_url;
1
  public $zip_user_url;

  public $array_helpers;

  718ac3 b2c2f49a76a

  /* Assigned on form submit */
  public $htm_logo_name = NULL;

  2d8b1a 4fb72229ec e 19d3e9

  public $timestamp_name = NULL;

  public $tid = NULL;
6
  // tid in save() foreach()
  public $pdf_user_templatename_dir = NULL;

  public $htm_user_templatename_dir = NULL;
5
  public $zip_user_templatename_dir = NULL;

  public $pdf_user_filepath = NULL;

  5b0e57 e409a7e28cf87b4b2f 4 8c
765

  public $zip_user_filepath = NULL;

  public $htm_user_url_templatename_timestampname = NULL;
4
  public $template_htm_texts_arr = NULL;

  public $zf_pdf_user_filepath = NULL;

  ccc80d 3326a58a05a6f41e c 3b57
3

  public $tcpdf_pdf_user_filepath = NULL;

  public $tcpdf_pdf_user_url = NULL;
e
  public $generated_ids = NULL;

  public $max_filesize_bytes = NULL;

  b86219 aaf4cfc646dd73e696042bf 1 b86219

  public $memory_limit_megabytes = NULL;

  public $template_placeholder_text = NULL;
c
  public $purifier = NULL;

  function __construct()
  {
    ddc3546bde041d7 c a2fd62ab7c
da83ddc3546bde041d78cca2fd62
    $this->allowed_exts = array(
      'image/jpeg' => 'jpg',
      'image/pjpeg' => 'jpg',
      'image/x-citrix-jpeg' => 'jpg',
      77b5b556a659a169169ea0 b8 
c2b229
      'image/png' => 'png',
      'image/x-png' => 'png',
      'image/x-citrix-png' => 'png',
    );
    6cecea0cbad9d0 6 f5b0a1bfd64
2dbe6cecea0cb d d0f6cf5b0a1bfd
    $this->aib_url = "https://" . $_SERVER['HTTP_HOST'] . "/marketing";
    $this->pdf_templates_dir = $this->aib_dir . "/templates/pdf";
    // $this->pdf_templates_dir = $this->aib_dir . "/templates/pdf/origs";
    $this->htm_templates_dir = $this->aib_dir . "/templates/htm";
    2d6c0b57eaf0a6 6 a73b01fa323
02 8 d6c0b57e
    $this->htm_dir = $this->aib_dir . "/htm";
    $this->zip_dir = $this->aib_dir . "/zip";
    $this->pdf_url = $this->aib_url . "/pdf";
    $this->htm_url = $this->aib_url . "/htm";
    c9897c7a256c98 7 afcb6cea470
48 7 9897c7a2
    $this->pdf_user_dir = $this->aib_dir . "/pdf/" . trim($_SESSION[id]);
    $this->htm_user_dir = $this->aib_dir . "/htm/" . trim($_SESSION[id]);
    $this->zip_user_dir = $this->aib_dir . "/zip/" . trim($_SESSION[id]);
    $this->array_helpers = new Array_Helpers();
    e1e9999c7458f9c d 2b1ee01843
986ce1e9999c
    $this->max_filesize_bytes = 2097152;
    // limited to 2M on doteasy
    $this->max_filesize_megabytes = $this->bytes2megabytes($this->max_filesize_bytes);
    $this->memory_limit_megabytes = 128;
    b319c8c6bdbbacb5aae5c3b30b03
f22 b 19c8c6 dbbac 5aae5 3b3 b03
f 26b319c8c6 dbba b5aae5 3b 0b03 f226b3 9c8c6bdbb cb5aae c3b30b03
f 26 31 c8c6bdbb cb5aa 5c3b3 b03
f 26b319c8 6bd bacb5 ae5 3b30b 3
f226b3 9c8 6bd bacb5aa 5c3b30b03 f226b 19c8c6bdbba b5a e5c3b30b03
f 26b31 c8c6 dbbacb5aa 5c3b30b03 f226 319c8 6bdbba b5aa 5c3b30b0 
f226b319 8c6bdbbac 5aae c3b3 b03
f2 6b 19c8c bdbbacb5a e5c3b30b0 
f226 319c8c bdb ac 5aa 5c3b30b 3
f22 b31 c8c6b bbacb aae5c3 30b03
f2 6b319c8c6 dbba b5 ae5c3 30b03
f22 b319 8c6bd bacb5aa 5c3b 0b03
f 26b3 9c c6bd bac 5aae5c b30b0 
f226b3 9c8c6bd bacb5aae5 3b3 b03
f22 b319 8c6bd bacb5aae5 3b 0b03
f 26b3 9c8c6bd bacb5 ae5c3b30 03
f226b31 c8c6bdbb cb5aae5c3 30 03
f 26b3 9c8 6bdb acb aae5c3b 0b0 
f226b31 c8c6 dbbacb5aae5c3 30b03
f22 b319c c6bdbb cb5aa 5c3b30b 3
f22 b3 9c8c6 dbbacb5 ae c3b 0b03
f226 319 8c6bdbb cb5aae5c b30b03
f 26b31 c8c bdbba b5 ae5c3b30b 3
f226b3 9c8c6b bbacb5a e5c3b30b03
f 26b3 9c8c6 dbbacb5a e5 3b30 03
f22 b319 8c6bdbbacb aae5c b30b03
 2 6b319c8c6bdb acb5a e5c3 30b0 
f226b319c c6bdbb cb5aae c3b30b03
f 26b319c8c bdbba b5aae5 3b30b 3
f 26b3 9 8c bdb acb5aa 5c3b30b0 
f22 b319c8c bdb acb5a e5 3b 0b03
f2 6b319c8c6b bbacb aae5c3 30b03
f 26b319c c6bdb acb5a e5c3b30b03
 226b319c c6bdb acb5aae5c3b3 b03
 226 31 c8c6b bbacb5aae c3b30b03
 22 b319c8c bdbbacb aae c3b30b03
f 26b319c8 6bdbbacb aae5c b30b03
f22 b 19c8c bdbba b5aae5c b30b03
f 26b319 8c6bdbba b5aae5 3b30 03
f226 319c8 6bdb acb5aa 5c3b30b 3
f226b 19c8c6bdbb cb5aa 5c3b30b0 
f226 319c c6bdbb cb5aae c3b30 03
f226b3 9c8c6bdb acb5aae5c b30b0 
f226b3 9c8c6bdbba b5aae5c b30 03
 226b31 c8c6bd bacb5 ae5c3b30b 3
f226b 19c8 6b bb cb5 ae5c3 3 b03
f 26b319c8c6b bbacb5 ae5c3 30b03
 226b31 c8c6bd bacb5a e5c3b30b 3
f226b319c c6bdbb cb5aa 5c3b30b03
 226b319 8c6b bbacb5aa 5c3b30 03
f226 319c8 6bdb acb5aa 5c3b30b03
f2 6b319c c6bdb acb5 ae c3b30b0 
f2 6b319c8c6 dbbac 5aa 5c3b 0b 3
f226b319c c6bdbbacb5aa 5c3 30b03
f2 6b319c8c bdb acb5aae5c3 30b 3
f226b31 c8c6bdbba b5a e5c3b30b 3
f226b31 c8 6bdbbacb5a
  }
  public static function topnav()

  {
    522054 fd
<p style="color:#000000;">
<b><a href="/marketing/list/">My iBlasts</a> | <a href="/marketing/form/">Create iBlasts</a> | <a id="help" style="cursor:pointer"><u>Help</u></a> | <a href="/logout/">Logout</a></b>
</p>
';
  de
  public function get_allowed_exts_return_msg()

  {
    // return mesage for user
    9ed1b4d71d20fafa36051bcc3 6 
83fc9ed1b4d71d20fafa36051bcc3868
8
    $i = 0;
    $str = "";
    foreach($image_extensions_allowed AS $v) {
      if ($i == sizeof($image_extensions_allowed) - 1) {
        86953f 0 cf d4c
      }
      else if ($i > 0) {
        $str.= ", ";
      }
      40ec08 f5db
      $i++;
    }
    return $str;
  }
  4aa9ee 6857336d 55ecbee94d5e38
4a4aa9ee2

  {
    return $bytes / 1048576;
  }
  8b653e 72813932 44460df6276ed1
8

  {
    global $_values, $db, $logo_dir;
    $_FILES['logo'] = $_SESSION['logo'];
    dc0ef3fe5594785355d0 4 95825
fbc
    $error_messages = "";
    $logo_dir = $this->aib_dir . "/logos";
    $logo_name_arr = explode('.', sanitize($_FILES['logo']['name']));
    $logo_name = $logo_name_arr[0];
    4e012a11bc282a18a7125fbfb3c4
26534 01 a11 c2
      $this->tid = $v;
      $imgData = NULL;
      $imgSize = NULL;
      // rename file type to logo.xyz according to upload file type
      186e6f7381a0538ef064 b 03d
4fa c 186e6f7381a0538ef0643b303d
4fa4cd186e6f7381a05
      $logo_data = file_get_contents($_SESSION['tmp_file_upload_path']);
      $logo_size = getimagesize($_SESSION['tmp_file_upload_path']);
      $logo_max_dimensions = $this->get_logo_max_dimensions();
      $max_form_chars = $this->get_vendor_paragraph_form_max_chars();
      3b602931e0 b 1df6f53e2a3eb
7b3bd33b6 2931e 4b01df6f53e2a3eb
7b3bd33b602931e04b01df6f53e2a3
      if (strlen(trim($paragraph)) > $max_form_chars) {
        $this->paragraph = trim(substr($paragraph, 0, $max_form_chars));
      }
      else {
        7cae924eb97ec7f5 b d9d0a
a5469c217cae
      }
      $insert = "INSERT INTO marketing_responses (
      `password`,
      `paragraph`,
      09092caaf3d7f
      `logo_name`,
      `logo_filename`
      ) VALUES (
      '" . sanitize($this->password) . "',
      d7 b 8976a2f33f6d777ed3c90
c15212d73b18 7 a2f3
      '" . sanitize(addslashes($logo_data)) . "',
      '" . sanitize(addslashes($logo_name)) . "',
      '" . sanitize(addslashes($_FILES['logo']['name'])) . "'
      )";
      e44a1f9 4 95328e2a075fa492
46a827e4
      if (!$result) {
        $error_messages.= 'Form could not be saved(1)';
        $error_messages.= "<br />";
      }
      e28fcf11aeee26c06af81 4 c9
24d44
      $datetime = date('Y-m-d H:i:s', $this->timestamp_name);
      $this->pdf_user_dir = $this->create_directory($this->pdf_user_dir);
      $this->htm_user_dir = $this->create_directory($this->htm_user_dir);
      $this->zip_user_dir = $this->create_directory($this->zip_user_dir);
      c711cc52872c718ec3f0238c4e
d78ef c 11cc52872c718ec3f0238c4e
d78ef7c711cc52872c 1 ec3 0 38c4e
d78ef7c711cc52872c718e
      $this->zip_user_templatename_dir = $this->create_directory($this->zip_user_dir . "/" . $this->tid2templatename());
      $this->htm_user_templatename_dir = $this->create_directory($this->htm_user_dir . "/" . $this->tid2templatename());
      $this->htm_user_templatename_timestamp_dir = $this->create_directory($this->htm_user_templatename_dir . "/" . $this->timestamp_name);
      $this->pdf_user_filepath = $this->pdf_user_templatename_dir . "/" . $this->timestamp_name . ".pdf";
      44ffddf1dd0f8ade9c97e669 f 6807b044ffddf1dd0f8ade9c97e6693f 6 07b 4 ffddf1dd0f8ade9c97e66 3 
6807b044ffddf1
      // $this->htmprint_user_filepath = $this->htm_user_templatename_dir."/index-print.html";
      $this->zip_user_filepath = $this->zip_user_templatename_dir . "/" . $this->timestamp_name . ".zip";
      $this->pdf_user_url = $this->pdf_url . "/" . trim($_SESSION['id']) . "/" . $this->tid2templatename() . "/" . $this->timestamp_name . ".pdf";
      $this->htm_user_url = $this->htm_url . "/" . trim($_SESSION['id']) . "/" . $this->tid2templatename() . "/" . $this->timestamp_name;
      d9 56e9373e89e
      // $this->htmprint_user_url = $this->htm_url."/".trim($_SESSION['id']) . "/" . $this->tid2templatename()  . "/" . $this->timestamp_name."/index-print.html";//index.html
      $this->zip_user_url = $this->zip_url . "/" . trim($_SESSION['id']) . "/" . $this->tid2templatename() . "/" . $this->timestamp_name . ".zip";
      $this->htm_user_url_templatename = $this->htm_user_url . "/" . $this->tid2templatename();
      $this->htm_user_url_templatename_timestampname = $this->htm_user_url_templatename . "/" . $this->timestamp_name;
      d784c13b7ce5801ea1737c05c3
 4 00cd784c13b7ce5801ea1737 0 c3
34c00cd784c13b7ce5801ea1737c0 c 
34 0 cd784c13b7ce5801ea173 c 5c3
34c00cd
      $this->zf_pdf_user_url = $this->pdf_url . "/" . trim($_SESSION['id']) . "/" . $this->tid2templatename() . "/" . $this->timestamp_name . "_zf.pdf";
      $this->tcpdf_pdf_user_filepath = $this->pdf_user_filepath = $this->pdf_user_templatename_dir . "/" . $this->timestamp_name . "_tcpdf.pdf";
      $this->tcpdf_pdf_user_url = $this->pdf_url . "/" . trim($_SESSION['id']) . "/" . $this->tid2templatename() . "/" . $this->timestamp_name . "_tcpdf.pdf";
      // remove _tcpdf pre extension for live site
      cbe2973a1f9c09160dc758eaf6
ef0 0 cbe2973a1f9c09160dc758ea 6 ef0e0dcbe2973a1f9c09160dc758eaf6 e 0e0 c e2973a1f9c09160dc758e f 
ef0e0dc
      $this->tcpdf_pdf_user_url = $this->pdf_url . "/" . trim($_SESSION['id']) . "/" . $this->tid2templatename() . "/" . $this->timestamp_name . ".pdf";
      $this->template_htm_texts_arr = $this->get_template_htm_texts();
      $this->htm_create($logo_data, $logo_max_dimensions);
      file_put_contents($this->htm_user_templatename_timestamp_dir . "/images/" . $_FILES["logo"]["name"], $logo_data);
      1a79b02ea900dc3 b 62f8cbf3
a4c12b1a79b02ea900dc3eb462f8cbf3
a4c12b1a79b02ea900dc e 462f8cbf3
 4 12b1a79b02ea900dc3eb462f cbf3
a4c12b1a79b02ea900dc3eb462f8cbf3
a4c1 b a79b02ea90 d 3eb462f8cbf3
a4c12b1a 9b02ea900dc3eb462f8cbf3
a4c12b1a79b02ea900dc3eb46 f8cbf3
a4c12b1a79b02ea900dc3eb462f8cbf3
a4c12b1a79b0
      $this->tcpdf_modify();
      $this->zip_create();
      $sql = "INSERT INTO
      marketing_generated (
      ea8f6a279f7b
      `generated_on`,
      `pdf_path`,
      `htm_path`,
      `zip_path`,
      aedd69f0dfb
      `htm_url`,
      `zip_url`,
      `zf_pdf_path`,
      `zf_pdf_url`,
      65bad4ebeba23be418
      `tcpdf_pdf_url`,
      `dompdf_pdf_path`,
      `dompdf_pdf_url`,
      `htmprint_path`,
      a3ca235e26b75c5
      ) VALUES (
      '" . addslashes($this->password) . "',
      '" . $datetime . "',
      '" . addslashes($this->pdf_user_filepath) . "',
      4d 2 18c5cb3868de9723f6da7
9d47ad4d82c18c c 3868
      '" . addslashes($this->zip_user_filepath) . "',
      '" . addslashes($this->pdf_user_url) . "',
      '" . addslashes($this->htm_user_url) . "',
      '" . addslashes($this->zip_user_url) . "',
      49 e 643f69e5a3b74433bf2c8
ae8c69490ed643f69 5 3b74
      '" . addslashes($this->zf_pdf_user_url) . "',
      '" . addslashes($this->tcpdf_pdf_user_filepath) . "',
      '" . addslashes($this->tcpdf_pdf_user_url) . "',
      '" . addslashes($this->dompdf_pdf_user_filepath) . "',
      06 e 909ce844eea69fb052ad8
055418068ec909ce 4 eea6
      '" . addslashes($this->htmprint_user_filepath) . "',
      '" . addslashes($this->htmprint_user_url) . "'
      )";
      $result = $db->sql_query($sql);
      2b 39a5d0c249 ab
        $error_messages.= 'Form could not be saved(3)';
        $error_messages.= "<br />";
      }
      // max_ids for marketing customers table from previous 2 inserts
      a84861ba9a267446 e b157a2c
412df8a84861ba9 267446aecb157a2c
412df8a
      $max_generated_id = $this->get_max_id("id", "marketing_generated");
      // NEW TABLE
      $insert = "INSERT INTO marketing_customers (
      `cid`,
      46fa97c
      `response_id`,
      `generated_id`
      ) VALUES (
      " . sanitize(trim($_SESSION[id])) . ",
      b 1 4aca8c7d8c09f2c61f0b3f 8 ec5
      " . ($max_response_id) . ",
      " . ($max_generated_id) . ")";
      $this->generated_ids[] = $max_generated_id;
      $result = $db->sql_query($insert);
      7d 0635eeb301 2d
        $error_messages.= 'Form could not be saved(2)';
        $error_messages.= "<br />";
      }
      $form_id = $this->purifier->purify($_GET['form']);
      cd 6b037c78bef9ab96 b2 ea1
c7c13acde6b037c78 ef
        $this->deteleInProgress($form_id);
      }
      sleep(1);
      // for slower connections
    20
    // foreach($_POST['pdf_template_ids'] AS $v)
    return $error_messages;
  }
  /**
   e8e9f9 1909 37fa 23e 874d1c6 
2c4e e9f9d 90 437f 323e8874d c68 2c4e e9f9d19
   */
  public function htm_create($logo_data, $logo_max_dimensions)

  {
    5b2104ccaea9fd80b4b6419e7698
9a895b2104ccaea f 80b b 419e7698
9a895b2104ccaea9fd80b4b641 e 698
9a895b2104ccaea9fd80b4b6419e7698
9a895b21
    $vendor_htm_fileline = $this->get_template_vendor_htm_fileline();
    $vendor_htm_logo_tag_style = $this->get_template_vendor_htm_logo_tag_style();
    $filename_htm_background = $this->get_template_filename_htm_background();
    // 11/2/2011 update to create from templates_template direwctory for previewing right column template text
    37 39 1bb95 b5a26ea7a255e1ed
f1be3793941bb950b5a26ea7a2 5e1e 
f1be37 39 1bb 50b5a26e 7a255e1ed
 1be37
    // $lines = $this->array_helpers->array_readfile($this->htm_user_templatename_timestamp_dir . "/index.html");
    if (is_file($this->htm_user_templatename_timestamp_dir . "/index.html")) unlink($this->htm_user_templatename_timestamp_dir . "/index.html");
    copy("/home/edgebps2/public_html/marketing/templates/htm/templates_template/index.html", $this->htm_user_templatename_timestamp_dir . "/index.html");
    $lines = $this->array_helpers->array_readfile($this->htm_user_templatename_timestamp_dir . "/index.html");
    17 0506b1 8d154 94a1 568eec 
2 6117d050
    $logo_tag = '<img id="vendor_logo" style="' . $vendor_htm_logo_tag_style["vendor_htm_logo_tag_style"] . '" src="images/' . $this->htm_logo_name . '" alt="iBlast Vendor Logo" />';
    $lines = $this->array_helpers->array_insert($lines, $logo_tag, $vendor_htm_fileline["vendor_htm_fileline_inserttext"]);
    $vendor_paragraph_tags = $this->get_htm_paragraph_vendor();
    $vendor_open_tag = $vendor_paragraph_tags["vendor_paragraph_htm_open_tag"];
    4a63cb05a71a7117f 1 58f210f5
305c4a63cb05a71a7
    $vendor_close_tag = $vendor_paragraph_tags["vendor_paragraph_htm_close_tag"];
    $vendor_paragraph_htm = $vendor_open_tag . $vendor_paragraph . $vendor_close_tag;
    $paragraph_tag = '  ' . $vendor_paragraph_htm;
    $lines = $this->array_helpers->array_insert($lines, $paragraph_tag, $vendor_htm_fileline["vendor_htm_fileline_inserttext"]);
    6b 12 eb7 f45fed7 f18a e8 b7
631e6 c121eb7
    for ($i = 0; $i < sizeof($this->template_htm_texts_arr); $i++) {
      /*
      $template_htm_texts =
      $this->template_htm_texts_arr[$i]["template_text_htm_open_tag"].
      b2fdf1c01461b4d4cf01d4c1e5
cfb50db2fdf1c01461b4d4cf0
      $this->template_htm_texts_arr[$i]["template_text_htm_close_tag"];
      */
      $template_text = substr($this->template_htm_texts_arr[$i]['template_text'], 0, $this->template_htm_texts_arr[$i]['template_text_maxchar']);
      $template_htm_texts = $this->template_htm_texts_arr[$i]["template_text_htm_open_tag"] . $template_text . $this->template_htm_texts_arr[$i]["template_text_htm_close_tag"];
      efcb49 f 91534f5409d400e35
908d72efcb499fe91534f540 d400e35
908d72efcb49 fe91534f5409d400e35
908d72efcb499fe91534f5409d400e35
908d
    }
    // DO NOTE DELETE: MOVED TO TEMPLATE CREATE, CONTINUE TO USE ON INITIAL ITERATION FOR TIDS 1-10
    // where tids >10 insert background image when creating template using template name
    // 10/31/2011 REMOVED, MANUALLY ADDED TO TEMPLATES IN TEMPLATES DIRECTORY
    9c 6ae784bda 86f6a30 b21 931
96e7 c46ae 84 da0 6f6a3 ab21 931
96e79c46ae784b a086f6a30 b211931
9
    $bacgkround_img_tag = ' <img id="background-img" class="bg" src="images/' . $filename_htm_background[filename_htm_background] . '" alt="iBlast" />';
    $lines = $this->array_helpers->array_insert($lines, $bacgkround_img_tag, $vendor_htm_fileline["vendor_htm_fileline_insertbacgkroundimg"]);
    /*
    if($this->tid<=10) {
    19106950c4002714c69 2 6 ca3c cf2019106950c400271 c6922d6eca c
cf2019106950c4002714c6922d6eca3c
cf2019106950c4002714c6922d6eca3 
cf201910695 c4002
    $lines = $this->array_helpers->array_insert($lines,$bacgkround_img_tag,$vendor_htm_fileline["vendor_htm_fileline_insertbacgkroundimg"]);
    }
    */
    $this->array_helpers->array_writefile($this->htm_user_templatename_timestamp_dir . "/index.html", $lines);
  ea
  /**
   Create existing user PDF from HTML
   */
  public function tcpdf_modify()
9
  {
    // 11/2/2011 update, rebuild template without placeholders
    // $this->pdf_create_template_preview($this->tid2templatename($this->tid),0);
    // $this->save_images_template_add_pdf($this->tid2templatename($this->tid));
    ee47994b3a1ea837e 8 02125c88
cd81ee47994b3a1ea837ed
    $pdf = & new FPDI();
    // $pdf->setPageUnit("mm"); // this is the default
    $pdf->setPageUnit("pt");
    // $pdf->setPageUnit("in");
    52f3b897f304de49dc954716f687
 74 52f3b
    $pdf->setPDFVersion("1.4");
    $pagecount = $pdf->setSourceFile($this->tid2templatefilename());
    $tplidx = $pdf->importPage(1);
    $pdf->AddPage('P', array(
      12496b73b32fcaa7f7384f7566
ae63c112496b 3 32fc
      $tcpdf_dimensions["tcpdf_height_inches"] * 72
    ));
    $pdf->useTemplate($tplidx, 0, 0, $tcpdf_dimensions["tcpdf_width_inches"] * 72, $tcpdf_dimensions["tcpdf_height_inches"] * 72, false);
    // 11/2 update, for trimming to max char width
    2f3ab7ab3cf3574b05f87901fcac
 3 72f3ab7ab3cf3574b05f87901fcac
53672f3ab7ab3cf357
    $html = "";
    $template_htm_texts = "";
    for ($i = 0; $i < sizeof($this->template_htm_texts_arr); $i++) {
      $template_text = substr($this->template_htm_texts_arr[$i]['template_text'], 0, $this->template_htm_texts_arr[$i]['template_text_maxchar']);
      b3bb1e5ed3d56e9160a 5 0924
54d441b3bb1e5ed3d56e9160ae580924
54d441b3bb1e5ed3d56e9160ae5 0 24
54d441b3bb1 5 d3d56e9160ae580924
54d441b3bb1e5ed3d56e9160ae580924
54d441b3bb1e5ed3
      $html.= $template_htm_texts;
    }
    $vendor_paragraph_form_max_chars = $this->get_vendor_paragraph_form_max_chars();
    $vendor_paragraph_tags = $this->get_tcpdf_paragraph_vendor();
    e010a30c709f9600b6d8e937f3f1
 6 ae010a30c709f9600b6d8e937f3f1
566
    $vendor_open_tag = $vendor_paragraph_tags["vendor_paragraph_tcpdf_open_tag"];
    $vendor_paragraph = (trim($template_text));
    $vendor_paragraph = trim($this->paragraph);
    $vendor_close_tag = $vendor_paragraph_tags["vendor_paragraph_tcpdf_close_tag"];
    7afcd7d 890c864f627821a5 a a
0eaf7afcd7d5890 8 4f627821a55ada
0eaf
    list($width, $height, $type, $attr) = getimagesize($this->htm_user_url . '/images/' . $this->htm_logo_name);
    // reduce image to half size for pdf
    $width = $width * .50;
    $height = $height * .50;
    82c00593b09ea58ed519e0ae e c
6bb782c00593b09ea58ed519e0aebe8c
    $pdf->writeHTMLCell($pdf_template_vendor_arr["vendor_paragraph_tcpdf_width"], $pdf_template_vendor_arr["vendor_paragraph_tcpdf_height"], $pdf_template_vendor_arr["vendor_paragraph_tcpdf_left_x"], $pdf_template_vendor_arr["vendor_paragraph_tcpdf_top_y"], $html, 1, 2, 1, true, '', true);
    $pdf->Output($this->tcpdf_pdf_user_filepath, 'F');
    /** ZF for uploaded logo */
    $pdf = Zend_Pdf::load($this->tcpdf_pdf_user_filepath);
    e1 3b09 c528 52ff 5a1b 6a436
1e 1e c3b0 4c528
    $pdf_page = $pdf->pages[0];
    // exit;
    // Vendor image
    $image = Zend_Pdf_Image::imageWithPath($this->htm_user_templatename_timestamp_dir . "/images/" . $this->htm_logo_name);
    96 45d3 eee576
    $pdf_page->drawImage($image, $pdf_template_vendor_arr["vendor_logo_pdf_left_x"], $pdf_template_vendor_arr["vendor_logo_pdf_bottom_y"], $pdf_template_vendor_arr["vendor_logo_pdf_left_x"] + $width, $pdf_template_vendor_arr["vendor_logo_pdf_bottom_y"] + $height);
    $pdf->save($this->tcpdf_pdf_user_filepath);
  }
  /**
   61048e 48c 35 7ff 0ce99b33 86
8f 61 48e3 8cf3567ff 0ce 9b33 86
8f86
   */
  public function zip_create()

  {
    d6006fae458bc9f1bafe82d6ce5f
c341d6006fae458bc9f1bafe82d6ce5f
 341d6006fae458bc9f1bafe82d6
  }
  public function get_max_id($id_name, $tbl_name)

  {
    b90f6b c1289
    $q = "SELECT MAX(" . $id_name . ") AS max_id FROM " . $tbl_name;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    if (!isset($rowset[0]["max_id"])) return 1;
    bd40b1 cbc1b6a9beaaf68fe5c10

  }
  public function line_wrap_zend_pdf_vendor($pdf_page, $pdf_vendor_arr)

  {
    97 3 e2 3382 397 268ae5
    $tmp_str = wordwrap($this->paragraph, $pdf_vendor_arr["vendor_paragraph_pdf_wordwrap_charwidth"], '\n');
    $tmp_arr = explode('\n', $tmp_str);
    $tmp_y = $pdf_vendor_arr["vendor_paragraph_tcpdf_top_y"];
    for ($j = 0; $j < sizeof($tmp_arr); $j++) {
      bc2189174ca80dbdd88f88cb33
459dabbc2189174ca80dbdd88f88cb33
459dabbc2189174ca80dbdd88f88cb33
459dabbc2189174ca80dbdd8 f88cb33
459dabbc2189174ca80dbdd88f88cb33
459dabbc 189174ca8
      $tmp_y = $tmp_y - $pdf_vendor_arr["vendor_paragraph_pdf_wordwrap_linespace"];
    }
    return $pdf_page;
  }
  fef642 92c0eb0c 8e2b4e8c798a1c
d9fef642c92c0eb0cf8e2b4 8c798a1c
d9fef642c 2c0e

  {
    // i == loop arr index
    $tmp_str = wordwrap($pdf_template_arr[$i]["template_text"], $pdf_template_arr[$i]["template_text_pdf_wordwrap_charwidth"], '\n');
    7edf01c4 5 5b0013aecff26 e62
e5757ed
    $tmp_y = $pdf_template_arr[$i]["template_text_pdf_bottom_y"];
    for ($j = 0; $j < sizeof($tmp_arr); $j++) {
      $pdf_page->setFillColor(Zend_Pdf_Color_Html::color($pdf_template_arr[$i]["template_text_pdf_color_html"]))->drawText($tmp_arr[$j], $pdf_template_arr[$i]["template_text_pdf_left_x"], $tmp_y);
      $tmp_y = $tmp_y - $pdf_template_arr[$i]["template_text_pdf_wordwrap_linespace"];
    00
    return $pdf_page;
  }
  public function get_pdf_template()

  94
    global $db;
    $q = "
      SELECT
      template_text,
      082ac171626e15077b3d09b8b2
43
      template_text_pdf_font_size,
      template_text_pdf_left_x,
      template_text_pdf_bottom_y,
      template_text_pdf_wordwrap_charwidth,
      ff398966495f2273d2381614e7
541d69ff398
      template_text_pdf_color_html
      FROM marketing_templates_text t
      WHERE t.tid=" . $this->tid;
    $r = $db->sql_query_limit($q, NULL);
    9b302bf e e5aeac3aade1272ecf
b09c9b3
    return $rowset;
  }
  public function get_pdf_template_vendor()

  d9
    global $db;
    $q = "
      SELECT
      vendor_logo_pdf_left_x,
      b2e8d6865dacb3e9d888e79f26
      vendor_paragraph_pdf_font_name,
      vendor_paragraph_pdf_font_size_px,
      vendor_paragraph_tcpdf_left_x,vendor_paragraph_tcpdf_top_y,
      vendor_paragraph_tcpdf_width,vendor_paragraph_tcpdf_height,
      2d89b79c07fba0b30d8e3ea
      vendor_paragraph_pdf_wordwrap_charwidth,
      vendor_paragraph_pdf_wordwrap_linespace
      FROM marketing_templates t
      WHERE t.tid=" . $this->tid;
    09 a 4d0e443a4699299e8a0c2b2
 0820
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0];
  }
  public function get_tcpdf_dimensions()
7
  {
    global $db;
    $q = "
      SELECT
      2010f780a315885674eda6d569
72b2fb2010f7
      FROM marketing_templates t
      WHERE t.tid=" . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    87a760 2c07f45e7e9c
  }
  public function get_htm_paragraph_vendor()

  {
    8aa171 f28d1
    $q = "
      SELECT
      vendor_paragraph_htm_open_tag,vendor_paragraph_htm_close_tag
      FROM marketing_templates t
      1b221 5d67ff2 3 a06bea915f
7
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0];
  }
  da008d 569e2d5d 34bb5c98addc87
06da008d4569e2

  {
    global $db;
    $q = "
      4c5f831
      vendor_paragraph_tcpdf_open_tag,vendor_paragraph_tcpdf_close_tag
      FROM marketing_templates t
      WHERE t.tid=" . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    1ff63e1 e d80f3602c3534b1dd7
7c751ff
    return $rowset[0];
  }
  public function image_resize($src, $dst, $width, $height, $crop = 0)

  ba
    // ini_set('memory_limit', $this->memory_limit_megabytes.'M');
    if (!list($w, $h) = getimagesize($src)) return "Unsupported picture type!";
    $type = strtolower(substr(strrchr($src, ".") , 1));
    if ($type == 'jpeg') $type = 'jpg';
    9ef5e0 73e0292 ee
    case 'bmp':
      $img = imagecreatefromwbmp($src);
      break;

    19f8 6f9c130
      $img = imagecreatefromgif($src);
      break;

    case 'jpg':
      48e0 d 934b9bb089c6b4a078e
7a2f134
      break;

    case 'png':
      $img = imagecreatefrompng($src);
      5d339ae

    default:
      return "Unsupported picture type!";
    }
    60 ff52ac4
    if ($crop) {
      // if($w < $width or $h < $height) return "Picture is too small!";
      if ($w < $width or $h < $height) {
        copy($src, $dst);
        8ceb4d 52529 f9 cdb 8202
0  d550 8ce 4d552529bf9
      }
      $ratio = max($width / $w, $height / $h);
      $h = $height / $ratio;
      $x = ($w - $width / $ratio) / 2;
      a7 c 2408bc b cc5637de
    }
    else {
      // if($w < $width and $h < $height) return "Picture is too small!";
      if ($w < $width or $h < $height) {
        38ef70765f 8ce1bc2
        return "Logo is too small.  Logo not resized.";
      }
      $ratio = min($width / $w, $height / $h);
      $width = $w * $ratio;
      db54c95 9 d5 5 82dd4a8d
      $x = 0;
    }
    $new = imagecreatetruecolor($width, $height);
    // preserve transparency
    6a 561ea6 6b 2289f 5a 1c34d 
d 7c6a25 1e
      imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
      imagealphablending($new, false);
      imagesavealpha($new, true);
    }
    83d5f6f269ffd27fe388f5e6 fa8
f e4 3d f6f 69 fd27fe3 8f5e63fa 
f9 483d5
    switch ($type) {
    case 'bmp':
      imagewbmp($new, $dst);
      break;
4
    case 'gif':
      imagegif($new, $dst);
      break;

    0d05 1498e21
      imagejpeg($new, $dst);
      break;

    case 'png':
      fbe5736d70cd6d 1d96e98
      break;
    }
    return true;
  }
  f05a86 b8f53bce 268e408badaab3
47f05a868b8f53bce126

  {
    global $db;
    $q = "
      ff618c2
      vendor_htm_fileline_inserttext,
      vendor_htm_fileline_insertbacgkroundimg
      FROM marketing_templates
      WHERE tid=" . $this->tid;
    75 7 c32677e15eeeefd4ef9bbed
 e517
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0];
  }
  public function get_template_vendor_htm_logo_tag_style()
d
  {
    global $db;
    $q = "
      SELECT
      5a3a329bca5ac6c201d97f6d74
      FROM marketing_templates
      WHERE tid=" . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    26c23b 080a356f34d4
  }
  public function get_template_filename_htm_background()

  {
    74449e bb429
    $q = "
      SELECT
      filename_htm_background
      FROM marketing_templates
      da1b0 c80d8 7 4d26a6305a4b
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0];
  }
  a39581 c2242dd9 bc2915c3e8b5cb
70a39581dc

  {
    global $db;
    $q = "
      8b9ab46
      template_text,template_text_maxchar,
      template_text_htm_open_tag,template_text_htm_close_tag,
      template_text_tcpdf_open_tag ,template_text_tcpdf_close_tag
      FROM marketing_templates_text
      99718 dc521 3 f56d288256 5 4a
      ORDER BY weight DESC";
    $r = $db->sql_query_limit($q, NULL);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset;
  32
  public function get_vendor_paragraph_form_max_chars()

  {
    global $db;
    70 9 42
      SELECT
      vendor_paragraph_form_max_chars
      FROM marketing_templates
      WHERE tid=" . $this->tid;
    94 8 bb644bfff57779ab60a1684
 2be9
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0]["vendor_paragraph_form_max_chars"];
  }
  public function get_logo_max_dimensions()
c
  {
    global $db;
    $q = "
      SELECT
      4c70c2cfd917e28530a12b0784

      vendor_logo_max_width_px
      FROM marketing_templates
      WHERE tid=" . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    f5e0600 5 0dac04a2f2573654a9
f574f5e
    return $rowset[0];
  }
  public function generatedid2responseid($generated_id)

  c6
    global $db;
    $q = "
      SELECT response_id FROM marketing_customers
      WHERE generated_id=" . $generated_id;
    2c b 88d3bdbf9ccaef7487f816d
 3362
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0]['response_id'];
  }
  public function generatedid2dirpaths($generated_id)
e
  {
    global $db;
    $q = "
      SELECT pdf_path,htm_path,zip_path,
      d29d6c287ea a4f16ab0eb349b
d9be62d29d6c287ea
      FROM marketing_generated
      WHERE id=" . $generated_id;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    7740c3 eeba572c007e
  }
  public function deleteGenerated($formid)

  {
    17477b 0b6d2
    $generated_id = $formid;
    // formid is generated_id, id of table _generated
    $response_id = $this->generatedid2responseid($generated_id);
    $dirpaths = $this->generatedid2dirpaths($generated_id);
    55 e132fd084bbb5ac7f435a385f
7e78554e1 2f
      // from selected, delete from lowest to highest tiers
      unlink($dirpaths["zf_pdf_path"]);
      // delete file
      // delete all empty directories and subdirectories in user account directory
      30d7dec2352687b33cb60ccc97
ae881530d7dec2352687b33cb60ccc97
ae
      // delete empty dirs in this user account directory
      $this->recurse_delete_empty_directories($this->pdf_dir);
      // delete empty dirs in pdf directory i.e. account dirs
    }
    52 3442363b5fa4038095634ae87
c41a52734423 3b
      // from selected, delete from lowest to highest tiers
      unlink($dirpaths["tcpdf_pdf_path"]);
      // delete file
      // delete all empty directories and subdirectories in user account directory
      f6544ec726ddc59644ffec7198
02b6f6f6544ec726ddc59644ffec7198
02
      // delete empty dirs in this user account directory
      $this->recurse_delete_empty_directories($this->pdf_dir);
      // delete empty dirs in pdf directory i.e. account dirs
    }
    f1 6334caa0e25f3385acdc3ccb5
31c5f146334ca 0e
      // from selected, delete from lowest to highest tiers
      unlink($dirpaths["dompdf_pdf_path"]);
      // delete file
      // delete all empty directories and subdirectories in user account directory
      90c39da11c99b403562b3a25af
17873890c39da11c99b403562b3a25af
17
      // delete empty dirs in this user account directory
      $this->recurse_delete_empty_directories($this->pdf_dir);
      // delete empty dirs in pdf directory i.e. account dirs
    }
    9b 4bffa0e9b95e87f75426a2b9d
a4599b 4b
      // from selected, delete from lowest to highest tiers
      unlink($dirpaths["pdf_path"]);
      // delete file
      // delete all empty directories and subdirectories in user account directory
      198f53427eaa9a237a7f701b08
5d2ae5198f53427eaa9a237a7f701b08
5d
      // delete empty dirs in this user account directory
      $this->recurse_delete_empty_directories($this->pdf_dir);
      // delete empty dirs in pdf directory i.e. account dirs
    }
    b8 70fbe250972c85fac6fe5ce7e
f33ab8c70fbe25 97
      // from selected, delete from lowest to highest tiers
      $this->recurse_delete_directory(dirname($dirpaths["htm_path"]));
      // ts directory
      // delete all empty directories and subdirectories in user account directory
      b5a59d54e8b21e367bdfb645b4
7b8eedb5a59d54e8b21e367bdfb645b4
7b8eedb5a5 d 4e8b21e3
      // delete empty template name directories
      $this->recurse_delete_empty_directories($this->htm_user_dir);
      // delete empty dirs in this user account directory
      $this->recurse_delete_empty_directories($this->htm_dir);
      cd 380a45 4545c 6637 f7 dd
 e25f8cd33 0a45 4545cc6 375f7
    }
    if (is_file($dirpaths["zip_path"])) {
      // from selected, delete from lowest to highest tiers
      unlink($dirpaths["zip_path"]);
      24 731ba6 083c2
      // delete all empty directories and subdirectories in user account directory
      $this->recurse_delete_empty_directories($this->zip_user_dir);
      // delete empty dirs in this user account directory
      $this->recurse_delete_empty_directories($this->zip_dir);
      b6 89610e e0767 19f3 be ea
 0473ab6d8 610e e0767c1 f3dbe
    }
    // delete from filesystem htm, pdf, and zips referenced in marketing generated
    $sql = "DELETE FROM marketing_responses WHERE id=" . $response_id;
    $result = $db->sql_query($sql);
    7b93 d ea32a7f bca5 0e6cc932
bd967b93cd ea32a fabc 5 0e6cc932
bd967b
    $result = $db->sql_query($sql);
    $sql = "DELETE FROM marketing_customers WHERE generated_id=" . $generated_id;
    $result = $db->sql_query($sql);
  }
  b13bbb a45b136d 4404d83b0eb826
c6b13bbb

  {
    global $db;
    $q = "SELECT filename FROM marketing_templates WHERE tid = " . $this->tid;
    e7 e fa7dad085e4a14b66d5e009
 4bae
    $rowset = $db->sql_fetchrowset($r);
    return $this->pdf_templates_dir . "/" . $rowset[0]['filename'];
  }
  public function tid2templatepathfull()
d
  {
    global $db;
    $q = "SELECT pathfull FROM marketing_templates WHERE tid = " . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    e8c68f6 7 9b66d40869c89f8cae
2cf9e8c
    return $this->pdf_templates_dir . "/" . $rowset[0]['filename'];
  }
  public function tid2templatename()

  19
    global $db;
    $q = "SELECT name FROM marketing_templates WHERE tid = " . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    561e86 483d7826a70796cecfaf
  }
  public function password2cid()

  {
    8bf25f 25b84
    $q = "SELECT filename FROM marketing_templates WHERE tid = " . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $this->pdf_templates_dir . "/" . $rowset[0]['filename'];
  a9
  public function is_empty_folder($folder)

  {
    $c = 0;
    2b 1997eab99f9aeef07 0e
      $files = opendir($folder);
      while ($file = readdir($files)) {
        $c++;
      }
      b1 124 2 27 2d
        return false;
      }
      else {
        return true;
      1f
    }
  }
  public function recurse_delete_empty_directories($dir)

  f6
    if (is_dir($dir)) {
      $objects = scandir($dir);
      foreach($objects as $object) {
        if ($object != "." && $object != "..") {
          0f 9240795bba81c7 5 75
 e eafada40 69 40795 ba 1c705b75
4e5eafada40f6924079 b a81 7 5b75
4e5e fa
            // $this->recurse_delete_empty_directories($dir."/".$object); // recurse for empty subdirs
          }
          else if (filetype($dir . "/" . $object) == "dir" && $this->is_empty_folder($dir . "/" . $object)) {
            rmdir($dir . "/" . $object);
            43 0e1135 82bec 77b2
          }
          // ignore files
        }
      }
      ece5bb2c115e2e8ea
    }
  }
  public function recurse_delete_directory($dir)

  bc
    if (is_dir($dir)) {
      $objects = scandir($dir);
      foreach($objects as $object) {
        if ($object != "." && $object != "..") {
          35 c7a89979c000d7 5 d4
 8 7e2345c3 7c a89979 000d7d5dd4
3897e2345c357c7a89979c000 7 5dd 
 897e2345c3
          else unlink($dir . "/" . $object);
        }
      }
      reset($objects);
      6ea50d4b25eb5
    }
  }
  public function create_directory($dir)

  38
    if (!is_dir($dir)) {
      mkdir($dir);
    }
    return $dir;
  ae
  public function recurse_copy($src, $dst)

  {
    $dir = opendir($src);
    9ac8b748c35f05
    while (false !== ($file = readdir($dir))) {
      if (($file != '.') && ($file != '..')) {
        if (is_dir($src . '/' . $file)) {
          $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
        70
        else {
          copy($src . '/' . $file, $dst . '/' . $file);
        }
      }
    7f
    closedir($dir);
  }
  public function recurse_zip($source, $destination)

  5b
    if (extension_loaded('zip') === true) {
      if (file_exists($source) === true) {
        $zip = new ZipArchive();
        if ($zip->open($destination, ZIPARCHIVE::CREATE) === true) {
          81f70e7 5 83a056c683aa
7f5371
          if (is_dir($source) === true) {
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source) , RecursiveIteratorIterator::SELF_FIRST);
            foreach($files as $file) {
              $file = realpath($file);
              9f ee501e5291e689 
3e 1341b e3
                // $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                $zip->addEmptyDir($this->tid2templatename() . "/" . str_replace($source . '/', '', $file . '/'));
              }
              else if (is_file($file) === true) {
                66 449bb652b798d
23a851e0049f368066c449bb6 2 798d 23a 51e0049 368066c449bb652b798d
23a851
                $zip->addFromString($this->tid2templatename() . "/" . str_replace($source . '/', '', $file) , file_get_contents($file));
              }
            }
          }
          72df fe f70e1bc60a6f66
83 7da 77672 f9
            // $zip->addFromString(basename($source), file_get_contents($source));
            $zip->addFromString($this->tid2templatename() . "/" . basename($source) , file_get_contents($source));
          }
        }
        a3 a47 6c7 20 5086 90868
d67fe063a30a4796c7620a508
        // $zip->addFromString(basename($this->tcpdf_pdf_user_filepath), file_get_contents($this->tcpdf_pdf_user_filepath));
        $zip->addFromString($this->tid2templatename() . "/" . $this->tid2templatename() . ".pdf", file_get_contents($this->tcpdf_pdf_user_filepath));
        return $zip->close();
      }
    a0
    return false;
  }
  public function generateData($formData, $password, $customerName, &$progbar)

  73
  }
  public function getGeneratedList($password)

  {
    d2a538 16a9f
    $sql = sprintf("
        SELECT
        g.id,
        g.generated_on,
        fa1ae49e566
        g.htm_url,
        g.htmprint_url,
        g.zip_url,
        g.zf_pdf_url,
        d481fbd126509b4b6
        g.dompdf_pdf_url,
        t.display_name
        FROM
        marketing_generated g
        a274 6fad 069e79e38f550c
8e1b 4 8a 7466fad3069e79e38f55
        LEFT JOIN marketing_templates t ON t.tid=c.tid
        WHERE g.`password` LIKE '%s'
        ORDER BY g.generated_on desc", $password);
    $result = $db->sql_query($sql);
    9a 5ee0de3b5b7c7692ea f9 3f3
4ed19a 5e 0d 3b
      echo '
        <script type="text/javascript" language="javascript">
        $(document).ready(function() {
          $( "#form-submit-dialog" ).dialog({width:350});
        c603
        </script>
        <div id="form-submit-dialog" style="display:none" title="Process complete!">
        <br/><br/>
        <center><p>Your submitted iBlasts can now be downloaded.</p></center>
        999164c
        ';
    }
    if ($result) {
      $i = 0;
      b63f1a9 4 e873 c61aa8bfab8
c80612b63f1a9740e8732c61aa8bfab8
c80612b63f1
      $num_rows = mysql_num_rows($result);
      while ($row = $db->sql_fetchrow($result)) {
        $quarter = ceil(date('m', strtotime($row['generated_on'])) / 3) - 1;
        if ($quarter == 0) {
          07fe3517 b c29
        }
        $year = date('Y', strtotime($row['generated_on']));
        if ($quarter == 4) {
          $year = $year - 1;
        6f
        if (isset($_GET[gen_ids])) {
          $gen_id_just_submitted = explode(",", $_GET[gen_ids]);
          if (in_array($row['id'], $gen_id_just_submitted)) $highlight_submitted = "background-color:yellow;";
          else $highlight_submitted = "";
        de
        $fileid = $row['id'];
        $generated = date('m/d/Y h:i:s A', strtotime($row['generated_on']));
        $pdf_anchor = "<a target='_blank' href='" . $row['tcpdf_pdf_url'] . "'>PDF</a>";
        $htm_anchor = "<a target='_blank' href='" . $row['htm_url'] . "'>Web</a>";
        dce0c563873e2169 6 180 b
c96b3070dce0c 63873e2 6 86b180eb
c96b3070dce c 63873e 16986b180eb

        $zip_anchor = "<a target='_blank' href='" . $row['zip_url'] . "'>Web Zip</a>";
        $display_name = $row['display_name'];
        $output.= "<li style='padding:5px'>";
        $span_pipe = "<span style='padding-left:5px;padding-right:5px'>|</span>";
        aa258f4dc ffd13d a70459b
a89f5d94aa258f4dc2f d 3d5a70459b
a89f5d94a 2 8f4dc2
        $output.= "Generated on $generated ( CST ) " . $span_pipe . " ";
        $output.= $display_name;
        $output.= "</span>";
        $output.= "<br/>";
        c7795d1c5 10bc3d 5d1d644
3a65252fc7795d1c561 b 3df5d1d644
3a65252fc 7 5d1c56
        // $output .= $pdf_anchor." $span_pipe ".$htm_anchor." $span_pipe ".$htmprint_anchor." $span_pipe ".$zip_anchor." $span_pipe ".($num_rows-$i);
        $output.= $pdf_anchor . " $span_pipe " . $htm_anchor . " $span_pipe " . $zip_anchor . " $span_pipe " . ($num_rows - $i);
        $output.= $span_pipe . " <a id='delete-confirm-" . $fileid . "' style='cursor: pointer;'><u>Delete</u></a>";
        $output.= "</span>";
        b6ac23c78 1ec04a725
        $output.= '
<script type="text/javascript" language="javascript">
$(document).ready(function() {
$( "#delete-confirm-' . $fileid . '-dialog" ).hide();
  16d8cafe43cce83c7a91 b f102296 c 16d8cafe43cce83c7a 10 ef
    $( "#delete-confirm-' . $fileid . '-dialog" ).dialog({
      resizable: true,
      height:200,
      width:500,
      c86eb6e68 876c8e
      draggable: true,
      position: \'center\',
      modal: true,
      buttons: {
        1c48c8c 2 c b9205c060ba9
81454ef 1 48c ca2accb920 c0
          $( this ).dialog( "close" );
          // alert("delete confirmed ' . $fileid . '");
          window.location = "./delete.php?type=pdf&id=' . $fileid . '";
        },
        ed24451 6f85bdd6ae b6
          $( this ).dialog( "close" );
          // alert("delete cancelled ' . $fileid . '");
        }
      }
    d57e
  });
});
</script>
<div style="display:none" id="delete-confirm-' . $fileid . '-dialog" class="delete-confirm-' . $fileid . '-dialog"  title="Confirm Delete">
6807
<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
Please confirm deleting "' . $row["display_name"] . '", generated on ' . $row["generated_on"] . '.
All files and data pertaining to this iBlast will be permanently deleted, and cannot be recovered.
</p>
c0e8d7
<p>
</p>
</div>
                ';
        51 e87c988 3a ebcdd7cfe0
cf97c6795 8 87c988b3abebcdd c e0
cf97c679518e87c98 b abebcdd7cfe0
cf 7 67 518e87c988b3abebcdd7cfe0
cf97c679518e87c988b3abe  dd7cf 0
cf97c679518e87c988b3abebcdd7cfe0
cf 7 679518e87 98 b3abebcdd7cfe0
cf97c67951
        $i++;
      }
      $output.= '</ul>';
      if ($i == 0) {
        e92fd43 7 04439 2e64c5ec
d47fb705e92 d4347104439e2e64c5ec
d 7fb705e92 d434710 439e2e64c5ec
d4
      }
    }
    else {
      $output = '<div style="padding-left: 20px;">No generated PDFs found.</div>';
    54
    return $output;
  }
  public function get_prev_upload_count($tid)

  34
    global $db;
    $q = "
  SELECT COUNT( * ) AS cnt
  FROM `marketing_customers` c
  daf8 933154352f7020b9497 1 c8 
cada 8 933154
  WHERE c.tid = " . $tid . "
  AND c.cid=" . trim($_SESSION['id']);
    $r = $db->sql_query($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    936b93 6c389615929c62b37c901
b1
  }
  public function get_allowed_exts_list($padded)

  {
    1f 29a45c82 fa 02 1c5122 9c5
1d571 0 9a 5c820fa30261c512279c5
1d571f029a45c8
    return implode(' , ', array_unique($this->allowed_exts));
  }
  public function get_help_content($template_upload_limit, $get_allowed_exts_return_msg, $max_filesize_megabytes)

  9b
    return '
      <h3 class="basic-modal"><b>Anixter Information Blasts</b></h3>
Purpose: Create customized Anixter iBlast product microsites/minisites and PDFs for marketing iBlast products.
<br/><br/>
8c9ac defdca1 ec3 e3 d58
<a href="/marketing/form/index.php">Create iBlasts</a>,
and select product iBlasts you wish to create.
Currently, products are limited to <i><b style="color:#fffff"><span class="template_checkbox_limit"></span>
products per request</b></i>, and <i><b style="color:#fffff">' . $template_upload_limit . ' saved versions per product</b></i>.
a6f768dd774
Add a paragraph describing your company or the product your company offers.  HTML tags are supported.
<br/><br/>
Add a company logo image.
Currently, company logo uploads are limited to
bcb00 7035d62ff98274e7d795c4 c 1
bcb0057035d62ff98274e7d795 4 c 1
bcb 057035 62ff98274
within <i><b style="color:#fffff">' . $max_filesize_megabytes . ' MBs</b></i>.
Logo image dimensions are resized after upload.
<br/><br/>
After submitting your iBlast request, go to
3e 8e9dfa478c9e84cb4b48aeff0095f
3eb8e dfa478c9e84c
to view or download your iBlasts.
Anixter iBlast product microsites/minisites are styled for web and print views
and are downloaded as a ZIP file.
Previous iBlast downloads can be deleted after download to "unlock" the
9e957 0e2aa239cb92abd753e5bd e 2
9e957a0e2aa239cb92ab 7 3 5bdde 2
9e957a e2a 239cb92abd753e5 dde12
9
<br/><br/>
(press ESC or click on the upper right X to close the overlay)
      ';
  }
  889836 5607f1bc 99ae039c45b656
b488983655607f1

  {
    // set the default timezone to use. Available since PHP 5.1
    $aib = new aib();
    e1df53 140691504 13eb370dfe 
891ce1df53f1 0691 04f13eb370d
    $user = new User($_SESSION['password']);
    $user->checkPassword();
    $password = '';
    if (isset($_SESSION)) {
      7a05062e2 7 390d5a84ae1238
ec2db77a
    }
    $self = strip_tags($_SERVER["PHP_SELF"]);
    $paragraph = isset($_values["paragraph"]) ? htmlspecialchars($_values["paragraph"]) : "";
    $paragraph = isset($_values["pdf_template_ids"]) ? htmlspecialchars($_values["pdf_template_ids"]) : "";
    c8d69b31a5e 7 5aba0c6c84f621
5a
    $flashhead2 = getFlashHead(2);
    if (isset($_GET['form']) && is_numeric($_GET['form'])) {
      $hiddenform = (int)$this->purifier->purify($_GET['form']);
    }
    c7ff 6e
      $hiddenform = '0';
    }
    $customer = $_SESSION['customer_name'];
    if ($_SESSION[roles][0][rid] == 8) $q_pdf_templates = "SELECT tid,display_name,published FROM `marketing_templates` WHERE 1";
    e338 f71474565d12973a 8 55fc
45 0e338ff71474565d12973af815 fc
4 60e338ff71474565d1297 af815 fc
4560e338ff7
    $r_pdf_templates = $db->sql_query_limit($q_pdf_templates, NULL);
    $rowset = $db->sql_fetchrowset($r_pdf_templates);
    $pdf_templates_str = "";
    $template_upload_limit = TEMPLATE_UPLOAD_LIMIT;
    3b9 19e 2 85 29 7 90ec199440
d7b83 9219e 20
      $checkbox_disable = "";
      $checkbox_italics = "";
      $tid_cnt = $aib->get_prev_upload_count($rowset[$i]['tid']);
      if ($tid_cnt >= $template_upload_limit) {
        7a663b5c505489042 e 6384
ea75ff1
        $checkbox_italics = "font-style:italic;";
      }
      if ($_SESSION[roles][0][rid] == 8) {
        if ($rowset[$i]['published'] == 1) {
          329b7a1f16227ee48b1e c
7837 47fa3329 7 1f16227ee48b1e6c
 8 7847fa3329b7a1f 6 2 ee48b1e6c
7837847 a 3 9b7a1f16227ee48 1e6c
7837847fa3329b7a1f16 27ee48b1e6c
7837847fa332 b7a1f162 7 e48b1e6c
7837847fa 3 9b a1f16227ee48b1e6c
7837847fa3329b7 1f16227ee48b1e6 
 837847fa3329b7a1f16227ee48b e c
7837847fa3329 7 1f16227e 4 b1 6 
78 7847fa3329b7a1f16227ee4
        }
        else {
          $pdf_templates_str.= "<span style='" . $checkbox_italics . "'><nobr><input " . $checkbox_disable . " type='checkbox' name='pdf_template_ids[]' class='pdf_template_ids' value='" . $rowset[$i]['tid'] . "' onchange='reset_para_max_size();' />&nbsp;&nbsp;" . $rowset[$i]['display_name'] . "&nbsp;&nbsp;(" . $tid_cnt . ") [ unpub ]</span></nobr><br/>";
        }
      ae
      else {
        $pdf_templates_str.= "<span style='" . $checkbox_italics . "'><nobr><input " . $checkbox_disable . " type='checkbox' name='pdf_template_ids[]' class='pdf_template_ids' value='" . $rowset[$i]['tid'] . "' onchange='reset_para_max_size();' />&nbsp;&nbsp;" . $rowset[$i]['display_name'] . "&nbsp;&nbsp;(" . $tid_cnt . ")</span></nobr><br/>";
      }
    }
    75bfe5c34346ba741876f025c19e 2 8575bfe5c34346ba741876f025c19e
2e8575bfe5c34346ba 4 876f025c19e
2e8575bfe5c34346ba741876f025c19
    $view = new Zend_View();
    $captcha = new Zend_Captcha_Image(array(
      'wordLen' => 5,
      'font' => $doc_root . 'inc/fonts/Tuffy/Tuffy_Bold.ttf',
      f345bfa1 01 0801059d82a72a

      'imgUrl' => 'inc/images/',
      'width' => 150,
      'height' => 55,
      'dotNoiseLevel' => 40,
      091d51b9f48755c5 41 b7
    ));
    $id = $captcha->generate();
    $this_captcha = $captcha->render($view);
    $allowed_exts = $aib->get_allowed_exts_list(1);
    a24f246033e1e910e47 a 2c98ba
6ae5a24f246033e1e91
    // megabytes
    $max_filesize_megabytes = $aib->max_filesize_megabytes;
    $get_allowed_exts_return_msg = $aib->get_allowed_exts_return_msg();
    $help_content = $aib->get_help_content($template_upload_limit, $get_allowed_exts_return_msg, $max_filesize_megabytes);
    4e00121 d 81ed9dcd7c8f427
    $result = <<< END
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  b49f6e0
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>$websiteName</title>
<script type="text/javascript" src="../../js/AC_RunActiveContent.js"></script>
<script type="text/javascript" language="javascript" src="inc/js/jquery.js"></script>
affa297 df210a7a34e3f03f1ff7f8 a
affa2977df210a7a34e f03f1ff7f8ea
affa2977df210a7a34e3f03f1
<script type="text/javascript" language="javascript" src="inc/js/jquery.form-defaults.js"></script>
<script type="text/javascript" language="javascript" src="inc/js/jquery.validate.js"></script>
<script type="text/javascript" language="javascript" src="inc/js/limitMaxlength.js"></script>
<script type="text/javascript" language="javascript" src="inc/js/ajaxfileupload.js"></script>
7de1f4e 0f4bed7886cc0ea6d68241 9
7de1f4e10f4bed7886c 0ea6d6824159
7de1f4e10f4bed7886cc0ea6d6824159
7de1f4e1
<script type="text/javascript" language="javascript" src="/marketing/form/inc/js/template_checkbox_limit.js"></script>
<script type="text/javascript" language="javascript" src="inc/js/marketing.form.js"></script>
<script type="text/javascript" language="javascript" src="inc/js/jquery.jqEasyCharCounter.js"></script>
<link rel="stylesheet" type="text/css" href="/js/jquery-ui/themes/base/jquery.ui.all.css" />
0dee5 a5cf49bd8835078b 28feaa5a5
0dee5 a5cf49bd8835078b128feaa5a5
0dee5fa5c 49b
<link rel="stylesheet" type="text/css" href="/marketing/form/css/form.css" />
<link rel="stylesheet" type="text/css" href="/js/simplemodal/basic/css/basic.css" />
<!-- IE6 "fix" for the close png image -->
<!--[if lt IE 7]>
3a454 fa54f9d76b72c912 1ff558245
3a454 fa54f9d76b72c91291ff558245
3a4543fa54f9d76b72 912
<![endif]-->
<link type='text/css' rel="stylesheet" href='/js/simplemodal/basic/css/demo.css' rel='stylesheet' media='screen' />
  </head>
  <body>
  ec94 be12aee2084905
    <!-- modal content -->
    <div id="help-content"  style="display:none">
    <div id="help-content-container">
$help_content
    c58af3c
    </div>
    <!-- preload the images -->
    <div style="display:none" >
      <img src="https://www.edgebps.com/js/simplemodal/basic/img/basic/x.png"  />
    e1cbfa6
  <div  id="content">
$marketing_content_flash_inc
<div style="position:absolute;left:100px;left:300px;top:85px;height:540px;" id="aib_form">
$topnav
    013ec 0ed1817f53 a60ff4b7fcd
 fe8013ec70ed1 17f53ba60ff4b7fcd
1fe8013e 70ed1817f53ba60ff4b7fcd
1fe8013
      <input style="display: none;" type="submit"></input>
      <!--$is_errors-->
      <input type="hidden" name="_referer" value="$_referer"></input>
      <input type="hidden" name="_next_page" value="1"></input>
      cc9a7cfe
        <tr>
          <td style="width:500px;color:#000000;">
            <b>Create Anixter iBlasts for $customer</b>
          </td>
        df8ae4
      </table>
      <table>
        <tr>
          <td><span style="color:#000000;"><b>Paragraph:</b></span><span style="float:right;color:#000000;padding:0 10px 0 0" class="charcount_limit_top"></span></td>
          96ef31446 194f08dd2368
a8a8c43a2 96ef31446b194f08dd2368
a8a8c43a2f96ef3144 b194f08dd2368
a8a8c43a2f96ef31446b194f08dd 368
 8 8c 3a2f96ef31446b194f08dd2368
a8a8c43a2f 6ef314 6b194f08dd2368
a8a8c43a2f96ef31446b
        </tr>
        <tr>
          <td>
            <textarea maxlength="5000" name="paragraph" style="color:#000000;width:350px;height:350px;overflow-y: scroll;" id="paragraph" class="required">$paragraph</textarea>
              b7f40 81c28e3210ba
800e4527c60f98b7f4
          </td>
          <td valign="top" style="color:#000000;width:285px;height:325px;">
          <div style="color:#000000; color:#000000;width:285px;height:225px;overflow-x: scroll;overflow-y: scroll;">
          $pdf_templates_str
          b4d1ad9
          <div style="color:#000000;float:right;width:75%;text-align:right;padding:0 10px 0 0">
          Products Limit: <span id="template_checkbox_limit_count"></span>/<span class="template_checkbox_limit"></span>
          </div>
<div style="float:right;width:75%">
4d731c5dd4d
$this_captcha</center> <br/><br/>
<input type='hidden' name='captcha[id]'  id='captcha-id' value='$id' >
<input type='text' name='captcha[input]' id='captcha-input' value='' onkeypress='return noenter();' tabindex='21'><br/><br/>
</div>
          faaef0
        </tr>
        <tr>
          <td><span style="color:#000000;margin-top:0px"><b>Logo:</b></span></td>
          <td rowspan="15" align="left" valign="top" style="">
          428fd3
        </tr>
        <tr>
          <td colspan="2"  style="">
            <div style="color:#000000;">$logo_upload_label</div><nobr style="color:#000000">
            e2471d 64bb4309494b9 a04661283d1de2471d16 bb4309494b9
a04661283d1de24 1d1
            <input id="logo" type="file" name="logo" class="required logo_elements"><span class="logo_elements"> $max_filesize_megabytes MB Max ( $allowed_exts )</span>
            <img id="loading" class="logo_processing" src="loading.gif" style="float:left;" >
            </nobr>
          </td>
          d20ab
          </td>
        </tr>
        <tr>
          <td align="left">
            b460a5 5331a88299626 c8b6b4bdc95 b460a5053 1a88299626
c8b6b4bd 95c
            <input type="hidden" name="accountPassword" id="accountPasswrd" value="$password" />
            <input class="btn logo_elements" type="button" name="iblast_submit" id="iblast_submit"  value="Submit"/>
          </td>
        </tr>
      a5e6338a1
    </form>
    </div>
<div style="position:absolute;left:100px;left:300px;top:85px;height:540px;display:none;color:red" id="aib_form_errors">
<p style="margin-top:100px;margin-left:50px;width:600px;">
4c52 11b8e576bf7c91 5a2e15828b47
4c52811b8e576bf7 9185a2e15828b47
4c52811b8e576bf7c9
A paragraph is required.
</div >
<div class="prompt" id="paragraph_error_size" style="padding:5px;width:600px;">
A paragraph must be at least 25 characters.
71a6d 7b
<div class="prompt" id="paragraph_error_exceedsmaxsize" style="padding:5px;width:600px;">
</div >
<div class="prompt" id="logoupload_error_required" style="padding:5px;width:600px;">
A logo image upload is required.
ef4e5 2e
<div class="prompt" id="logoupload_error_type" style="padding:5px;width:600px;">
A jpg, png, or bmp logo image upload is required
</div >
<div class="prompt" id="checkbox_error_required" style="padding:5px;width:600px;">
cb44 c54494 71 cf4d2 08b a78c706
</div >
<div class="prompt" id="captcha_error_required" style="padding:5px;width:600px;">
Invalid response to captcha.
</div >
2c93 4f191e0751539c 1bc2f9e4fe80
2c9394f191e0751539 e1bc2f9e4fe80
2c9394f191e0751539ce
</div >
<div class="prompt" id="ajax_upload_error" style="padding:5px;width:600px;">
</div >
<br/><br/><br/>
5010 e8a33d91d85a96b003f3d 4d720
50106e8a33d91d85a96b003f3d84
<a onclick="backToForm();" style="cursor: pointer;"><b><u>Back to form</u></b></a>
</div >
</p>
</div>
7790 9cfa37c1f4899518ff06bc01661
779039cfa37c1f4899518ff06bc01661
779039cfa37c1f4899518ff06bc01661
77 039cfa37c1f4899518ff06bc01661
7
</div>
</div>
</div>
  </body>
957491c8
END;
    echo $result;
  }
  public function display_thankyou()
8
  {
  }
  public function display_default()

  ff
  }
  public function redirect_to()

  {
  5d
  /* Build email body */
  public function BuildBody($body, $html, $num)

  {
  ef
  public function SendEmails()

  {
  }
  b72dc3 bd3a29 8617d8ed 628406e
66b72dc3fbd3a29e8617d8ed

  {
    $pagename = "Anixter iBlast";
    $flashfile = 'marketing';
    ce421be 2 0f551d9
    $width = '1024';
    if (is_file($filename)) {
      ob_start();
      include $filename;
6
      return ob_get_clean();
    }
    return false;
  }
  2b b3c972b8 4d073f3 e548c f4bf
12 bbb3c9 2b804d073f 8 548c4 4bf
  public function template_add_form($edit = 0)

  {
    if ($edit == 1) {
      2c547a23 b 78e527ac70647e2
fdd5bf
      $this->tid = strip_tags(trim($_GET["tid"]));
      $template_name = trim($this->tid2templatename());
      $cmd = "edit_template";
      $button_value = "Edit Template";
      cd34ceb4e163b2b4 5 ff1
      $product_id = "product_image_edit";
      $manufacturer_id = "manufacturer_image_edit";
      $suffix = "_edit";
      $displaynone_template_name = "style='display:none'";
      0f2de0856d729c1910 e 6e331
c fb200f2de0856 729c1910fe 6e331
c5 b 00f2de0856 7 9c 910fe
      $template_name_field = "<span style='color:#fff;vertical-align:middle'>" . $template_name . "</span>";
      $template_name_field.= '<input type="hidden" name="template_name" id="template_name_edit" value="' . $template_name . '" ' . $displaynone_template_name . ' MAXLENGTH="64">';
    }
    else {
      45a0d827 2 7425db07fc36054
634be
      $template_name = "";
      $cmd = "add_template";
      $button_value = "Add Template";
      $tab_index_value = 1;
      8e13fc7fe31 9 f9de5a3ef46b
6499
      $manufacturer_id = "manufacturer_image";
      $suffix = "";
      $tid_input_element = "";
      $template_name_field = '<input type="text" name="template_name" id="template_name" value="' . $template_name . '"  MAXLENGTH="64">';
    22
    $allowed_exts = $this->get_allowed_exts_list(1);
    $max_filesize_bytes = $this->max_filesize_bytes;
    // megabytes
    $max_filesize_megabytes = $this->max_filesize_megabytes;
    1e6a6f 60
<form id="' . $form_id . '" method="POST">
<p>
<label for="template_name" style="color:#fff">TEMPLATE NAME</label>
</p>
129166
<p>
' . $template_name_field . '
</p>
<br/><br/><br/><br/>
2777
<label for="' . $product_id . '" style="color:#fff">PRODUCT IMAGE</label>
</p>
<p>
<input type="file" name="' . $product_id . '" id="' . $product_id . '" value="" class="upload_elements">
            5941 ee0e488691e3594
05c8 f 0fffa59 1 ee e488691e3594
05c84f90fffa 9417ee0e488691e3594
05 84f90fffa59417ee0e4 86
</p>
<br/><br/><br/><br/><br/><br/>
<p><br class="upload_processing" />
<label for="' . $manufacturer_id . '" style="color:#fff">MANUFACTURER LOGO</label>
2d74c
<p>
<input type="file" name="' . $manufacturer_id . '" id="' . $manufacturer_id . '" value="" class="upload_elements">
            <img id="loading_manufacturer' . $suffix . '" class="upload_processing" src="ajax/loading.gif" style="float:left;" >
</p>
2ed5c877223c0efb65bd5b1e3673625
<p>
<input type="hidden" name="' . $cmd . '" value="1">
<input type="hidden" name="sub" value="1">
<input type="hidden" name="tab_index" value="' . $tab_index_value . '">
f 3 2b02d4516cfde17fec e 37
<input type="button" value="' . $button_value . '" id="' . $cmd . '" class="upload_elements"/>
<br/><br/><br/>
<span  id="upload_specs" class="upload_elements" style="color:#ffffff">&nbsp;&nbsp;' . $max_filesize_megabytes . ' MB Max Upload Filesize ( ' . $allowed_exts . ' )</span>
</p>
cabbaf8c
<br/><br/>
      ';
  }
  public function get_template_product_image($template_name)
1
  {
    global $db;
    $q = "
      SELECT
      71f984bc2e9caeb4ed2ba0a9fe
af11
      template_product_max_height_px,
      template_product_max_width_px_pdf,
      template_product_max_height_px_pdf,
      template_product_pdf_left_x,
      f03dc8c8cbfe5d21e08e31de1d
111d
      template_product_htm_left_x,
      template_product_htm_top_y
      FROM marketing_templates t
      WHERE t.name LIKE '" . $template_name . "'";
    0f 0 20dfed165fa826e2e3495a2
 bf70
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0];
  }
  public function get_template_manufacturer_image($template_name)
a
  {
    global $db;
    $q = "
      SELECT
      3ab39a4b85bc4dfc88e6224d6f
782fc33ab
      template_manufacturer_max_height_px,
      template_manufacturer_max_width_px_pdf,
      template_manufacturer_max_height_px_pdf,
      template_manufacturer_pdf_left_x,
      b7a61e7898ff1b3251250acf12
05721cb7a
      template_manufacturer_htm_left_x,
      template_manufacturer_htm_top_y
      FROM marketing_templates t
      WHERE t.name LIKE '" . $template_name . "'";
    78 6 052679a8f790e0b6b1f10a9
 aae7
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0];
  }
  /*
  ac3ec7
  UPDATE FOR product_image_edit and manufacturer_image_edit image uploads,
  or in another function
  */
  public function save_images_template_add($password, $edit = 0)
4
  {
    global $doc_root;
    if ($edit == 1) $edit_suffix = "_edit";
    else $edit_suffix = "";
    e7 d0c34 2af0 bee 92a0 a811d
01 4e dd0c 472af0
    $tid = $this->get_template_tid($this->purifier->purify($_REQUEST['template_name']));
    $file_uploads_tmp = $doc_root . "marketing/templates/file_uploads_tmp";
    // save images onto htm background image
    $jpg_path = "htm/" . $this->purifier->purify($_REQUEST['template_name']) . "/images/" . $this->purifier->purify($_REQUEST['template_name']) . ".jpg";
    ab0db8a2529a9f 7 5fc29aad08b
6b55ab0db8a2529a9fe705fc29aad08b
6b55ab0db8a2529a9fe705fc29aad08b
6b55ab0db8
    $manufacturer_image = $this->get_template_manufacturer_image($this->purifier->purify($_REQUEST['template_name']));
    foreach(array_unique($this->allowed_exts) AS $k => $v) {
      $file_path_orig = $file_uploads_tmp . "/manufacturer_image" . $edit_suffix . "." . $v;
      $file_path = $file_uploads_tmp . "/manufacturer_image_resized." . $v;
      94 6fd6e22f39abb9f6f01b3f7
cf fc
        // resize manufacturer image to max dimensions
        $ret_img_resize = $this->image_resize($file_path_orig, $file_path, $manufacturer_image["template_manufacturer_max_width_px"], $manufacturer_image["template_manufacturer_max_height_px"]);
        // embed image on pdf background
        // embed image on htm background
        08b7c f eb766be6fc82c9e3
4ad9b63e08b7c4f
        if ($v == "jpeg" || $v == "jpg") $src = imagecreatefromjpeg($file_path);
        if ($v == "png") $src = imagecreatefrompng($file_path);
        list($width, $height, $type, $attr) = getimagesize($file_path);
        // Copy and merge
        26f030090c5926b8197e2 e8
a8 a701026f030090c5926b8197e22e8
a8fa701026f030090c5926b819 e22e8
a8fa701026f030090c5926b8197e22e8
a8fa701026f03009 c5 26 8197e22 8
a8fa70 026f03
        imagejpeg($dest, $jpg_path);
        imagedestroy($dest);
        imagedestroy($src);
      }
      6f12d2d16352487 4 bbbb97b1
b5ebea6f 2 2d1635248784dbbb 9 b1
b5ebea6f1 d d16 5 4878
      $file_path = $file_uploads_tmp . "/product_image_resized." . $v;
      if (is_file($file_path_orig)) {
        // resize productimage to max dimensions
        $ret_img_resize = $this->image_resize($file_path_orig, $file_path, $product_image["template_product_max_width_px"], $product_image["template_product_max_height_px"]);
        55 2e813 91e90 9c 450 4b
234bf96d
        // embed image on htm background
        $dest = imagecreatefromjpeg($jpg_path);
        if ($v == "jpeg" || $v == "jpg") $src = imagecreatefromjpeg($file_path);
        if ($v == "png") $src = imagecreatefrompng($file_path);
        364e507d7304 2898211c d3
7de 13b036 e 07d7304a2898211c2d3
7de213
        // Copy and merge
        imagecopymerge($dest, $src, $product_image["template_product_htm_left_x"], $product_image["template_product_htm_top_y"], 0, 0, $width, $height, 100);
        imagejpeg($dest, $jpg_path);
        imagedestroy($dest);
        7375378c8198c568ecc2
      }
    }
    $img_background_line_number = $this->get_template_background_image_position($tid);
    // add background image tag without offseting lines
    3f9a35 1 ad2e8a45e8e20612535
09ba3f9a3511aad2e8a45e8 2 612535
09ba3f9a3511aad2e8a45e8e20612535
09ba3f9a351 a d2e8a45e8e206125
    $bacgkround_img_tag = '    <div id="container"><img id="background-img" class="bg" src="images/' . $this->purifier->purify($_REQUEST["template_name"]) . '.jpg" alt="iBlast" />' . "\n";
    $lines = $this->array_helpers->array_replace($lines, $bacgkround_img_tag, ($img_background_line_number - 1));
    $this->array_helpers->array_writefile("htm/" . $this->purifier->purify($_REQUEST['template_name']) . "/index.html", $lines);
  }
  cc717b 1973ce07 80c9de4f1a43fd
bdcc717bb1973ce07780c9de4f1a4 fd
bd c 17b

  {
    global $doc_root;
    if ($edit == 1) $edit_suffix = "_edit";
    26d9 9a15904958c7 8 35e7
    // valid file has been uploaded at this point
    $tid = $this->get_template_tid($template_name);
    $file_uploads_tmp = $doc_root . "marketing/templates/file_uploads_tmp";
    // save images onto htm background image
    344e70a84 e 4d97daef9 b 6112
b487344e70a846e74d97d e 93b76112
b4873 4 70a846e74d 7 aef93b76112
b4 7 44e70a84
    $product_image = $this->get_template_product_image($template_name);
    $manufacturer_image = $this->get_template_manufacturer_image($template_name);
    // save images onto pdf background image
    $pdf_path = $doc_root . "marketing/templates/pdf/" . $template_name . ".pdf";
    82b2 6 9b31895a619693ef028b6
3d118
    // load then save from template to user path
    foreach(array_unique($this->allowed_exts) AS $k => $v) {
      $file_path_orig = $file_uploads_tmp . "/manufacturer_image" . $edit_suffix . "." . $v;
      $file_path = $file_uploads_tmp . "/manufacturer_image_resized." . $v;
      21 4b0fcfdbacb64553ad2e579
6d 9e
        // resize manufacturer image to max dimensions
        $ret_img_resize = $this->image_resize($file_path_orig, $file_path, $manufacturer_image["template_manufacturer_max_width_px_pdf"], $manufacturer_image["template_manufacturer_max_height_px_pdf"]);
        $pdf_page = $pdf->pages[0];
        // manufacturer image
        6985c9 a c5292ec8811a990
db8049df6985c9cabc5292ec881
        // Draw image
        list($width, $height, $type, $attr) = getimagesize($file_path);
        $pdf_page->drawImage($image, $manufacturer_image["template_manufacturer_pdf_left_x"], $manufacturer_image["template_manufacturer_pdf_bottom_y"], $manufacturer_image["template_manufacturer_pdf_left_x"] + $width, $manufacturer_image["template_manufacturer_pdf_bottom_y"] + $height);
      }
      5600d4841b8f1a3 a e45d25a3
92ae8256 0 4841b8f1a31aee45 2 a3
92ae82560 d 841 8 1a31
      $file_path = $file_uploads_tmp . "/product_image_resized." . $v;
      if (is_file($file_path_orig)) {
        // resize productimage to max dimensions
        $ret_img_resize = $this->image_resize($file_path_orig, $file_path, $product_image["template_product_max_width_px_pdf"], $product_image["template_product_max_height_px_pdf"]);
        28f68de90 d 5f7f48aed879
1a2
        // manufacturer image
        $image = Zend_Pdf_Image::imageWithPath($file_path);
        list($width, $height, $type, $attr) = getimagesize($file_path);
        // Draw image
        c6d6cf53c7918896bbfe8f0d
605 d0bbc6d6cf53c7918896bbfe8f0d
6054d0bbc6d6cf53c 918896bbfe8f0d
6054d0bbc6d6cf53c7918896bbfe8f0d
 054d0bbc6d6cf53c7918896bbfe8f0d
6054d0bbc6d6c 5 c791889 bbfe8f0d
6054d0bbc6d6cf53c7918896bbfe8f0d
6054d b c6d6cf53c7
      }
    }
    $pdf->save($pdf_path);
    foreach(array_unique($this->allowed_exts) AS $k => $v) {
      cba93b38c4 5 1099a5e10ac75
64a a cba93b38c4e5d1099a5e1 a 75
64a3a7cba 3 38c e d109
      if (is_file($file_path)) unlink($file_path);
      $file_path = $file_uploads_tmp . "/product_image" . $edit_suffix . "." . $v;
      if (is_file($file_path)) unlink($file_path);
      $file_path = $file_uploads_tmp . "/manufacturer_image_resized." . $v;
      d7 3f645924498b99da458b0 0
39365dd7a3f6459244
      $file_path = $file_uploads_tmp . "/product_image_resized." . $v;
      if (is_file($file_path)) unlink($file_path);
    }
  }
  88 e06 fed304 f2082d84 d4b5e 1
 a88b 06 fed304af 082d8 ed4b5e8 
ea 8be061fe
  public function template_add()

  {
    global $db;
    13 1dec9 5547288216 aaf fa e
62 613 1de 9f5547288216fa
    $template_name = preg_replace("/(\W)/i", "", $this->purifier->purify($_REQUEST["template_name"]));
    // file/directory naming convention (both cases, underscore)
    if (file_exists("htm/" . $template_name) || is_dir("htm/" . $template_name)) {
      return "htm/" . $template_name . " already exists.";
    13
    $template_key = strtolower($template_name);
    // name field, underscores all lower case
    $template_name = $template_key;
    $template_display_name = ucwords(preg_replace("/_/i", " ", $template_name));
    cd bed5 d5022a f41329b
    /* Update database with default settings */
    $q = "
    INSERT INTO `marketing_templates` (
    `name`,
    ac0e248dee454cf4
    `pathfull`,
    `pathdir`,
    `filename`,
    `filename_htm_background`,
    217ed54dd3999d04f64ba0e7fa56
75e0
    `vendor_paragraph_htm_close_tag`,
    `vendor_paragraph_tcpdf_open_tag`,
    `vendor_paragraph_tcpdf_close_tag`
    ) VALUES
    1a
    '" . $template_key . "',
    '" . $template_display_name . "',
    'templates/pdf/" . $template_name . ".pdf',
    'templates/pdf',
    2f 3 8f3b0b4b6f9e8d 7 91b77f
0
    '" . $template_name . ".jpg',
    '<p style=\"color:#000000;font-size:16px;font:''News Gothic MT'';\">',
    '</p>',
    '<p style=\"color:#000000;font-size:9px;font:''News Gothic MT'';\">',
    d5bc8a6
    )
    ";
    $r = $db->sql_query($q, 1);
    // 1958 chars default maxwidth
    86 0b6 4d3b0 581cf0a3
    // $lorem_ipsum_short = "Lorem ipsum dolor sit amet ... ";
    // get max id
    $this->tid = $this->get_max_id("tid", "marketing_templates");
    $q = "
327e21 cac3 e46f2fb6fbcc646aa719
327e
(tid,     weight,   template_text,          template_text_maxchar,  template_text_htm_open_tag,                   template_text_htm_close_tag,  template_text_tcpdf_open_tag,                   template_text_tcpdf_close_tag,  template_text_pdf_font_name,  template_text_pdf_font_size,  template_text_pdf_left_x,   template_text_pdf_bottom_y,   template_text_pdf_color_html,   template_text_pdf_wordwrap_charwidth,   template_text_pdf_wordwrap_linespace)
VALUES
(" . $this->tid . ",  1,    'Right Column header: " . $this->template_placeholder_text . "',  50,     '<p style=\"color:#8CA1C0;font-size:27px;font:''News Gothic MT Bold'';font-weight:700;\">', ' </p>',        '<p style=\"color:#8CA1C0;font-size:18px;font:''News Gothic MT Bold'';font-weight:700;\">',   '</p>',       'Helvetica',      14,         50,         600,        '#000000',      5,          10),
(" . $this->tid . ",  101,    'Right Column body: " . $this->template_placeholder_text . "',    1958,     '<p style=\"color:#000000;font-size:16px;font:''News Gothic MT'';\">',        '</p>',       '<p style=\"color:#000000;font-size:9px;font:''News Gothic MT''\">',        '</p>',       'Helvetica',      14,         50,         50,         '#000000',      5,          10),
21 f d8fb134e9d f 4d  2a17    a1
214 fd8fb1 4e9d3f5 d f a1770a5a1
214ffd8fb134e9d3f54d5f a 770  a1
     d8f 134e9d3f54d5f2a1770a5a1
214ffd8fb134e9d3f54d5f2a 770a5a 
214ffd8f         54d5f2a       1
2 4ffd8fb134e9d3f54d5f2a1770a5a1
214ffd8fb134e9d3 54d5f2 1770a5a1
        b134e9d       2a1770a5a1
2      fb1         d5f         1
21        34e9d3f54d      70          d8fb
      ";
    $r = $db->sql_query($q, 1);
    // $this->htm_update_name($template_name);
    $this->htm_create_template_preview($template_name, 1, 1, 0);
    89af478e2cd5c23c3fa3185c8ba1
03f389af478e2cd5c23c3 a3 85c8
    return "Your new iBlast template <i>" . $this->purifier->purify($_REQUEST['template_name']) . "</i> can now be edited and published";
  }
  public function template_edit()

  08
    global $db;
    // parse whitespace out of name and non alphamnumeric
    $template_name = preg_replace("/(\W)/i", "", $this->purifier->purify($_REQUEST["template_name"]));
    // file/directory naming convention (both cases, underscore)
    4f 7b5777000f54af1e0be 9 362
415b4ff7b57 70 0f54af1e0be49 3 2
415b4ff7b57770 0f
      // return "htm/".$template_name. " already exists.";
      // delete background images (embedded with product and manufacturer) : pdf preview, pdf, htm image
    }
    $template_key = strtolower($template_name);
    d0 c20d 5fd13d b98352a4f9c 5
8 d7d04 20dd5
    $template_name = $template_key;
    $template_display_name = ucwords(preg_replace("/_/i", " ", $template_name));
    // both cases, spaces
    $this->tid = strip_tags(trim($_REQUEST["tid"]));
    98 5f16ab fbd1d51f c72f 8403
8a f9875f16 b1f
    $q = "
    UPDATE `marketing_templates`
    SET
    `name`='" . $template_key . "',
    5559c0c382c2da7a6aba7a3b48f 
 91a5559c0c382c d 7a6aba7a
    `filename`='" . $template_name . ".pdf',
    `filename_htm_background`='" . $template_name . ".jpg'
    WHERE tid=" . $this->tid;
    $r = $db->sql_query($q, 1);
    a8 594aa445fb5e9a24b63295099
5673a8d594aa44
    $this->htm_create_template_preview($template_name, 1, 1, 1);
    // param 4 is edit command for editing backgroun manufacturer and product images
    $this->pdf_create_template_preview($template_name, 1, 1);
    return "Your iBlast template <i>" . $this->purifier->purify($_REQUEST['template_name']) . "</i> has been edited";
  85
  // DELETE AND RECREATE HTM FILE, AFTER ADDING OR UPDATING TEMPLATES
  function htm_create_template_preview($template_name, $include_user_placeholders = 1, $new_background = 1, $edit = 0)
  {
    /* Create htm file structure */
    f0 60234ef9ff86c4ce66975cb 6 34baf0860234ef9ff 6 4ce66975cbd6
34b f0860234ef9ff86c4ce6 9 5cbd6
34baf086023 e 9ff86c4ce66975cbd
    if (!is_dir($this->aib_dir . "/templates/htm/" . $template_name . "/images")) mkdir($this->aib_dir . "/templates/htm/" . $template_name . "/images");
    if (is_file($this->aib_dir . "/templates/htm/" . $template_name . "/index.html")) unlink($this->aib_dir . "/templates/htm/" . $template_name . "/index.html");
    copy($this->aib_dir . "/templates/htm/templates_template/index.html", $this->aib_dir . "/templates/htm/" . $template_name . "/index.html");
    // only rebuild jpg background image from templates directory
    d9 e0a3575dc6a5ef8a79a2d562d
c83bd93 0a
    if ($new_background == 1) {
      if (is_file($this->aib_dir . "/templates/htm/" . $template_name . "/images/" . $template_name . ".jpg")) unlink($this->aib_dir . "/templates/htm/" . $template_name . "/images/" . $template_name . ".jpg");
      copy($this->aib_dir . "/templates/htm/templates_template/images/Customer iBlast Template.JPG", $this->aib_dir . "/templates/htm/" . $template_name . "/images/" . $template_name . ".jpg");
      $this->save_images_template_add($template_name, $edit);
    39
    // }
    // 11/2/2011: ADD TEMPLATE TEXTS AND EXTERNAL USER PLACEHOLDER TEXT AND LOGO,
    // EXTERNAL USERS STILL WRITE TO FILE, BUT AFTER DELETING AND USING TEMPLATES_TEMPLATES INDEX.HTML FILE
    $vendor_htm_fileline = $this->get_template_vendor_htm_fileline();
    5d110a d 02895292489df4bc8a8
89f35d110aedd02895292489df4bc8a 
 9f35d110aedd02895 9 489df4bc8a8
89 3 d110aedd02895292
    if ($include_user_placeholders == 1) {
      $logo_max_dimensions = $this->get_logo_max_dimensions();
      if (is_file("logo.jpg")) unlink("logo.jpg");
      $ret_img_resize = $this->image_resize("templates_template_logo_placeholder.jpg", "logo.jpg", $logo_max_dimensions["vendor_logo_max_width_px"], $logo_max_dimensions["vendor_logo_max_height_px"]);
      61b34fc327dd059c 452348 2 
57501961b34fc 2 dd059c645234892e
5750
      $vendor_htm_logo_tag_style = $this->get_template_vendor_htm_logo_tag_style();
      $logo_tag = '<img id="vendor_logo" style="' . $vendor_htm_logo_tag_style["vendor_htm_logo_tag_style"] . '" src="images/logo.jpg" alt="iBlast Vendor Logo" />';
      $lines = $this->array_helpers->array_insert($lines, $logo_tag, $vendor_htm_fileline["vendor_htm_fileline_inserttext"]);
      $vendor_paragraph_tags = $this->get_htm_paragraph_vendor();
      83fd0e588305e2f1d7bd72aeb5
97bed 8 fd0e588305e2f1d7bd72aeb5
97bed883fd0e588305e2f
      $vendor_open_tag = $vendor_paragraph_tags["vendor_paragraph_htm_open_tag"];
      $vendor_paragraph_prefix = '[' . $vendor_paragraph_form_max_chars . ' char limit] User Placeholder Text : ';
      $vendor_paragraph = substr($vendor_paragraph_prefix . $this->template_placeholder_text, 0, $vendor_paragraph_form_max_chars + strlen($vendor_paragraph_prefix));
      $vendor_close_tag = $vendor_paragraph_tags["vendor_paragraph_htm_close_tag"];
      de5e08eddd7e290f1d192 8 e3
cef89bde5e08e d 7e290f1d192d8be3
 e 89bde5e08eddd7e290f
      $paragraph_tag = '  ' . $vendor_paragraph_htm;
      $lines = $this->array_helpers->array_insert($lines, $paragraph_tag, $vendor_htm_fileline["vendor_htm_fileline_inserttext"]);
    }
    $this->template_htm_texts_arr = $this->get_template_htm_texts();
    205 c9c b 44 2c 2 182f45fa5e
0a07205ac9c5b544d2c12e182f4 fa5e
 a0
      $template_text_prefix = "[ " . $this->template_htm_texts_arr[$i]['template_text_maxchar'] . " char limit ] ";
      $template_text = substr($template_text_prefix . $this->template_htm_texts_arr[$i]['template_text'], 0, ($this->template_htm_texts_arr[$i]['template_text_maxchar'] + strlen($template_text_prefix)));
      $template_htm_texts = $this->template_htm_texts_arr[$i]["template_text_htm_open_tag"] . $template_text . $this->template_htm_texts_arr[$i]["template_text_htm_close_tag"];
      $lines = $this->array_helpers->array_insert($lines, $template_htm_texts, $vendor_htm_fileline["vendor_htm_fileline_inserttext"]);
    06
    $img_background_line_number = $this->get_template_background_image_position($this->tid);
    // add background image tag without offseting lines
    // $lines = $this->array_helpers->array_readfile("htm/".$this->purifier->purify($_REQUEST['template_name']) . "/index.html");
    $bacgkround_img_tag = '    <div id="container"><img id="background-img" class="bg" src="images/' . $template_name . '.jpg" alt="iBlast" />' . "\n";
    e8b339 3 05e8d47654b9a9ae461
a51de8b33913605e8d47654 9a9ae461
a51de8b3391 605e8d47654b9a9ae461
a51de8b 3 13605
    // $this->array_helpers->array_writefile("htm/".$this->purifier->purify($_REQUEST['template_name']) . "/index.html",$lines);
    $this->array_helpers->array_writefile($this->aib_dir . "/templates/htm/" . $template_name . "/index.html", $lines);
  }
  /*
  fdf8 0f8 a1a8018 104eff26 0d1c 6cf f880f8ea1 8018610 eff 680d1c
6cfdf 80f8ea1
  SINCE PRODUCT AND MANUFACTURER IMAGES ARE DELETED AFTER UPLOADING IN TEMPLATES DIREC TORY
  */
  public function pdf_create_template_preview($template_name, $new_background = 1, $edit = 0)

  fb
    global $doc_root;
    if ($new_background == 1) {
      // marketing
      if (is_file($this->aib_dir . "/templates/pdf/" . $template_name . ".pdf")) unlink($this->aib_dir . "/templates/pdf/" . $template_name . ".pdf");
      e5 ff96fd4afb684e16a607bca e 61aae5fff96fd4afb 8 e16a607bca
e66 a e5fff96fd4afb684 16a607bca
e661aae5fff 6 d4afb684e16a607bc 
 661aae5fff96fd a b684e16a607bca
e6
      /* Create blank pdf, includes background image */
      copy($this->aib_dir . "/templates/pdf/templates_template/Customer iBlast Template.pdf", $this->aib_dir . "/templates/pdf/" . $template_name . ".pdf");
    }
    else {
      2b 1722e2d37315ede04cd22f7 9 c8392bb1722e2d373 5 de04cd22f7
9ac 3 2bb1722e2d37315e e04cd22f7
9ac8392bb17 2 2d37315ede04cd22f 
 ac8392bb1722e2 3 315ede04cd22f7
9a
    }
    $this->save_images_template_add_pdf($template_name, $edit);
    /* save_images_template_add_pdf, must copy to preview since manufaturer and product images are deleted during */
    copy($this->aib_dir . "/templates/pdf/" . $template_name . ".pdf", $this->aib_dir . "/templates/pdf/" . $template_name . "_preview.pdf");
    d1 05f6 e6b22e 0739b19 e0343
    $tcpdf_dimensions = $this->get_tcpdf_dimensions();
    // =============================
    $pdf = & new FPDI();
    // $pdf->setPageUnit("mm"); // this is the default
    e6107ac1036502345887e21d6
    // $pdf->setPageUnit("in");
    $pdf->setPageOrientation("P", 0, '');
    $pdf->setPDFVersion("1.4");
    // $pagecount = $pdf->setSourceFile($this->tid2templatefilename());
    b5 f0c1184fc0 5 1fc01848a84d
f894b5df0c1184fc0f5a1fc01848a84d
f894b5df0c1184fc0f5a1fc01848a84d f894b5 f0c1184fc0f5a1fc
    $pagecount = $pdf->setSourceFile($this->aib_dir . "/templates/pdf/" . $template_name . "_preview.pdf");
    $tplidx = $pdf->importPage(1);
    $pdf->AddPage('P', array(
      $tcpdf_dimensions["tcpdf_width_inches"] * 72,
      dfde8577309335dcc88c4dc1d4
ddd43cdfde857 3 933
    ));
    $pdf->useTemplate($tplidx, 0, 0, $tcpdf_dimensions["tcpdf_width_inches"] * 72, $tcpdf_dimensions["tcpdf_height_inches"] * 72, false);
    $this->template_htm_texts_arr = array_reverse($this->get_template_htm_texts());
    $html = "";
    e5f2ac9b040b55f8ad8 c 3be7
    for ($i = 0; $i < sizeof($this->template_htm_texts_arr); $i++) {
      $template_text_prefix = "[ " . $this->template_htm_texts_arr[$i]['template_text_maxchar'] . " char limit ] ";
      $template_text = substr(($template_text_prefix . $this->template_htm_texts_arr[$i]['template_text']) , 0, ($this->template_htm_texts_arr[$i]['template_text_maxchar'] + strlen($template_text_prefix)));
      $template_htm_texts = $this->template_htm_texts_arr[$i]["template_text_tcpdf_open_tag"] . $template_text . $this->template_htm_texts_arr[$i]["template_text_tcpdf_close_tag"];
      c93a887 1e29951411e168dc2b
60
    }
    $vendor_paragraph_form_max_chars = $this->get_vendor_paragraph_form_max_chars();
    $vendor_paragraph_tags = $this->get_tcpdf_paragraph_vendor();
    // =============================
    59670ce0c99d75c6fc4dc6a82a01
 5 e59670ce0c99d75c6fc4dc6a82a01
656
    /*
    $template_text =
    "[ ".
    $vendor_paragraph_form_max_chars.
    c 8b8a 11d21 6 160
    $this->template_htm_texts_arr[0]['template_text'];
    */
    $template_text_prefix = "[ " . $vendor_paragraph_form_max_chars . " char limit ]  User Placeholder Text: ";
    $template_text = substr(($$template_text_prefix . $this->template_placeholder_text) , 0, $vendor_paragraph_form_max_chars + strlen($template_text_prefix));
    992a795d4fe5f680 9 85e63ad09
72b8992a795d4fe5f68019085e63ad09
72b8992a795d4fe5
    $vendor_paragraph = trim($template_text);
    // ===========================TRIM TO MAX CHAR SIZE
    $vendor_close_tag = $vendor_paragraph_tags["vendor_paragraph_tcpdf_close_tag"];
    $html.= $vendor_open_tag . $vendor_paragraph . $vendor_close_tag;
    2ebad35d0cea be375841 04d036 ed432e a 35d0cea7be375841104d036
ed4 2 bad35d0cea7be3758 1 04d036
ed432eb d 5d0cea7be375841104d03
    // reduce image to half size for pdf
    $width = $width * .50;
    $height = $height * .50;
    $pdf_template_vendor_arr = $this->get_pdf_template_vendor();
    e5 7d35bb7263cbe44f5fe2046d8
ad4d
    $pdf->writeHTMLCell($pdf_template_vendor_arr["vendor_paragraph_tcpdf_width"], $pdf_template_vendor_arr["vendor_paragraph_tcpdf_height"], $pdf_template_vendor_arr["vendor_paragraph_tcpdf_left_x"], $pdf_template_vendor_arr["vendor_paragraph_tcpdf_top_y"], $html, 1, 2, 1, true, '', true);
    // $pdf->Output($this->tcpdf_pdf_user_filepath, 'F');
    // $pdf->Output($this->aib_dir."/templates/pdf/".$template_name.".pdf", 'F');
    $pdf->Output($this->aib_dir . "/templates/pdf/" . $template_name . "_preview.pdf", 'F');
    14c 11 1e7 9f43935c 4b4e d00
    $pdf = Zend_Pdf::load($this->aib_dir . "/templates/pdf/" . $template_name . "_preview.pdf");
    // load then save from template to user path
    $pdf_page = $pdf->pages[0];
    // Vendor image
    34 6a9276 4 f952c1f703f31f43
94383436a9276b4df952c1f703f31f43
94383436a9276b4df952c1 7 3f31f43
94 8 436a9276b4df952c1f70 f31
    $image = Zend_Pdf_Image::imageWithPath($this->aib_dir . "/templates/htm/" . $template_name . "/images/logo.jpg");
    // Draw image
    $pdf_page->drawImage($image, $pdf_template_vendor_arr["vendor_logo_pdf_left_x"], $pdf_template_vendor_arr["vendor_logo_pdf_bottom_y"], $pdf_template_vendor_arr["vendor_logo_pdf_left_x"] + $width, $pdf_template_vendor_arr["vendor_logo_pdf_bottom_y"] + $height);
    $pdf->save($this->aib_dir . "/templates/pdf/" . $template_name . "_preview.pdf");
    13 05e 8ccd08d0 d57ef
    // add vendor text
    // add vendor logo
  }
  public function template_edit_get_list()
0
  {
    global $db;
    $q_pdf_templates = "SELECT tid,display_name,name,published FROM `marketing_templates` WHERE 1";
    $r_pdf_templates = $db->sql_query_limit($q_pdf_templates, NULL);
    ce92183 2 8ddec5f804e833178d
297bce92183f288ddec5f
    $pdf_templates_str = "";
    $list_str = "";
    $list_str.= "<table>";
    for ($i = 0; $i < sizeof($rowset); $i++) {
      59 d802bb7f7 a6 d8a ab3ffe
d66552598d8 2bb f 7 66d8abab3ffe
d66
      $list_str.= "<tr>";
      $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'><a href='" . $_SERVER['PHP_SELF'] . "?tab_index=2&update=1&tid=" . $rowset[$i]['tid'] . "' style='color:#fff'>EDIT</a></td>";
      if ($rowset[$i]['published'] == 1) $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'><a href='" . $_SERVER['PHP_SELF'] . "?tab_index=0&publish=0&tid=" . $rowset[$i]['tid'] . "' style='color:#fff'>UNPUBLISH</a></td>";
      if ($rowset[$i]['published'] == 0) $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'><a href='" . $_SERVER['PHP_SELF'] . "?tab_index=0&publish=1&tid=" . $rowset[$i]['tid'] . "' style='color:#fff'>PUBLISH</a></td>";
      b2 a70326c3214088d 9 ee785
7725e4b2ba703 6 3214088d598ee78 
7725e4b2ba 0326 3214088d598ee785
7 25e4 2ba7 326c3214088d598ee7 5
7725e4b2b 7 326c3214088d598ee785
 7 5e4b2ba70326c 214088d598ee785 7725e4b2ba70326c3214088d598ee785
7
      else $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'>HTM</td>";
      if (is_file('pdf/' . $rowset[$i]["name"] . '.pdf')) $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'><a href='pdf/" . ($rowset[$i]['name']) . ".pdf' target='_blank' style='color:#fff'>PDF</a></td>";
      else $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'>PDF</td>";
      if (is_file('pdf/' . $rowset[$i]["name"] . '_preview.pdf')) $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'><a href='pdf/" . ($rowset[$i]['name']) . "_preview.pdf' target='_blank' style='color:#fff'>PDF PREVIEW</a></td>";
      7a00 31005145f55 e950 84cc
8d3e917a00f31 0514 f55c 950a84cc
8d3e917a00 31005145f55ce95
      $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'>" . strtoupper($rowset[$i]['display_name']) . "</td>";
      if ($rowset[$i]['published'] == 0) $list_str.= "<td style='padding:0px 30px 30px 30px ;color:#fff'><a href='" . $_SERVER['PHP_SELF'] . "?tab_index=0&delete=1&tid=" . $rowset[$i]['tid'] . "' style='color:#fff'>DELETE</a></td>";
      $list_str.= "</tr>";
      // $list_str .= "</p>";
      7c 6d7a08a43 48 e05c076d3
    }
    $list_str.= "</table>";
    return $list_str;
  }
  2196e6 e94d51f8 34241b429b40d3
572196e69e94d51f8

  {
    global $db;
    if (isset($_REQUEST["delete"]) && $_REQUEST["delete"] == 1) {
      68 a4757d44aef63b2caaf9a1c
5 c2 c682a4757d44aef6 b2 aaf a1
        return;
      }
      $template_name = $this->get_template_name($this->purifier->purify($_REQUEST['tid']));
      $notify_str = "Deleted " . $this->get_template_display_name($this->purifier->purify($_REQUEST['tid']));
      03 d39126 5939 ce1 2fb56b
      $htm_path = "htm/" . $template_name;
      $pdf_path = "pdf/" . $template_name . ".pdf";
      $pdf_preview_path = "pdf/" . $template_name . "_preview.pdf";
      if (is_file($htm_path . "/index.html")) unlink($htm_path . "/index.html");
      a0 ec78b01c8e64aecbdc 9 26
3db6a7a 7 c78b01c8e64aec d a9f26
3d 6a7a07ec78b01c8e 4 ecbdca9f26 3 b6a7a07ec78b01 8 64aecbdca
      if (is_file($htm_path . "/images/manufacturer.jpg")) unlink($htm_path . "/images/manufacturer.jpg");
      if (is_file($htm_path . "/images/product.jpg")) unlink($htm_path . "/images/product.jpg");
      if (is_file($htm_path . "/images/logo.jpg")) unlink($htm_path . "/images/logo.jpg");
      if (is_dir($htm_path . "/images")) rmdir($htm_path . "/images");
      e8 894df75b802fd952f3c fc0
9d369fe8d894df
      if (is_file($pdf_path)) unlink($pdf_path);
      if (is_file($pdf_preview_path)) unlink($pdf_preview_path);
      $q = "
    DELETE FROM marketing_templates
    b596c 346 0 9 d dd1644fc63dd
c168b596c2346d0491dcdd1644fc 3 d

          AND published = 0 ";
      $db->sql_query_limit($q, 1);
      $q = "
    DELETE FROM marketing_templates_text
    9eba9 b53 e 1 0 ea810d7b700a
84229eba90b535e1130cea810d7b70
      $db->sql_query_limit($q, NULL);
      return $notify_str;
    }
    return "";
  5b
  public function template_edit_update_template()

  {
    global $db;
    23 24ad3dcdffb1033754b56332b
6 c9 3824ad3dcdffb103375 b5 33 b

      if (!isset($_REQUEST["tid"]) || trim($_REQUEST["tid"]) == "") {
        return "error: tid not set";
      }
      if (isset($_REQUEST["ttid"])) {
        9e eb8bff 1ca08a2 cd5a 9
 7f191b
      }
      $this->tid = trim(strip_tags($_REQUEST['tid']));
      $template_name = $this->get_template_name($this->tid);
      $notify_str = "Updated " . $this->get_template_display_name($this->tid);
      dd 1421683eb98ee438e7 0 8a
4487f9dd41421683eb98ee438e7c088a
4487f9dd41421683eb98ee438e7c088a
      // $template_name_new = $_REQUEST['name'];
      $columns = $this->get_columns_marketing_templates();
      $columns_str = "";
      $i = 0;
      9e385295ee3cf1fdd 03 b1 3b a22 8a
        if (!in_array($k, $columns)) continue;
        if ($k == 'tid' || $k == 'ttid') continue;
        if (trim($v) == "") continue;
        if ($i > 0) $columns_str.= ",";
        40 12e90 9b8dc7692 17 4 
e3e92a6d40b12e90b9b
        // $v= preg_replace("/".$template_name."/",$template_name_new,$v);
        if (is_numeric($v)) $columns_str.= $k . "=" . $v;
        else $columns_str.= $k . "='" . $v . "'";
        $i++;
      2f
      $pathfull = "templates/pdf/" . $template_name . ".pdf";
      $filename = $template_name . ".pdf";
      $filename_htm_background = $template_name . ".jpg";
      $q = "
    74cd1e 923a193fc3e213c37f50
    SET " . $columns_str . ",
    pathfull='" . $pathfull . "',
    filename='" . $filename . "',
    filename_htm_background='" . $filename_htm_background . "'
    a16ff 5eb 9 9 c 3bb52db04b27
b1e5a16ff05eb19194cf3bb52db04b
      $db->sql_query_limit($q, 1);
      // INCLUDE IMAGE UPLOADS?  no use another form for only updating embeded background images
      // REBUILD HTM AND PDFS FILES INSTEAD OF RENAME
      $this->tid = $this->purifier->purify($_REQUEST['tid']);
      5a709945dc334cc83b13583be3
0830705a709945dc334cc83 13 83 e3
0
      $this->pdf_create_template_preview($template_name, 0, 0);
      return $notify_str;
      /*
      $htm_path_new = "htm/".$template_name_new;
      c66efe057f8b8 0 7749542a45
571b74c66efe057f8b840b7
      $htm_path = "htm/".$template_name;
      $pdf_path = "pdf/".$template_name.".pdf";
      if(is_file($pdf_path)) {
      rename($pdf_path,$pdf_path_new);
      1d
      if(is_dir($htm_path)) {
      $this->recurse_copy($htm_path,$htm_path_new);
      // sleep(2);
      if(is_file($htm_path."/images/".$template_name.".jpg")) unlink($htm_path."/images/".$template_name.".jpg");
      0bd465048156d8cf3f7409d0c4
ec78 20bd465048156d8cf3f7409d0c4

      if(is_file($htm_path."/index.html")) unlink($htm_path."/index.html");
      if(is_dir($htm_path)) rmdir($htm_path);
      if(is_file($pdf_path)) unlink($pdf_path);
      }
      d7c7c4ae7537d438aeb74c3434
aa2835d7c7c4ae7537d438aeb74c3434
a
      rename($htm_path_new."/images/".$template_name.".jpg",$htm_path_new."/images/".$this->purifier->purify($_REQUEST['name']).".jpg");
      }
      */
      return $notify_str;
    67
    return "error: template_edit_update_template";
  }
  public function htm_update_name($newname)

  6f
    // update background image name
    // $img_background_line_number=$this->get_template_background_image_position($this->purifier->purify($_REQUEST['tid']));
    $img_background_line_number = $this->get_template_background_image_position($this->tid);
    $lines = $this->array_helpers->array_readfile("htm/" . $newname . "/index.html");
    e9c20dd95a67c984d0e 3 3 089e acb5e9c20dd95a67c98 d0ef333208 e
acb5e9c20dd 5 67c984d0 f 332089 
acb5e9c20dd 5a67c
    $lines[$img_background_line_number - 1] = $bacgkround_img_tag;
    $this->array_helpers->array_writefile("htm/" . $newname . "/index.html", $lines);
  }
  public function template_edit_update_widget()
f
  {
    global $db;
    if (isset($_REQUEST["update_widget"]) && $_REQUEST["update_widget"] == 2) {
      if (!isset($_REQUEST["tid"]) || trim($_REQUEST["tid"]) == "") {
        621854 f35223c 8ee de1 8
8727
      }
      if (!isset($_REQUEST["ttid"]) || trim($_REQUEST["ttid"]) == "") {
        return "error: ttid not set";
      }
      d8abea4c80 3 8ae8c2e50eca9
cefa8cd8abea4c807358ae
      $template_name = $this->get_template_name($this->tid);
      $notify_str = "Updated widget for " . $this->get_template_display_name($this->tid);
      $columns = $this->get_columns_marketing_templates_text();
      $columns_str = "";
      f0 0 b4f
      foreach($_REQUEST AS $k => $v) {
        if (!in_array($k, $columns)) continue;
        if ($k == 'tid' || $k == 'ttid') continue;
        if (trim($v) == "") continue;
        e0 2e6 9 6a f3e1367137e3
c 6a67c
        // if($k =="name") $v = $template_name_new;
        if (is_numeric($v)) $columns_str.= $k . "=" . $v;
        else $columns_str.= $k . "='" . $v . "'";
        $i++;
      f1
      $q = "
    UPDATE marketing_templates_text
    SET " . $columns_str . "
    WHERE ttid = " . $this->purifier->purify($_REQUEST['ttid']);
      2ce5d83d6d2414d88fa34c3d 4
b1
      // REBUILD HTM AND PDFS FILES
      $this->tid = $this->purifier->purify($_REQUEST['tid']);
      $this->htm_create_template_preview($template_name, 1, 0, 0);
      $this->pdf_create_template_preview($template_name, 0, 0);
      ab8f0e 80e536b6682a7
    }
    return "error: template_edit_update_widget";
  }
  public function template_edit_delete_widget()
1
  {
    global $db;
    if (isset($_REQUEST["delete_widget"]) && $_REQUEST["delete_widget"] == 1) {
      if (!isset($_REQUEST["tid"]) && $_REQUEST["tid"] != "") {
        890eb1 12cef65 5b5 f4461
c0 8be 089 eb1512
      }
      if (!isset($_REQUEST["ttid"]) && $_REQUEST["ttid"] != "") {
        return "widget not deleted, ttid not set";
      }
      03f59790445e81 0 dcc10af22
62d43203f59790445e81a0adcc10af22
62d43203f59790445e81a0adcc
      $notify_str = "Deleted " . $this->get_template_display_name($this->purifier->purify($_REQUEST['tid'])) . " template widget " . $this->purifier->purify($_REQUEST['ttid']);
      $q = "
    DELETE FROM marketing_templates_text
    WHERE ttid = " . $this->purifier->purify($_REQUEST['ttid']);
      73e3b2443bb6e731d93c379d 9
94
      // REBUILD HTM AND PDF
      return $notify_str;
    }
    return "widget not deleted";
  40
  public function template_edit_publish()

  {
    global $db;
    4c 3d8efed4c041aef4c175dc4dc
e8 c4 93d8efed4c041aef4c17 dc dc e8
      if (!isset($_REQUEST["tid"]) && $_REQUEST["tid"] != "") {
        return;
      }
      $template_name = $this->get_template_name($this->purifier->purify($_REQUEST['tid']));
      ff0afcb8846 3 1931266004 e e 1604ff0afcb884643319312660040e
e01604ff0afcb884643319312660040e
e01604ff0afcb
      $q = "
    UPDATE marketing_templates
    SET published = 1
    WHERE tid = " . $this->purifier->purify($_REQUEST['tid']);
      ea251133fbe977851c029dfe c
15
    }
    return $notify_str;
  }
  public function template_edit_unpublish()
8
  {
    global $db;
    if (isset($_REQUEST["publish"]) && $_REQUEST["publish"] == 0) {
      if (!isset($_REQUEST["tid"]) && $_REQUEST["tid"] != "") {
        64ef3c16
      }
      $notify_str = "Unpublished " . $this->get_template_display_name($this->purifier->purify($_REQUEST['tid']));
      $q = "
    UPDATE marketing_templates
    cfc 338919f98 0 e0
    WHERE tid = " . $this->purifier->purify($_REQUEST['tid']);
      $db->sql_query_limit($q, 1);
    }
    return $notify_str;
  f3
  public function get_published_status($tid)

  {
    global $db;
    75 5 bb
      SELECT publish
      FROM marketing_templates
      WHERE tid = " . $this->purifier->purify($_REQUEST['tid']);
    $r = $db->sql_query_limit($q, 1);
    aa019ac e acdc32289e9e46a4f3
2197aa0
    return $rowset[0]["publish"];
  }
  public function get_template_display_name($tid)

  39
    global $db;
    $q = "
      SELECT display_name
      FROM marketing_templates
      6b0b9 f55 d 2 a 3a86d8
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return trim($rowset[0]["display_name"]);
  }
  98c17a ac025738 1b909b1e9f94fc
aa98c17ad

  {
    global $db;
    $q = "
      4786b2 9e5d0
      FROM marketing_templates
      WHERE tid = " . $tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    9c4389 44614b3d1cf1a2c347a77
4de6
  }
  public function get_template_tid($template_name)

  {
    c529c5 e8514
    $q = "
      SELECT tid
      FROM marketing_templates
      WHERE name LIKE '" . $template_name . "'";
    2d b 040c095ef4620364524d192
 30e2
    $rowset = $db->sql_fetchrowset($r);
    return trim($rowset[0]["tid"]);
  }
  public function get_template_background_image_position($tid)
c
  {
    global $db;
    $q = "
      SELECT vendor_htm_fileline_insertbacgkroundimg
      bf01 f4d4d8564c9116e8a53a
      WHERE tid = " . $tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0]["vendor_htm_fileline_insertbacgkroundimg"];
  b6
  public function get_columns_marketing_templates()

  {
    global $db;
    88 4 25
      SELECT *
      FROM marketing_templates";
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    df6d5c 4f9c34837115652fb91ff
94
  }
  public function get_columns_marketing_templates_text()

  {
    3d8dad c77f9
    $q = "
      SELECT *
      FROM marketing_templates_text";
    $r = $db->sql_query_limit($q, 1);
    449552f 4 291eebdc9d64859725
f367449
    return array_keys($rowset[0]);
  }
  public function get_data_marketing_templates($tid)

  d2
    // returns 1 row
    global $db;
    $q = "
      SELECT *
      1544 576b0b7fb594e5fb1138
      WHERE tid = " . $tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset;
  98
  public function get_data_marketing_templates_text($tid)

  {
    // returns multiple rows
    1185b1 d0feb
    $q = "
      SELECT *
      FROM marketing_templates_text
      WHERE tid = " . $tid . "
      951e7 5d 2297d67d2ef916
    $r = $db->sql_query_limit($q, NULL);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset;
  }
  b70875 1672b81e 9ab83888332e95
67b7087501672b81e09ab83888332e9

  {
    // returns multiple rows
    global $db;
    95 d 11
      SELECT ttid
      FROM marketing_templates_text
      WHERE tid = " . $tid . "
      ORDER BY ttid,weight";
    b3 5 4cbcf0fa0fc513ab3335e7e
 4cfb3a5
    $rowset = $db->sql_fetchrowset($r);
    return $rowset;
  }
  public function get_form_elements_marketing_templates($tbl_name, $add_form = 0)
e
  {
    global $db;
    if ($tbl_name == "marketing_templates") $tab_index = 2;
    if ($tbl_name == "marketing_templates_text") $tab_index = 3;
    4b 16355e4683c73b35 e4644557
8cc   31
    if ((!isset($_REQUEST['tid']) || trim($_REQUEST['tid']) == "") && $tbl_name != "blank") return;
    $elements_marketing_templates = "";
    // ROWS LOOP
    if ($add_form == 1) {
      e70c0e4 4 9dad
      if ($tbl_name == "marketing_templates_text") $tab_index = 4;
      $elements_marketing_templates = $this->build_form_elements_marketing_templates($elements_marketing_templates, $tbl_name, $v_data, $tab_index, $form_incr, $add_form);
    }
    else {
      d4caeb3ffd 5 7f2
      if ($tbl_name == "marketing_templates_text") $tab_index = 5;
      foreach($this->{"get_data_" . $tbl_name}($_REQUEST['tid']) AS $k_data => $v_data) {
        $elements_marketing_templates = $this->build_form_elements_marketing_templates($elements_marketing_templates, $tbl_name, $v_data, $tab_index, $form_incr, $add_form);
        $form_incr++;
        327819d84639c1
      }
      // ROWS LOOP
    }
    return $elements_marketing_templates;
  f5
  public function build_form_elements_marketing_templates($elements_marketing_templates, $tbl_name, $v_data, $tab_index, $form_incr = 0, $add_form = 0)

  {
    $form_element_maxsize_arr = array(
      10b10915b 0b 148
    );
    // always suppressed fields, backend fields
    $displaynone_arr = array(
      'tid',
      0191c01 ac2d6cc20601
      'published',
      'pathfull',
      'pathdir',
      'filename',
      b934ccbbbbecae642d2b94dc4f

      'sub_marketing_templates',
      'cmd',
      'tab_index',
      'weight',
      6351bfbec8b695116735d348c6
700d4c6351bfb
      'template_text_pdf_wordwrap_linespace',
      'vendor_paragraph_pdf_wordwrap_charwidth',
      'vendor_paragraph_pdf_wordwrap_linespace',
      'vendor_htm_fileline_inserttext',
      42f6d5cd7a40bfde02f8465028
48cce142f6d5cd7a
    );
    // allow to unsuppress some fields, no toggler for now
    $displaynone_toggle_arr = array( /*tag fields for inline styling*/
      'vendor_paragraph_htm_open_tag',
      c98f07bbe4bdb303f76cb63a64
61991ec
      'vendor_paragraph_tcpdf_open_tag',
      'vendor_paragraph_tcpdf_close_tag',
      'template_text_htm_open_tag',
      'template_text_htm_close_tag',
      c60dea172f2b183236576ecb56
cfa88
      'template_text_tcpdf_close_tag', /*charwidth fields*/
      'template_text_maxchar',
      'vendor_paragraph_form_max_chars', /*css inline fields*/
      'template_text_pdf_font_name',
      8f0d890b3b9341458322c7bbe6
e772
      'template_text_pdf_color_html',
      'vendor_paragraph_pdf_font_name',
      'vendor_paragraph_pdf_font_size_px',
      'vendor_pdf_color_html',
      e2bda39c85f19476deeb3d454b
1 8672e2b a39c85f19 76deeb3d4
      'vendor_logo_max_width_px',
      'vendor_logo_max_height_px',
      'vendor_logo_pdf_left_x',
      'vendor_logo_pdf_bottom_y',
      b32f3c9877e6b85df3c9364ed2
09c56
      'vendor_paragraph_tcpdf_height',
      'tcpdf_width_inches',
      'tcpdf_height_inches', /*positioning fields*/
      'template_product_max_height_px',
      63fe08fda3c32fd80e85f19c1e
56b2a9
      'template_product_max_width_px_pdf',
      'template_product_max_height_px_pdf',
      'template_product_pdf_left_x',
      'template_product_pdf_bottom_y',
      8d7c847d2498abd555dd436c0b
a7b6
      'template_product_htm_top_y',
      'template_manufacturer_max_width_px',
      'template_manufacturer_max_height_px',
      'template_manufacturer_max_width_px_pdf',
      68ed9e1191f3606201afe5d1c7
af312168ed9e1191
      'template_manufacturer_pdf_left_x',
      'template_manufacturer_pdf_bottom_y',
      'template_manufacturer_htm_left_x',
      'template_manufacturer_htm_top_y',
      39c1a7ade97d215f0296d453bd
8f668439c
      'template_htm_background_height_px',
      'template_pdf_background_width_px',
      'template_pdf_background_height_px',
      'template_text_pdf_left_x',
      3ea7317dca9af61840978d4120
077
      'vendor_paragraph_tcpdf_left_x',
      'vendor_paragraph_tcpdf_top_y',
    );
    $disabled = "disabled='true'";
    1467beadc27e 0 8d571d16550af
50821467be
    $displaynone_inline = "display:none";
    if (isset($v_data['ttid']) && $tbl_name == "marketing_templates_text") {
      $elements_marketing_templates.= "<div id='template_edit_template_widget_ttid_" . $v_data['ttid'] . "_form'>";
    }
    f02f f7 5830981284 b2 dc6ee6
56a2f02f2f7c583 98
      $elements_marketing_templates.= "<div id='template_edit_vendor_widget_ttid_form'>";
    }
    else {
      $elements_marketing_templates.= "<div id='template_edit_template_widget_ttid_form'>";
    20
    // _hide/show_ class fields for button, toggle_css_pos_fields for text/textarea elementas
    $toggler_button = "
     <input type='button' onclick='$(\".toggle_css_pos_fields_show\").hide();$(\".toggle_css_pos_fields_hide\").fadeIn();$(\".toggle_css_pos_fields\").toggle();' class='toggle_css_pos_fields_show' value='SHOW CSS/POSITIONING/RESIZING FIELDS' />
     <input type='button' onclick='$(\".toggle_css_pos_fields_hide\").hide();$(\".toggle_css_pos_fields_show\").fadeIn();$(\".toggle_css_pos_fields\").toggle();' class='toggle_css_pos_fields_hide' style='display:none' value='HIDE CSS/POSITIONING/RESIZING FIELDS' />
    91d
    $disable_sumbit = "";
    if ($add_form == 1) $disable_sumbit = "disabled='true'";
    $displaynone = "display:none";
    $elements_marketing_templates.= "
     6d037 c4826e2b572fa64
     <input type='submit' $disable_sumbit>
    ";
    $elements_marketing_templates.= $toggler_button;
    $elements_marketing_templates.= "
      4bb545
      <br/>
    ";
    $elements_marketing_templates.= "
    <table>
    d49
    $i = 0;
    $displaying_incr = 0;
    $element = "";
    foreach($this->{"get_columns_" . $tbl_name}() AS $k => $v) {
      8b 5d712eae 9f 874 1ee55dd
0070 e b05d
      // set values, or no value else $field_value = trim(($v_data[$v]));
      /*
      if(in_array($v,array_keys($form_element_maxsize_arr))) {
      $maxsize_str= 'data-maxsize="'.$form_element_maxsize_arr[$v].'"';
      6181cd8
      $maxsize_str= 'data-maxsize="'.$form_element_maxsize_arr["default"].'"';
      }
      // ad hoc setting of template text for body to 1900
      if($v=='template_text' && $v_data["weight"]==101 ) {
      74828c1cab9ce 73d45f6e83e2
6137d37482
      }
      else if($v=='template_text' && $v_data["weight"]==1 ) {
      $maxsize_str= 'data-maxsize="55"';
      }
      1208 c12c2e4cd19679ef50611
 d2 ff1208bc12c2e4cd19679e 5 61
      $maxsize_str= 'data-maxsize="55"';
      }
      */
      if ($v == 'template_text') {
        9ff7ca309375 d a7c5fbb46
e6636e a ff7ca3093757dba7c5fbb46
e6636e7a f 7ca30
      }
      else if (is_numeric($v_data[$v])) {
        $maxsize_str = 'data-maxsize="10"';
      }
      75e3 70 5a5c1929105f37e036
b1e bd75 3f
        // 256 for "tag" fields
        $maxsize_str = 'data-maxsize="256"';
      }
      else {
        4b 75e532d 520d1 3697fa
        $maxsize_str = 'data-maxsize="75"';
      }
      // change "toggle" to toggler later?????????????????
      if (in_array($v, $displaynone_arr, true) || in_array($v, $displaynone_toggle_arr, true)) {
        0cf0ffd31164c03a48b f e7
ecff23140cf0f
      }
      else {
        $displaynone_inline = "";
        $displaying_incr++;
      a6
      if (in_array($v, $displaynone_toggle_arr, true)) {
        $toggle_css_pos_fields_inline = "toggle_css_pos_fields";
      }
      else {
        e306177e82d52d61f42aebf4
c73b 2 9e30
      }
      if ($v == 'name') {
        $displaynone_inline = "display:none";
      }
      39693f943a0f e eef11b37147
8e942039693f943
      $element.= "
        <td style='width:650px;padding-bottom:10px;color:#fff;" . $displaynone_inline . "' class='" . $toggle_css_pos_fields_inline . "'>
        <lable for='" . $v . "'/><nobr>" . strtoupper(preg_replace('/_/i', ' ', $v)) . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</nobr><br/>
        <textarea rows='5' cols='75' id='" . $v . "' name='" . $v . "' " . $maxsize_str . ">" . $field_value . "</textarea>
        ab8468
        ";
      // if( ($displaying_incr%2==0&&$displaying_incr>0)) {
      $elements_marketing_templates.= "
        <tr>
        8 4 9dd751d6 0 b8
        </tr>
        ";
      $element = "";
      // }
      0f638d
    }
    if ($tbl_name == "marketing_templates_text" && $add_form == 1) {
      $cmd = "add_widget";
    }
    e1 31d92898f6 ff e43652e8f19
8541e1b31 92 98f6bffde 36 2e f1
      $cmd = "add";
    }
    if ($tbl_name == "marketing_templates_text" && $add_form == 0) {
      $cmd = "update_widget";
    7f
    if ($tbl_name == "marketing_templates" && $add_form == 0) {
      $cmd = "update";
    }
    $elements_marketing_templates.= "
    1a3fb
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    <lable for='sub_" . $tbl_name . "'/><nobr>SUB " . strtoupper(preg_replace('/_/i', ' ', $tbl_name)) . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</nobr><br/>
    <input type='text' id='sub_" . $tbl_name . "' name='sub_" . $tbl_name . "' value='sub_" . $tbl_name . "'/>
    </td>
    4b1 3d1df8b35bd914aa5e0054e3
f0db4b1c3d1df8b35bd914aa5e0054e3
f0db4b1
    <lable for='sub'/><nobr  >CMD</nobr><br/>
    <input type='text' name='" . $cmd . "' value='2' " . $tbl_name . "  />
    </td>
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    9c288d c468ed914 0 1 41db5ba
0 5 9c288dec468e 9140001141db5ba
01
    <input type='text' name='tab_index' value='" . $tab_index . "' " . $tbl_name . " />
    </td>
    </tr>
    ";
    b0484816e097744e6a1a257ad5ad
29 7b
    </table>
     <input type='submit' $disable_sumbit>
    ";
    $elements_marketing_templates.= $toggler_button;
    874d899066e14fcb316091c1a51c
ed 48
     </form>
    ";
    if ($tbl_name == "marketing_templates_text" && $add_form == 0) {
      $elements_marketing_templates.= "
      1ea76e
     <form>
      <table>
    <tr>
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    ac9d6f9 f05c1d41c3b4bbf3506a
6f2cac9d6f91 05c1d41c3b4bbf350
     <input type='text' name='delete_widget' value='1' />
    </td>
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    <lable for='tid'/><nobr >TID</nobr><br/>
     4ae4d3 f1188eea1fa e0e2f5ba
b 0074ae4d a 1188eea1fa5e0e f ba
b3
    </td>
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    <lable for='ttid'/><nobr >TTID</nobr><br/>
     <input type='text' name='ttid' value='" . $v_data['ttid'] . "'/>
    531330
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    <lable for='tab_index'/><nobr>TAB INDEX</nobr><br/>
     <input type='text' name='tab_index' value='" . $tab_index . "'/>
    </td>
    9521bd
    <tr>
    <td style='width:650px;padding-bottom:10px;color:#fff;'>
     <input type='submit' value='Delete Widget' disabled='true'>
    </td>
    40c282
    </table>
    </form>
      ";
    }
    36 0eae55bbc4 7d a12df6b5258
6b9c3690e e5 bbc487d0a 2d 6b 25
      $elements_marketing_templates.= "
      <br/>
     <form>
      <table>
    f5cf5
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    <lablel for='delete_widget'/><nobr>DELETE </nobr><br/>
     <input type='text' name='delete' value='1' />
    </td>
    01f 18c54f1836acdcba953e3aa2
68f401f518c54f1836acdcba953e3aa2
68f401f
    <lable for='tid'/><nobr >TID</nobr><br/>
     <input type='text' name='tid' value='" . $v_data['tid'] . "'/>
    </td>
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    eaba48 b81fe625e4ea2144d62dd
58eb aba48eb81fe625e4ea
     <input type='text' name='tab_index' value='" . $tab_index . "'/>
    </td>
    </tr>
    <tr>
    c44 e206464859414a69f7879d90
306bc44be206464859414a69f787
     <input type='submit' value='Delete Widget' disabled='true'>
    </td>
    </tr>
    </table>
    7d839453
      ";
    }
    $elements_marketing_templates.= "
      </div>
    3ac
    return $elements_marketing_templates;
  }
  public function tcpdf_create_blank()

  aa
  }
  public function zend_pdf_create_blank($pdf_basename, $pdf_filename)

  {
    0c56 0 65d e0bc647cebbb
    $inches_x = 9;
    $inches_y = 11;
    $src = "iblast_blank/" . $pdf_filename;
    $dst = "iblast_blank/resized_" . $pdf_filename;
    1c8d 5 b3c35d0b08ed1e881916
    // set inches from image size rather than predefined pdf size(quality loss?):
    $inches_x = ($tmp[0] / 72) * (8 / 6);
    $inches_y = ($tmp[1] / 72) * (8 / 6);
    $pdf->pages[] = new Zend_Pdf_Page($inches_x * 72, $inches_y * 72);
    323a1a 8 3fa655804 2 e3b9
    $height = $inches_y * 72;
    $width_px = $inches_x * 72 * (8 / 6);
    // 6pts==8pxs,9"==648pts=864px
    $height_px = $inches_y * 72 * (8 / 6);
    03 bbaa23142f44a 2192d71
    // quality loose when resizing, auto resized in zend
    // image_resize($src, $dst, $width, $height, $crop=0){
    // $this->image_resize($src, $dst, $width_px, $height_px, 0);
    $image = Zend_Pdf_Image::imageWithPath($src);
    12 98ebf 21 342089 6d 7bf 55
c
    // $page->drawImage($image, $left, $bottom, $right, $top);
    $pdf->pages[0]->drawImage($image, 0, 0, $width, $height);
    unlink("iblast_blank/" . $pdf_basename . ".pdf");
    $pdf->save("iblast_blank/" . $pdf_basename . ".pdf");
  3d
}

