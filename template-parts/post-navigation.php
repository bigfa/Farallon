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
                    <span class="post-title"><?php echo get_the_title($previou_post) ?><svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" fill="none">
                            <path stroke="#1D1D1F" stroke-linecap="round" stroke-linejoin="round" d="M4.667 12.667 13.333 4m0 0v8.32m0-8.32h-8.32"></path>
                        </svg></span>
                </a>
            </div>
        <?php endif ?>
        <?php if ($next_post) : ?>
            <div class="nav-next">
                <a href="<?php echo get_permalink($next_post) ?>2" rel="next">
                    <span class="meta-nav">Next</span>
                    <span class="post-title"><?php echo get_the_title($next_post) ?><svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" fill="none">
                            <path stroke="#1D1D1F" stroke-linecap="round" stroke-linejoin="round" d="M4.667 12.667 13.333 4m0 0v8.32m0-8.32h-8.32"></path>
                        </svg></span>
                </a>
            </div>
        <?php endif ?>
    </div>
</nav>