<?php header("HTTP/1.1 404 Not Found"); 
	include("system/application/config/config.php"); 
	include("system/application/config/stikked.php");
?>

<?php $page_title = $heading; $title = "Error"; $error=TRUE; ?>

<?php require_once("system/application/views/defaults/header.php");?>

<div class="grid_16 box alpha omega box-shadow">
	<h2 class="box-header"><?=$heading?></h2>
	<div class="about">
		<?=$message?>
	</div>
</div>

<?php require_once("system/application/views/defaults/footer.php");?>
