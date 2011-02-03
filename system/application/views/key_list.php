<?php $this->load->view('defaults/header');?>

<div class="grid_16 box box-shadow alpha omega navigation">
<div class="box-header"><h2>List of your keys:</h2></div>

<div class="grid_15 alpha omega">
		<?php
		function checkNum($num){
			return ($num%2) ? TRUE : FALSE;
		}
		$n = 0;		
		if(!empty($keys)){ ?>
			<table class="recent">
				<tbody>
					<tr>
						<th class="key">Key</th>
						<th class="title">Title</th>
						<th class="created">Created</th>
						<th class="expiry">Expiry</th>
						<th class="controls">Controls</th>
					</tr>
		<?	foreach($keys as $key) {
				if(checkNum($n) == TRUE) {
					$eo = "even";
				} else {
					$eo = "odd";
				}
				$n++;
		?>	

		<tr class="<?=$eo?>">
			<td class="first"><?=$key['key']?></td>
			<td><?=$key['title']?></td>
			<td><? $p = explode(",", timespan($key['created'], time())); echo $p[0];?> ago</td>
			<td>in <? $p = explode(",", timespan(time(), $key['expire'])); echo $p[0];?></td>
			<td class="danger"><a href="<?= site_url('main/delete_key/' . $key['key']) ?>">delete</a></td>
		</tr>

		<? }?>
				</tbody>
			</table> 
		<?} else { ?>
			<p>Strange, you have no keys O.o</p>
		<? }?>
</div>
</div>

<div class="grid_16 box box-shadow alpha clear-both navigation">
	<div class="box-header"><h2>Create new key:</h2></div>
	<form name="key-form" action="<?=site_url("create_key")?>" method="post">
			<div class="item_group">
			<div class="item">
				<label for="name">Title
					<span class="instruction">Who is going to use this key?</span>
				</label>
				<input type="text" name="title" id="title" maxlength="150" tabindex="1"  />
			</div>
			<div class="item">
				<label for="expire">Expiry After
					<span class="instruction">When should we delete your key?</span>
				</label>
				<select name="ttl" id="ttl" class="select" tabindex="2">
				<option value="604800">1 Week</option>
				<option value="31536000">1 Year</option>
				<option value="94608000">3 Years</option>
				</select>
			</div>
		   
			<div class="item" style="float: right; margin-right: 21px;"><button style="float: right; width: 115px;" type="submit" value="submit" name="submit">Create</button></div>
		</div>

	</form>
</div>

<?php $this->load->view('defaults/footer');?>
