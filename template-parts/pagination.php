<?php echo get_the_posts_pagination(
    array(
        'mid_size'  => 1,
        'prev_text' => $prev_text,
        'next_text' => $next_text,
        'class' => ''
    )
);
