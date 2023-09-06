<?php
if (post_password_required()) {
    return;
}
?>
<div id="comments" class="responsesWrapper">
    <h3 class="comments--title"><?php echo number_format_i18n(get_comments_number()); ?> 条评论</h3>
    <meta content="UserComments:<?php echo number_format_i18n(get_comments_number()); ?>" itemprop="interactionCount">
    <ol class="commentlist sulliComment--list">
        <?php if (have_comments()) {
            wp_list_comments(array('style' => 'ol', 'avatar_size' => 48, 'callback' => 'farallon_comment'));
        } else {
        ?>
            <li class="no--comment">no comments.</li>
        <?php } ?>
    </ol>
    <nav class="nav-links nav-links__comment">
        <?php paginate_comments_links([
            'prev_next' => false
        ]); // check for comment navigation 
        ?>
    </nav>
    <?php if (comments_open()) :
        comment_form();
    endif; ?>
</div>