<div class="post-modern">
    <div class="post-inner">
        <?php printec_post_thumbnail('post-thumbnail', true); ?>
        <div class="post-content">
            <div class="entry-header">
                <div class="entry-meta">
                    <?php printec_post_meta(); ?>
                </div>
                <?php the_title('<h3 class="sigma entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>
            </div>
            <div class="entry-content">
                <div class="entry-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 100); ?></div>
                <?php echo '<div class="more-link-wrap"><a class="more-link" href="' . get_permalink() . '">' . esc_html__('Read more', 'printec') . '</a></div>'; ?>
            </div>
        </div>
    </div>
</div>