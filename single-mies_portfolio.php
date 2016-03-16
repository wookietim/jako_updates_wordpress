<?php
/**
 * The template for the single project view.
 *
 * @package Mies
 * @since   Mies 1.0
 */

get_header();

global $post, $wpgrade_private_post, $page_section_idx, $header_height;

//some global variables that we use in our page sections
$page_section_idx = 0;

if ( have_posts() ) : the_post();

	if ( post_password_required() && ! $wpgrade_private_post['allowed'] ) {

		get_template_part( 'templates/password-request-form' );

	} else { // no password protection
		get_template_part( 'templates/hero' ); //let there be heroes

		if ( function_exists( 'display_pixfields' ) && ! has_shortcode( get_the_content(), 'pixfields' ) ) {
			display_pixfields();
		}

		if ( get_the_content() ): ?>
			<div class="content">
				<?php the_content(); ?>
			</div><!-- .content.content--portfolio -->
		<?php endif;
	}

	get_template_part( 'templates/subprojects' );

	if ( ! ( wpgrade::option( 'project_menu_share_label' ) == '' ) ) : ?>
		<div class="addthis_toolbox addthis_default_style addthis_32x32_style"
		     addthis:url="<?php echo esc_attr( wpgrade_get_current_canonical_url() ) ?>"
		     addthis:title="<?php wp_title( '|', true, 'right' ) ?>"
		     addthis:description="<?php echo esc_attr( trim( strip_tags( get_the_excerpt() ) ) ) ?>">
			<?php get_template_part( 'templates/core/addthis-social-popup' ); ?>
		</div>
	<?php endif; ?>

<?php
	$previous_post = get_previous_post();
	$next_post = get_next_post();
	echo "<center><div align='center' style='border:1px solid black;width:40%'><br>";
	if(get_the_author_meta("user_tw") != ""){
		echo "Follow  " . ucfirst(get_the_author_meta("user_nicename")) . " on Twitter: <a href='http://www.twitter.com/@" . get_the_author_meta("user_tw") . "'>" . get_the_author_meta("user_tw") . "</a><br>";
	}
	echo "<table style='border:none;border-collapse:collapse' border=0 cellspacing=0 cellpadding=0><tr>";
	echo "<td rowspan='2'>" . get_avatar(get_the_author_meta("ID")) . "</td>";
	echo "<td><b>" . get_the_author_meta("display_name") . "</b><br>";
	echo "<a href='mailto:" . get_the_author_meta("user_email") . "'>" . get_the_author_meta("user_email") . "</a></td>";
	echo "</tr></table><br>";
	echo "</div><br>";

	echo "<table style='width:60%' border=0><tr>";
	if($previous_post->post_name != ""){
		echo "<td align='left'><b>Previous Story</b><br><a href='" . $previous_post->post_name . "'>" . $previous_post->post_title . "</a></td>";
	}
	if( $next_post->post_name != ""){
		echo "<td align='right'><b>Next Story</b><br><a href='" . $next_post->post_name . "'>" . $next_post->post_title . "</a></td>";
	}
	echo "</table></center>";

?>

<div class="content" id="disqus_thread"></div>
<script>
/**
* RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
* LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL; // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = '//kicksusa.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>	

<?php else :
	get_template_part( 'no-results' );
endif;

get_footer();