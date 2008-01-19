<?php $this->load->view('header');?>
<h1 class="pagetitle">Recent Pastes</h1>
<table class="recent">
	<tbody>
		<tr>
			<th class="title">Title</th>
			<th class="name">Name</th>
			<th class="lang">Language</th>
			<th class="time">When</th>
		</tr>

		<?php 
		function checkNum($num){
			return ($num%2) ? TRUE : FALSE;
		}
				
		if(!empty($pastes)){ 
			foreach($pastes as $paste) {
				if(checkNum($paste['id']) == TRUE) {
					$eo = "even";
				} else {
					$eo = "odd";
				}
		?>	

		<tr class="<?=$eo?>">
			<td class="first"><a href="<?=base_url()?>view/<?=$paste['pid']?>"><?=$paste['title']?></a></td>
			<td><?=$paste['name']?></td>
			<td><?=$paste['lang']?></td>
			<td><? $p = explode(",", timespan($paste['created'], time())); echo $p[0];?> ago.</td>
		</tr>

		<? } } else { ?>
			<p>There have been no pastes :(</p>
		<? }?>
	</tbody>
</table>
<?=$pages?>
<?php $this->load->view('footer');?>