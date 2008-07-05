<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>Stikked</title>
		<link rel="stylesheet" href="<?=base_url()?>static/styles/raw.css" type="text/css" media="screen" title="raw stylesheet" charset="utf-8" />
	</head>
	<body>
		<div id="container">
			<h1 class="pagetitle"><?=$title?></h1>
			<?php if(!$this->db_session->userdata("view_raw")){?>
				<a href="<?=site_url("view/".$pid)?>">Go Back</a>
			<?php } else { ?>
				<a href="<?=base_url()?>">Go Home</a>
			<?php }?> 
			&mdash; <a href="<?=site_url("view/options")?>">Change The View Options</a>
			<pre>
<?=$raw?>
			</pre>
			<?php if(!$this->db_session->userdata("view_raw")){?><a href="<?=site_url("view/".$pid)?>">Go Back</a><?php } else { ?><a href="<?=base_url()?>">Go Home</a><?php }?>
		</div>
	</body>
</html>