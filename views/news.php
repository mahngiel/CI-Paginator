<!-- If news exists -->
<?php if($newsbits): ?>

	<?php foreach($newsbits as $newsbit): ?>
		<!-- loop through newsbits -->
	<?php endforeach; ?>
	
	<!-- Check for pages and more than one page -->
	<?php if( $pages  && ($pages->total_pages > 1) ): ?>
		<?php $this->load->view( 'pagination' );?>
	<?php endif; ?>

<?php else: ?>
	<p>No newsbits for you!</p>
<?php endif; ?>
