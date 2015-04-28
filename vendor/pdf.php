<?php
include('../configs/web.config.php');
$pdf = $_GET['pdf'];
if (($pdf != "") && (file_exists(APP_ROOT."static/pdf/".$pdf))){
header('Content-disposition: attachment; filename='.$pdf.'');
header('Content-type: application/pdf');
readfile(HTML_PATH_STATIC."pdf/".$pdf);
} else { throw new Exception("pdf file not found.");   }