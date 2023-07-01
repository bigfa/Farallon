<?php
/*
Template Name: About
Template Post Type: page
*/
get_header();
?>
<div class="template--about">
    <?php while (have_posts()) : the_post(); ?>
        <h2 class="hero--title"><?php the_title(); ?></h2>
        <div class="graph">
            <?php the_content(); ?>
            <div class="about--list">
                <div class="about--item">
                    <div class="date">
                        2022-20-22
                    </div>
                    <div class="about--item__content">
                        <div class="title">成立</div>
                        <p>成；哦</p>
                    </div>
                </div>
                <div class="about--item">
                    <div class="date">
                        2022-20-22
                    </div>
                    <div class="about--item__content">
                        <div class="title">成立</div>
                        <p>成；哦</p>
                    </div>
                </div>
                <div class="about--item">
                    <div class="date">
                        2022-20-22
                    </div>
                    <div class="about--item__content">
                        <div class="title">成立</div>
                        <p>成；哦</p>
                    </div>
                </div>
                <div class="about--item">
                    <div class="date">
                        2022-20-22
                    </div>
                    <div class="about--item__content">
                        <div class="title">成立</div>
                        <p>成；哦</p>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>
<?php get_footer(); ?>