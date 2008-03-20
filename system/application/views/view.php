<?php $this->load->view('header', $data); ?>
<?php if(isset($insert)){
	echo $insert;
}?>

<div class="paste">
	<div class="info">
		<h1 class="pagetitle right"><?=$title?></h1>
		<div class="meta">
			<span class="detail"><strong>By</strong> <?=$name?>, <? $p = explode(',', timespan($created, time())); echo $p[0]?> ago, written in <?=$lang?>.</span><br/>
			<span class="detail"><strong>URL </strong><a href="<?=$url?>"><?=$url?></a></span><br/>
			<span class="detail rawl"><strong><a href="<?=base_url()?>view/raw/<?=$pid?>">View Raw</a></strong></span>
		</div>
	</div>
	
	<div class="text_formatted">
		<?=$paste?>
	</div>
</div>

<?php $this->load->view('footer'); ?>