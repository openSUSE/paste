<script type="text/javascript">
function settype(type)
{
	if(type == "auto") {
		type = document.getElementById("lang").value;
	}
	if(type == "image") {
		document.getElementById("text-paste").style.display = "none";
		document.getElementById("file-paste").style.display = "";
		document.getElementById("code-selector").setAttribute("class", "");
		document.getElementById("image-selector").setAttribute("class", "selected");
	} else {
		document.getElementById("text-paste").style.display = "";
		document.getElementById("file-paste").style.display = "none";
		document.getElementById("code-selector").setAttribute("class", "selected");
		document.getElementById("image-selector").setAttribute("class", "");
	}
	if(document.getElementById("lang").value != type) {
		document.getElementById("lang").value = type;
	}
}

window.onload=function() {
	settype("auto");
}

</script>

<?php if(isset($this->validation->error_string)){ echo $this->validation->error_string; }?>
<div class="grid_16 box box-shadow alpha clear-both navigation">
	<div class="box-header"><h2>
		<?php if(!isset($page['instructions'])){ ?>
			Here you can create your paste:
		<?php } else { ?>
			<?php echo $page['instructions']; ?>
		<?php } ?></h4>
	<div class="header-tabs" style="float: right;"><ul>
		<li id="image-selector" onClick="settype('image');">Image</li>
		<li id="code-selector" onClick="settype('text');">Code</li>
	</ul></div>
	</div>
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
			<div class="item" style="float: right;">
				<label for="lang">Language
					<span class="instruction">What language is your paste written in?</span>
				</label>
				
				<?php 
				$lang_extra = 'id="lang" class="select" tabindex="3" onchange=\'settype("auto")\'';
				echo form_dropdown('lang', $languages, $lang_set, $lang_extra); ?>
			</div>								
		</div>							
		
		<div class="item_group">
			<label for="paste">Your paste
				<span class="instruction">Paste your paste here</span>
			</label>
		
			<div id="text-paste">
			<textarea name="code" cols="40" rows="20" tabindex="4"><?php if(isset($paste_set)){ echo $paste_set; }?></textarea>
			</div>
			<div id="file-paste">
			<input type="file" size="90" style="width: 720px;" name="file"/>
			</div>
		</div>																											
		
		<div class="item_group">

			<div class="item">
				<label for="private">Private
					<span class="instruction">Private pastes aren't shown in recent listings.</span>
				</label>
				<div class="text_beside">
					<?php
						$set = array('name' => 'private', 'id' => 'private', 'tabindex' => '6', 'value' => '1', 'checked' => $private_set);
						echo form_checkbox($set);
					?>
				</div>
			</div>						
		
			<div class="item">
				<label for="expire">Delete after
					<span class="instruction">When should we delete your paste?</span>
				</label>
				<?php
					if(!isset($expire_set))
						$expire_set = 10080;
					$expire_extra = 'id="expire" class="select" tabindex="7"';
					$options = array(
									"30" => "30 minutes",
									"60" => "1 hour",
									"360" => "6 hours",
									"720" => "12 hours",
									"1440" => "1 day",
									"10080" => "1 week",
									"40320" => "1 month",
									"151200" => "3 months",
									"604800" => "1 year",
									"1209600" => "2 years",
									"1814400" => "3 years",
									"0" => "Never"
								);
				echo form_dropdown('expire', $options, $expire_set, $expire_extra); ?>
			</div>
		   
			<div class="item" style="float: right; margin-right: 21px;"><button style="float: right; width: 115px;" type="submit" value="submit" name="submit">Create</button></div>
		</div>
		
		
		<?php if($reply){?>
		<input type="hidden" value="<?php echo $reply; ?>" name="reply" />
		<?php }?>
		<input type="hidden" name="api_key" />
	</form>
</div>
