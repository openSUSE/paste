<?php $this->load->view('header'); ?>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$(".expand").click(function(){
			$(".paste").css("width", "90%");
			$(".text_formatted").hide();
			$(".text_formatted").css("width", "100%");
			$(".text_formatted").fadeIn(500);
		});
	});
</script>

<?php if(isset($insert)){
	echo $insert;
}?>

<div class="paste_info">
	<div class="info">
		<h1 class="pagetitle right"><?=$title?></h1>
		<div class="meta">
			<span class="detail"><strong>By</strong> <?=$name?>, <? $p = explode(',', timespan($created, time())); echo $p[0]?> ago, written in <?=$lang?>.</span><br/>
			<span class="detail"><strong>URL </strong><a href="<?=$url?>"><?=$url?></a></span><br/>
			<?php if(!empty($snipurl)){?>
				<span class="detail"><strong>Snipurl </strong><a href="<?=$snipurl?>"><?php echo htmlspecialchars($snipurl) ?></a></span><br/>
			<?php }?>
			<span class="detail rawl"><strong><a href="<?=site_url("view/raw/".$pid)?>">View Raw</a></strong> &mdash; <a href="#" class="expand">Expand paste to full width of browser</a></span><br/><br/>
			<span class="detail"><a href="<?=site_url("view/options")?>">Change Viewing Options</a></span>
		</div>
	</div>
</div>
</div>
</div>
</div>
</div>

<div class="paste <?php if($full_width){ echo "full"; }?>">
	<div class="text_formatted <?php if($full_width){ echo "full"; }?>">
		<?=$paste?>
	</div>
</div>

<?php $this->load->view('view_footer'); ?>