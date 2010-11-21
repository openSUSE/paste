<?php 

$add = "";
if($lang_code == "image") {
   $add = ', filename="' . $paste . '"';
}

header('Content-disposition: attachment' . $add);

require 'raw.php';

?>
