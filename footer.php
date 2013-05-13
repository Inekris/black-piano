<?php $options = get_black_piano_option(); ?>
	</div><!-- #contents end -->

<?php if ( 'right' != $options[ 'layout' ] ) {  ?>
<div id="pre-footer"><div class="footer-text">
		<?php bp_show_copyright_info(); ?>
	  </div>
		<div id="footer">
		</div></div>
	<?php } 
	else { ?>
		<div id="footer">
		</div>	
	<?php } ?>


<?php wp_footer(); ?>
</body>
</html>