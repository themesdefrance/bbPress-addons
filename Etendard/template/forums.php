<?php get_header(); ?>

	<section class="headerbar">
		
		<div class="wrapper">
			
			<h1 class="headerbartitle">
				<?php _e( 'Forum', 'etendard'); ?>
			</h1>
			
		</div>
		
	</section>
	
	<section class="blog">
		
		<div class="wrapper">
		
			<?php if(have_posts()) : ?>
			
				<?php while (have_posts()) : the_post(); ?>

					<?php the_content(); ?>

				<?php endwhile; ?>
			
			<?php else : ?>
			
				<p><?php echo apply_filters('etendard_nopostfound', __('Sorry but no post match what you are looking for.','etendard')); ?></p>
				
			<?php endif; ?>
		
		</div>
		
	</section>

<?php get_footer(); ?>
