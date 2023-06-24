<?php get_header(); ?>
<header class="archive-header u-textAlignCenter" data-id="<?php echo get_queried_object()->term_id; ?>">
    <?php
    the_archive_title('<h1 class="archive-title" ><svg t="1687537480349" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="16356" width="32" height="32"><path d="M940.783 83.217c-11.604-11.632-27.626-18.857-45.254-18.857a63.38 63.38 0 0 0-3.632 0.111H533.379c-17.572 0-33.548 7.178-45.143 18.746l-0.001-0.001-0.035 0.035-0.041 0.041L101.451 470c-49.78 49.78-49.78 131.239 0 181.019L372.98 922.548c49.78 49.78 131.239 49.78 181.019 0L940.708 535.84l0.041-0.041 0.035-0.035-0.001-0.001c11.568-11.596 18.746-27.571 18.746-45.143V132.103c0.068-1.203 0.111-2.412 0.111-3.632-0.001-17.628-7.225-33.65-18.857-45.254zM752 384c-61.856 0-112-50.144-112-112s50.144-112 112-112 112 50.144 112 112-50.144 112-112 112z" p-id="16357"></path></svg>', '</h1>');
    the_archive_description('<div class="taxonomy-description">', '</div>');
    ?>
</header>
<main class="site--main">
    <?php if (have_posts()) :
        while (have_posts()) : the_post();
            get_template_part('template-parts/content', get_post_format());
        endwhile;
    endif;
    ?>
    <?php get_template_part('template-parts/pagination'); ?>
</main>

<?php get_footer(); ?>