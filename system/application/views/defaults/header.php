<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<? if(!isset($page_title)) $page_title=$this->config->item('site_name'); ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title><?php echo $page_title;?></title>
		<link rel="stylesheet" href="<?=base_url()?>static/themes/bento/css/style.css" type="text/css" />
		<link rel="stylesheet" href="<?=base_url()?>static/styles/bento-fixes.css" type="text/css" />
		<script type="text/javascript" src="<?=base_url()?>static/themes/bento/js/jquery.js"></script> 
		<script type="text/javascript" src="<?=base_url()?>static/themes/bento/js/script.js"></script> 
		<script type="text/javascript" src="<?=base_url()?>static/themes/bento/js/l10n/global-navigation-data-en_US.js"></script> 
		<script type="text/javascript" src="<?=base_url()?>static/themes/bento/js/global-navigation.js"></script> 
 
		<link rel="icon" type="image/png" href="http://static.opensuse.org/themes/bento/images/favicon.png" /> 
	</head>
	<body>
<?
  $handle = fopen("static/themes/bento/includes/header.html","rb");
  $content = stream_get_contents($handle);
  fclose($handle);
  $content = str_replace( array('<ul id="global-navigation">',
  			    'container_12', '<!-- Search -->' , 'images/'),
             array('<ul id="global-navigation" style="width: 500px;">',
				 'container_16',
				 '<ul id="local-navigation">
				 <li><a href="'.site_url("lists").'" title="Recent Pastes">Recent</a></li>
				 <li><a href="'.base_url().'" title="Create A New Paste">Create</a></li></ul>',
				 base_url().'static/themes/bento/images/'),
				 $content );
  echo $content;
?>
  <!-- End: Header -->

		<div id="subheader" class="container_16">
			<div id="breadcrump" class="grid_12 alpha">
				<a href="#" title=""><img src="<?=base_url()?>static/themes/bento/images/home_grey.png" width="16" height="16" alt="Home" /> Paste</a> &gt;
				<?php 
					if(isset($title))	{ 
						if(isset($url)) { 
							?><a href="<?=$url?>"><?
						}
						echo $title;
						if(isset($url)) {
							?></a><?
						}
					} else if(isset($pastes)) {
						?><a href="<?=site_url("lists")?>">Recent Pastes</a><?
					} else {
						?> Create a new paste <?
					}?>
			</div>
		</div>

		<div id="content" class="container_16 content-wrapper">
			<?php if(isset($status_message)){?><script type="text/javascript" charset="utf-8">
				$(document).ready(function(){
					$(".change").oneTime(3000, function() {
						$(this).fadeOut(2000);
					});						
				});</script>
				<div class="message success change">
					<div class="container">
						<?php echo($status_message); ?>
					</div>
				</div>
			<?php }?>				
