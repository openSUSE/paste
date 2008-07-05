<?php $this->load->view('header'); ?>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function(){
		$(".show").click(function(){
			$(".advanced_show").hide();
			$(".advanced").show();
		});
	});
</script>

<?php if(isset($status_message)){?><div class="message instruction"><?php echo($status_message); ?></div><?php }?>
<?php if(isset($this->validation->error_string)){ echo $this->validation->error_string; }?>
<form action="<?=base_url()?>" method="post" accept-charset="utf-8" class="form">
	<table class="data">
		<tr>
			<td class="label"><label>Name</label></td>
			<td>
				<?php $set = array('name' => 'name', 'id' => 'name', 'value' => $name_set,	              'maxlength' => '32', 'class' => 'info textfield');
				echo form_input($set);?>
		</tr>
		<tr>
			<td class="label"><label>Title</label></td>
			<td><input type="text" name="title" value="" class="info textfield" /></td>
		</tr>
		<tr>
			<td class="label"><label>Language</label></td>
			<td>	
				<?php $lang_extra = 'id="lang" class="selectfield"'; echo form_dropdown('lang', $languages, $lang_set, $lang_extra); ?>
			</td>
			<td class="label spaced"><label>Delete After</label></td>
			<td>
				<?php 
					$expire_extra = 'id="expire" class="selectfield"';
					$options = array(
									"0" => "Keep Forever",
									"30" => "30 Minutes",
									"60" => "1 hour",
									"360" => "6 Hours",
									"720" => "12 Hours",
									"1440" => "1 Day",
									"100080" => "1 Week",
									"40320" => "4 Weeks"
								);
				echo form_dropdown('expire', $options, $expire_set, $expire_extra); ?>
			</td>
		</tr>
		<tr>
			<td class="label"><label>Private</label></td>
			<td>
				<?php
				$set = array('name' => 'private', 'id' => 'private', 'class' => 'checkbox', 'value' => '1', 'checked' => $private_set);
				echo form_checkbox($set);
				?><small style="margin-left: 10px;">This prevents your paste from showing up in recent paste listings.</small></td>
		</tr>
		<tr>
			<td class="label"><label>Create a Snipurl</label></td>
			<td>
				<?php
				$set = array('name' => 'snipurl', 'id' => 'snipurl', 'class' => 'checkbox', 'value' => '1', 'checked' => $snipurl_set);
				echo form_checkbox($set);
				?><small style="margin-left: 10px;">This auto-magically creates a shortened snipurl that will redirect to your paste.</small></td>
		</tr>
		<tr class="advanced_show"><td class="label"></td><td><a href="#" class="show">Display Advanced Options</a></td></tr>
		<tr class="advanced">
			<td class="label"><label>Auto Copy</label></td>
			<td>
				<?php
				$set = array('name' => 'acopy', 'id' => 'acopy', 'class' => 'checkbox', 'value' => '1', 'checked' => $acopy_set);
				echo form_checkbox($set);
				?><small style="margin-left: 10px;">This auto-magically copies the link to your clipboard. (Requires Javascript and Flash or IE).</small> </td>
		</tr>
		<tr class="advanced last">
			<td class="label"><label>Remember Me</label></td>
			<td>
				<?php
				$set = array('name' => 'remember', 'id' => 'remember', 'class' => 'checkbox', 'value' => '1', 'checked' => $remember_set);
				echo form_checkbox($set);
				?><small style="margin-left: 10px;">This will remember your settings if you return.</small></td>
		</tr>		
	</table>
	
	<div>
		<textarea name="code" class="paste_body" rows="auto" cols="auto"></textarea>
	</div>
	
	<div class="final">
		<button type="submit" name="submit" class="submit">Paste!</button>
	</div>
</form>
<?php $this->load->view('footer');?>