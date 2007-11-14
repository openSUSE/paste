<?php $this->load->view('header'); ?>
<script>
$(document).ready(function(){
		$(".raw").hide();
		$(".rawl a").click(function() { 
	      $('.raw').slideToggle(); 
	    });
});
</script>
<div id="main">
	<div id="content">
		<div id="paste">
			<p>
				<h1 class="pagetitle"><?=$title?></h1><br/>
				<p id="meta"><span id="detail"><strong>Posted By:</strong> <?=$name?></span><span id="detail"><strong>Posted At:</strong> <?=$created?></span><span id="detail"><strong>URL: </strong><a href="<?=$url?>"><?=$url?></a><span id="detail" class="rawl"><br/><strong><a href="#">View Raw</a></strong></span></p>
			</p>
			<div class="raw">
				<textarea id="raw"><?=$raw?></textarea>
			</div>
			<div class="pasted">
				<?=$paste?>
			</div>
		</div>
	</div>	
	<?php $this->load->view('sidebar');?>
</div>

<?php $this->load->view('footer'); ?>