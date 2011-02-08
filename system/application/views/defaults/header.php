<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<? if(!isset($page_title)) $page_title=$this->config->item('site_name');
if (!function_exists('site_url')) {
	function site_url($arg) {
		return $config['site_url'].'/'.$arg;
	}
}

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title><?php echo $page_title;?></title>
		<link rel="stylesheet" href="<?=site_url()?>static/themes/bento/css/style.css" type="text/css" />
		<link rel="stylesheet" href="<?=site_url()?>static/styles/bento-fixes.css" type="text/css" />
		<script type="text/javascript" src="<?=site_url()?>static/themes/bento/js/jquery.js"></script> 
		<script type="text/javascript" src="<?=site_url()?>static/themes/bento/js/script.js"></script> 
		<script type="text/javascript" src="<?=site_url()?>static/themes/bento/js/l10n/global-navigation-data-en_US.js"></script> 
		<script type="text/javascript" src="<?=site_url()?>static/themes/bento/js/global-navigation.js"></script> 
		<script type="text/javascript" src="<?=site_url()?>static/themes/bento/js/script.js"></script> 
		<script type="text/javascript" src="<?=site_url()?>static/js/dropdown.js"></script>
		<link rel="icon" type="image/png" href="<?=site_url()?>static/themes/bento/images/favicon.png" />
	</head>
	<body>
<?
  $handle = fopen("static/themes/bento/includes/header.html","rb");
  $content = stream_get_contents($handle);
  fclose($handle);
  $content = str_replace( array('<ul id="global-navigation">',
  			    'container_12', 'images/'),
             array('<ul id="global-navigation" style="width: 500px;">',
				 'container_16',
				 site_url().'static/themes/bento/images/'),
				 $content );
  $content = preg_replace( '/<form id="global-search-form".*\n.*\n.*\n.*\n.*/',
				 '<ul id="local-navigation">
				 <li><a href="'.site_url("lists").'" title="Recent Pastes">Recent</a></li>
				 <li><a href="'.site_url().'" title="Create A New Paste">Create</a></li></ul>',
				 $content );
  echo $content;
?>
  <!-- End: Header -->

		<div id="subheader" class="container_16">
			<div id="breadcrump" class="grid_10 alpha">
				<a href="<?=site_url()?>" title=""><img src="<?=site_url()?>static/themes/bento/images/home_grey.png" width="16" height="16"/>openSUSE Paste</a> &gt;
				<?php 
					if(isset($title))	{ 
						if(isset($url)) { 
							?><a href="<?=$url?>"><?
						}
						echo $title;
						if(isset($url)) {
							?></a><?
						}
					} else 	if(isset($page_title) && ($_SERVER['REQUEST_URI'] != '/'))	{ 
						?>
						<a href="<?php
						if(isset($url)) { 
							echo $url;
						} else {
							echo $_SERVER['REQUEST_URI'];
						}?>"><?=$page_title?></a><?php
					} else {
						?> Create a new paste <?
					}?>
			</div>
			<div class="grid_6 omega" style="text-align: right; font-size: 0.9em">
			<?php if((!isset($oid_login)) || ($oid_nick == FALSE)) { ?>
				<a href="/user/login" id="login-trigger">Login</a>
				<div id="login-form">
				<form action="<?=site_url("login")?>" method="post" enctype="application/x-www-form-urlencoded" id="login_form">
				<p><label class="inlined" for="openid">OpenID</label><input type="text" class="inline-text" name="openid" value="" id="openid" /></p>
				<p><input value="Login" type="submit"/></p>
				<p class="slim-footer"><a id="close-login" href="#">Cancel</a></p>
				</form>
				</div>
			<?php } else { ?>
				<b><?= $oid_nick ?></b>
				<?php function selected_title($link, $title, $compare) {
					if($compare == $title) {
						return $title;
					} else {
						return '<a href="' . $link . '">' . $title . '</a>';
					}
				}
				?> 
				|
				<?= selected_title("/my_list","My Pastes",$page_title) ?>
				|
				<?= selected_title("/my_keys","My Keys",$page_title) ?>
				|
				<a href="/logout">Logout</a>
			<?php } ?>
			</div>
		</div>

		<div id="content" class="container_16 content-wrapper">
			<?php if(isset($status_message)) {?>
			<script type="text/javascript" charset="utf-8">
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
