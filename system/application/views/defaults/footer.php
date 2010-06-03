		</div>
		<div class="clear"></div>
<?
  $handle = fopen("static/themes/bento/includes/footer.html","rb");
  $content = stream_get_contents($handle);
  fclose($handle);
  $content = str_replace('<p>',
  								'<p>Powered By <a href="http://code.google.com/p/stikked/">Stikked</a> created by <a href="http://benmcredmond.com">Ben McRedmond</a></p><p></p><p>',
								$content);
	echo $content;
	?>
	</body>
</html>
