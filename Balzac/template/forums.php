<?php get_header(); ?>

	<section class="blog">

		<div class="wrapper">

			<?php if(have_posts()) : ?>

				<?php while (have_posts()) : the_post(); ?>

					<article <?php post_class('article'); ?>>
						
						<?php if(!is_archive()) : ?>
						
							<header class="header">
	
								<h1 class="header-title entry-title">
	
									<?php the_title(); ?>
	
								</h1>
	
							</header>
						
						<?php endif; ?>

						<div class="content" itemprop="articleBody">

							<?php the_content(); ?>

						</div>

					</article>

				<?php endwhile; ?>

			<?php else : ?>

				<p><?php echo apply_filters('balzac_nopostfound', __('Sorry but no post match what you are looking for.','balzac')); ?></p>

			<?php endif; ?>

		</div>

	</section>

<?php get_footer(); ?>
