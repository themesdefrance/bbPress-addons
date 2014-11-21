<?php get_header(); ?>
		
	<div class="wrapper">
	
		<ul class="posts">
		
			<?php if(have_posts()) : ?>
			
				<?php while (have_posts()) : the_post(); ?>
			
				<li>
					
					<article <?php post_class('post'); ?> itemscope itemtype="http://schema.org/Article">
	
						<header class="post-header">
							
							<h1 class="entry-title post-header-title" itemprop="name">
					
								<?php the_title(); ?>
									
							</h1>
							
						</header>
						
						
						<div class="entry-content post-content" itemprop="articleBody">
			
							<?php the_content(); ?>
					
						</div>
						
					</article>
					
				</li>
			
				<?php endwhile; ?>
				
			<?php endif; ?>
			
		</ul>
	
	</div>

<?php get_footer(); ?>
