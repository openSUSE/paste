<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title><?php echo $this->config->item('site_name');?></title>
		<link rel="stylesheet" href="<?=base_url()?>static/styles/raw.css" type="text/css" media="screen" title="raw stylesheet" charset="utf-8" />
	</head>
	<body>
		<div id="container">
			<?php if(isset($insert)){
				echo $insert;
			}?>
			
			<h1><?=$title?></h1>
			<a href="<?=site_url("view/".$pid)?>">Go Back</a>

<?php
		 if($lang_code=='image') {
		 	echo '<p>';
		 	echo '<img src=\'' . $raw . '\' alt=\'' . $paste . '\'/>';
		 	echo '</p>';
		 } else {
			echo '<pre>';
		 	echo $raw;
			echo '</pre>';
		 }
?>
			<a href="<?=site_url("view/".$pid)?>">Go Back</a>
		</div>
	</body>
</html>
