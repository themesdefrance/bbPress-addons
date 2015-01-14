<?php get_header(); ?>

<section class="content">

	<div class="wrapper">

		<main class="main-content<?php if ($sidebar) echo ' col-2-3'; ?>" role="main" itemprop="mainContentOfPage">


			<?php if(have_posts()) : ?>

				<?php while (have_posts()) : the_post(); ?>

					<article <?php post_class('post'); ?> itemscope itemtype="http://schema.org/CreativeWork">

						<header class="entry-header">

							<h1 class="entry-title" itemprop="name">

								<?php the_title(); ?>

							</h1>

						</header>

						<div class="entry-content" itemprop="text">

							<?php the_content(); ?>

						</div>

					</article>

				<?php endwhile; ?>

			<?php endif; ?>

		</main><!-- END .main-content -->

	</div><!-- END .wrapper -->

</section><!-- END .content -->

<?php get_footer(); ?>
