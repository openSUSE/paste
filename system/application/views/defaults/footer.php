		</div>
		<div class="clear"></div>
<?
#  $handle = fopen("static/themes/bento/includes/footer.html","rb");
#  $content = stream_get_contents($handle);
#  fclose($handle);
  $handle = fopen("system/application/views/defaults/footer_message","rb");
  $other_content = stream_get_contents($handle);
  fclose($handle);
#  $content = str_replace('<p>',	'<p>'.$other_content.'</p><p>',	$content);
  echo $other_content;
?>
	</body>
</html>
