<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package PLUMCO_Framework
 */
?>
<div class="no-results not-found">
	<div class="page-content">
		<h2><?php esc_html_e( 'Nothing Found', 'plumco' ); ?></h2>
		<?php if ( is_search() ) : ?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'plumco' ); ?></p>
			<a class="theme-btn" href="<?php echo esc_url(home_url( '/' )); ?>"><?php esc_html_e( 'BACK TO HOME', 'plumco' ); ?></a>
			<?php else : ?>
			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'plumco' ); ?></p>
			<a  class="theme-btn" href="<?php echo esc_url(home_url( '/' )); ?>"><?php esc_html_e( 'BACK TO HOME', 'plumco' ); ?></a>
			<?php endif; ?>
	</div><!-- .page-content -->
</div><!-- .no-results -->
