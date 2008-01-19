<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>Stikked</title>
		<link rel="stylesheet" href="<?=base_url()?>static/style.css" type="text/css" media="screen" title="main" charset="utf-8" />
		<script src="<?=base_url()?>static/jquery.js" type="text/javascript"></script>
	</head>

	<body onload="">
		<div id="container">
			<div id="left">
				<div class="logo">
					<a href="<?=base_url()?>"><img src="<?=base_url()?>static/logo.png" alt="Stikked - Command-V your life." border="0"/></a>
				</div>
				<div class="toolbar">
					<ul>
					<?php $page = $this->uri->segment(1);?>
						<li class="<?if($page ==""){?>active<?}?>"><a href="<?=base_url()?>">Paste</a></li>
						<li class="<?if($page =="lists" || $page == "view"){?>active<?}?>"><a href="<?=base_url()?>lists">Recent Pastes</a></li>
						<li class="<?if($page =="about"){?>active<?}?> last"><a href="<?=base_url()?>about">About</a></li>
					</ul>
				</div>
				<div class="sidebar">
					<?php $this->load->view('sidebar');?>
				</div>	
			</div>
			
			<div id="content">
				<div class="border-top"></div>
					<div class="border-content">
						<div class="page">
							<div class="container">