<?php 

if($lang_code=='image') {
$frm="jpeg";
$path_part = pathinfo($raw);
$ext = $path_part['extension'];
if(($ext=="gif") || ($ext=="png"))
   $frm = $ext;

header('Content-type: image/' . $frm);

readfile(getenv("DOCUMENT_ROOT") . $raw);

} else {

header('Content-type: text/plain');

echo html_entity_decode($raw); 

}

?>
