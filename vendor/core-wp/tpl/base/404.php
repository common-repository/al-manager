<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<p><?php _e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'toolbox'); ?></p>

        <?php get_search_form(); ?>

        <?php the_widget('WP_Widget_Recent_Posts'); ?>

        <div class="widget">
            <h2 class="widgettitle"><?php _e('Most Used Categories', 'toolbox'); ?></h2>
            <ul>
                <?php wp_list_categories(array('orderby' => 'count', 'order' => 'DESC', 'show_count' => 'TRUE', 'title_li' => '', 'number' => '10')); ?>
            </ul>
        </div>

        <?php
        $archive_content = '<p>' . sprintf(__('Try looking in the monthly archives. %1$s', 'toolbox'), convert_smilies(':)')) . '</p>';
        the_widget('WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content");
        ?>

        <?php the_widget('WP_Widget_Tag_Cloud'); ?>