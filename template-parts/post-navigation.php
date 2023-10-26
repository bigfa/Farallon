<?php
$previou_post = get_previous_post();
$next_post = get_next_post();
?>
<nav class="navigation post-navigation is-active" aria-label="文章">
    <div class="nav-links">
        <?php if ($previou_post) : ?>
            <div class="nav-previous">
                <a href="<?php echo get_permalink($previou_post) ?>" rel="prev">
                    <span class="meta-nav">Previous</span>
                    <span class="post-title">
                        <?php echo get_the_title($previou_post) ?>
                    </span>
                </a>
            </div>
        <?php endif ?>
        <?php if ($next_post) : ?>
            <div class="nav-next">
                <a href="<?php echo get_permalink($next_post) ?>" rel="next">
                    <span class="meta-nav">Next</span>
                    <span class="post-title">
                        <?php echo get_the_title($next_post) ?>
                    </span>
                </a>
            </div>
        <?php endif ?>
    </div>
</nav>