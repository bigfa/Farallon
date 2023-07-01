<?php
/*
Template Name: Archive
Template Post Type: page
*/
get_header();
?>
<main class="page--archive">
    <?php
    $args = [
        'posts_per_page' => -1,
        'post_type' => ['post'],
        'ignore_sticky_posts' => 1,
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
            'views' => farallon_post_view($post->ID)
        ];

    endwhile;
    wp_reset_postdata();
    $output = '';
    foreach ($arr as $year => $year_post) {
        $output .= '<div class="archive--list__year"><h2 class="archive--title__year ">' . $year . '</h2>';
        foreach ($year_post as $month => $month_post) {
            $output .=  '<ul class="archive--list" data-year="' . $year . ' - ' . $month  . '">';
            foreach ($month_post as $value) {
                $output .= '<li class="archive--item"><div class="archive--title"><a href="' . $value['link'] . '">' . $value['title'] . '</a></div><div class="archive--meta">' . $value['views'] . ' reads</li>';
            }
            $output .= '</ul>';
        }
        $output .= '</div>';
    }
    echo $output;
    ?>
    </div>
</main>
<?php get_footer(); ?>