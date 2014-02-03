<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage SGCampus
 */

get_header(); ?>

	<div id="content" class="large-8 columns" role="main">
    
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>

Hola mundo template.

			<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>

	</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
