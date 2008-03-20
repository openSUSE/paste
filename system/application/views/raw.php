<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<title>Stikked</title>
		<link rel="stylesheet" href="<?=base_url()?>static/styles/raw.css" type="text/css" media="screen" title="raw stylesheet" charset="utf-8" />
	</head>
	<body>
		<div id="container">
			<h1 class="pagetitle"><?=$title?></h1>
			<a href="<?=base_url()?>view/<?=$pid?>">Go Back</a>
			<pre>
<?=$raw?>
			</pre>
			<a href="<?=base_url()?>view/<?=$pid?>">Go Back</a>
		</div>
	</body>
</html>