<?php
/**
 * The template for displaying a Timeline.
 *
 * @package StormBringer
 * @since StormBringer 0.0.1
 *
 * Template Name: Timeline
 */
?>
<?php get_header(); ?>

<?php //get_sidebar(); ?>

	<div id="content" role="main">

		<?php if ( function_exists( 'yoast_breadcrumb' ) ) :  yoast_breadcrumb(); endif; ?>

		<?php if ( have_posts() ) : the_post(); ?>

			<?php
			get_template_part( 'content', 'page' );
			?>

		<?php endif; ?>

		<section class="timeline-content">

			<?php query_posts( 'posts_per_page=-1' );
			$dates_array         = Array();
			$year_array          = Array();
			$i                   = 0;
			$prev_post_ts        = null;
			$prev_post_year      = null;
			$distance_multiplier = 9;
			?>

			<?php while (have_posts()) :
			the_post();

			$post_ts   = strtotime( $post->post_date );
			$post_year = date( 'Y', $post_ts );

			/* Handle the first year as a special case */
			if (is_null( $prev_post_year )) {
			?>
			<h3 class="archive-year"><?php echo $post_year ?></h3>
		<ul class="archives-list">
		<?php
		}
		else if ($prev_post_year != $post_year) {
		/* Close off the OL */
		?>
		</ul>
		<?php

		$working_year = $prev_post_year;

		/* Print year headings until we reach the post year */
		while ( $working_year > $post_year ) {
			$working_year --;
			?>
			<h3 class="archive-year"><?php echo $working_year ?></h3>
		<?php
		}

		/* Open a new ordered list */
		?>
			<ul class="archives-list">
				<?php
				}

				/* Compute difference in days */
				if ( ! is_null( $prev_post_ts ) && $prev_post_year == $post_year ) {
					$dates_diff = ( date( 'z', $prev_post_ts ) - date( 'z', $post_ts ) ) * $distance_multiplier;
				} else {
					$dates_diff = 0;
				}
				?>
				<li><span class="date"><?php the_time( __( 'F j\<\s\u\p\>S\<\/\s\u\p\>', 'stormbringer' ) ); ?></span>
					<span class="linked"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></span>
					<?php if ( get_comments_number() != 0 ): ?>
						<span class="badge"><?php comments_popup_link( __( '0', 'stormbringer' ), __( '1', 'stormbringer' ), __( '%', 'stormbringer' ) ); ?></span>
					<?php endif; ?>
				</li>
				<?php
				/* For subsequent iterations */
				$prev_post_ts   = $post_ts;
				$prev_post_year = $post_year;
				endwhile;

				/* If we've processed at least *one* post, close the ordered list */
				if ( ! is_null( $prev_post_ts )) {
				?>
			</ul>
		<?php } ?>
		</section>
		<!-- /.timeline-content -->

	</div>
	<!-- /#content -->

<?php get_footer(); ?>