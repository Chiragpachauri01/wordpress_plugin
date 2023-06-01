<?php

function school_list() {
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/schools/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Schools</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=schools_create'); ?>">Add New</a>
            </div>
            <br class="clear">
        </div>
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "school";

        $rows = $wpdb->get_results("SELECT id, name , description ,image from $table_name");
        ?>
        <table class='wp-list-table widefat fixed striped posts'>
            <tr>

                <th class=" ss-list-width">Title</th>
                <th class=" ss-list-width">Description</th>
                <th class=" ss-list-width">Image</th>
                <th class=" ss-list-width">Update</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td class=" ss-list-width"><?php echo $row->name; ?></td>
                    <td class=" ss-list-width"><?php echo $row->description; ?></td>
                    <td class=" ss-list-width"><img src="http://<?php echo $row->image;?>" width="100" ></td>
                    <td><a href="<?php echo admin_url('admin.php?page=schools_update&id=' . $row->id); ?>">Update</a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php

    
}?>

<?php
function school_display() {
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/schools/style-admin.css" rel="stylesheet" />      
     
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "school";

        $rows = $wpdb->get_results("SELECT id, name , description ,image from $table_name");
        ?>
        <div class="slider-block">
                <h3 class="ta-c">Schools</h3>
                <div class="slider">
                <?php foreach ($rows as $row) { ?>
                  <div class="item">
            
                        <img src="http://<?php echo $row->image;?>" width="400" height="300"/>
               
                    <h4><?php echo $row->name; ?></h4>
                    <p><?php echo $row->description; ?></p>
                  </div>
                  <?php } ?>
                </div>
               
           
     
    </div>
    <?php

    
}

add_shortcode('school_display','school_display');
?>