<?php
if (post_password_required()) {
    return;
}
?>
<div id="comments" class="responsesWrapper">
    <h3 class="comments--title">
        <svg viewBox="0 0 24 24" class="icon" aria-hidden="true" width="16" height="16">
            <g>
                <path d="M1.751 10c0-4.42 3.584-8 8.005-8h4.366c4.49 0 8.129 3.64 8.129 8.13 0 2.96-1.607 5.68-4.196 7.11l-8.054 4.46v-3.69h-.067c-4.49.1-8.183-3.51-8.183-8.01zm8.005-6c-3.317 0-6.005 2.69-6.005 6 0 3.37 2.77 6.08 6.138 6.01l.351-.01h1.761v2.3l5.087-2.81c1.951-1.08 3.163-3.13 3.163-5.36 0-3.39-2.744-6.13-6.129-6.13H9.756z"></path>
            </g>
        </svg>
        <?php echo number_format_i18n(get_comments_number()); ?>
    </h3>
    <meta content="UserComments:<?php echo number_format_i18n(get_comments_number()); ?>" itemprop="interactionCount">
    <ol class="commentlist sulliComment--list">
        <?php if (have_comments()) {
            wp_list_comments(array('style' => 'ol', 'avatar_size' => 48, 'callback' => 'farallon_comment'));
        } else { ?>
            <li class="no--comment"><?php _e('This post has no comment yet', 'Farallon'); ?></li>
        <?php } ?>
    </ol>
    <nav class="nav-links nav-links__comment">
        <?php paginate_comments_links([
            'prev_next' => false
        ]); ?>
    </nav>
    <?php if (comments_open()) :
        comment_form();
    endif; ?>
</div>