<?php 
	// To create a universal pagination, we need to break up the URI
	$uri = explode('/page', $this->uri->uri_string() );
	$uri = $uri[0] . '/page/';
?>
<ul>
	<li><?php echo anchor($uri . $pages->current_page, 'Page ' . $pages->current_page . ' of ' . $pages->total_pages); ?></li>
	<?php if($pages->first): ?><li><?php echo anchor( $uri . '1', '<<'); ?></li><?php endif; ?>
	<?php if($pages->previous): ?><li><?php echo anchor($uri. ($pages->current_page - 1), '<'); ?></li><?php endif; ?>

	<?php if($pages->before): ?>
		<?php foreach($pages->before as $before): ?>
			<li <?php if($pages->current_page == $before): echo 'class="selected"'; endif; ?>><?php echo anchor($uri. $before, $before); ?></li>
		<?php endforeach; ?>
	<?php endif; ?>

	<li><?php echo anchor($uri. $pages->current_page, $pages->current_page); ?></li>

	<?php if($pages->after): ?>
		<?php foreach($pages->after as $after): ?>
			<li <?php if($pages->current_page == $after): echo 'class="selected"'; endif; ?>><?php echo anchor($uri. $after, $after); ?></li>
		<?php endforeach; ?>
	<?php endif; ?>
	
	<?php if($pages->next): ?><li><?php echo anchor($uri. ($pages->current_page + 1), '>'); ?></li><?php endif; ?>
	<?php if($pages->last): ?><li><?php echo anchor($uri. $pages->total_pages, '>>'); ?></li><?php endif; ?>
</ul>