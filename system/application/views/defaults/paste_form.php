
<?php if(isset($this->validation->error_string)){ echo $this->validation->error_string; }?>
<div class="grid_16 box box-shadow alpha clear-both navigation">
		<?php if(!isset($page['instructions'])){ ?>
			<h2 class="box-header">Here you can create your paste:</h2>
		<?php } else { ?>
			<h2 class="box-header"><?php echo $page['instructions']; ?></h2>
		<?php } ?>
		
	<form name="paste-form" enctype="multipart/form-data" action="<?=base_url()?>" method="post">
		<div class="item_group">
			<div class="item">
				<label for="name">Author
					<span class="instruction">What's your name?</span>
				</label>
				
				<?php $set = array('name' => 'name', 'id' => 'name', 'value' => $name_set, 'maxlength' => '32', 'tabindex' => '1');
				echo form_input($set);?>
			</div>
			
			<div class="item">
				<label for="title">Title
					<span class="instruction">Give your paste a title.</span>
				</label>
				
				<input value="<?php if(isset($title_set)){ echo $title_set; }?>" type="text" id="title" name="title" tabindex="2"/>
			</div>
			<?php
			if(strncmp("img",$_SERVER['SERVER_NAME'],3)==0) {
				$lang_set='image';
				if(!($expire_set))
					$expire_set = 60;
			}
			if(($reply) && ($lang_set=='image')) {
				$lang_set  = 'text';
				$paste_set = '';
			}
			if(!($expire_set)) {
				$expire_set = 10080;
			}
			?>
			<div class="item" style="float: right;">
				<label for="lang">Language
					<span class="instruction">What language is your paste written in?</span>
				</label>
				
				<?php $lang_extra = 'id="lang" class="select" tabindex="3" onchange=\'
				if(this.options[this.selectedIndex].value=="image") {
					document.getElementById("text-paste").style.display = "none";
					document.getElementById("file-paste").style.display = "";
				} else {
					document.getElementById("text-paste").style.display = "";
					document.getElementById("file-paste").style.display = "none";
				} \''; echo form_dropdown('lang', $languages, $lang_set, $lang_extra); ?>
			</div>								
		</div>							
		
		<div class="item_group">
			<label for="paste">Your paste
				<span class="instruction">Paste your paste here</span>
			</label>
		
			<?php if(strncmp("img",$_SERVER['SERVER_NAME'],3)==0) {
				$filestyle="";
				$textstyle='style="display: none;"';
			} else{
				$textstyle="";
				$filestyle='style="display: none;"';
			} ?>
			<div id="text-paste" <?php echo $textstyle ?>>
			<textarea name="code" cols="40" rows="20" tabindex="4"><?php if(isset($paste_set)){ echo $paste_set; }?></textarea>
			</div>
			<div id="file-paste" <?php echo $filestyle ?>>
			<input type="file" size="90" style="width: 720px;" name="file"/>
			</div>
		</div>																											
		
		<div class="item_group">

			<div class="item">
				<label for="private">Private
					<span class="instruction">Private paste aren't shown in recent listings.</span>
				</label>
				<div class="text_beside">
					<?php
						$set = array('name' => 'private', 'id' => 'private', 'tabindex' => '6', 'value' => '1', 'checked' => $private_set);
						echo form_checkbox($set);
					?>
				</div>
			</div>						
		
			<div class="item">
				<label for="expire">Delete After
					<span class="instruction">When should we delete your paste?</span>
				</label>
				<?php 
					$expire_extra = 'id="expire" class="select" tabindex="7"';
					$options = array(
									"30" => "30 Minutes",
									"60" => "1 hour",
									"360" => "6 Hours",
									"720" => "12 Hours",
									"1440" => "1 Day",
									"10080" => "1 Week",
									"40320" => "1 Month",
									"151200" => "3 Monts",
									"604800" => "1 Year",
									"1209600" => "2 Years",
									"1814400" => "3 Years",
									"0" => "Never"
								);
				echo form_dropdown('expire', $options, $expire_set, $expire_extra); ?>
			</div>
		   
			<div class="item" style="float: right; margin-right: 21px;"><button style="float: right; width: 115px;" type="submit" value="submit" name="submit">Create</button></div>
		</div>
		
		
		<?php if($reply){?>
		<input type="hidden" value="<?php echo $reply; ?>" name="reply" />
		<?php }?>
		<div id="spammer">
		<input type="checkbox" value="1" name="spammer" id="spammer-check" checked="true" />
		I'm a spammer
		<script language="JavaScript">
				window.onload=function() {
					document.getElementById('spammer-check').checked = false;
					document.getElementById('spammer').style.display = 'none';
				}
		</script>
		</div>

	</form>
</div>
