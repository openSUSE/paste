<?php $this->load->view("header.php"); ?>

<h1 class="pagetitle clear">Change Viewing Options</h1>

Here you can change the preferences for viewing pastes.<br/><br/>

<form action="<?=site_url("view/options")?>" method="post" accept-charset="utf-8" class="form">
	<table class="data">
		<tr>
			<td class="label"><label>Expand Paste</label></td>
			<td>
				<?php
				$set = array('name' => 'full_width', 'id' => 'full_width', 'class' => 'checkbox', 'value' => '1', 'checked' => $full_width_set);
				echo form_checkbox($set);
				?><small style="margin-left: 10px;">This automatically expands the width of a paste to fill the whole page.</small></td>
		</tr>
		<tr>
			<td class="label"><label>View Raw</label></td>
			<td>
				<?php
				$set = array('name' => 'view_raw', 'id' => 'view_raw', 'class' => 'checkbox', 'value' => '1', 'checked' => $view_raw_set);
				echo form_checkbox($set);
				?><small style="margin-left: 10px;">If you're on dial-up or a low bandwidth connection you may want to view your pastes in the stripped down raw form by default.</small></td>
		</tr>	
	</table>
	
	<div class="final">
		<button type="submit" name="submit" class="submit">Save!</button>
	</div>
</form>

<?php $this->load->view("footer.php"); ?>