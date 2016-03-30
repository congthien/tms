<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package tsm
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-list-item'); ?>>

		<div class="row">

			<div class="col-md-4 col-sm-4">
				<a href="<?php the_permalink() ?>" class="media-box grid-featured-img">
				<?php if ( has_post_thumbnail() ) {
					the_post_thumbnail('tsm_blog_medium');
				} ?>
				</a>
			</div>

			<div class="col-md-8 col-sm-8">
				<header class="entry-header">
					<?php

						the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );


					if ( 'post' === get_post_type() ) : ?>
					<div class="entry-meta">
						<?php tsm_posted_on(); ?>
					</div><!-- .entry-meta -->
					<?php
					endif; ?>
				</header><!-- .entry-header -->

				<div class="grid-item-excerpt">
					<?php the_excerpt(); ?>
				</div>
				<a href="<?php the_permalink() ?>" class="basic-link"><?php _e('Read More', 'tsm'); ?></a>
			</div>

		</div>

</article><!-- #post-## -->
