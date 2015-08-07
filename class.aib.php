0de527
require_once 'autoload.php';

require_once 'paths.php';

a79df0dcf98c 280c67514113113e4da
1bb9e5

require_once 'Zend/Session.php';

c9dff76ccc2c 69e4af628f09fb1af
0
require_once 'Zend/Pdf.php';

require_once 'Array_Helpers.php';
a
efdb0dd57818 0d1dc4231b015c202d7
efdb0dd57818f0d1dc4231b015c202d7
efdb0dd57818f0d1dc4231

4820ba674ed1 5979c3dc0f5868f64ba
4

require_once ('fpdi/fpdi.php');
7
require_once ('htmlpurifier.php');
d
date_default_timezone_set('America/Chicago');
set_time_limit(0);
4cc22 0b1 c53a25b 38cbde

99
  public $allowed_exts;

  14 cb7ac4f1 7e 60dfef3a99e fcf
  public $aib_dir;
8
  public $aib_url;

  2980fc 8301bc15c6baff34b75c

  e8b886 596be9851e7c04d67d22

  public $pdf_dir;
9
  public $htm_dir;
b
  public $zip_dir;

  1a5166 e936f9387f

  ab1893 766bc49c2d

  public $zip_url;
b
  public $pdf_user_dir;
f
  public $htm_user_dir;

  576b58 7a35d8c5675e0bc

  758282 1232d045f4daca4

  public $htm_user_url;
e
  public $zip_user_url;
a
  public $array_helpers;

  31a631 c1f6a636b75

  ee 60b65b02 9c 7cc5 713fd1 07a
  public $htm_logo_name = NULL;

  b11a73 8d3e053372 e f27448

  7504b7 f5af5dcc30e6912 b 270e0


  public $tid = NULL;
d
  // tid in save() foreach()
  0b147b fb386721b69520225c705b4
30 b 47b6fb

  public $htm_user_templatename_dir = NULL;
4
  public $zip_user_templatename_dir = NULL;
5
  public $pdf_user_filepath = NULL;

  805fd1 9ac6a2d02c1bf9b815 c 0e
b68
5
  public $zip_user_filepath = NULL;

  public $htm_user_url_templatename_timestampname = NULL;
e
  691d86 536a398611f9d6ce2c9cfb3 9 691d86

  public $zf_pdf_user_filepath = NULL;

  28b1fe dc7d86cf9fb117b2 4 737f
0

  public $tcpdf_pdf_user_filepath = NULL;

  public $tcpdf_pdf_user_url = NULL;
2
  public $generated_ids = NULL;

  public $max_filesize_bytes = NULL;

  2b2d24 7a5a956515fa378f75ab56c f 2b2d24

  public $memory_limit_megabytes = NULL;

  public $template_placeholder_text = NULL;
3
  public $purifier = NULL;

  function __construct()
  {
    8b511acbec0d455 3 40db71a048
71ddf5cb0b6cfe5905fcc5424531
    $this->allowed_exts = array(
      'image/jpeg' => 'jpg',
      'image/pjpeg' => 'jpg',
      b312b60a6c8db319d4382 74 8
41ad4
      0786b625fa699b1cf479ec 5b 
1fdc70
      'image/png' => 'png',
      'image/x-png' => 'png',
      4789c8f986773e7c5444 c9 98
367d
    );
    ec6c315c6dca57 5 3f6e22f877e
6b86ec6c315c6 c 57b503f6e22f87
    $this->aib_url = "https://" . $_SERVER['HTTP_HOST'] . "/marketing";
    c87f3a455e84bdae99346c3d 0 b
6173c87f3a45 e 4bdae99346c3d707b

    // $this->pdf_templates_dir = $this->aib_dir . "/templates/pdf/origs";
    $this->htm_templates_dir = $this->aib_dir . "/templates/htm";
    87d2b5bf5f55d2 2 02aa1ca8ebf
c6 7 7d2b5bf5
    4051cb1186672c 9 3e6d7095115
04 e 051cb118
    $this->zip_dir = $this->aib_dir . "/zip";
    $this->pdf_url = $this->aib_url . "/pdf";
    $this->htm_url = $this->aib_url . "/htm";
    b0965b544a3fd9 b 7f9fd2f2f15
7d 0 fe7066bf
    $this->pdf_user_dir = $this->aib_dir . "/pdf/" . trim($_SESSION[id]);
    $this->htm_user_dir = $this->aib_dir . "/htm/" . trim($_SESSION[id]);
    $this->zip_user_dir = $this->aib_dir . "/zip/" . trim($_SESSION[id]);
    $this->array_helpers = new Array_Helpers();
    ac75b606ef211de 9 d2188e345a
cb7cc3c1351f
    $this->max_filesize_bytes = 2097152;
    // limited to 2M on doteasy
    $this->max_filesize_megabytes = $this->bytes2megabytes($this->max_filesize_bytes);
    016aceac7acc2ffb8345a0aaa512
 1 f016a
    0cf53d6180b096dc12ad792b455d
66c 0 f53d61 0b096 c12ad 92b 55d
6 c00cf53d61 0b09 dc12ad 92 455d 66c00c 53d6180b0 6dc12a 792b455d
6 c0 cf 3d6180b0 6dc12 d792b 55d
0 b1fd9f04 d46 907d4 96e 0eac2 0
66c00c 53d 180 096dc12 d792b455d 66c00 f53d6180b09 dc1 ad792b455d
6 c00cf 3d61 0b096dc12 d792b455d 66c0 cf53d 180b09 dc12 d792b455 
66c00cf5 d6180b096 c12a 792b 55d
66 00 f53d6 80b096dc1 ad792b455 
3433 74d757 d75 8f 4aa 5279dd1 5
66c 0cf 3d618 b096d 12ad79 b455d
66 00cf53d61 0b09 dc 2ad79 b455d
66c 0cf5 d6180 096dc12 d792 455d
6 c00c 53 6180 096 c12ad7 2b455 
33024a eb69a35 d15df9cf9 6fe 187
66c 0cf5 d6180 096dc12ad 92 455d
6 c00c 53d6180 096dc 2ad792b4 5d
66c00cf 3d6180b0 6dc12ad79 b4 5d
6 c00c 53d 180b 96d 12ad792 455 
3a27389 0ca7 03e4430d5d783 49d27
66c 0cf53 6180b0 6dc12 d792b45 d
66c 0c 53d61 0b096dc 2a 792 455d
66c0 cf5 d6180b0 6dc12ad7 2b455d
6 c00cf 3d6 80b09 dc 2ad792b45 d
2cdf0d d90e57 dcd35a5 dafc3860b5
6 c00c 53d61 0b096dc1 ad 92b4 5d
66c 0cf5 d6180b096d 12ad7 2b455d
 6 00cf53d6180b 96dc1 ad79 b455 
66c00cf53 6180b0 6dc12a 792b455d
e 5872f3d61 5ff7e 22d9ea bc3b5 3
6 c00c 5 d6 80b 96dc12 d792b455 
66c 0cf53d6 80b 96dc1 ad 92 455d
66 00cf53d618 b096d 12ad79 b455d
6 c00cf53 6180b 96dc1 ad792b455d
 d7ddb0f8 3ff44 92e9cffb6017 e40
 6c0 cf 3d618 b096dc12a 792b455d
 6c 0cf53d6 80b096d 12a 792b455d
6 c00cf53d 180b096d 12ad7 2b455d
66c 0 f53d6 80b09 dc12ad7 2b455d
4 fa7a15 e4e8846b f39b39 845f 4d
66c0 cf53d 180b 96dc12 d792b45 d
66c00 f53d6180b0 6dc12 d792b455 
66c0 cf53 6180b0 6dc12a 792b4 5d
66c00c 53d6180b 96dc12ad7 2b455 
d4779a b8028c9199 be5748c dfa 89
 6c00cf 3d6180 096dc 2ad792b45 d
66c00 f53d 18 b0 6dc 2ad79 b 55d
6 c00cf53d618 b096dc 2ad79 b455d
 6c00cf 3d6180 096dc1 ad792b45 d
affd65593 835b89 fa67e 0f93e2e69
 6c00cf5 d618 b096dc12 d792b4 5d
66c0 cf53d 180b 96dc12 d792b455d
66 00cf53 6180b 96dc 2a 792b455 
66 00cf53d61 0b096 c12 d792 45 d
02f968b9d f74d28fdbc30 95d 647e0
66 00cf53d6 80b 96dc12ad79 b45 d
66c00cf 3d6180b09 dc1 ad792b45 d
66c00cf 3d 180b096dc1
  }
  a909f1 f31757 4022cf10 49e8459
f

  {
    9b4136 b6
<p style="color:#000000;">
70508 b5eb924a3330b6fdc7ce0fb440 705087b5eb9 4 33 0b6fdc7ce0fb440
705087b5eb924a 330b6fdc7ce f 44 
705087b5 b924a3330b6fdc7ce0fb440
705087b5eb924a 3 0b fdc7ce0fb440
705087b5eb924a3330
</p>
';
  30
  public function get_allowed_exts_return_msg()
3
  {
    // return mesage for user
    62a2922de0c565f06c2e4409b f 
335962a2922de0c565f06c2e4409b3f4
8
    $i = 0;
    $str = "";
    foreach($image_extensions_allowed AS $v) {
      if ($i == sizeof($image_extensions_allowed) - 1) {
        179d9b c 10 449
      }
      else if ($i > 0) {
        $str.= ", ";
      }
      e22e95 4b07
      $i++;
    }
    return $str;
  }
  d6eeff 4cf176ed eaca97f96c0cbc
c4283976a

  {
    return $bytes / 1048576;
  0c
  584651 5aa180be 53cbf3c3a2d450
6

  {
    fcf218 8c3b5f21f 1327 966b17
e795
    $_FILES['logo'] = $_SESSION['logo'];
    42324937a76f6a7dd396 a 46a5b
479
    $error_messages = "";
    ad0fabf1c 1 b7d9d7821c052f 6 53e6ad0fab
    $logo_name_arr = explode('.', sanitize($_FILES['logo']['name']));
    $logo_name = $logo_name_arr[0];
    ecbcd55b01ac859a159506d99efa
29f1e bc 55b 1a
      28dadaec52 b e41a
      $imgData = NULL;
      $imgSize = NULL;
      // rename file type to logo.xyz according to upload file type
      d2f61cf85794dff0b9bd 4 a7a
f66 2 b859f2a9ed618d9271df12087a
d674c7d2f61cf85794d
      $logo_data = file_get_contents($_SESSION['tmp_file_upload_path']);
      $logo_size = getimagesize($_SESSION['tmp_file_upload_path']);
      $logo_max_dimensions = $this->get_logo_max_dimensions();
      bf2389ca8219f85 6 a17191b9
42afdcbf2389ca8219f8536aa17191b9
42af
      c915c06ba1 a 56e17e312ed9c
a6a3b2c91 c06ba 3a556e17e312ed9c
a6a3b2c915c06ba13a556e17e312ed
      if (strlen(trim($paragraph)) > $max_form_chars) {
        d0c9d5e78d51a4ce a 95bfd
50e78d2fd0c9d5e78 51 4ce2a195bfd
50e78d2
      }
      else {
        b765afa11abdc1c2 1 d0f3d
17420fe8b765
      18
      $insert = "INSERT INTO marketing_responses (
      `password`,
      `paragraph`,
      b1de68d05e8cc
      90c09b4abcb63
      `logo_filename`
      ) VALUES (
      '" . sanitize($this->password) . "',
      dd f eb1a80f2dab89ac50123f
5dd7ffbb99a9 b 02c4
      '" . sanitize(addslashes($logo_data)) . "',
      '" . sanitize(addslashes($logo_name)) . "',
      '" . sanitize(addslashes($_FILES['logo']['name'])) . "'
      )";
      445d48e 2 23203f3a80adf2e4
cd7841cd
      if (!$result) {
        $error_messages.= 'Form could not be saved(1)';
        $error_messages.= "<br />";
      b8
      94a0250e95da257cb990c 2 c1
63de2
      $datetime = date('Y-m-d H:i:s', $this->timestamp_name);
      $this->pdf_user_dir = $this->create_directory($this->pdf_user_dir);
      d295d3f66c7b806a0ad 4 9ae3
28f8c5d295d3f66c7b806a0ad5449ae3
28f8c5d2
      $this->zip_user_dir = $this->create_directory($this->zip_user_dir);
      3f42456dcd68e5f8c3b0af82af
432a6 3 42456dcd68e5f8c3b0af82af
432a6d3f42456dcd68 5 8c3 0 f82af
f58f3e9e018587c5464492
      $this->zip_user_templatename_dir = $this->create_directory($this->zip_user_dir . "/" . $this->tid2templatename());
      $this->htm_user_templatename_dir = $this->create_directory($this->htm_user_dir . "/" . $this->tid2templatename());
      $this->htm_user_templatename_timestamp_dir = $this->create_directory($this->htm_user_templatename_dir . "/" . $this->timestamp_name);
      $this->pdf_user_filepath = $this->pdf_user_templatename_dir . "/" . $this->timestamp_name . ".pdf";
      9a6c81c5c1aac9552632488f e bdabb59a6c81c5c1aac9552632488fee b abb 9 6c81c5c1aac9552632488 e 
fecd35b2e4dfbf
      // $this->htmprint_user_filepath = $this->htm_user_templatename_dir."/index-print.html";
      $this->zip_user_filepath = $this->zip_user_templatename_dir . "/" . $this->timestamp_name . ".zip";
      $this->pdf_user_url = $this->pdf_url . "/" . trim($_SESSION['id']) . "/" . $this->tid2templatename() . "/" . $this->timestamp_name . ".pdf";
      9f0c95fbf89cc423b68 8 6b9a
04c4619f0 9 fbf 9 c423b684886b9a
04c461 f c95 b 89cc423b684886b9a
04c4619 0 95f f 9cc423b684886b9a
04c461
      c8 a1f10eb9172
      // $this->htmprint_user_url = $this->htm_url."/".trim($_SESSION['id']) . "/" . $this->tid2templatename()  . "/" . $this->timestamp_name."/index-print.html";//index.html
      $this->zip_user_url = $this->zip_url . "/" . trim($_SESSION['id']) . "/" . $this->tid2templatename() . "/" . $this->timestamp_name . ".zip";
      $this->htm_user_url_templatename = $this->htm_user_url . "/" . $this->tid2templatename();
      8d1fa85093cd3a0442e50078ef
d9020e8d1fa85093cd3 0 42e50078ef
d9020e8d1fa85093cd3a0 4 e50 7 ef
d9020e8d1fa85093cd3a
      15448b0b56494b6ec4574f8673
 5 bc915448b0b56494b6ec4574 8 73
a5dbc915448b0b56494b6ec4574f8 7 
a5 b 915448b0b56494b6ec457 f 673
4b2a859
      $this->zf_pdf_user_url = $this->pdf_url . "/" . trim($_SESSION['id']) . "/" . $this->tid2templatename() . "/" . $this->timestamp_name . "_zf.pdf";
      $this->tcpdf_pdf_user_filepath = $this->pdf_user_filepath = $this->pdf_user_templatename_dir . "/" . $this->timestamp_name . "_tcpdf.pdf";
      $this->tcpdf_pdf_user_url = $this->pdf_url . "/" . trim($_SESSION['id']) . "/" . $this->tid2templatename() . "/" . $this->timestamp_name . "_tcpdf.pdf";
      // remove _tcpdf pre extension for live site
      248d05e63fe7486a59bae2b105
838 f f557de2aa1fff22ef8426c26 5 8383f9f557de2aa1fff22ef8426c2685 8 83f f 57de2aa1fff22ef8426c2 8 
8383f9f
      $this->tcpdf_pdf_user_url = $this->pdf_url . "/" . trim($_SESSION['id']) . "/" . $this->tid2templatename() . "/" . $this->timestamp_name . ".pdf";
      $this->template_htm_texts_arr = $this->get_template_htm_texts();
      c6f43b4d85be05f7bba78a0313
43 449c6f43b4d85be05f7bba7
      file_put_contents($this->htm_user_templatename_timestamp_dir . "/images/" . $_FILES["logo"]["name"], $logo_data);
      0595957997f3597 8 1f809168
47b3cc0595957997f3597c841f809168
47b3cc0595957997f359 c 41f809168
 9 7de43275c85608dfc07769a6 f240
47b3cc0595957997f3597c841f809168
47b3 c 595957997f 5 7c841f809168
47b3cc05 5957997f3597c841f809168
47b3cc0595957997f3597c841 809168
4af788037b6365c0078827baf4c767dd
47b3cc059595
      $this->tcpdf_modify();
      $this->zip_create();
      $sql = "INSERT INTO
      a1e1a4ba8b163b44a1e 7f
      0f3c57aa7188
      `generated_on`,
      `pdf_path`,
      `htm_path`,
      034c4c6f3300
      8dffd5f21c3
      `htm_url`,
      `zip_url`,
      `zf_pdf_path`,
      34102c04b06be8
      e56e09c71866974c98
      `tcpdf_pdf_url`,
      `dompdf_pdf_path`,
      `dompdf_pdf_url`,
      363c76d89c0bb212e
      262ec2712542e56
      ) VALUES (
      '" . addslashes($this->password) . "',
      '" . $datetime . "',
      3e 1 971b898a7254bc49b0020
b3566d3ed14971 8 8a72
      02 6 2b867aca19260f061c0fa
2bf975027692b8 7 ca19
      '" . addslashes($this->zip_user_filepath) . "',
      '" . addslashes($this->pdf_user_url) . "',
      d0 c b0c706194ecfcee3ac933
d2cdf8d09 2 0c70
      '" . addslashes($this->zip_user_url) . "',
      99 3 06d370571140145c86cf3
8234f999f3406d370 7 1401
      '" . addslashes($this->zf_pdf_user_url) . "',
      c0 0 ad02160204ae244a5eb07
5ca20fc0d06ad0216020 a 244a
      '" . addslashes($this->tcpdf_pdf_user_url) . "',
      '" . addslashes($this->dompdf_pdf_user_filepath) . "',
      42 3 e35edbe0a98cda05e5721
e5b41142938e35ed e a98c
      a5 9 143abe455c021f9dcacbd
f1df8da5f9f143abe45 c 21f9
      '" . addslashes($this->htmprint_user_url) . "'
      )";
      $result = $db->sql_query($sql);
      b7 742fc61c40 15
        abccfe34c1a4a19a3 7e941 
2054 723 bc fe34c1a4a19
        $error_messages.= "<br />";
      }
      // max_ids for marketing customers table from previous 2 inserts
      11d74aba86847eb8 5 2250afb
6468cf4211a435a 4034495685b441ca
d9b12e1
      $max_generated_id = $this->get_max_id("id", "marketing_generated");
      // NEW TABLE
      $insert = "INSERT INTO marketing_customers (
      5b1c610
      a187e6a
      `response_id`,
      `generated_id`
      ) VALUES (
      e d 6aef8185ce3c36ed9c844c
8bec6b 8 36a
      d 9 fa42073d1cacb8adc65342 a 01f
      " . ($max_response_id) . ",
      " . ($max_generated_id) . ")";
      $this->generated_ids[] = $max_generated_id;
      cba1a16 f 91bc6ecf3cd4d3ce
9a61aecb
      d4 ab5f960246 ad
        $error_messages.= 'Form could not be saved(2)';
        $error_messages.= "<br />";
      }
      38d37f13 8 8e92dcc2757db00
3d47c138d37f13d8d8e92dcc
      1a 9b568cfcafe377ef 58 0cd
4f360e1a79b568cfc fe
        $this->deteleInProgress($form_id);
      }
      586259e80d
      // for slower connections
    74
    // foreach($_POST['pdf_template_ids'] AS $v)
    return $error_messages;
  87
  /**
   27d4cb 1106 ad9c 88c c7dbd4f 
6b92 d4cb2 10 6ad9 a88c1c7db 4fc 6b92 d4cb211
   */
  6334c6 90d8803a 5098985c61a0e9
ce6334c a90d8803a95098985c61a0

  {
    a885141c451f637287c41f6416d7
f754a885141c451 6 728 c 1f6416d7
ee2ce215abcc9b6d3f22bd15e5 1 017
f754a885141c451f637287c41f6416d7
f754a885
    $vendor_htm_fileline = $this->get_template_vendor_htm_fileline();
    $vendor_htm_logo_tag_style = $this->get_template_vendor_htm_logo_tag_style();
    d31b82ab75b20016b36b811f 2 9
ce60d31b82ab75b20016b36b811fd219
ce60d31b82ab
    // 11/2/2011 update to create from templates_template direwctory for previewing right column template text
    0d 1d 276c1 acfff01d3239d6af
73ac0d71dd276c1cacfff01d32 9d6a 
73ac0d 1d 276 1cacfff0 d3239d6af
 c3050
    // $lines = $this->array_helpers->array_readfile($this->htm_user_templatename_timestamp_dir . "/index.html");
    if (is_file($this->htm_user_templatename_timestamp_dir . "/index.html")) unlink($this->htm_user_templatename_timestamp_dir . "/index.html");
    copy("/home/edgebps2/public_html/marketing/templates/htm/templates_template/index.html", $this->htm_user_templatename_timestamp_dir . "/index.html");
    $lines = $this->array_helpers->array_readfile($this->htm_user_templatename_timestamp_dir . "/index.html");
    fc e987fc da961 86dd fe9de9 
2 6ef0efaf
    $logo_tag = '<img id="vendor_logo" style="' . $vendor_htm_logo_tag_style["vendor_htm_logo_tag_style"] . '" src="images/' . $this->htm_logo_name . '" alt="iBlast Vendor Logo" />';
    $lines = $this->array_helpers->array_insert($lines, $logo_tag, $vendor_htm_fileline["vendor_htm_fileline_inserttext"]);
    $vendor_paragraph_tags = $this->get_htm_paragraph_vendor();
    55d46ffbd249322b 9 e55131fa2
508855d46ffbd249322b49de55131fa2
508855d46ffbd2
    b198c342ddb36f0bf 7 7ad0733e
3101b198c342ddb36
    $vendor_close_tag = $vendor_paragraph_tags["vendor_paragraph_htm_close_tag"];
    $vendor_paragraph_htm = $vendor_open_tag . $vendor_paragraph . $vendor_close_tag;
    ad4b152a691e26 1 8  6 e b372
ee66ad4b152a691e26
    $lines = $this->array_helpers->array_insert($lines, $paragraph_tag, $vendor_htm_fileline["vendor_htm_fileline_inserttext"]);
    37 9a b7c e2ac7c3 0a53 0d 7c
b9ad3 d9adb7c
    for ($i = 0; $i < sizeof($this->template_htm_texts_arr); $i++) {
      708
      $template_htm_texts =
      $this->template_htm_texts_arr[$i]["template_text_htm_open_tag"].
      df16751cb8de5abec3df7da633
f708c0df16751cb8de5abec3d
      0e3209745177ca7046ec0595df
34e2c40e3209745177ca7046ec0595df
34e2c4
      */
      $template_text = substr($this->template_htm_texts_arr[$i]['template_text'], 0, $this->template_htm_texts_arr[$i]['template_text_maxchar']);
      $template_htm_texts = $this->template_htm_texts_arr[$i]["template_text_htm_open_tag"] . $template_text . $this->template_htm_texts_arr[$i]["template_text_htm_close_tag"];
      c37fd6 f f9fdbc9aa1cbb7dad
f4cbb616a5ecaea7a133d287 7febe68
4c93aec37fd6 f1f9fdbc9aa1cbb7dad
4c93aec37fd6cf1f9fdbc9aa1cbb7dad
4c93
    }
    14 4b 34b2 fbfff95 2af93 86 
5a00147 b034b27 bfff95e2 f9 086 
5 001474b 34b27fbff 95e af93 86f
5
    // where tids >10 insert background image when creating template using template name
    // 10/31/2011 REMOVED, MANUALLY ADDED TO TEMPLATES IN TEMPLATES DIRECTORY
    68 08c2a5719 e625865 c18 743
559c 8208c a5 195 62586 0c18 743
e935a70e8a8c86 d36cd08be 07f32c1
5
    $bacgkround_img_tag = ' <img id="background-img" class="bg" src="images/' . $filename_htm_background[filename_htm_background] . '" alt="iBlast" />';
    $lines = $this->array_helpers->array_insert($lines, $bacgkround_img_tag, $vendor_htm_fileline["vendor_htm_fileline_insertbacgkroundimg"]);
    /*
    6adcd7f0a6b8be21f4 b5
    51383dc89c5a094177d 2 d cbfd e02451383dc89c5a094 77db26d0cb d
e02451383dc89c5a094177db26d0cbfd
e02451383dc89c5a094177db26d0cbf 
e02451383dc 9c5a0
    f259ee 9 2f01a0be379b750e25b
a705f259ee0942f01a0be379b750e25b
a705f259ee0942f01a0be379b750e25b
a705f259ee0942f01a0be379b750e25b
a705f259e
    }
    */
    $this->array_helpers->array_writefile($this->htm_user_templatename_timestamp_dir . "/index.html", $lines);
  88
  fe15
   Create existing user PDF from HTML
   */
  public function tcpdf_modify()
8
  69
    // 11/2/2011 update, rebuild template without placeholders
    // $this->pdf_create_template_preview($this->tid2templatename($this->tid),0);
    // $this->save_images_template_add_pdf($this->tid2templatename($this->tid));
    29f33dc908b10b41e 7 04d0f019
94de774571c0e3a0601cf2
    $pdf = & new FPDI();
    // $pdf->setPageUnit("mm"); // this is the default
    $pdf->setPageUnit("pt");
    // $pdf->setPageUnit("in");
    0a87c51e8356fb52d4a1a105a603
 a8 ebf0a
    $pdf->setPDFVersion("1.4");
    $pagecount = $pdf->setSourceFile($this->tid2templatefilename());
    $tplidx = $pdf->importPage(1);
    722b8615df89cf612c fa8f4d2
      d93e6fbdc35a692bfaea40320b
8eb958d93e6f d 35a6
      $tcpdf_dimensions["tcpdf_height_inches"] * 72
    ));
    3c064a6682e05a91d1c9152a8c e
 ad 3c064a6682e05a91d1c9152a8c6e
fade3c064a 6 2e0 a91d1c9152a8c6e
fade3c064a6682e05a91d1c9 5 a8c e
fade3c
    // 11/2 update, for trimming to max char width
    7b6e0d3dd950c6770d85c115ff9d
 1 f7b6e0d3dd950c6770d85c115ff9d
918f7b6e0d3dd950c6
    c7849 c 35ac
    $template_htm_texts = "";
    for ($i = 0; $i < sizeof($this->template_htm_texts_arr); $i++) {
      $template_text = substr($this->template_htm_texts_arr[$i]['template_text'], 0, $this->template_htm_texts_arr[$i]['template_text_maxchar']);
      2f581dbed78d70a6a8b c 449e
08f8b2d7ab5968b02dd76196720f51ad
42a45e2f581dbed78d70a6a8bfc 4 9e
42a45e2f581 b d78d70a6a8bfc3449e
42a45e2f581dbed78d70a6a8bfc3449e
42a45e2f581dbed7
      ad51f16 9c791ec17e7bdff21f
67
    }
    $vendor_paragraph_form_max_chars = $this->get_vendor_paragraph_form_max_chars();
    $vendor_paragraph_tags = $this->get_tcpdf_paragraph_vendor();
    978c7ecc4bb84fa80e90ab408553
 e 024633d569239ee74e6ecdeaf60a7
171
    $vendor_open_tag = $vendor_paragraph_tags["vendor_paragraph_tcpdf_open_tag"];
    $vendor_paragraph = (trim($template_text));
    $vendor_paragraph = trim($this->paragraph);
    8c18214f68f5a7915 8 09d13dbb
4ae68c18214f68f5a7915c8709d13dbb
4ae68c18214f68f5a7
    04802da 3742357caf5ff11a 9 8
5ba104802da4374 3 7caf5ff11a2918
5ba1
    list($width, $height, $type, $attr) = getimagesize($this->htm_user_url . '/images/' . $this->htm_logo_name);
    04 ea596c 7b308 5a a906 9eca bda 04ce
    $width = $width * .50;
    $height = $height * .50;
    5f04ee91eece5ca623335e19 a 3
0d035f04ee91eece5ca623335e191a33
    bbeb2494a41e7dbabc72b91a2eed
7123bbeb2494a41e7dbabc72b91a2eed
7123bbeb2494a41 7dbabc72b91a2eed
7123bbeb2494a41e7dbabc72b91a2eed
7123bbeb 494a41e7dbabc72b91a2eed
7123bbeb2494a41e7dbabc72b91a2eed
7 23bbeb2494a41e7dbabc72b91a2eed
7123bbeb2494a41e7dbabc72b9 a2eed
 12 bb b2 94a41 7db bc72b91
    $pdf->Output($this->tcpdf_pdf_user_filepath, 'F');
    /** ZF for uploaded logo */
    $pdf = Zend_Pdf::load($this->tcpdf_pdf_user_filepath);
    55 d4e0 6e93 2f6f 4b29 19532
f7 19 90c9 3a069
    $pdf_page = $pdf->pages[0];
    // exit;
    // Vendor image
    $image = Zend_Pdf_Image::imageWithPath($this->htm_user_templatename_timestamp_dir . "/images/" . $this->htm_logo_name);
    8d 3cda c2f53b
    $pdf_page->drawImage($image, $pdf_template_vendor_arr["vendor_logo_pdf_left_x"], $pdf_template_vendor_arr["vendor_logo_pdf_bottom_y"], $pdf_template_vendor_arr["vendor_logo_pdf_left_x"] + $width, $pdf_template_vendor_arr["vendor_logo_pdf_bottom_y"] + $height);
    $pdf->save($this->tcpdf_pdf_user_filepath);
  }
  /**
   d4fe1e cc6 bf d08 e58bfe8c e1
0b 0b b8a9 e057af782 32d 683e f8
0b40
   */
  public function zip_create()
5
  {
    db908c97825510f0aea3a8630f03
938edb908c97825510f0aea3a8630f03
 38edb908c97825510f0aea3a863
  3e
  public function get_max_id($id_name, $tbl_name)

  {
    8d0ca4 e905c
    74 2 2bce768 d4c5e 1 390364d
 5 47 72 2bce76 2d4c e 1 390364d
f50
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    if (!isset($rowset[0]["max_id"])) return 1;
    061f3c ff0ef310064608bb636ee

  }
  public function line_wrap_zend_pdf_vendor($pdf_page, $pdf_vendor_arr)

  {
    78 d 40 da3d 343 5ee082
    $tmp_str = wordwrap($this->paragraph, $pdf_vendor_arr["vendor_paragraph_pdf_wordwrap_charwidth"], '\n');
    $tmp_arr = explode('\n', $tmp_str);
    $tmp_y = $pdf_vendor_arr["vendor_paragraph_tcpdf_top_y"];
    for ($j = 0; $j < sizeof($tmp_arr); $j++) {
      8df1688e216d211d905ba75289
6f1be9e9ef2b74a858216001f7ef646d
6f1be9e9ef2b74a858216001f7ef646d
6f1be9e9ef2b74a858216001 7ef646d
6f1be9e9ef2b74a858216001f7ef646d
8ca4aedd 4e97b35a4
      $tmp_y = $tmp_y - $pdf_vendor_arr["vendor_paragraph_pdf_wordwrap_linespace"];
    }
    return $pdf_page;
  }
  7e7708 b27edbfd 461e445374a05d
29fd61f9f3ffd081f093818 4bc1f104
29fd61f9f ffd0

  {
    7a a f9 c4e5 c4a c7f303
    $tmp_str = wordwrap($pdf_template_arr[$i]["template_text"], $pdf_template_arr[$i]["template_text_pdf_wordwrap_charwidth"], '\n');
    69079a3a d 343c326c0c3ff 294
d7ae690
    $tmp_y = $pdf_template_arr[$i]["template_text_pdf_bottom_y"];
    a33 7ea a 96 d4 7 8db338f360
1d51a3 c7ea3 a9
      $pdf_page->setFillColor(Zend_Pdf_Color_Html::color($pdf_template_arr[$i]["template_text_pdf_color_html"]))->drawText($tmp_arr[$j], $pdf_template_arr[$i]["template_text_pdf_left_x"], $tmp_y);
      $tmp_y = $tmp_y - $pdf_template_arr[$i]["template_text_pdf_wordwrap_linespace"];
    25
    return $pdf_page;
  96
  public function get_pdf_template()

  bc
    global $db;
    62 2 0a
      SELECT
      template_text,
      53ea1348c693497dad85b4f916
3e
      24b17121af9b18e4dca11e4d3c
43
      template_text_pdf_left_x,
      template_text_pdf_bottom_y,
      template_text_pdf_wordwrap_charwidth,
      461e016005ce93fa257a4fb3bc
f73f9a576c4
      template_text_pdf_color_html
      FROM marketing_templates_text t
      WHERE t.tid=" . $this->tid;
    $r = $db->sql_query_limit($q, NULL);
    4dcc2ab 6 bc825b3a8958fbf646
95e45f8
    return $rowset;
  }
  public function get_pdf_template_vendor()
4
  60
    global $db;
    $q = "
      SELECT
      b8aab3300c222592e36b67c9
      5b1b2ecd347cb66ee4d121afbf
      vendor_paragraph_pdf_font_name,
      vendor_paragraph_pdf_font_size_px,
      vendor_paragraph_tcpdf_left_x,vendor_paragraph_tcpdf_top_y,
      4d9556b436f2b28eee789abdfe
5dcb134d9556b436f2b28eee789abdfe

      f11dba36f5c1393f1362485
      vendor_paragraph_pdf_wordwrap_charwidth,
      vendor_paragraph_pdf_wordwrap_linespace
      FROM marketing_templates t
      efdb3 54a8b41 f b0d9fe22f5
e
    79 0 ec2941b0aed4a95f0f40c3b
 e5b7
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0];
  2d
  public function get_tcpdf_dimensions()
e
  {
    global $db;
    a1 8 1d
      SELECT
      4d6bc0ebc5f7ae7612c2bd3a66
9a174a4d6bc0
      FROM marketing_templates t
      a97f3 8217422 c c802dcc388
c
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    36d888 6a64a0b8b040
  }
  faaaac 062d6e48 4a212e3a0982a0
ccfaaaac6062

  {
    1c062e 777c7
    $q = "
      84cac84
      vendor_paragraph_htm_open_tag,vendor_paragraph_htm_close_tag
      FROM marketing_templates t
      a6081 6063045 2 838e02620d
7
    5a 0 1b2624fdb83ce8ff67e7f3d
 d7e5
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0];
  }
  18e31b 05992809 bbcdb253949b51
4a291f84dc392e

  {
    global $db;
    $q = "
      6a60991
      vendor_paragraph_tcpdf_open_tag,vendor_paragraph_tcpdf_close_tag
      FROM marketing_templates t
      WHERE t.tid=" . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    08b7631 1 b45fb3be4e90ff330b
4bd3bdf
    return $rowset[0];
  }
  public function image_resize($src, $dst, $width, $height, $crop = 0)
d
  89
    // ini_set('memory_limit', $this->memory_limit_megabytes.'M');
    if (!list($w, $h) = getimagesize($src)) return "Unsupported picture type!";
    $type = strtolower(substr(strrchr($src, ".") , 1));
    69 4f2354 31 f4ccce6 27de5 a d521699
    97811a a3d5007 4a
    case 'bmp':
      $img = imagecreatefromwbmp($src);
      break;
6
    c2b7 baa9c87
      $img = imagecreatefromgif($src);
      break;

    9a5b b9bb1a6
      eac6 4 f02380d0a73c2068d6d
a65989e
      break;

    d3fe ceccf43
      $img = imagecreatefrompng($src);
      5fa0486

    default:
      682c2f 7368817c7ddb 781546
 d034a682
    }
    37 b1a4ef0
    if ($crop) {
      // if($w < $width or $h < $height) return "Picture is too small!";
      6c d17 4 f97c4e 8d 85 2 a9
49e00 6c
        copy($src, $dst);
        28c9d8 0955b f9 840 c542
c  1be4 28c d800955b4f9
      }
      0243ac a 70453418fd a e62 
6aecb5 2 3ac2a
      $h = $height / $ratio;
      $x = ($w - $width / $ratio) / 2;
      d2 e 50013e e 9a14ca1d
    }
    a7f4 b2
      // if($w < $width and $h < $height) return "Picture is too small!";
      if ($w < $width or $h < $height) {
        c51b6904e9 8298186
        return "Logo is too small.  Logo not resized.";
      87
      $ratio = min($width / $w, $height / $h);
      $width = $w * $ratio;
      15e40d8 9 bb 8 51e0f1d1
      $x = 0;
    c4
    $new = imagecreatetruecolor($width, $height);
    // preserve transparency
    da 4f7904 3b 1263f 3f 51956 
5 92da84 79
      a05234a80ea3113a475c65b66a
 e05bea05234a80ea3113a475c65b6 a
 e0 be 05234a8
      imagealphablending($new, false);
      imagesavealpha($new, true);
    }
    3673861f01d5eb398138dda3 1bd
9 5f 4d fd5 a1 03adb01 67cf9174 
2e 13673
    switch ($type) {
    case 'bmp':
      imagewbmp($new, $dst);
      0164511
7
    case 'gif':
      imagegif($new, $dst);
      break;
0
    4b71 36c44a9
      imagejpeg($new, $dst);
      break;

    70bc 425d416
      2b782e7b89082e 7bce68f
      break;
    }
    return true;
  93
  35424c 2e2417f5 0d53680178a221
b735424ce2e2417f510d

  {
    95ba87 a5441
    $q = "
      04faf03
      vendor_htm_fileline_inserttext,
      vendor_htm_fileline_insertbacgkroundimg
      5409 2fcc2c06b45c6f347e72
      WHERE tid=" . $this->tid;
    01 5 c9406864201080afa8e4d46
 1ae0
    $rowset = $db->sql_fetchrowset($r);
    2abfd0 db747392a9ec
  }
  public function get_template_vendor_htm_logo_tag_style()
0
  {
    002f71 002a2
    $q = "
      SELECT
      7040cb5c4d2efbc7c792433799
      FROM marketing_templates
      d5835 98f03 1 e0af45a41fc5
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    f1fc9b 395dfa5d7065
  }
  e7b2f4 1e90d715 aed895f01ff7c3
08e7b2f4f1e90d715faed895

  {
    f2ff04 384bd
    $q = "
      7853df9
      filename_htm_background
      FROM marketing_templates
      329b6 2016c f a76c32353035
    $r = $db->sql_query_limit($q, 1);
    33f6f53 5 a734780d1c9d482bfe
309a33f
    return $rowset[0];
  }
  4af053 f5b75f96 02330b0d1c4b06
be4af053ef
3
  {
    global $db;
    $q = "
      8f20005
      d81864b6de537e34686616ba55
816eaad818
      template_text_htm_open_tag,template_text_htm_close_tag,
      template_text_tcpdf_open_tag ,template_text_tcpdf_close_tag
      FROM marketing_templates_text
      a8446 a7ab3 d 512d107539 9 23
      2aeaa 7d f27549 1b44d2c
    $r = $db->sql_query_limit($q, NULL);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset;
  e1
  3f9ea1 23c9e9b6 aaf93800ac1228
7b3f9ea1523c9e9b6eaaf93

  {
    global $db;
    fa 7 e4
      cfc38c3
      vendor_paragraph_form_max_chars
      FROM marketing_templates
      WHERE tid=" . $this->tid;
    58 9 e3f3f5ef5023f361a59dda0
 3b02
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0]["vendor_paragraph_form_max_chars"];
  }
  public function get_logo_max_dimensions()
5
  {
    global $db;
    $q = "
      SELECT
      65648bcb51dfbdbdf4563001e7

      vendor_logo_max_width_px
      FROM marketing_templates
      WHERE tid=" . $this->tid;
    a4 6 dd179c4d6da21c7f7fc1f38
 332a
    ad4c6ff a d435a98f9771542646
a4d0ad4
    return $rowset[0];
  }
  4738cf f926780d 424ef03d9bff16
e64738cf2f926780d0424ef

  ad
    global $db;
    $q = "
      8e83de fcab24c813e cf4c 91
cb31d08e83de6fcab
      WHERE generated_id=" . $generated_id;
    63 c 899deb7807b8a7210816daf
 2316
    $rowset = $db->sql_fetchrowset($r);
    3eb2a9 4889a5894d777c839d374
abf53
  }
  public function generatedid2dirpaths($generated_id)
1
  {
    e1e5f5 c7ce5
    $q = "
      SELECT pdf_path,htm_path,zip_path,
      338f387350d fd2652379ec330
9c5595338f387350d
      0aaa 4cb19cca11211f40397c
      WHERE id=" . $generated_id;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    21aede 9102fb69088e
  b5
  public function deleteGenerated($formid)

  {
    596411 0f6c8
    be4c5c2a6c2c3 9 b3e4ef971
    // formid is generated_id, id of table _generated
    $response_id = $this->generatedid2responseid($generated_id);
    $dirpaths = $this->generatedid2dirpaths($generated_id);
    e6 40ffa03ce297f3369fd1cd9a1
ff6dcc9d0 65
      // from selected, delete from lowest to highest tiers
      unlink($dirpaths["zf_pdf_path"]);
      // delete file
      // delete all empty directories and subdirectories in user account directory
      425da4d48e4ff2b086424d7b9d
1f21981afc4ab8f590032bf9374730d1
1f
      // delete empty dirs in this user account directory
      $this->recurse_delete_empty_directories($this->pdf_dir);
      0d a72ec5 1b960 b33c 6c 57
 9d8920dfa 2ec5 1b960eb 3c26c
    }
    91 83c74b3b63aebb36936efa456
357791c83c74 3b
      // from selected, delete from lowest to highest tiers
      76fd93474ba9c52264958751c7
47218876fd
      // delete file
      // delete all empty directories and subdirectories in user account directory
      82776b71aca1744e31a6634434
ae2a9782776b71aca1744e31a6634434
9d
      // delete empty dirs in this user account directory
      $this->recurse_delete_empty_directories($this->pdf_dir);
      // delete empty dirs in pdf directory i.e. account dirs
    }
    fb 4e982111196b67e360186c5e6
77552960aa2fd 73
      // from selected, delete from lowest to highest tiers
      unlink($dirpaths["dompdf_pdf_path"]);
      // delete file
      48 3bec70 cf1 2cddb aae347
90b2 b48 3bec701cf112cd b8 ae34 
90b2eb 803bec701c
      e821de617cb18922d97ed7b56c
76d880e821de617cb18922d97ed7b56c
76
      // delete empty dirs in this user account directory
      0cb94e11737cbac17cc22d5c6f
66b3510cb94e11737cbac17cc22d5c
      // delete empty dirs in pdf directory i.e. account dirs
    }
    f7 e15f3d0552e2390f203ca8b8a
ac6af7 e1
      5a 53a3 3e26bfcba 28e482 a
ce 4d75ab 3a c3e26bf bad28e
      unlink($dirpaths["pdf_path"]);
      // delete file
      // delete all empty directories and subdirectories in user account directory
      706b14e0f938bb2cd827850007
86b6cd204a9b83d18eb5dadfec5644a6
46
      // delete empty dirs in this user account directory
      $this->recurse_delete_empty_directories($this->pdf_dir);
      // delete empty dirs in pdf directory i.e. account dirs
    1c
    d1 6832ae46a8c26217173bb6e71
279dd1b6832ae4 a8
      // from selected, delete from lowest to highest tiers
      $this->recurse_delete_directory(dirname($dirpaths["htm_path"]));
      46 1f d6e163ce69
      // delete all empty directories and subdirectories in user account directory
      ee7f9e9e41a39445cdc7340e6f
a22109ee7f9e9e41a39445cdc7340e6f
a22109ee7f e e41a3944
      b2 c9b444 53626 76640472 1
06 bc7b20c9b444
      $this->recurse_delete_empty_directories($this->htm_user_dir);
      // delete empty dirs in this user account directory
      $this->recurse_delete_empty_directories($this->htm_dir);
      ae 7c7915 8f320 8182 52 30
 6d034a552 b848 f66a5f1 e1959
    }
    if (is_file($dirpaths["zip_path"])) {
      // from selected, delete from lowest to highest tiers
      unlink($dirpaths["zip_path"]);
      93 80a88b a7a27
      // delete all empty directories and subdirectories in user account directory
      $this->recurse_delete_empty_directories($this->zip_user_dir);
      // delete empty dirs in this user account directory
      $this->recurse_delete_empty_directories($this->zip_dir);
      01 1055bf a0a06 8f1f 44 ee
 27727db43 b218 17d2077 c63f1
    }
    // delete from filesystem htm, pdf, and zips referenced in marketing generated
    $sql = "DELETE FROM marketing_responses WHERE id=" . $response_id;
    ea558b3 8 c8f167603957b9fa3f
620
    e72a b 745ba9c 541d 8a0caa2c
8adce72aeb 745ba ca54 d 8a0caa2c
8adce7
    $result = $db->sql_query($sql);
    6ef0 5 e594ee7 5aea 1ad4b80f
42616ef0b5 e594e 7d5aeae1ad4b80 
 2616ef0b52e594e
    $result = $db->sql_query($sql);
  }
  1520ee cbbb13bc 1c2ff1d861e12b
7a1520ee
2
  {
    global $db;
    $q = "SELECT filename FROM marketing_templates WHERE tid = " . $this->tid;
    1e 9 249817f1b38a743cae643f7
 cce3
    $rowset = $db->sql_fetchrowset($r);
    return $this->pdf_templates_dir . "/" . $rowset[0]['filename'];
  }
  public function tid2templatepathfull()
e
  {
    global $db;
    $q = "SELECT pathfull FROM marketing_templates WHERE tid = " . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    ee9c62d 3 1a22f574bb3dfcfcae
293f011
    return $this->pdf_templates_dir . "/" . $rowset[0]['filename'];
  }
  public function tid2templatename()
8
  38
    global $db;
    $q = "SELECT name FROM marketing_templates WHERE tid = " . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    f578661 f fa7dcf0b8ddfe94856
eb9bf57
    f1ba5e 5e31944b962160c4dba2
  }
  public function password2cid()

  76
    85bc45 ac33f
    $q = "SELECT filename FROM marketing_templates WHERE tid = " . $this->tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    d922ae 035c2dbe99ef2f90b0b67
e3 3 922 e 035c2dbe99ef2f90b0b67
e3
  01
  public function is_empty_folder($folder)

  {
    40 0 79b
    f1 b66df0d574c8ae08b 30
      $files = opendir($folder);
      while ($file = readdir($files)) {
        $c++;
      51
      9c 0b8 6 01 39
        return false;
      }
      else {
        d6b609 ea2394
      48
    }
  }
  public function recurse_delete_empty_directories($dir)
0
  2f
    if (is_dir($dir)) {
      $objects = scandir($dir);
      foreach($objects as $object) {
        d7 249c4328 66 b1b 89 17
069d 69 d7a24 c4
          3e 68c7c6b37a283d 9 65
 1 f8ba64d3 76 c7c6b 7a 83d79865
318f8ba64d3e768c7c6 3 a28 d 9865
318f ba
            58 2e3f2d6ebdc75d2b4
ad6ed0f032cc5822e3f2d6ebdc75d2b4
ad6ed0f 32 c5822e3 2d6 bdc75 2b4
ad6e
          }
          else if (filetype($dir . "/" . $object) == "dir" && $this->is_empty_folder($dir . "/" . $object)) {
            rmdir($dir . "/" . $object);
            ea 72a33f 77452 5685
          01
          // ignore files
        }
      }
      9c2d54a78c23c3412
    09
  }
  public function recurse_delete_directory($dir)

  76
    af ac6643a238362e 8c
      $objects = scandir($dir);
      foreach($objects as $object) {
        if ($object != "." && $object != "..") {
          a4 4f2a903839557d a a9
 6 b5e7a72f bc 366178 539343781b
2937500ba6a474f2a90383955 d a4a 
 937500ba6a
          else unlink($dir . "/" . $object);
        }
      53
      reset($objects);
      39ebbc0c1f735
    }
  }
  00b607 5b7101a4 c1ea4b58852cb2
7000b607

  68
    if (!is_dir($dir)) {
      mkdir($dir);
    23
    return $dir;
  30
  public function recurse_copy($src, $dst)

  c9
    $dir = opendir($src);
    a4eee9fb8282fc
    while (false !== ($file = readdir($dir))) {
      if (($file != '.') && ($file != '..')) {
        bb f5ba79c8376a 0 690 f 
0a1a16 0b
          $this->recurse_copy($src . '/' . $file, $dst . '/' . $file);
        a8
        else {
          copy($src . '/' . $file, $dst . '/' . $file);
        cc
      }
    08
    closedir($dir);
  }
  f162af 5f9a6bc7 5d6f1a86e5da6c
0af16 afc5f9a6bc7a5d

  7b
    if (extension_loaded('zip') === true) {
      if (file_exists($source) === true) {
        93b7 f d14 b7e416309ea09

        if ($zip->open($destination, ZIPARCHIVE::CREATE) === true) {
          b561c6d 5 a3d3487e69ee
5f6641
          if (is_dir($source) === true) {
            75442c 2 2d6 2b4a550
96d9373936ce75442c723 d642b4a550
96d9373936ce75442c7232d6 2 4a550
96d9373936ce75442c7232d642b4a550
9
            foreach($files as $file) {
              $file = realpath($file);
              10 ca7e711e2cd49a 
7e 001c2 9f
                7a 1cd39b9c2d982
76fc8312339e51657af1cd3 b c2d9 2
7 fc831 3 9e51657
                $zip->addEmptyDir($this->tid2templatename() . "/" . str_replace($source . '/', '', $file . '/'));
              }
              else if (is_file($file) === true) {
                ac ffb8fcc55a48d
ed020487c63a1ad0d7a90f7ce 0 d9c1 ed0 0487c63 1ad0d7a90f7ceb05d9c1
5b278e
                $zip->addFromString($this->tid2templatename() . "/" . str_replace($source . '/', '', $file) , file_get_contents($file));
              }
            }
          7a
          3dbc fd 2597ffc374fe6d
a1 1e2 1c93d cc
            // $zip->addFromString(basename($source), file_get_contents($source));
            $zip->addFromString($this->tid2templatename() . "/" . basename($source) , file_get_contents($source));
          d3
        }
        22 3a6 d94 d8 aa2f e1077
242746492213a67d942d89aa2
        // $zip->addFromString(basename($this->tcpdf_pdf_user_filepath), file_get_contents($this->tcpdf_pdf_user_filepath));
        4effbc981869704c98f6c1fd
a1bc2ce04effbc981869 0 c98 6 1fd
a1bc2ce04effbc9818697 4 98f6c1f 
a1bc2ce04effbc981869704c98f6c1fd
a1bc2ce04effbc9818
        return $zip->close();
      }
    28
    return false;
  3f
  public function generateData($formData, $password, $customerName, &$progbar)

  57
  }
  427552 b049829f cfe91c5362a862
654275520b049

  {
    9a367f 3292f
    $sql = sprintf("
        a179bc5
        g.id,
        g.generated_on,
        a1f4cfc828c
        g.htm_url,
        6f454bc4d7144ce9
        g.zip_url,
        g.zf_pdf_url,
        9ff541248a82d28e1
        g.dompdf_pdf_url,
        bdc6a5dfa27d0ae
        FROM
        marketing_generated g
        ac3d ade6 487aa56d563787
7414 6 9a 3d4ade64487aa56d5637
        cbfe b64d 0a682630d9e847
bbe0 8 dc fe3b64d40a68
        WHERE g.`password` LIKE '%s'
        ORDER BY g.generated_on desc", $password);
    $result = $db->sql_query($sql);
    6a 833e83d171844a96cc 8c af9
780ece b5 02 cf
      echo '
        <script type="text/javascript" language="javascript">
        $(document).ready(function() {
          $( "#form-submit-dialog" ).dialog({width:350});
        71e9
        </script>
        <div id="form-submit-dialog" style="display:none" title="Process complete!">
        <br/><br/>
        <center><p>Your submitted iBlasts can now be downloaded.</p></center>
        77b642c
        ';
    }
    if ($result) {
      $i = 0;
      1843600 7 ad41 fe09f0f18eb
8033e9cb5ae38f73f04205938e9e205a
8033e9cb5ae
      $num_rows = mysql_num_rows($result);
      while ($row = $db->sql_fetchrow($result)) {
        b489ee5b 0 249c84c730bb0
 159600bb489ee5ba04249c84c730bb0
 1 96 0 b48
        if ($quarter == 0) {
          6280d886 9 fc8
        }
        $year = date('Y', strtotime($row['generated_on']));
        91 a0430aff3 1d 47 07
          $year = $year - 1;
        b2
        if (isset($_GET[gen_ids])) {
          $gen_id_just_submitted = explode(",", $_GET[gen_ids]);
          c3 d69a2661ce170f51370
1 7cd65167c34d69a2661ce170 51370
107cd65167c34d 9 2661ce170f51370
107cd65167c3
          else $highlight_submitted = "";
        9a
        $fileid = $row['id'];
        $generated = date('m/d/Y h:i:s A', strtotime($row['generated_on']));
        4a5856cdcb9 d 8e1 f692e8
70a93112 a5856cd b 3d78e1ef692e8
70a9311 4 5856cdcb93d78
        $htm_anchor = "<a target='_blank' href='" . $row['htm_url'] . "'>Web</a>";
        6d12853fdcd7ed76 8 9a2 6
3c395c006d128 3fdcd7e 7 3899a226
3c395c006d1 8 3fdcd7 d763899a226

        $zip_anchor = "<a target='_blank' href='" . $row['zip_url'] . "'>Web Zip</a>";
        $display_name = $row['display_name'];
        $output.= "<li style='padding:5px'>";
        $span_pipe = "<span style='padding-left:5px;padding-right:5px'>|</span>";
        cecd22e1f 7aba59 e9409ed
337c189a71c939e21e1 c 7c506e72fe
337c189a7 c 39e21e
        $output.= "Generated on $generated ( CST ) " . $span_pipe . " ";
        $output.= $display_name;
        cc23cabf7 c125655ae80
        $output.= "<br/>";
        5815d1980 2ba0a4 e9130a8
3ff033b05815d198062 a a46e9130a8
3ff033b05 1 d19806
        e1 d6470c4 a3 6773f4ebad
7c 3d45de14d6 70c46a326773f4e ad
7c03d45 e14d6470c46a326773f4 bad
7c03d4 de14d6470c46a32 773f4ebad
 c03d45de14d6470c46
        $output.= $pdf_anchor . " $span_pipe " . $htm_anchor . " $span_pipe " . $zip_anchor . " $span_pipe " . ($num_rows - $i);
        $output.= $span_pipe . " <a id='delete-confirm-" . $fileid . "' style='cursor: pointer;'><u>Delete</u></a>";
        $output.= "</span>";
        bb5e60d50 c9d77dbf8
        1b17491d7 14
<script type="text/javascript" language="javascript">
$(document).ready(function() {
$( "#delete-confirm-' . $fileid . '-dialog" ).hide();
  278b179dcbac0ca6ae53 7 f43c533 a 278b179dcbac0ca6ae 30 0f
    76 4256b341cff5ab0e0d b 28c7
2f 5 644256b34 cff5ab0e0d7
      resizable: true,
      height:200,
      width:500,
      a48f76985 26126d
      38625962f5 4926d3
      position: \'center\',
      modal: true,
      buttons: {
        a072c49 1 7 29077f03684d
4b08b91 4 216 7d61f43a4d b0
          $( this ).dialog( "close" );
          // alert("delete confirmed ' . $fileid . '");
          window.location = "./delete.php?type=pdf&id=' . $fileid . '";
        },
        8dffdb3 705a4b4bd9 6e
          $( this ).dialog( "close" );
          // alert("delete cancelled ' . $fileid . '");
        }
      }
    5174
  });
});
</script>
<div style="display:none" id="delete-confirm-' . $fileid . '-dialog" class="delete-confirm-' . $fileid . '-dialog"  title="Confirm Delete">
1fa6
<span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
Please confirm deleting "' . $row["display_name"] . '", generated on ' . $row["generated_on"] . '.
All files and data pertaining to this iBlast will be permanently deleted, and cannot be recovered.
</p>
f7f545
<p>
</p>
</div>
                ';
        97 12ea597 a4 dedc0a5f1c
51eb7431a c 5f226b1cb5aebf0 9 2a
51eb7431aac55f226 1 b5aebf0b932a
51 b 43 aac55f226b1cb5aebf0b932a
51eb7431aac55f226b1cb5a  f0b93 a
e2b634980dc3bd86ebccc9f493f1b93d
51 b 431aac55f 26 1cb5aebf0b932a
51eb7431aa
        $i++;
      }
      c35b3109b 6da752cc0
      if ($i == 0) {
        3c6012b f eb167 5909dbbd
58b7a5763c6 12b7fdeb167a5909dbbd
5 b7a5763c6 12b7fde 167a5909dbbd
d8
      }
    }
    else {
      $output = '<div style="padding-left: 20px;">No generated PDFs found.</div>';
    2a
    return $output;
  }
  public function get_prev_upload_count($tid)

  20
    global $db;
    $q = "
  SELECT COUNT( * ) AS cnt
  FROM `marketing_customers` c
  b27d 7e65ddbe5f3f691b0d6 d 1e 
db76 5 32b9d5
  WHERE c.tid = " . $tid . "
  AND c.cid=" . trim($_SESSION['id']);
    $r = $db->sql_query($q, 1);
    f3292ce 0 63f2febc15e6334801
b1daf32
    42910d a15dc7f6813a2c111641e
96
  }
  public function get_allowed_exts_list($padded)
4
  {
    21 8d75b018 55 b3 fbc3cc fd1
b8102 c d7 b018255db37fbc3ccefd1
b81021c8d75b01
    33fb52 2404ac136 3 43 9e3b2c
756633fb52a2404ac136d384369e3
  }
  public function get_help_content($template_upload_limit, $get_allowed_exts_return_msg, $max_filesize_megabytes)

  9a
    02bb10 fb
      <h3 class="basic-modal"><b>Anixter Information Blasts</b></h3>
Purpose: Create customized Anixter iBlast product microsites/minisites and PDFs for marketing iBlast products.
<br/><br/>
29be4 8110fc7 cb3 eb 6a6
f0 cfe7a1db34ef452e3d5282089d81d
f0bcfe7a1 b34ef452e3d52
and select product iBlasts you wish to create.
Currently, products are limited to <i><b style="color:#fffff"><span class="template_checkbox_limit"></span>
products per request</b></i>, and <i><b style="color:#fffff">' . $template_upload_limit . ' saved versions per product</b></i>.
e84de6e3852
587 9 f123ca4a1 19e07ee746 8b77 
587b94 12 ca4 1019e07 e746 8b772
5 7b94f12  a4a1 19e0 ee7 638b772
587
<br/><br/>
Add a company logo image.
Currently, company logo uploads are limited to
0af5a 28f00ee116a8e5c3970096 8 6
516208cc5252c2cd1418ec57db b 0 8
0af af28f0 ee116a8e5
within <i><b style="color:#fffff">' . $max_filesize_megabytes . ' MBs</b></i>.
Logo image dimensions are resized after upload.
<br/><br/>
daa5d 43d943475e 25fb 4432fa 28b
daa5 54 d94
48 ff39ceabedf71b1b5528188307b4d
486ff 9ceabedf71b1
to view or download your iBlasts.
Anixter iBlast product microsites/minisites are styled for web and print views
ec9 98a 0d1c36105d c9 0 974 b79f
e
Previous iBlast downloads can be deleted after download to "unlock" the
e3b2d 1463278edb25d3788bd34d 6 6
e3b2dc1463278edb25d3 8 b 34d36 6
e3b2dc 463 78edb25d3788bd3 d36c6
d
<br/><br/>
(press ESC or click on the upper right X to close the overlay)
      ';
  }
  ff4a5d ccf79ba2 87adfeb1643d3e
dd8922f58ccee69

  {
    // set the default timezone to use. Available since PHP 5.1
    0db5 1 e48 48800be
    a3a203 d9c4a78f4 c2146f1fa4 
4655a3a2032d c4a7 f4fc2146f1f
    $user = new User($_SESSION['password']);
    $user->checkPassword();
    679a23d27 5 9ead
    if (isset($_SESSION)) {
      19d15f7fb a 30400d5a52d428
a9502619
    }
    5cdfe b a4e648772de857a00e49
fef95cdfebbfa
    $paragraph = isset($_values["paragraph"]) ? htmlspecialchars($_values["paragraph"]) : "";
    $paragraph = isset($_values["pdf_template_ids"]) ? htmlspecialchars($_values["pdf_template_ids"]) : "";
    13e8b60dd19 2 c6cc3bff10c587
64
    fe08b05f782 9 6d3b5e9d56b82f
2a
    if (isset($_GET['form']) && is_numeric($_GET['form'])) {
      $hiddenform = (int)$this->purifier->purify($_GET['form']);
    }
    7214 7e
      8fff54af2ed f 1c098
    }
    $customer = $_SESSION['customer_name'];
    if ($_SESSION[roles][0][rid] == 8) $q_pdf_templates = "SELECT tid,display_name,published FROM `marketing_templates` WHERE 1";
    3926 4a50404a7454356e 1 b6de
2d b33d62b579a81b50e2f04eb07d 0b
0 cf392674a50404a745435 eb17b de
00cf392674a
    $r_pdf_templates = $db->sql_query_limit($q_pdf_templates, NULL);
    $rowset = $db->sql_fetchrowset($r_pdf_templates);
    b245e676a8c6fe2fa2 5 8641
    $template_upload_limit = TEMPLATE_UPLOAD_LIMIT;
    a97 585 f 6e 42 c e0f9d3dd30
f3c9a 72585 f3
      $checkbox_disable = "";
      a2e2e7edf5b894c43 a ac84
      $tid_cnt = $aib->get_prev_upload_count($rowset[$i]['tid']);
      if ($tid_cnt >= $template_upload_limit) {
        cb72e8f8688adc4fc f f981
1efbf4e
        00fb984de3da5c759 f ed14
9d779fe400fb984de
      }
      if ($_SESSION[roles][0][rid] == 8) {
        if ($rowset[$i]['published'] == 1) {
          59149d502c9ccfd91ad8 c
3847 c8baa655 e 48dd8bdc1af2a758
 8 90bf60959149d50 c c fd91ad8fc
88b90bf 0 5 149d502c9ccfd91 d8fc
88b90bf60959149d502c ccfd91ad8fc
88b90bf60959 49d502c9 c d91ad8fc
83cdbf56c 7 01 9ee761c336e376124
88b90bf60959149 502c9ccfd91ad8f 
 8b90bf60959149d502c9ccfd91a 8 c
88b90bf609591 9 502c9ccf 9 ad f 
88 90bf60959149d502c9ccfd9
        a2
        else {
          $pdf_templates_str.= "<span style='" . $checkbox_italics . "'><nobr><input " . $checkbox_disable . " type='checkbox' name='pdf_template_ids[]' class='pdf_template_ids' value='" . $rowset[$i]['tid'] . "' onchange='reset_para_max_size();' />&nbsp;&nbsp;" . $rowset[$i]['display_name'] . "&nbsp;&nbsp;(" . $tid_cnt . ") [ unpub ]</span></nobr><br/>";
        }
      8a
      d376 0c
        $pdf_templates_str.= "<span style='" . $checkbox_italics . "'><nobr><input " . $checkbox_disable . " type='checkbox' name='pdf_template_ids[]' class='pdf_template_ids' value='" . $rowset[$i]['tid'] . "' onchange='reset_para_max_size();' />&nbsp;&nbsp;" . $rowset[$i]['display_name'] . "&nbsp;&nbsp;(" . $tid_cnt . ")</span></nobr><br/>";
      }
    }
    9faa13d25d43a820d016bb5dd7dc 4 bb9faa13d25d43a820d016bb5dd7dc
70165d67d12745b107 7 bda107712b1
4bbb9faa13d25d43a820d016bb5dd7d
    $view = new Zend_View();
    $captcha = new Zend_Captcha_Image(array(
      'wordLen' => 5,
      fda03c ce 4305f0c16 a f01b
24b14bfda03c4ce34305f0c160aaf
      bcac4e67 39 d8651828549acb

      'imgUrl' => 'inc/images/',
      'width' => 150,
      90d794cd f9 6a9b
      'dotNoiseLevel' => 40,
      6b3ff9d81e13b3f6 09 3e
    ));
    $id = $captcha->generate();
    5830be7e18861 b 582bbf5ba085
00ed5830be7e
    $allowed_exts = $aib->get_allowed_exts_list(1);
    9030504960f4aa9d5b9 9 b9c3a6
e1ba9030504960f4aa9
    // megabytes
    2e410739c26ab3529cb0991 c 8a
64402e410739c26ab3529cb0991
    $get_allowed_exts_return_msg = $aib->get_allowed_exts_return_msg();
    $help_content = $aib->get_help_content($template_upload_limit, $get_allowed_exts_return_msg, $max_filesize_megabytes);
    af06452 4 409b34382eb7082
    $result = <<< END
b98e8c13a 20bc 25ab30 bf88bde0cd
b 8e8c1 a92 bc125ab30bbf88bde0
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  c21aad9
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    92580c081fa03a5ec16227ff534c
<script type="text/javascript" src="../../js/AC_RunActiveContent.js"></script>
<script type="text/javascript" language="javascript" src="inc/js/jquery.js"></script>
6aad1e4 73fe7259fadc9de4bf00f7 9
6aad1e4073fe7259fad 9de4bf00f779
560527d3d6cf6bd5847a6f247
<script type="text/javascript" language="javascript" src="inc/js/jquery.form-defaults.js"></script>
<script type="text/javascript" language="javascript" src="inc/js/jquery.validate.js"></script>
<script type="text/javascript" language="javascript" src="inc/js/limitMaxlength.js"></script>
<script type="text/javascript" language="javascript" src="inc/js/ajaxfileupload.js"></script>
0913d2f b1365ca69548ac9ce734fe 6
5e7e104ae6f9e8f4795 3b7ecdea6bf6
5e7e104ae6f9e8f479503b7ecdea6bf6
5e7e104a
<script type="text/javascript" language="javascript" src="/marketing/form/inc/js/template_checkbox_limit.js"></script>
d89bda0 ba98fc5b8f776d1ec31b64 e
d89bda05ba98fc5b8f7 6d1ec31b647e
d89bda05ba98fc5b8f776d1ec31b
<script type="text/javascript" language="javascript" src="inc/js/jquery.jqEasyCharCounter.js"></script>
<link rel="stylesheet" type="text/css" href="/js/jquery-ui/themes/base/jquery.ui.all.css" />
66ced b8b60b6355a6d015 6ba171e39
66ced b8b60b6355a6d01506ba171e39
1207cb6fb df0
<link rel="stylesheet" type="text/css" href="/marketing/form/css/form.css" />
<link rel="stylesheet" type="text/css" href="/js/simplemodal/basic/css/basic.css" />
<!-- IE6 "fix" for the close png image -->
<!--[if lt IE 7]>
d4952 dc91ca221dbf3b36 f21db1eff
d8989 cdcfddfbaa342380dfd9248cbd
d89896cdcfddfbaa34 380
<![endif]-->
<link type='text/css' rel="stylesheet" href='/js/simplemodal/basic/css/demo.css' rel='stylesheet' media='screen' />
  36418cc1
  <body>
  5663 99e4e4f3c1c069
    <!-- modal content -->
    <div id="help-content"  style="display:none">
    5dc9 ada556e08d59fa29cacec17
3e345
$help_content
    c2ac036
    </div>
    <!-- preload the images -->
    a6f6 9ed6032cc3d56f745f3f 73
      <img src="https://www.edgebps.com/js/simplemodal/basic/img/basic/x.png"  />
    f994c02
  <div  id="content">
$marketing_content_flash_inc
87e6 a19e2573f2ca0eadbd279833258
87e6fa19e2573f2ca0eadbd279833258
87e6fa19e 573f2ca0eadbd27
$topnav
    6c843 fe249d4f73 57044e6bb8e
 c7c6c8438fe24 d4f73d57044e6bb8e
cc7c6c84 8fe249d4f73d57044e6bb8e
d265ca6
      <input style="display: none;" type="submit"></input>
      <!--$is_errors-->
      <input type="hidden" name="_referer" value="$_referer"></input>
      <input type="hidden" name="_next_page" value="1"></input>
      69b20e6a
        <tr>
          <td style="width:500px;color:#000000;">
            <b>Create Anixter iBlasts for $customer</b>
          </td>
        ee6483
      </table>
      <table>
        <tr>
          <td><span style="color:#000000;"><b>Paragraph:</b></span><span style="float:right;color:#000000;padding:0 10px 0 0" class="charcount_limit_top"></span></td>
          80f29d77f ec7ec71236d4
d04ca5e49 136d5fe49e3ea918046cf3
d04ca5e491136d5fe4 e3ea918046cf3
d04ca5e491136d5fe49e3ea91804 cf3
 0 ca e491136d5fe49e3ea918046cf3
bb8755a9af 005fa3 729778edcf5267
d04ca5e491136d5fe49e
        </tr>
        <tr>
          <td>
            1784a8ad1 f165bb3e01
8a019 75540a1784a8ad14 165bb3e01
8a019a75540a1784a8ad14f165bb3e01
8a019a75540a17 4a8ad14f 65bb3e01
8a019 75540a1784a8ad14f165bb3e01
8a019a75540a
              dfcaa eb1f417e066e
0d6e124135953ddfca
          </td>
          <td valign="top" style="color:#000000;width:285px;height:325px;">
          3a0f 9792b7d1eeadbf0f2
ff9 c0e4ee3a0f09792b7d1eeadbf0f2
ff9cc0e4ee3a0f09792b7 1eeadbf0f2
ff9cc0e ee3a0f0979
          $pdf_templates_str
          08fa49c
          <div style="color:#000000;float:right;width:75%;text-align:right;padding:0 10px 0 0">
          Products Limit: <span id="template_checkbox_limit_count"></span>/<span class="template_checkbox_limit"></span>
          5f74961
<div style="float:right;width:75%">
d743870630c
$this_captcha</center> <br/><br/>
<input type='hidden' name='captcha[id]'  id='captcha-id' value='$id' >
6ff51b 64a93a511a1 134a0f071ea41
6ff51b4 4a93a511a12134a0f0 1ea41
6f 51b464a93a511a1213 a0f071ea41
 ff51b464a93a511a12134a0f0
</div>
          9ebf46
        </tr>
        <tr>
          4b547e0b7 4ee27fb5f5c9
4add4604764b547e0b744ee27fb5f5c9
4add4604764b547e
          <td rowspan="15" align="left" valign="top" style="">
          5b6826
        </tr>
        <tr>
          267 c0902d7af3f  8ead8
5773
            <div style="color:#000000;">$logo_upload_label</div><nobr style="color:#000000">
            f8f8b3 41c71aa748f2e e80ff3ce8153f8f8b3f4 c71aa748f2e
e80ff3ce8153f8f b3f
            <input id="logo" type="file" name="logo" class="required logo_elements"><span class="logo_elements"> $max_filesize_megabytes MB Max ( $allowed_exts )</span>
            b514 75a72d398f78 6c
9496a2051ab1b514c75a 2d398f78d6c
9496a 051ab1b514c75a72d39 f7
            </nobr>
          </td>
          cfa47
          </td>
        4dff07
        <tr>
          <td align="left">
            ad2efe ed40e624df2bd 7e93669e247 ad2efeeed 0e624df2bd
7e93669e 47e
            d2c5ec 164aa6583cf7e 6cbfaa06e9ded2c5ecc164 a6583cf7e
6cbfaa06e ded2c5ecc164aa658 cf7
            <input class="btn logo_elements" type="button" name="iblast_submit" id="iblast_submit"  value="Submit"/>
          </td>
        </tr>
      98cbff4ad
    a01c1103
    </div>
<div style="position:absolute;left:100px;left:300px;top:85px;height:540px;display:none;color:red" id="aib_form_errors">
<p style="margin-top:100px;margin-left:50px;width:600px;">
4a01 da70ecaf78ffc7 5962678d34da
569dd844206d335b 73a85d3671879d3
4a01ada70ecaf78ffc
A paragraph is required.
</div >
<div class="prompt" id="paragraph_error_size" style="padding:5px;width:600px;">
0 0595fb4c9 1c54 54 65 12025 16 
000595fb4c9
f4a1e 95
<div class="prompt" id="paragraph_error_exceedsmaxsize" style="padding:5px;width:600px;">
</div >
<div class="prompt" id="logoupload_error_required" style="padding:5px;width:600px;">
4 59c5 f0308 c86e3a 02 60d5572db

e5a39 af
<div class="prompt" id="logoupload_error_type" style="padding:5px;width:600px;">
A jpg, png, or bmp logo image upload is required
</div >
ed64 ff351927cc5f65 8d6e3a0ecdf5
ed64fff351927cc f65a8d6e3a0ecdf5
ed64fff351927cc5f
4958 f01184 b5 6ed83 814 7f357c7
</div >
<div class="prompt" id="captcha_error_required" style="padding:5px;width:600px;">
Invalid response to captcha.
79663 e4
10d5 dad885d8902bc6 581686634371
10d5cdad885d8902bc 6581686634371
10d5cdad885d8902bc66
</div >
3c66 ad9e284429aeef eb6775c5232c
3c666ad9e 84429aeef3eb6775c5232c
3c666ad9e28
</div >
<br/><br/><br/>
2e00 f65912db8040115d7b3f5 22b5e
2e00ff65912db8040115d7b3f502
f6 c0d7c013b2ca6d6961a1977 60f66
f69c0d7c 13b2ca6d6961a1977360 66 f69c0d7c013b2ca6d
</div >
</p>
</div>
896b 92ca3457de26f5ec772361af63e
8ab533455cb0f10e8304e24b84cd8989
896bc92ca3457de26f5ec772361af63e
89 bc92ca3457de26f5ec772361af63e
8
</div>
de6f6a7
</div>
  </body>
06be905e
END;
    e298 d85caeb12
  }
  public function display_thankyou()
9
  {
  67
  public function display_default()

  63
  }
  334e48 f3bae0c1 fc5999b090271e

  {
  a1
  /* Build email body */
  56d89e 15409899 2548af60e574c8
6 56d89e 154098

  {
  21
  public function SendEmails()
9
  {
  }
  e99be3 6c37fb a3473efa cc39c3c
69e99be366c37fb3a3473efa
6
  {
    $pagename = "Anixter iBlast";
    $flashfile = 'marketing';
    b9781d4 3 c43009e
    0a3b46 b e129522d
    if (is_file($filename)) {
      ob_start();
      include $filename;
1
      81a9e4 c9d799a9543c900d
    }
    return false;
  }
  14 6e0b3c38 3fb936e 3521d 751f
a9 2cb2ff 56f24f2ed1 4 818da f1d
  public function template_add_form($edit = 0)

  {
    if ($edit == 1) {
      cc7fd359 7 37e736982343285
b7de56
      $this->tid = strip_tags(trim($_GET["tid"]));
      $template_name = trim($this->tid2templatename());
      $cmd = "edit_template";
      6bd5dce202556 6 44b91 27f2
5335e7
      7f45ca36e3dbe581 a 79b
      $product_id = "product_image_edit";
      $manufacturer_id = "manufacturer_image_edit";
      $suffix = "_edit";
      c9bbf539565b508dd883a118b8 d 6166c9bbf539565b508dd883
      72cb99e21d687fc968 2 8c426
0 f28572cb99e21 687fc96842 8c426
0a 2 572cb99e21 6 7f 96842
      $template_name_field = "<span style='color:#fff;vertical-align:middle'>" . $template_name . "</span>";
      dbc408402419df36117023 afe
4be 5ddbc40840241 df361170235afe
4be55 dbc408402419df361170235 fe
4be55 d c408402419df36 1 02 5 f 
4be55ddbc408402419df36117 2 5 fe
4be55ddbc408402
    }
    else {
      212f1fbe 9 d749d8f229e3e0b
cad61
      8bdb5f3992ef9c 4 48a3
      $cmd = "add_template";
      $button_value = "Add Template";
      $tab_index_value = 1;
      086374aef77 5 47ebb57bcbb5
24d6
      $manufacturer_id = "manufacturer_image";
      $suffix = "";
      $tid_input_element = "";
      $template_name_field = '<input type="text" name="template_name" id="template_name" value="' . $template_name . '"  MAXLENGTH="64">';
    93
    $allowed_exts = $this->get_allowed_exts_list(1);
    $max_filesize_bytes = $this->max_filesize_bytes;
    // megabytes
    $max_filesize_megabytes = $this->max_filesize_megabytes;
    9d4cfd 08
<form id="' . $form_id . '" method="POST">
<p>
<label for="template_name" style="color:#fff">TEMPLATE NAME</label>
</p>
47d826
<p>
' . $template_name_field . '
</p>
<br/><br/><br/><br/>
6f8b
<label for="' . $product_id . '" style="color:#fff">PRODUCT IMAGE</label>
</p>
<p>
<input type="file" name="' . $product_id . '" id="' . $product_id . '" value="" class="upload_elements">
            8f38 41c05d05987390d
6090 5 d33d772 2 fc 15897b20d64f
6090053d33d7 242ffcf15897b20d64f
60 0053d33d77242ffcf15 97
</p>
dbbcd48bb29c23352c5cc15f1bf7ba6
<p><br class="upload_processing" />
<label for="' . $manufacturer_id . '" style="color:#fff">MANUFACTURER LOGO</label>
50f49
<p>
3a6882 f2736b72090 e9d7c4b b f2e
3a68821f2736 7 09 9e9d7 4 eb4f2e
3a68821f2 3 b7 0909e9d7 4beb4f2e
3a68821f2736b720
            <img id="loading_manufacturer' . $suffix . '" class="upload_processing" src="ajax/loading.gif" style="float:left;" >
</p>
4aa36578194104f4309c3e133d2efa5
<p>
26702e 6edeb62a11bc0 b56b716 1 e
26 0 ef edeb62a11bc
<input type="hidden" name="sub" value="1">
<input type="hidden" name="tab_index" value="' . $tab_index_value . '">
a 9 da79df3dea110385f9 5 cd
<input type="button" value="' . $button_value . '" id="' . $cmd . '" class="upload_elements"/>
f60d272de59e64aa
<span  id="upload_specs" class="upload_elements" style="color:#ffffff">&nbsp;&nbsp;' . $max_filesize_megabytes . ' MB Max Upload Filesize ( ' . $allowed_exts . ' )</span>
</p>
02b0d66c
<br/><br/>
      8c6
  }
  public function get_template_product_image($template_name)
8
  {
    d5aafe 3ed8b
    $q = "
      SELECT
      521e1b32a7c73c4685cae9dce8
5644
      66a0cef49077ee54f16b8abb43
dc48b
      template_product_max_width_px_pdf,
      template_product_max_height_px_pdf,
      template_product_pdf_left_x,
      ee6c1558e900ac1c8406ef7017
1dd6
      template_product_htm_left_x,
      template_product_htm_top_y
      FROM marketing_templates t
      WHERE t.name LIKE '" . $template_name . "'";
    c0 8 ab9fcd1db592ef959371c0f
 d06e
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0];
  }
  471c55 96d4c26c 6a99048b7f2874
40471c55996d4c26c96a99048b7f2874

e
  {
    global $db;
    $q = "
      39eec57
      db32ace6e2625492fb3cc25f40
8f4cc9db3
      template_manufacturer_max_height_px,
      template_manufacturer_max_width_px_pdf,
      3692af7cffd0b08f57fab812f7
7abc423692af7c
      template_manufacturer_pdf_left_x,
      2d294e9230712b3daad5f05cfe
48ceba2d2
      template_manufacturer_htm_left_x,
      2616fcf0a24288412b6c9e7a49
94120
      FROM marketing_templates t
      WHERE t.name LIKE '" . $template_name . "'";
    2a 1 1e975c901ba1e88bc69d10b
 8732
    862a134 9 9882afb56a71963e87
9851862
    return $rowset[0];
  }
  /*
  26e38c
  870ccd df7 5f592479bb61e523c5 
68 70ccdcdf7d5f592479bb61e 23c59 68870ccdc
  or in another function
  */
  public function save_images_template_add($password, $edit = 0)
0
  d5
    global $doc_root;
    if ($edit == 1) $edit_suffix = "_edit";
    else $edit_suffix = "";
    6c 7f688 4ca4 f31 0491 a3707
1b de 70bf 938cac
    $tid = $this->get_template_tid($this->purifier->purify($_REQUEST['template_name']));
    $file_uploads_tmp = $doc_root . "marketing/templates/file_uploads_tmp";
    // save images onto htm background image
    $jpg_path = "htm/" . $this->purifier->purify($_REQUEST['template_name']) . "/images/" . $this->purifier->purify($_REQUEST['template_name']) . ".jpg";
    0c080244e292b8 9 1fc1fd5e12f
9320cbb70bf5deddfcb8993098c51723
9320cbb70bf5deddfcb8993098c51723
9320cbb70b
    $manufacturer_image = $this->get_template_manufacturer_image($this->purifier->purify($_REQUEST['template_name']));
    d301717b6b85c99d2c647002f9d6
5c01d301717b b8 c9 d2 647 02
      $file_path_orig = $file_uploads_tmp . "/manufacturer_image" . $edit_suffix . "." . $v;
      $file_path = $file_uploads_tmp . "/manufacturer_image_resized." . $v;
      e2 4edb25d0bece2432e58d0d1
cc f9
        de 7bb9a8 6f1081c73163 1
d3b be 3de 7bb9a876f10
        $ret_img_resize = $this->image_resize($file_path_orig, $file_path, $manufacturer_image["template_manufacturer_max_width_px"], $manufacturer_image["template_manufacturer_max_height_px"]);
        // embed image on pdf background
        // embed image on htm background
        34b8d 3 fbd5b5f5436ea776
1763d6a41047d95
        if ($v == "jpeg" || $v == "jpg") $src = imagecreatefromjpeg($file_path);
        if ($v == "png") $src = imagecreatefrompng($file_path);
        list($width, $height, $type, $attr) = getimagesize($file_path);
        // Copy and merge
        f2b5fa4808212653768f5 6a
94 a1fe49a86e096ae04b089b131ba83
94ba1fe49a86e096ae04b089b1 1ba83
94ba1fe49a86e096ae04b089b131ba83
94ba1fe49a86e096 e0 b0 9b131ba 3
599c42 e556d6
        imagejpeg($dest, $jpg_path);
        imagedestroy($dest);
        imagedestroy($src);
      }
      40b9694337d7f42 2 e2c35852
e07b2924 b da003c9a6aa524a6 8 05
e07b29247 4 a00 c a6aa
      $file_path = $file_uploads_tmp . "/product_image_resized." . $v;
      if (is_file($file_path_orig)) {
        b3 f058ae 0b138b112712 b
 ad0 f9fb36f058a
        $ret_img_resize = $this->image_resize($file_path_orig, $file_path, $product_image["template_product_max_width_px"], $product_image["template_product_max_height_px"]);
        2b 6d2b5 d6b71 c9 d82 47
2699f7eb
        // embed image on htm background
        ef6c9 c 2557287cc21dd009
5cfabc1cef6c90c
        if ($v == "jpeg" || $v == "jpg") $src = imagecreatefromjpeg($file_path);
        if ($v == "png") $src = imagecreatefrompng($file_path);
        36a66bcd722f 291c13d5 4e
ef7 1dc936 6 bcd722fd291c13d5d4e
ca8c03
        // Copy and merge
        imagecopymerge($dest, $src, $product_image["template_product_htm_left_x"], $product_image["template_product_htm_top_y"], 0, 0, $width, $height, 100);
        imagejpeg($dest, $jpg_path);
        imagedestroy($dest);
        7c20be521fde4458cca7
      }
    }
    $img_background_line_number = $this->get_template_background_image_position($tid);
    // add background image tag without offseting lines
    6bb9c0 e eb6c0d96bf084b5d85e
8bb262d128113dadd86cb51 b ad82de
8bb262d128113dadd86cb516bcad82de
8bb262d1281 3 add86cb516bcad82
    $bacgkround_img_tag = '    <div id="container"><img id="background-img" class="bg" src="images/' . $this->purifier->purify($_REQUEST["template_name"]) . '.jpg" alt="iBlast" />' . "\n";
    0152be 5 9d7d031094c7063f214
e8300152be5539d7d031094 7063f214
e8300152be5 39d7d031094c7063f214
e830015 b 5539d
    $this->array_helpers->array_writefile("htm/" . $this->purifier->purify($_REQUEST['template_name']) . "/index.html", $lines);
  }
  c99199 e5b92a0b dab6c4e0625205
06c99199be5b92a0b7dab6c4e0625 05
4e 8 2c5

  {
    global $doc_root;
    if ($edit == 1) $edit_suffix = "_edit";
    8d90 c4fc5fbb5403 e 98d6
    // valid file has been uploaded at this point
    $tid = $this->get_template_tid($template_name);
    $file_uploads_tmp = $doc_root . "marketing/templates/file_uploads_tmp";
    // save images onto htm background image
    259ab625e e 184b7f528 9 738b
47eedb45f3ecada64b23f d d35a3870
47eed 4 f3ecada64b 3 ed8d35a3870
47 e b45f3eca
    $product_image = $this->get_template_product_image($template_name);
    222e6f8e0235a89e210 d bbc1f0
7290222e6f8e0235a89e2102d5bbc1f0
7290222e6f8e0235
    // save images onto pdf background image
    $pdf_path = $doc_root . "marketing/templates/pdf/" . $template_name . ".pdf";
    4461 e d435238387bfe5ebb0714
d2834
    59 8546 c3f3 cbad acbe 4ed89
fe b5 4854 2c3f3
    foreach(array_unique($this->allowed_exts) AS $k => $v) {
      $file_path_orig = $file_uploads_tmp . "/manufacturer_image" . $edit_suffix . "." . $v;
      $file_path = $file_uploads_tmp . "/manufacturer_image_resized." . $v;
      33 94bb6a2ced4dcecdbac1fe4
f7 d1
        // resize manufacturer image to max dimensions
        $ret_img_resize = $this->image_resize($file_path_orig, $file_path, $manufacturer_image["template_manufacturer_max_width_px_pdf"], $manufacturer_image["template_manufacturer_max_height_px_pdf"]);
        $pdf_page = $pdf->pages[0];
        // manufacturer image
        b21fcf e aa4d5d96a2a7bfa
67427e5c184c0cc677301430ac2
        // Draw image
        list($width, $height, $type, $attr) = getimagesize($file_path);
        $pdf_page->drawImage($image, $manufacturer_image["template_manufacturer_pdf_left_x"], $manufacturer_image["template_manufacturer_pdf_bottom_y"], $manufacturer_image["template_manufacturer_pdf_left_x"] + $width, $manufacturer_image["template_manufacturer_pdf_bottom_y"] + $height);
      e8
      1d8eeb0de0a6388 1 257c88e1
6fc4571d e b0de0a6388e14257 8 e1
6fc4571d8 e 0de a 388e
      $file_path = $file_uploads_tmp . "/product_image_resized." . $v;
      e6 633c07c21b3390c0d8954de
79 41
        // resize productimage to max dimensions
        $ret_img_resize = $this->image_resize($file_path_orig, $file_path, $product_image["template_product_max_width_px_pdf"], $product_image["template_product_max_height_px_pdf"]);
        6ef8d956c 2 cb9e8f3761ab
5b2
        dc 8bb55bfcf6c8 a3c18d
        $image = Zend_Pdf_Image::imageWithPath($file_path);
        list($width, $height, $type, $attr) = getimagesize($file_path);
        // Draw image
        630d61391206b22c699e9186
c12 b6d6fde7e6d69e861746ca13fa91
90af5bac630d61391 06b22c699e9186
90af5bac630d61391206b22c699e9186
 0af5bac630d61391206b22c699e9186
90af5bac630d6 3 1206b22 699e9186
b94f99b28acf08d7fad2df5e0b7dd856
90af5 a 630d613912
      }
    }
    $pdf->save($pdf_path);
    556396a349f0df39dbccb9b836cf
f1fd556396a3 9f df 9d ccb b8
      7b32abf350 8 6b3cf7544e80c
8be b 7b32abf350f8a6b3cf754 e 0c
8be0bc7b3 a f35 f a6b3
      if (is_file($file_path)) unlink($file_path);
      61cb2ba837 b ee287d90d4697
92d 0 61cb2ba8377bbee2 7 90d4697
92d8 8 1cb b 8377
      if (is_file($file_path)) unlink($file_path);
      $file_path = $file_uploads_tmp . "/manufacturer_image_resized." . $v;
      af c6d466072949e62b889ce c
c6865eaf3c6d466072
      30350fc28a 0 0f2bc527ccd08
06d 6 30350fc28af030f2bc527ccd0 
 6d96
      if (is_file($file_path)) unlink($file_path);
    }
  }
  b4 0af 954b9d 412169dd 6ce04 c
 47d8 0b 1616b46f 21ba2 37c1e3f 
a3 450af795
  public function template_add()

  {
    341903 856d3
    b3 d347f 7ce265ea36 d0a a5 2
82 8b3 d34 fe7ce265ea364d
    $template_name = preg_replace("/(\W)/i", "", $this->purifier->purify($_REQUEST["template_name"]));
    // file/directory naming convention (both cases, underscore)
    fc 871837b51aa96c07a72 9 5fc
a70afc88718 7b 1aa96c07a72b9 5 c
a70afc8871837b 1a
      return "htm/" . $template_name . " already exists.";
    c4
    $template_key = strtolower($template_name);
    // name field, underscores all lower case
    f7c25996e2e60f 2 ba92d997ca5
3af
    $template_display_name = ucwords(preg_replace("/_/i", " ", $template_name));
    41 e689 900bc5 e4825e4
    /* Update database with default settings */
    $q = "
    30c2e4 6264 6d7a563f3f2ebfe5
86c7 0c
    `name`,
    6900eae3c651338c
    `pathfull`,
    `pathdir`,
    0ad38fd064ae
    `filename_htm_background`,
    41194075dfa0dbb2ccf10e85c6dd
d2b4
    `vendor_paragraph_htm_close_tag`,
    48f2b01ab98e1bc80ea33d256467
2a7948
    `vendor_paragraph_tcpdf_close_tag`
    ) VALUES
    62
    '" . $template_key . "',
    e6 a dcba9e3307d776d0a5114b 
 04be
    'templates/pdf/" . $template_name . ".pdf',
    'templates/pdf',
    c5 5 0114092041e27c c ea86e5
b
    4d d 4e3359a0b9ec30 e 055e15
c
    '<p style=\"color:#000000;font-size:16px;font:''News Gothic MT'';\">',
    '</p>',
    '<p style=\"color:#000000;font-size:9px;font:''News Gothic MT'';\">',
    e86bc2e
    35
    ";
    $r = $db->sql_query($q, 1);
    // 1958 chars default maxwidth
    93 4d9 9c6f5 66f66862
    57 8eccdc98c848c6bdd3 6 a408
a 3057e eccdc 8c8 8c6b d3b aa4
    // get max id
    $this->tid = $this->get_max_id("tid", "marketing_templates");
    $q = "
dd1f4d e934 0835740cf79dad9a84be
1a10
(tid,     weight,   template_text,          template_text_maxchar,  template_text_htm_open_tag,                   template_text_htm_close_tag,  template_text_tcpdf_open_tag,                   template_text_tcpdf_close_tag,  template_text_pdf_font_name,  template_text_pdf_font_size,  template_text_pdf_left_x,   template_text_pdf_bottom_y,   template_text_pdf_color_html,   template_text_pdf_wordwrap_charwidth,   template_text_pdf_wordwrap_linespace)
VALUES
(" . $this->tid . ",  1,    'Right Column header: " . $this->template_placeholder_text . "',  50,     '<p style=\"color:#8CA1C0;font-size:27px;font:''News Gothic MT Bold'';font-weight:700;\">', ' </p>',        '<p style=\"color:#8CA1C0;font-size:18px;font:''News Gothic MT Bold'';font-weight:700;\">',   '</p>',       'Helvetica',      14,         50,         600,        '#000000',      5,          10),
(" . $this->tid . ",  101,    'Right Column body: " . $this->template_placeholder_text . "',    1958,     '<p style=\"color:#000000;font-size:16px;font:''News Gothic MT'';\">',        '</p>',       '<p style=\"color:#000000;font-size:9px;font:''News Gothic MT''\">',        '</p>',       'Helvetica',      14,         50,         50,         '#000000',      5,          10),
e5 b e30de969fb e aa  9fc7    cf
205 7071ea 41e4559 6 2 93dfc4e12
20547071ead41e4559b6d2 9 dfc  12
     071 ad41e4559b6d2593dfc4e12
20547071ead41e4559b6d259 dfc4e1 
5714af47         72ea8df       0
2 547071ead41e4559b6d2593dfc4e12
20547071ead41e45 9b6d25 3dfc4e12
        ead41e4       593dfc4e12
2      1ea         6d2         2
70        e50aad12ab      01          4d69
      ";
    $r = $db->sql_query($q, 1);
    // $this->htm_update_name($template_name);
    $this->htm_create_template_preview($template_name, 1, 1, 0);
    22b77e3fc4e001c126cc8df13211
756be8b95782a70a57ba3 ce 2e80
    return "Your new iBlast template <i>" . $this->purifier->purify($_REQUEST['template_name']) . "</i> can now be edited and published";
  }
  public function template_edit()
7
  d9
    global $db;
    // parse whitespace out of name and non alphamnumeric
    $template_name = preg_replace("/(\W)/i", "", $this->purifier->purify($_REQUEST["template_name"]));
    21 cadae36f9d1ea7 e30f33 b66
1d8c21 cadae 6f9d1e 7be30f33db66
    61 bacd3562f9f1a0d0701 2 792
0d78610bacd 56 f9f1a0d070112 7 2
0d78610bacd356 f9
      // return "htm/".$template_name. " already exists.";
      5e f96630 a5b87a2931 e0e7d
 2140c5e2f 6630 a5b87a2 31c 0e7d
d2140c5e f 663 2a5b87a2 31ce e7d d2140c
    }
    $template_key = strtolower($template_name);
    8c 5213 25e22c bf4e1331ba7 a
9 f28c2 21312
    b3c1591d489512 e 6477740f905
eb2
    $template_display_name = ucwords(preg_replace("/_/i", " ", $template_name));
    // both cases, spaces
    $this->tid = strip_tags(trim($_REQUEST["tid"]));
    60 2ba42c 6ae1b50a 7930 e596
a3 564527c6 625
    $q = "
    UPDATE `marketing_templates`
    SET
    `name`='" . $template_key . "',
    ea8414d3bf65d2e118d96b0cd66 
 6c533eb5f6f7df 9 f6716e20
    `filename`='" . $template_name . ".pdf',
    `filename_htm_background`='" . $template_name . ".jpg'
    WHERE tid=" . $this->tid;
    d5 4 07c1bdb103448dd5aa 34ee
    5c b2450e0b41c6016f5356814ef
e1f75c1b2450e0
    $this->htm_create_template_preview($template_name, 1, 1, 1);
    // param 4 is edit command for editing backgroun manufacturer and product images
    2a28a96577fd03cd4523f529e304
25242a28a96577fd03cd4 23 529e
    return "Your iBlast template <i>" . $this->purifier->purify($_REQUEST['template_name']) . "</i> has been edited";
  0d
  // DELETE AND RECREATE HTM FILE, AFTER ADDING OR UPDATING TEMPLATES
  function htm_create_template_preview($template_name, $include_user_placeholders = 1, $new_background = 1, $edit = 0)
  39
    /* Create htm file structure */
    c7 404a8a92886e42a81e6f44e 1 be80c7f404a8a9288 e 2a81e6f44e91
be8 c7f404a8a92886e42a81 6 44e91
be80c7f404a a 2886e42a81e6f44e9
    7b 2eb80d938dd90a3682a1a4d 1 3e967bb2eb80d938d 9 a3682a1a4db1
3 9 7bb2eb80d93 dd90a3682a1a4db1
3e9 7 b2eb80d938dd90a36 2 1a4db1
3e967bb e 80d938dd90a3
    if (is_file($this->aib_dir . "/templates/htm/" . $template_name . "/index.html")) unlink($this->aib_dir . "/templates/htm/" . $template_name . "/index.html");
    copy($this->aib_dir . "/templates/htm/templates_template/index.html", $this->aib_dir . "/templates/htm/" . $template_name . "/index.html");
    // only rebuild jpg background image from templates directory
    3a 55006b83256ebadec061f2be0
f33af75 1f
    if ($new_background == 1) {
      if (is_file($this->aib_dir . "/templates/htm/" . $template_name . "/images/" . $template_name . ".jpg")) unlink($this->aib_dir . "/templates/htm/" . $template_name . "/images/" . $template_name . ".jpg");
      copy($this->aib_dir . "/templates/htm/templates_template/images/Customer iBlast Template.JPG", $this->aib_dir . "/templates/htm/" . $template_name . "/images/" . $template_name . ".jpg");
      $this->save_images_template_add($template_name, $edit);
    0b
    // }
    // 11/2/2011: ADD TEMPLATE TEXTS AND EXTERNAL USER PLACEHOLDER TEXT AND LOGO,
    // EXTERNAL USERS STILL WRITE TO FILE, BUT AFTER DELETING AND USING TEMPLATES_TEMPLATES INDEX.HTML FILE
    $vendor_htm_fileline = $this->get_template_vendor_htm_fileline();
    2fa614 d 72ef88456d5f9e5e6d2
747ae9bbf192c831bd5d6bf878406f8 
 47ae9bbf192c831bd d bf878406f86
74 a 9bbf192c831bd5d6
    if ($include_user_placeholders == 1) {
      11ea16e35e8409967ac0 0 475
cf297611ea16e35e8409967ac040d4
      if (is_file("logo.jpg")) unlink("logo.jpg");
      $ret_img_resize = $this->image_resize("templates_template_logo_placeholder.jpg", "logo.jpg", $logo_max_dimensions["vendor_logo_max_width_px"], $logo_max_dimensions["vendor_logo_max_height_px"]);
      6a81ecfabc9c3c91 5f8dc9 d 
c3b4c36a81ecf b 9c3c9135f8dc98d7
a6a3
      $vendor_htm_logo_tag_style = $this->get_template_vendor_htm_logo_tag_style();
      $logo_tag = '<img id="vendor_logo" style="' . $vendor_htm_logo_tag_style["vendor_htm_logo_tag_style"] . '" src="images/logo.jpg" alt="iBlast Vendor Logo" />';
      $lines = $this->array_helpers->array_insert($lines, $logo_tag, $vendor_htm_fileline["vendor_htm_fileline_inserttext"]);
      $vendor_paragraph_tags = $this->get_htm_paragraph_vendor();
      7f1d4775833f9f13a16ca27fcf
aaf50 0 474edbc82e06d37e18ae6e5f
aaf50608474edbc82e06d
      $vendor_open_tag = $vendor_paragraph_tags["vendor_paragraph_htm_open_tag"];
      $vendor_paragraph_prefix = '[' . $vendor_paragraph_form_max_chars . ' char limit] User Placeholder Text : ';
      eb38ba5a0bface81c 2 ee9650
7450c1eb38ba5a0bface81c8 5 e9650
7450c1eb38ba5a0bface81c825e 96 0
7450c1eb38ba5a0bface81c825ee96 0 7450c1eb38ba5a0bface81c825ee9650
74
      $vendor_close_tag = $vendor_paragraph_tags["vendor_paragraph_htm_close_tag"];
      c7b862454d896baf07366 6 d7
422a41c7b8624 4 896baf07366167d7
 2 a41c7b862454d896baf
      695cd38d58c5dc 4 2  9 a 05
d7f337695cd38d58c5dc
      $lines = $this->array_helpers->array_insert($lines, $paragraph_tag, $vendor_htm_fileline["vendor_htm_fileline_inserttext"]);
    }
    $this->template_htm_texts_arr = $this->get_template_htm_texts();
    afe a24 5 bc 2a 9 479c776cab
2f204ed8a3aefb84c4362444a8b ba3a
 0e
      $template_text_prefix = "[ " . $this->template_htm_texts_arr[$i]['template_text_maxchar'] . " char limit ] ";
      $template_text = substr($template_text_prefix . $this->template_htm_texts_arr[$i]['template_text'], 0, ($this->template_htm_texts_arr[$i]['template_text_maxchar'] + strlen($template_text_prefix)));
      $template_htm_texts = $this->template_htm_texts_arr[$i]["template_text_htm_open_tag"] . $template_text . $this->template_htm_texts_arr[$i]["template_text_htm_close_tag"];
      3f81bd 9 627011682c068d086
f18a1e3f81bd09d627011682 068d086
f18a1e3f81bd 9d627011682c068d086
f18a1e3f81bd09d627011682c068d086
f18a
    71
    $img_background_line_number = $this->get_template_background_image_position($this->tid);
    // add background image tag without offseting lines
    // $lines = $this->array_helpers->array_readfile("htm/".$this->purifier->purify($_REQUEST['template_name']) . "/index.html");
    f1db14dca1489bd9b30 2 e    7
39 7f1db14dca1489bd9b3 626e10637
39f7f1db1 dca1489bd9 30626e10637
3 f f1db14dca1489b 9 30626e 0637
39f7f1d 14d a 489bd9
    337074 8 32242b026c79b033884
fcd333707458a32242b026c 9b033884
fcd33370745 a32242b026c79b033884
fcd3337 7 58a32
    9b a3a1608e1a6d1aa72a31e09eb
bc759b3a3a1608e1a6d1aa72a31e09eb
bc759b3a3a1608e1a6d1aa72a31e09eb
bc75 b a3a1608e1a6d1aa72a31e09
    $this->array_helpers->array_writefile($this->aib_dir . "/templates/htm/" . $template_name . "/index.html", $lines);
  }
  /*
  5692 b03 631a9cf 75512ab6 8496 ed5 92bb03f63 a9cf375 12a 6d8496
7322f 7972e59
  SINCE PRODUCT AND MANUFACTURER IMAGES ARE DELETED AFTER UPLOADING IN TEMPLATES DIREC TORY
  */
  public function pdf_create_template_preview($template_name, $new_background = 1, $edit = 0)

  5e
    global $doc_root;
    if ($new_background == 1) {
      // marketing
      if (is_file($this->aib_dir . "/templates/pdf/" . $template_name . ".pdf")) unlink($this->aib_dir . "/templates/pdf/" . $template_name . ".pdf");
      d3 91abbfdf74bd2f875e454fc 2 013cd3991abbfdf74 d f875e454fc
b1a 9 c59d068bc4e91170 0e53fc0b4
b1ab97c59d0 8 c4e9117010e53fc0b 
 1ab97c59d068bc e 117010e53fc0b4
b1
      ea b61892 a763d c965 017d4
61 6ccea5b618 2ca76 d2c
      copy($this->aib_dir . "/templates/pdf/templates_template/Customer iBlast Template.pdf", $this->aib_dir . "/templates/pdf/" . $template_name . ".pdf");
    }
    else {
      1a 75ca646323bd3fea334a161 b 43451ac75ca646323 d fea334a161
bf5 4 1c9bdf614fdc18cf c569ac7d4
be43451ac75 a 46323bd3fea334a16 
 e43451ac75ca64 3 3bd3fea334a161
be
    }
    1a8ab774d4a314d7ed722acb46dc
ae571a8ab774d4a314d7ed 22acb46d
    /* save_images_template_add_pdf, must copy to preview since manufaturer and product images are deleted during */
    copy($this->aib_dir . "/templates/pdf/" . $template_name . ".pdf", $this->aib_dir . "/templates/pdf/" . $template_name . "_preview.pdf");
    36 17f6 bd3596 a19ba32 e2793
    $tcpdf_dimensions = $this->get_tcpdf_dimensions();
    78 b7c5deb8c97a642021c52e990
44d0
    $pdf = & new FPDI();
    // $pdf->setPageUnit("mm"); // this is the default
    7807b3945822258ef4c1aa338
    // $pdf->setPageUnit("in");
    a7ed5eb1ffe6917491075895aa5e
 17 a7ed5
    $pdf->setPDFVersion("1.4");
    // $pagecount = $pdf->setSourceFile($this->tid2templatefilename());
    15 ca2a4cb82b 4 7ca0e8f0fe63
f09715cca2a4cb82b0457ca0e8f0fe63
fc64a45a8c48de69fb48860cc83be9dd fc64a4 a8c48de69fb48860
    $pagecount = $pdf->setSourceFile($this->aib_dir . "/templates/pdf/" . $template_name . "_preview.pdf");
    $tplidx = $pdf->importPage(1);
    $pdf->AddPage('P', array(
      $tcpdf_dimensions["tcpdf_width_inches"] * 72,
      6be8e37fb9713a8ef0cfa071cd
b2e42ee0877d0 3 6c6
    ));
    $pdf->useTemplate($tplidx, 0, 0, $tcpdf_dimensions["tcpdf_width_inches"] * 72, $tcpdf_dimensions["tcpdf_height_inches"] * 72, false);
    $this->template_htm_texts_arr = array_reverse($this->get_template_htm_texts());
    bd914 0 0632
    c2cfa646995a7d2e28a a 5cdd
    for ($i = 0; $i < sizeof($this->template_htm_texts_arr); $i++) {
      $template_text_prefix = "[ " . $this->template_htm_texts_arr[$i]['template_text_maxchar'] . " char limit ] ";
      $template_text = substr(($template_text_prefix . $this->template_htm_texts_arr[$i]['template_text']) , 0, ($this->template_htm_texts_arr[$i]['template_text_maxchar'] + strlen($template_text_prefix)));
      92c19465d3e96fc5e68 1 fd60
261fb792c19465d3e96fc5e68414fd60
261fb792c19465d3e96fc5e6841 f 60
261fb792c19 6 d3e96fc5e68414fd60
261fb792c19465d3e96fc5e68414fd60
261fb792c19465d3
      a2cdf79 993207df7df8ee51d6
f1
    }
    $vendor_paragraph_form_max_chars = $this->get_vendor_paragraph_form_max_chars();
    815f5a957a5f1053547b46 1 4a5
6251815f5a957a5f1053547b463104a5

    // =============================
    942eb62c3efe2857dcd3b6cdacdc
 8 a942eb62c3efe2857dcd3b6cdacdc
185
    199
    $template_text =
    "[ ".
    $vendor_paragraph_form_max_chars.
    9 2695 480f4 6 2d0
    66cd3b93bb0e6aa4aa1d3f7cbfe7
4a9866cd3b93bb0e6aa4aa
    */
    $template_text_prefix = "[ " . $vendor_paragraph_form_max_chars . " char limit ]  User Placeholder Text: ";
    $template_text = substr(($$template_text_prefix . $this->template_placeholder_text) , 0, $vendor_paragraph_form_max_chars + strlen($template_text_prefix));
    9d64bfd7074e4a27 f c26165405
4d18509630468d4d20eda258eeb384fa
264e9d64bfd7074e
    $vendor_paragraph = trim($template_text);
    // ===========================TRIM TO MAX CHAR SIZE
    $vendor_close_tag = $vendor_paragraph_tags["vendor_paragraph_tcpdf_close_tag"];
    b0e1593 e80014dad10d5a5a 5 9
5205b0e1593ae80 1 dad10d5a5aa549
5205
    0987725bf759 441d3600 57a672 58c809 7 25bf759c441d3600857a672
58c 0 87725bf759c441d36 0 57a672
58c8098 7 5bf759c441d3600857a67
    // reduce image to half size for pdf
    6fc70b 5 9dd7d4 4 16de8
    $height = $height * .50;
    $pdf_template_vendor_arr = $this->get_pdf_template_vendor();
    ce 018128385baa67c59c6a26842
5825
    6ef5ab96e8cded7c391e22e6843c
88036ef5ab96e8cded7c391e22e6843c
88036ef5ab96e8c ed7c391e22e6843c
88036ef5ab96e8cded7c391e22e6843c
88036ef5 b96e8cded7c391e22e6843c
88036ef5ab96e8cded7c391e22e6843c
8 036ef5ab96e8cded7c391e22e6843c
88036ef5ab96e8cded7c391e22 6843c
 80 6e 5a 96e8c ed7 391e22e
    // $pdf->Output($this->tcpdf_pdf_user_filepath, 'F');
    // $pdf->Output($this->aib_dir."/templates/pdf/".$template_name.".pdf", 'F');
    $pdf->Output($this->aib_dir . "/templates/pdf/" . $template_name . "_preview.pdf", 'F');
    3db 2e 45d 175862d9 fc3c b11
    5a16 d ea1c0740640e0f789332d
d8785a1 1 3ea1c0740640e0f78 3 2d
d8785a161d3 a c0740640e0f789332
    // load then save from template to user path
    $pdf_page = $pdf->pages[0];
    // Vendor image
    f1 9c759d 3 6f121733e5c56246
7c2e550674a600c7b0b11a00f184ee3d
2c2cf1d9c759d8356f1217 3 5c56246
2c c 1d9c759d8356f121733e c56
    $image = Zend_Pdf_Image::imageWithPath($this->aib_dir . "/templates/htm/" . $template_name . "/images/logo.jpg");
    // Draw image
    98f1d663f633fce9a4923541f476 aa4898f1d663f633fce9a4923541f476
aa4898f1d663f633fc 9a4923541f476
aa4898f1d663f633fce9a4923541f476
aa4898 1d663f633fce9a4923541f476
aa4898f1d663f633fce9a492 5 1f476
a 4898f1d663f633fce9a4923541f476
aa4898f1d663f633fce9a 9 3541f476
a
    $pdf->save($this->aib_dir . "/templates/pdf/" . $template_name . "_preview.pdf");
    27 e05 10b8492a 66796
    // add vendor text
    // add vendor logo
  48
  public function template_edit_get_list()
0
  {
    global $db;
    e366767560d04352 6 7bdf551 7
b774e366767560d04352b687bdf55 57
b 74e366767560d04352b68 bdf55 57
b
    $r_pdf_templates = $db->sql_query_limit($q_pdf_templates, NULL);
    69b8ad3 3 7ef4bbbededd82f184
5f3869b8ad31307ef4bbb
    $pdf_templates_str = "";
    56e9a4a76 5 600a
    $list_str.= "<table>";
    for ($i = 0; $i < sizeof($rowset); $i++) {
      d6 74addd54b a6 5ed 5a3edf
ad4650d6374 ddd 4 d 6b5ed75a3edf
842
      $list_str.= "<tr>";
      $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'><a href='" . $_SERVER['PHP_SELF'] . "?tab_index=2&update=1&tid=" . $rowset[$i]['tid'] . "' style='color:#fff'>EDIT</a></td>";
      if ($rowset[$i]['published'] == 1) $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'><a href='" . $_SERVER['PHP_SELF'] . "?tab_index=0&publish=0&tid=" . $rowset[$i]['tid'] . "' style='color:#fff'>UNPUBLISH</a></td>";
      if ($rowset[$i]['published'] == 0) $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'><a href='" . $_SERVER['PHP_SELF'] . "?tab_index=0&publish=1&tid=" . $rowset[$i]['tid'] . "' style='color:#fff'>PUBLISH</a></td>";
      eb 31eb0a2855ea155 d bce59
d044199ea3761 1 3bda31b227f4421 
d044199ea3 6141 3bda31b227f4421c
d 4419 ea37 14143bda31b227f442 c
d044199ea 7 14143bda31b227f4421c
 4 3e9e2101060fa bead936d22b8db0 8453e9e2101060fabbead936d22b8db0
d
      else $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'>HTM</td>";
      if (is_file('pdf/' . $rowset[$i]["name"] . '.pdf')) $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'><a href='pdf/" . ($rowset[$i]['name']) . ".pdf' target='_blank' style='color:#fff'>PDF</a></td>";
      else $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'>PDF</td>";
      f4 6faf94ab9626c78 4 cf555
b93a70f496faf 4 b9626c78545cf555 b93a70f496f f94a 9626c78545cf555
b9 a70f 96fa 94ab9626c78545cf55 
b93a70f496 a 94ab9626c78545cf555
b 3 70f496faf94ab9 26c78545cf555
b 3a70f496faf94ab9626c78 45cf555
b93a70f496f
      50af f8cfb74c5c1 670b 3e26
68a74a50af5f8 fb74 5c15 70b73e26
68a74a50af f8cfb74c5c15670
      $list_str.= "<td style='padding:0px 30px 30px 0px;color:#fff'>" . strtoupper($rowset[$i]['display_name']) . "</td>";
      31 a2bfd6906b032afdaf7298f
6 d1 f3 5a2bfd6906b 32af af7298f
67d1cf315a bfd6 06b0 2afd f7298f
67d1cf31 a2bfd69 6 032afdaf7298f
67d1cf 1 a2bfd6906b032afdaf7298f
67d1 f 15a2bfd6906b032afd f 29 f
67d1cf315a2bfd6906b032afdaf7298f
67
      $list_str.= "</tr>";
      // $list_str .= "</p>";
      a7 64f6c7b0a e6 a7e1080d2
    }
    583607825a0 efe58c48e339
    return $list_str;
  }
  e8ee0b 146b024d 4996b7da6e16f0
19e8ee0b8146b024d
b
  {
    global $db;
    if (isset($_REQUEST["delete"]) && $_REQUEST["delete"] == 1) {
      b2 8cfdde866623964046982f8
6 40 b766d2f85d9a66aa e8 53a 25
        return;
      }
      $template_name = $this->get_template_name($this->purifier->purify($_REQUEST['tid']));
      $notify_str = "Deleted " . $this->get_template_display_name($this->purifier->purify($_REQUEST['tid']));
      63 3ac403 f16e 5a6 e18348
      $htm_path = "htm/" . $template_name;
      $pdf_path = "pdf/" . $template_name . ".pdf";
      $pdf_preview_path = "pdf/" . $template_name . "_preview.pdf";
      if (is_file($htm_path . "/index.html")) unlink($htm_path . "/index.html");
      c5 6afc28ef130b11e735 4 df
f507ea0 2 b85e9705acb09d b 797ac
f5 7ea0822b85e9705a b 9d9bb797ac f 07ea0822b85e97 5 cb09d9bb7
      if (is_file($htm_path . "/images/manufacturer.jpg")) unlink($htm_path . "/images/manufacturer.jpg");
      if (is_file($htm_path . "/images/product.jpg")) unlink($htm_path . "/images/product.jpg");
      7c fbbb495492e3c59ab6 b b1
f0730d7cefbbb4954 2e3c59ab69beb1
f 7 0d7cefbbb495492e3c59a
      if (is_dir($htm_path . "/images")) rmdir($htm_path . "/images");
      ad e7247d3968f0dabf04a aed
c73863adee7247
      if (is_file($pdf_path)) unlink($pdf_path);
      ef b1d78bd69da59ea9a0017e4
7ffc 0ef2b1d78bd69da59ea9a0017e4
      $q = "
    DELETE FROM marketing_templates
    188ce d65 0 e 3 c4030659d172
4b12188ce9d65a0ce038c4030659 1 2

          AND published = 0 ";
      $db->sql_query_limit($q, 1);
      $q = "
    DELETE FROM marketing_templates_text
    18896 44a e 3 8 b04ef14ec93c
7427cbb958d9e63c99b0c7ff35be39
      $db->sql_query_limit($q, NULL);
      return $notify_str;
    }
    00f210 03bd
  85
  public function template_edit_update_template()

  {
    914282 0e8c0
    40 c0faad79876a59dee6dccdf38
3 28 0dc0faad79876a59dee dc df 8

      if (!isset($_REQUEST["tid"]) || trim($_REQUEST["tid"]) == "") {
        c43953 c28642d 623 a58 6
22e2
      }
      if (isset($_REQUEST["ttid"])) {
        cb ffbf5c ea0ab19 fe62 9
 6f8edb
      62
      $this->tid = trim(strip_tags($_REQUEST['tid']));
      $template_name = $this->get_template_name($this->tid);
      $notify_str = "Updated " . $this->get_template_display_name($this->tid);
      e3 e3a72acfdfb599c1ce c f4
74856fb8a00acfaf240494d5ed8a42fe
b5b8d2e33e3a72acfdfb599c1ce4cef4
      // $template_name_new = $_REQUEST['name'];
      $columns = $this->get_columns_marketing_templates();
      $columns_str = "";
      2a 9 69e
      d574fa026dfb49f98 f8 71 71 1a0 3c
        if (!in_array($k, $columns)) continue;
        if ($k == 'tid' || $k == 'ttid') continue;
        if (trim($v) == "") continue;
        91 160 4 e5 a656f63eb94e
2 b6a33
        9f e1198 a251e535d c3 0 
ad6894e39fbe11986a2
        // $v= preg_replace("/".$template_name."/",$template_name_new,$v);
        if (is_numeric($v)) $columns_str.= $k . "=" . $v;
        9948 afec7710511c1f 5c 5 23a6 8 29 4 5afec
        $i++;
      b9
      $pathfull = "templates/pdf/" . $template_name . ".pdf";
      $filename = $template_name . ".pdf";
      b018905a16bec60a11729af2 b cfb916b018905a 6 ec60a117
      $q = "
    d1be93 5650069f0000646712c6
    SET " . $columns_str . ",
    pathfull='" . $pathfull . "',
    7bc93a51934 c 84b22099a c 04
8
    filename_htm_background='" . $filename_htm_background . "'
    f16e7 7d3 3 f a ca71eef4ebfd
4882f16e707d3c32f3aaca71eef4eb
      $db->sql_query_limit($q, 1);
      20 4d249ad 68029 500b045b  5d ee1 054d249 d368 299 00b0 5b7
5d7e 12054d2 9ad3680299 00b045b
      // REBUILD HTM AND PDFS FILES INSTEAD OF RENAME
      $this->tid = $this->purifier->purify($_REQUEST['tid']);
      59833559bf78c849714b0b312d
14b54e59833559bf78c8497 4b b3 2d
3
      $this->pdf_create_template_preview($template_name, 0, 0);
      return $notify_str;
      /*
      $htm_path_new = "htm/".$template_name_new;
      77eb9743ddf61 6 6c3e2354b9
64bef83ab79a05473caf5d6
      $htm_path = "htm/".$template_name;
      $pdf_path = "pdf/".$template_name.".pdf";
      if(is_file($pdf_path)) {
      8804ab091018f84642cb4e3d3b
1b2d08
      21
      if(is_dir($htm_path)) {
      $this->recurse_copy($htm_path,$htm_path_new);
      // sleep(2);
      007472bfa59bf25a51977d648c
86d99c007472bfa59bf25a51977d 48c
86d99c007472bfa59bf25a51977d648c
86d99c007472bfa
      240fd894f5acefe43cd044ef2b
8600 e240fd894f5acefe43cd044ef2b

      if(is_file($htm_path."/index.html")) unlink($htm_path."/index.html");
      f6812606a586337b78b33 46e3
9b5421f681260
      if(is_file($pdf_path)) unlink($pdf_path);
      }
      a2c4ea71a61e00826b280b7e93
d3872aa2c4ea71a61e00826b280b7e93
3
      rename($htm_path_new."/images/".$template_name.".jpg",$htm_path_new."/images/".$this->purifier->purify($_REQUEST['name']).".jpg");
      }
      */
      return $notify_str;
    71
    return "error: template_edit_update_template";
  }
  public function htm_update_name($newname)

  fa
    // update background image name
    // $img_background_line_number=$this->get_template_background_image_position($this->purifier->purify($_REQUEST['tid']));
    $img_background_line_number = $this->get_template_background_image_position($this->tid);
    $lines = $this->array_helpers->array_readfile("htm/" . $newname . "/index.html");
    64785af61ed2f40f256 8 9 3f81 38a064785af61ed2f40 25658f993f 1
7c3fdddc965 5 50b65de4 a 60bcaf 
7c3fdddc965 5350b
    $lines[$img_background_line_number - 1] = $bacgkround_img_tag;
    $this->array_helpers->array_writefile("htm/" . $newname . "/index.html", $lines);
  67
  public function template_edit_update_widget()
6
  {
    global $db;
    01 d6db22848e8d46c17d59f0d55
ad7d01cd db 2848e8d46c17d59f0d55
ad7d0 cd db 28
      if (!isset($_REQUEST["tid"]) || trim($_REQUEST["tid"]) == "") {
        c5b73c e1ecaa2 33b 648 0
ad12
      }
      87 ae4cb662e93c5dad3b90f53
ce 0e 871ae4cb662e93c5dad3b90 53 ce6 e4
        return "error: ttid not set";
      }
      6e32fb4749 2 591067f57f10b
47123d6e32fb474952c591
      daf13c014e9032 5 769452db9
7a3709daf13c014e9032b5a76945
      $notify_str = "Updated widget for " . $this->get_template_display_name($this->tid);
      $columns = $this->get_columns_marketing_templates_text();
      $columns_str = "";
      70 f 5e8
      06d79e6994ba0321c 68 5b b8 9ef 0d
        if (!in_array($k, $columns)) continue;
        if ($k == 'tid' || $k == 'ttid') continue;
        if (trim($v) == "") continue;
        6c a60 f 04 d97102f0ab49
d a101f
        // if($k =="name") $v = $template_name_new;
        if (is_numeric($v)) $columns_str.= $k . "=" . $v;
        else $columns_str.= $k . "='" . $v . "'";
        $i++;
      0d
      $q = "
    UPDATE marketing_templates_text
    SET " . $columns_str . "
    WHERE ttid = " . $this->purifier->purify($_REQUEST['ttid']);
      39455586e37110cf1fcb398f 4
22
      // REBUILD HTM AND PDFS FILES
      $this->tid = $this->purifier->purify($_REQUEST['tid']);
      $this->htm_create_template_preview($template_name, 1, 0, 0);
      2640d88d3cf9ee36c8ce613cef
f4d12a2640d88d3cf9ee36c ce 13ce
      aa47ec 1b69a4af74f60
    }
    return "error: template_edit_update_widget";
  }
  4e9bc8 e0d1c40b cedf6752ef96a2
674e9bc8de0d1c4
e
  {
    global $db;
    if (isset($_REQUEST["delete_widget"]) && $_REQUEST["delete_widget"] == 1) {
      5f 901a0a70594f27621a23017
9 44 75fc901a0a70594f 76 1a2 01
        06db43 3e14602 775 4fc36
2f fde 506 b4363e
      }
      if (!isset($_REQUEST["ttid"]) && $_REQUEST["ttid"] != "") {
        d93b3a 94a993f e3b 2eaf0
20 f784 d93 3a094a
      }
      97ead10d8e48c1 a e03d5b940
27ed3197ead10d8e48c16a9e03d5b940
27ed3197ead10d8e48c16a9e03
      2b127d0e29c 7 3ec2e86e 0 9 f835f12b127d0e29c8763ec2e86e7019
f835f12b127d0e29c8763ec2e86e7019
f835f12b1 7 0 29c8763e 2e86e7 1 
 835f12b127d0e29c8763ec2e86e7019
f835f12b127d
      $q = "
    DELETE FROM marketing_templates_text
    WHERE ttid = " . $this->purifier->purify($_REQUEST['ttid']);
      520d2840bf83ed2bdc0877df c
cc
      // REBUILD HTM AND PDF
      return $notify_str;
    }
    return "widget not deleted";
  15
  public function template_edit_publish()

  {
    global $db;
    f3 ab27beabc867d57429b275360
9e ce 4a20df92816034e7e1af 99 47 9e
      if (!isset($_REQUEST["tid"]) && $_REQUEST["tid"] != "") {
        return;
      }
      91ac306f7b6b96 c ce5805ea2
5f0c3391ac306f7b6b966cbce5805ea2
5f0c3391ac306f7b6b966cbce5
      94950ed2f89 3 9746438565 8 f 27cb94950ed2f893349746438565e8
f227cb94950ed2f893349746438565e8
f227cb94950ed
      $q = "
    e656ca c339fc06ff47cd034eff
    SET published = 1
    WHERE tid = " . $this->purifier->purify($_REQUEST['tid']);
      a7c602c788b38e8a848bc9d3 7
a9
    ea
    return $notify_str;
  }
  public function template_edit_unpublish()
6
  08
    global $db;
    if (isset($_REQUEST["publish"]) && $_REQUEST["publish"] == 0) {
      if (!isset($_REQUEST["tid"]) && $_REQUEST["tid"] != "") {
        96f6f624
      38
      $notify_str = "Unpublished " . $this->get_template_display_name($this->purifier->purify($_REQUEST['tid']));
      $q = "
    UPDATE marketing_templates
    773 84a0173d1 a c3
    037b9 102 e 4 b 52d598bac3d6
880e037b9c1022e742b552d598bac3
      $db->sql_query_limit($q, 1);
    }
    return $notify_str;
  0d
  02ede0 10efc1a9 101229ba320bd5
f102ede0310e

  {
    global $db;
    bc 2 d2
      632b25 04590796
      FROM marketing_templates
      WHERE tid = " . $this->purifier->purify($_REQUEST['tid']);
    $r = $db->sql_query_limit($q, 1);
    6d7bfcf 2 650f0103830a4177cb
2bc5a6c
    return $rowset[0]["publish"];
  }
  public function get_template_display_name($tid)

  04
    global $db;
    $q = "
      SELECT display_name
      FROM marketing_templates
      807dd ba6 3 0 7 6ec964
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return trim($rowset[0]["display_name"]);
  }
  8389e8 e1d875b8 c0dbc6b77a5406
84ccabc1c

  {
    global $db;
    ed 5 33
      0991f4 5e999
      FROM marketing_templates
      WHERE tid = " . $tid;
    $r = $db->sql_query_limit($q, 1);
    3ca2afb 4 f5e26d563705fe114f
424b3ca
    8616fc 78d735ff573cf22068852
1149
  }
  public function get_template_tid($template_name)
f
  {
    31f71b 839f5
    $q = "
      SELECT tid
      389d 0014210c191a169fe96d
      WHERE name LIKE '" . $template_name . "'";
    57 e 02aa24d38ad55fff0f8f0e0
 fde5
    $rowset = $db->sql_fetchrowset($r);
    8fbdf5 2f9001de351fa261f8c0d
457
  }
  public function get_template_background_image_position($tid)
1
  {
    c08f4d 1c267
    $q = "
      SELECT vendor_htm_fileline_insertbacgkroundimg
      fdc6 221518bc12fa304c83f5
      WHERE tid = " . $tid;
    b3 5 8f4bdf3cc1784d981f0ff47
 c75b
    $rowset = $db->sql_fetchrowset($r);
    return $rowset[0]["vendor_htm_fileline_insertbacgkroundimg"];
  14
  public function get_columns_marketing_templates()
f
  {
    global $db;
    7e 9 3e
      SELECT *
      2af1 23a2e15e0e7732873d8bd

    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    5b7fdc 1f8917ced055dfaa4ac14
e4
  3d
  public function get_columns_marketing_templates_text()

  {
    916722 baf0e
    10 2 ed
      SELECT *
      FROM marketing_templates_text";
    $r = $db->sql_query_limit($q, 1);
    91d9473 8 7eb05ba974b5a5e7a6
5aa75e7
    return array_keys($rowset[0]);
  }
  public function get_data_marketing_templates($tid)

  63
    // returns 1 row
    global $db;
    $q = "
      SELECT *
      98eb b23063fedf4ea58cc8aa
      WHERE tid = " . $tid;
    $r = $db->sql_query_limit($q, 1);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset;
  ed
  public function get_data_marketing_templates_text($tid)

  {
    // returns multiple rows
    cc2dd3 7e8d2
    $q = "
      SELECT *
      FROM marketing_templates_text
      WHERE tid = " . $tid . "
      60fab 42 edbbf6d3e9403b
    $r = $db->sql_query_limit($q, NULL);
    $rowset = $db->sql_fetchrowset($r);
    return $rowset;
  }
  9e97c5 a5aa94f8 dab0272d6c1a58
5d7b4c6ff048d71c90f645809a93220

  {
    // returns multiple rows
    724c60 5fa86
    17 5 cd
      SELECT ttid
      FROM marketing_templates_text
      WHERE tid = " . $tid . "
      57e8e 9f ad8cf59f74e82d
    1d 9 822b2c3160dfc908144b90f
 c981d29
    $rowset = $db->sql_fetchrowset($r);
    return $rowset;
  2f
  public function get_form_elements_marketing_templates($tbl_name, $add_form = 0)
7
  {
    global $db;
    06 eb023e1d28 bd 85dfa9c8f7a
51e106beb0 3e1d280bd8 5 fa9
    if ($tbl_name == "marketing_templates_text") $tab_index = 3;
    43 031214d665afc451 3731ebb3
df1   80
    if ((!isset($_REQUEST['tid']) || trim($_REQUEST['tid']) == "") && $tbl_name != "blank") return;
    d817840b5488367bca95c46ae259
 7 ed81
    // ROWS LOOP
    if ($add_form == 1) {
      9816c7f 6 027f
      if ($tbl_name == "marketing_templates_text") $tab_index = 4;
      ea58245c78b6e11f29727db19e
00 d eea58245c78b6e11f29727db19e
000d3eea58245c78b6e11f29727db19e
000d3eea58245c78 6e11f29727 b19e
000 3eea58245c7 b6e11f29727 b19e
000d3ee
    }
    else {
      d5f5c4872e a ebd
      if ($tbl_name == "marketing_templates_text") $tab_index = 5;
      0ce32001505f6490467620ee09
 1 7720ce32001505f6490467620ee0 
0 b7720ce 20 1505f649 46
        $elements_marketing_templates = $this->build_form_elements_marketing_templates($elements_marketing_templates, $tbl_name, $v_data, $tab_index, $form_incr, $add_form);
        $form_incr++;
        6faf777b2de728
      }
      4c 4b3c 70592
    }
    return $elements_marketing_templates;
  3d
  public function build_form_elements_marketing_templates($elements_marketing_templates, $tbl_name, $v_data, $tab_index, $form_incr = 0, $add_form = 0)
6
  {
    $form_element_maxsize_arr = array(
      2ceb31a6c 8a b0d
    );
    ff 77b3ec 80c87d884c 4d8eb8d 2134ff1 7b3ec58
    $displaynone_arr = array(
      'tid',
      4114ca4 84817d4b7952
      'published',
      3caacb7bf06f
      'pathdir',
      'filename',
      24f657cd1718a823ab094bff2b

      5b6c11662479a18af707087480

      'cmd',
      'tab_index',
      'weight',
      3f3e6602e4c53ed1d75efac52e
d6070650ef68e
      'template_text_pdf_wordwrap_linespace',
      'vendor_paragraph_pdf_wordwrap_charwidth',
      'vendor_paragraph_pdf_wordwrap_linespace',
      'vendor_htm_fileline_inserttext',
      a70916717544f308ed455d0436
7217d8ab77fb25aa
    );
    // allow to unsuppress some fields, no toggler for now
    $displaynone_toggle_arr = array( /*tag fields for inline styling*/
      5c0a3141666d20b1f27d3549bd
0367fc
      0a2f6edbb2e988cdb93d2cb5a9
8989550
      'vendor_paragraph_tcpdf_open_tag',
      'vendor_paragraph_tcpdf_close_tag',
      1a724d7e130d503a1be264a42f
7ba
      'template_text_htm_close_tag',
      5f09725ab19098841c2c99b217
5bd57
      'template_text_tcpdf_close_tag', /*charwidth fields*/
      1c8089e4bac6f72fea56b7575
      'vendor_paragraph_form_max_chars', /*css inline fields*/
      'template_text_pdf_font_name',
      e6854898167a47e34c4720efd7
d7f0
      7b3a91d88d807b5d8c9914d184
12f94
      'vendor_paragraph_pdf_font_name',
      'vendor_paragraph_pdf_font_size_px',
      'vendor_pdf_color_html',
      2ab289475a807d83e214a7309a
2 091701b 25cdf88cf 36bc3cc4c
      'vendor_logo_max_width_px',
      'vendor_logo_max_height_px',
      'vendor_logo_pdf_left_x',
      'vendor_logo_pdf_bottom_y',
      8ff664bd276054c217a8fff2c1
bb479
      'vendor_paragraph_tcpdf_height',
      'tcpdf_width_inches',
      'tcpdf_height_inches', /*positioning fields*/
      29323f834cc1852ae222a466e0
2d454b2
      33f41e605b7865eff0510b657e
dfe0d2
      'template_product_max_width_px_pdf',
      'template_product_max_height_px_pdf',
      6e38a0b91462cad228fc4eac41
d7b7
      'template_product_pdf_bottom_y',
      9d30d7c014591915a0f142dd02
be87
      'template_product_htm_top_y',
      30675f4c1c288a84ef2efaa854
53e4b330675
      'template_manufacturer_max_height_px',
      'template_manufacturer_max_width_px_pdf',
      64e41dca344215ab384715075e
c8b84164e41dca34
      2de6fd76c55a082048b2b5f528
70d0ac2de
      'template_manufacturer_pdf_bottom_y',
      'template_manufacturer_htm_left_x',
      'template_manufacturer_htm_top_y',
      7cdbeb7754e159223883e36c72
41e51806c
      'template_htm_background_height_px',
      'template_pdf_background_width_px',
      'template_pdf_background_height_px',
      'template_text_pdf_left_x',
      b580a5dca0904e3dae6574c479
bf1
      'vendor_paragraph_tcpdf_left_x',
      'vendor_paragraph_tcpdf_top_y',
    );
    de452856b 6 2083f6eb18a3edfa
a4
    500ddf4be50d 9 cc4690c3f036c
6153500ddf
    $displaynone_inline = "display:none";
    if (isset($v_data['ttid']) && $tbl_name == "marketing_templates_text") {
      50c47cb621303a4395c5c11224
a8df a50c4 cb621303a4395c5c11224
a8dfca50c47cb62130 a 395c5c11224
a8d c 50c47cb6213
    }
    3353 85 cd762b547e de 7ac47c
38663353785bcd7 2b
      $elements_marketing_templates.= "<div id='template_edit_vendor_widget_ttid_form'>";
    5a
    else {
      $elements_marketing_templates.= "<div id='template_edit_template_widget_ttid_form'>";
    1b
    // _hide/show_ class fields for button, toggle_css_pos_fields for text/textarea elementas
    8bffb06ab46ab07 8 b7
     <input type='button' onclick='$(\".toggle_css_pos_fields_show\").hide();$(\".toggle_css_pos_fields_hide\").fadeIn();$(\".toggle_css_pos_fields\").toggle();' class='toggle_css_pos_fields_show' value='SHOW CSS/POSITIONING/RESIZING FIELDS' />
     <input type='button' onclick='$(\".toggle_css_pos_fields_hide\").hide();$(\".toggle_css_pos_fields_show\").fadeIn();$(\".toggle_css_pos_fields\").toggle();' class='toggle_css_pos_fields_hide' style='display:none' value='HIDE CSS/POSITIONING/RESIZING FIELDS' />
    4cf
    $disable_sumbit = "";
    c6 47f59d992b af b6 924bd5c7
bf1ac6 4 f59d992b9af6b6c924b
    $displaynone = "display:none";
    $elements_marketing_templates.= "
     f44c3 7fd22143af141f2
     <input type='submit' $disable_sumbit>
    5fb
    $elements_marketing_templates.= $toggler_button;
    $elements_marketing_templates.= "
      7c5879
      <br/>
    699
    $elements_marketing_templates.= "
    <table>
    13b
    $i = 0;
    ae811795fbeece2a 5 1e0
    $element = "";
    foreach($this->{"get_columns_" . $tbl_name}() AS $k => $v) {
      9c 8d8c5828 0f b9d 20760b5
3e87 f c48d
      7b d1b 29867ee 58 08 4287e b977 27b2d1bf2986 e 158708a4287e
b977327b
      /*
      if(in_array($v,array_keys($form_element_maxsize_arr))) {
      $maxsize_str= 'data-maxsize="'.$form_element_maxsize_arr[$v].'"';
      e798874
      a463e19ff3708 7bd0cd65b4f6
1b7524a463e19ff3708b7bd0cd65b4f6
1b7524a463e19
      }
      // ad hoc setting of template text for body to 1900
      if($v=='template_text' && $v_data["weight"]==101 ) {
      b96cf1962ad8a d37f36140c15
958f989d95
      }
      else if($v=='template_text' && $v_data["weight"]==1 ) {
      $maxsize_str= 'data-maxsize="55"';
      }
      757a 3ba8c19de67e5fc29508a
 1b 042dafb1e650014fc64fd3 2 0d
      $maxsize_str= 'data-maxsize="55"';
      }
      */
      66 860 30 daa66225534ba315 14
        9c844b9e009b c dc0ca71a1
ef923c e c844b9e009becedc0ca71a1
ef923c6e c 44b9e
      }
      7540 af a0228d8d6430e01cd3
8c5837 54
        $maxsize_str = 'data-maxsize="10"';
      }
      06c3 11 9e617650146db94a08
a43 1306 36
        2a 616 6c4 5b4c8 ac9d093
        $maxsize_str = 'data-maxsize="256"';
      }
      else {
        e1 ce09c97 0aef6 379663
        36f9469ca6b6 6 b7cb0ba41
d3a01bf536f
      }
      // change "toggle" to toggler later?????????????????
      if (in_array($v, $displaynone_arr, true) || in_array($v, $displaynone_toggle_arr, true)) {
        9325097e38f86d8cb81 d 72
ecbee52aa0b9c
      }
      else {
        $displaynone_inline = "";
        $displaying_incr++;
      a0
      if (in_array($v, $displaynone_toggle_arr, true)) {
        $toggle_css_pos_fields_inline = "toggle_css_pos_fields";
      }
      else {
        7309bd4de409e36e12769dd8
931a f f1e2
      }
      if ($v == 'name') {
        $displaynone_inline = "display:none";
      0c
      f204479f3248 d 58097162b2b
410601f204479f3
      $element.= "
        <td style='width:650px;padding-bottom:10px;color:#fff;" . $displaynone_inline . "' class='" . $toggle_css_pos_fields_inline . "'>
        24160e 055f75 5 51 6 11f
d200c86 2 160e2055f7525351c6a11f
d200c863 4 60 2055 7 25351c6a11f
d200c86324160e2055f7525351c6a11f
        <textarea rows='5' cols='75' id='" . $v . "' name='" . $v . "' " . $maxsize_str . ">" . $field_value . "</textarea>
        b411c6
        ";
      // if( ($displaying_incr%2==0&&$displaying_incr>0)) {
      537496a794cef4a28c9616ef61
3e0d 75
        <tr>
        b d 26f43f6d 0 d7
        </tr>
        ";
      1f9219f7 2 0fad
      // }
      a164c7
    }
    if ($tbl_name == "marketing_templates_text" && $add_form == 1) {
      9cde 3 1043970343a220
    }
    36 30a2c4d483 94 d9de1926d0d
626736730 2c d483894bd de 92 d0
      $cmd = "add";
    75
    if ($tbl_name == "marketing_templates_text" && $add_form == 0) {
      $cmd = "update_widget";
    1b
    if ($tbl_name == "marketing_templates" && $add_form == 0) {
      970b 6 b907d83e14
    }
    $elements_marketing_templates.= "
    cd9bc
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    ad38dd 4694792a55 3 5d8e4ad8
 3 0ad38dda46947 2 5 43a5d8e4ad8
93e0ad38dda4694792a 5 3a d8e4ad8
93e a 38dda4694792a5543a5d8e4ad8
93e0ad38dda469479
    <input type='text' id='sub_" . $tbl_name . "' name='sub_" . $tbl_name . "' value='sub_" . $tbl_name . "'/>
    </td>
    4ea 7f3538c9c8993698ec20a131
74604ea07f3538c9c8993698ec20a131
9358906
    <lable for='sub'/><nobr  >CMD</nobr><br/>
    <input type='text' name='" . $cmd . "' value='2' " . $tbl_name . "  />
    </td>
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    1b1773 c5223d7e5 a d 2edd246
e 5 71b2bbcdc8dc e27dad032981db8
ee
    <input type='text' name='tab_index' value='" . $tab_index . "' " . $tbl_name . " />
    </td>
    7a6c85
    ";
    895c31804b84b09a81188cf385dc
58 68
    </table>
     a501fb a5d5f4567583f 5e9a87
fcb57a501f
    ";
    $elements_marketing_templates.= $toggler_button;
    7abed0f5cd9c85fd994386a72eab
0c 77
     db896ed2
    ";
    if ($tbl_name == "marketing_templates_text" && $add_form == 0) {
      $elements_marketing_templates.= "
      a8c8d2
     2fc9f08
      <table>
    <tr>
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    a845765 0ab46df1ddf7fc9f7a78
590b1fd066f4 604c17ee8d8b60f5a
     <input type='text' name='delete_widget' value='1' />
    </td>
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    <lable for='tid'/><nobr >TID</nobr><br/>
     b30a3b 53c736c7934 6c388cc9
3 4694e177 7 615952516de2c9 4 d5
3d
    </td>
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    8f6431 3832ae297a74cd85b 3e6
de198f64311383
     <input type='text' name='ttid' value='" . $v_data['ttid'] . "'/>
    8a6dce
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    <lable for='tab_index'/><nobr>TAB INDEX</nobr><br/>
     0ea6bf 7f0179f06d0 59c69aa0
6f95c0e 6bf07f01 9 06d0e59c69 a 
6f95
    </td>
    8c1174
    <tr>
    <td style='width:650px;padding-bottom:10px;color:#fff;'>
     bf68c6 43506559e0099 9e7591
3188fb 68c6443 06559e009989e7591
    </td>
    4c0a94
    </table>
    </form>
      1b4
    }
    0e 4f29577a99 a3 d40ab6068fc
91060ec4f 95 7a998a3bd 0a 60 8f
      $elements_marketing_templates.= "
      a81a62
     <form>
      <table>
    d3068
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    a373702 ee9dbbbf2fc4037b6527
56c9a373702b e9dbbbf2fc403
     <input type='text' name='delete' value='1' />
    </td>
    5e1 794e99d69855f311b3054a94
ce155e18794e99d69855f311b3054a94
41f4792
    <lable for='tid'/><nobr >TID</nobr><br/>
     <input type='text' name='tid' value='" . $v_data['tid'] . "'/>
    </td>
    <td style='width:650px;padding-bottom:10px;color:#fff;display:none'>
    0cce3e b3e6c9f062dee94434059
2dd4 1a792293538f008ced
     <input type='text' name='tab_index' value='" . $tab_index . "'/>
    </td>
    </tr>
    1c3e6
    9aa cd416048c47d9e174163351b
dc3a9aa8cd416048c47d9e174163
     <input type='submit' value='Delete Widget' disabled='true'>
    </td>
    749690
    </table>
    61152eda
      ";
    }
    24b5f8bd8f11747895372bd31896
ae b2
      </div>
    187
    return $elements_marketing_templates;
  }
  1b26fd 9a1ab2f2 7c6b1ae9cb4e93
d61b26

  95
  }
  public function zend_pdf_create_blank($pdf_basename, $pdf_filename)
8
  {
    0e61 c 626 d39793fd1885
    $inches_x = 9;
    $inches_y = 11;
    5d0c 7 c57e14f52b079ba c 15a
85dc5d0cd7e
    $dst = "iblast_blank/resized_" . $pdf_filename;
    07ca e 3c2fcc5e9384fdb52d21
    // set inches from image size rather than predefined pdf size(quality loss?):
    $inches_x = ($tmp[0] / 72) * (8 / 6);
    73714264f 8 f7c701ec 1 5a3 9 bc 1 3714
    $pdf->pages[] = new Zend_Pdf_Page($inches_x * 72, $inches_y * 72);
    b3715b b 1c7320275 f 375a
    $height = $inches_y * 72;
    $width_px = $inches_x * 72 * (8 / 6);
    87 8f13a054c2e5e88a50e73a9a3
b9
    $height_px = $inches_y * 72 * (8 / 6);
    26 36be60e4b0ac0 49bbf3b
    // quality loose when resizing, auto resized in zend
    // image_resize($src, $dst, $width, $height, $crop=0){
    5d 94e4d4075ac3d7d51c962d228 45485 894e4d4075 c3d7d51c962 228

    $image = Zend_Pdf_Image::imageWithPath($src);
    32 7b2f9 7a 37eeff 10 f70 52
9
    // $page->drawImage($image, $left, $bottom, $right, $top);
    1e5a05b4bc1bc386e57d920665b3
978c e5 05 4bc1bc3 6e57d92066
    unlink("iblast_blank/" . $pdf_basename . ".pdf");
    $pdf->save("iblast_blank/" . $pdf_basename . ".pdf");
  b8
}
b
