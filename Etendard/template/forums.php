<?php get_header(); ?>

	<section class="headerbar">
		
		<div class="wrapper">
			
			<h2 class="headerbartitle">
				<?php echo apply_filters('etendard_headerbar_bbpress', __('Forum', 'etendard')); ?>
			</h2>
			
		</div>
		
	</section>
	
	<section class="blog">
		
		<div class="wrapper">
		
			<?php if(have_posts()) : ?>
			
				<?php while (have_posts()) : the_post(); ?>
					
					<article <?php post_class('article'); ?>>
					
						<header class="header">
							
							<h1 class="header-title entry-title">
								
								<?php the_title(); ?>
								
							</h1>
							
						</header>
						
						<div class="content" itemprop="articleBody">
							
							<?php the_content(); ?>
							
						</div>
					
					</article>

				<?php endwhile; ?>
			
			<?php else : ?>
			
				<p><?php echo apply_filters('etendard_nopostfound', __('Sorry but no post match what you are looking for.','etendard')); ?></p>
				
			<?php endif; ?>
		
		</div>
		
	</section>

<?php get_footer(); ?>
