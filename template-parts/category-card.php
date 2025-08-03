<?php
global $farallonSetting;
$categories = get_the_category();
?>
<?php if (!empty($categories)) : ?>
    <div class="fCategory--list">
        <?php
        foreach ($categories as  $category) {
            echo '<a href="' . get_category_link($category->term_id) . '" class="fCategory--item">';
            if (get_term_meta($category->term_id, '_thumb', true)) {
                echo '<div class="fCategory--cover">';
                echo '<img src="' . get_term_meta($category->term_id, '_thumb', true) . '" alt="' . $category->name . '"/>';
                echo '</div>';
            }
            echo '<div class="fCategory--content">';
            echo '<div class="fCategory--title">' . $category->name . '</div>';
            echo '<div class="fCategory--description">' . $category->description . '</div>';
            echo '</div></a>';
        }
        ?>
    </div>
<?php endif; ?>