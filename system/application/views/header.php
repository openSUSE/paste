<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>Stikked</title>
		<link rel="stylesheet" href="<?=base_url()?>static/styles/main.css" type="text/css" media="screen" title="main" charset="utf-8" />
		<?php if(!empty($scripts)){?>
		<?php foreach($scripts as $script){?>
		<script src="<?=base_url()?>static/js/<?=$script?>" type="text/javascript"></script>
		<?}}?>
	</head>

	<body>
		<div id="container">
			<div class="header">
				<div class="container">
					<a href="<?=base_url()?>"><img src="<?=base_url()?>static/images/logo.png" alt="sticked" class="logo" /></a> 
					<div class="links">
						<ul>
							<?php $l = $this->uri->segment(1)?>
							<li <?php if($l == ""){ echo 'class="active"'; }?>><a href="<?=base_url()?>">Paste</a></li>
							<li <?php if($l == "lists" || $l == "view"){ echo 'class="active"'; }?>><a href="<?=base_url()?>lists">Recent</a></li>
							<li <?php if($l == "about"){ echo 'class="active"'; }?>><a href="<?=base_url()?>about">About</a></li>
						</ul>
					</div>
				</div>
			</div>
			
			<div class="page">
				<div class="content">
					<div class="container">