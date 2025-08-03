<?php
/*
Template Name: Archive
Template Post Type: page
*/
get_header();
?>

<main class="fArchive--main">
    <?php
    $args = [
        'posts_per_page' => -1,
        'post_type' => ['post'],
        'ignore_sticky_posts' => 1,
        'tax_query' => array(
            array(  // only show standard post format
                'taxonomy' => 'post_format',
                'field' => 'slug',
                'terms' => array('post-format-aside', 'post-format-audio', 'post-format-chat', 'post-format-gallery', 'post-format-image', 'post-format-link', 'post-format-quote', 'post-format-status', 'post-format-video'),
                'operator' => 'NOT IN'
            )
        )
    ];
    $the_query = new WP_Query($args);
    $arr = [];
    while ($the_query->have_posts()) : $the_query->the_post();
        $year_tmp = get_the_time('Y');
        $mon_tmp = get_the_time('n');
        if (!array_key_exists($year_tmp, $arr)) {
            $arr[$year_tmp] = [];
        }

        if (!array_key_exists($mon_tmp, $arr[$year_tmp])) {
            $arr[$year_tmp][$mon_tmp] = [];
        }

        $arr[$year_tmp][$mon_tmp][] = [
            'title' => get_the_title(),
            'link' => get_permalink(),
            'commentnum' => get_comments_number(),
            'views' => farallon_get_post_views_text(false, false, false, get_the_ID()),
            'date' => get_the_time('m-d'),
            'readtime' => farallon_get_post_read_time_text(get_the_ID()),
        ];

    endwhile;
    wp_reset_postdata();
    $output = '';
    foreach ($arr as $year => $year_post) {
        $output .= '<div class="archive--list__year"><h2 class="fArchive--heroTitle">' . $year . '</h2>';
        foreach ($year_post as $month => $month_post) {
            $output .=  '<ul class="fArchive--list" data-year="' . $year . ' - ' . $month  . '">';
            foreach ($month_post as $value) {
                $output .= '<li class="fArchive--item"><div class="fArchive--title"><a href="' . $value['link'] . '">' . $value['title'] . '</a></div><div class="fArchive--meta">' . $value['date'] . '<span class="sep"></span>' . $value['readtime'] . '</div></li>';
            }
            $output .= '</ul>';
        }
        $output .= '</div>';
    }
    echo $output;
    ?>
</main>

<?php get_footer(); ?>