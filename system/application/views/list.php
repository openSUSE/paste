<?php $this->load->view('defaults/header');?>

<div class="grid_16 box box-shadow alpha omega navigation">
<h2 class="box-header">List of recent pastes:</h2>
<!--<div class="box-header header-tabs">
<ul style="float: right;">
	<li><a href="<?php echo site_url("view/options")?>">Change paste viewing options</a></li> 
</ul>
</div> -->

<div class="grid_15 alpha omega">
		<?php 
		function checkNum($num){
			return ($num%2) ? TRUE : FALSE;
		}
		$n = 0;		
		if(!empty($pastes)){ ?>
			<table class="recent">
				<tbody>
					<tr>
						<th class="title">Title</th>
						<th class="name">Name</th>
						<th class="lang">Language</th>
						<th class="time">When</th>
					</tr>
		<?	foreach($pastes as $paste) {
				if(checkNum($n) == TRUE) {
					$eo = "even";
				} else {
					$eo = "odd";
				}
				$n++;
		?>	

		<tr class="<?=$eo?>">
			<td class="first"><a href="<?=site_url($paste['pid'])?>"><?=$paste['title']?></a></td>
			<td><?=$paste['name']?></td>
			<td><?=$paste['lang']?></td>
			<td><? $p = explode(",", timespan($paste['created'], time())); echo $p[0];?> ago.</td>
		</tr>

		<? }?>
				</tbody>
			</table> 
		<?} else { ?>
			<p>There have been no pastes :(</p>
		<? }?>
</div>
</div>
<p style="text-align: center;"><?=$pages?></p>
<?php $this->load->view('defaults/footer');?>
