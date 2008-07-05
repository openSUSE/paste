<?php header("HTTP/1.1 404 Not Found"); 
	include("system/application/config/config.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>Stikked</title>
		<link rel="stylesheet" href="<?=$config['base_url']?>static/styles/main.css" type="text/css" media="screen" title="main" charset="utf-8" />
	</head>

	<body>
		<div id="container">
			<div class="header">
				<div class="container">
					<a href="<?=$config['base_url']?>"><img src="<?=$config['base_url']?>static/images/logo.png" alt="sticked" class="logo" /></a> 
					<div class="links">
						<ul>
							<li><a href="<?=$config['base_url']?>">Paste</a></li>
							<li><a href="<?=$config['base_url']?>lists">Recent</a></li>
							<li><a href="<?=$config['base_url']?>about">About</a></li>
						</ul>
					</div>
				</div>
			</div>
			
			<div class="page">
				<div class="content">
					<div class="container">
						<h1><?=$heading?></h1>
						<div class="about">
							<?=$message?>
							<p><a href="<?=$config['base_url']?>">Go Home</a></p>
						</div>
					</div>
				</div>
			</div>
			<div class="footer">
				&copy; 2008 HiPPstr Networks<br/>
				Created by Ben McRedmond
			</div>
		</div>
	</body>
</html>