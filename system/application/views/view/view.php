<?php $this->load->view('defaults/header'); ?>

<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$(".expand").click(function(){
			$(".paste").css("width", "90%");
			$(".text_formatted").hide();
			$(".text_formatted").css("width", "100%");
			$(".text_formatted").css("margin-left", "0");
			$(".text_formatted").fadeIn(500);
			return false;
		});
	});
</script>

<?php if(isset($insert)){
	echo $insert;
}?>

<div class="grid_16 box box-shadow alpha">
	<h2 class="box-header">Info:</h2>
	<div class="info">
		<?php echo '<p>By ' . $name . ', ';
			$p = explode(',', timespan($created, time()));
			echo $p[0] . ' ago, written in ' . $lang . '.';
		if($toexpire==1) {
			if($expire > time()) {
				$p = explode(',', timespan(time(), $expire));
				echo ' This post will expire in ' . $p[0] . '</p>';
			} else {
				echo ' This post is expired and will be deleted soon.</p>';
			}
		} else {
			echo ' This post will never expire.</p>';
		}
		?>
		<?php if(isset($inreply)){?><p>This paste is a reply to <a href="<?php echo str_replace("/view/","/",$inreply['url'])?>"><?php echo $inreply['title']; ?></a> by <?php echo $inreply['name']; ?></p><?php }?>
		<p>URL: <a href="<?=str_replace("/view/","/",$url)?>"><?=str_replace("/view/","/",$url)?></a></p>
	</div>
</div>

<?if(isset($replies) and !empty($replies)) {?>
<div class="grid_16 box box-shadow alpha">
	<h2 class="box-header">Replies to <?php echo $title; ?>:</h2>

	<div class="grid_15">
		<?php
		
		function checkNum($num){
			return ($num%2) ? TRUE : FALSE;
		}
		
		if(isset($replies) and !empty($replies)){		
			$n = 1;
		?>
			
			<table class="recent">
				<tbody>
					<tr>
						<th class="title">Title</th>
						<th class="name">Name</th>
						<th class="time">When</th>
					</tr>

			<?php foreach($replies as $reply){
					if(checkNum($n)){
						$eo = "even";
					} else {
						$eo = "odd";
					}
					$n++;
			?>
				
				<tr class="<?=$eo?>">
					<td class="first"><a href="<?=site_url("view/".$reply['pid'])?>"><?=$reply['title']?></a></td>
					<td><?=$reply['name']?></td>
					<td><? $p = explode(",", timespan($reply['created'], time())); echo $p[0];?> ago.</td>
				</tr>
		
			<?php }?>
			</tbody>
			</table>
		<div class="spacer high"></div><div class="spacer high"></div>
		<?php }?>
		
		<?php 
			$reply_form['page']['title'] = "Reply to \"$title\"";
			$reply_form['page']['instructions'] = 'Here you can reply to the paste above'; ?>
	</div>
</div>

<?}?>

<div class="grid_16 box box-shadow alpha" <?php
	if($lang_code == "image") {
		echo 'style = "text-align: center;"';
	}
?>>
	<div class="box-header header-tabs">
	<ul style="float: right;">
		<li><a href="<?=site_url("view/simple/".$pid)?>">Simple</a></li>
		<li><a href="<?=site_url("view/raw/".$pid)?>">Raw</a></li>
		<?php if(isset($oid_login) && ($oid_login == $owner)) { ?>
		<li class="danger"><a href="<?=site_url("delete/".$pid)?>">Delete</a></li>
		<?php } ?>
		<li><a href="<?=site_url("view/download/".$pid)?>">Download</a></li>
	</ul>
	</div>
		<?php
		 if($lang_code=='image') {
		 	echo '<div style="margin: 0px auto;">';
		 	echo '<img src=\'' . $raw . '\' alt=\'' . $paste . '\'/>';
		 	echo '</div>';
		 } else {
			echo '<div class="text_formatted">';
		 	echo $paste;
			echo '</div>';
		 }
		?>
</div>

<? $this->load->view('defaults/paste_form', $reply_form); ?>

<?php $this->load->view('defaults/footer'); ?>
