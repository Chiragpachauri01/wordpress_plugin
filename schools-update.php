<?php

function schools_update() {
    global $wpdb;
    $table_name = $wpdb->prefix . "school";
    $id = $_GET["id"];
    $name = $_POST["name"] ?? '';
    $desc = $_POST["desc"] ?? '';
    $img ='';
    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "localhost/wordpress/wp-content/plugins/schools/uploads/dist/images/";
        $target_file = $target_dir . basename($_FILES["img"]["name"]);
        
        $img = $target_file;
    } else {
        $img= $wpdb->get_var($wpdb->prepare("SELECT image from $table_name where id=%s", $id));
    }
    
    //update
    if (isset($_POST['update'])) {
        $wpdb->update(
                $table_name,
                array('name' => $name,'description' => $desc,'image'=>$img),
                array('ID' => $id),
                array('%s',"%s", "%s"), 
                array('%d'),
        );
        
        echo '<div class="updated"><p>School updated</p></div>';
    }
    
    //delete
    else if (isset($_POST['delete'])) {
        $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %d", $id));
        
        echo '<div class="updated"><p>School deleted</p></div>';
    } 
    
    $schools = $wpdb->get_results($wpdb->prepare("SELECT id,name,description,image from $table_name where id=%d", $id));
    foreach ($schools as $s) {
        $name = $s->name;
        $desc = $s->description;
        $img = $s->image;
    }
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/schools/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Schools</h2>

        <?php if (isset($_POST['delete'])) { ?>
            <a href="<?php echo admin_url('admin.php?page=school_list') ?>">&laquo; Back to schools list</a>

        <?php } else if (isset($_POST['update'])) { ?>
            <a href="<?php echo admin_url('admin.php?page=school_list') ?>">&laquo; Back to schools list</a>

        <?php } else { ?>
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?> " enctype="multipart/form-data">
                <table class='wp-list-table widefat fixed'>
                    <tr><th>Name</th><td><input type="text" name="name" value="<?php echo $name; ?>" required/></td></tr>
                    <tr><th>Description</th><td><input type="text" name="desc" value="<?php echo $desc; ?>" required/></td></tr>
                    <tr><th class="ss-th-width">Image</th>
                    <td><input type="file" id="img" name="img" class="ss-field-width"  /></td></tr>
                </table>
                <input type='submit' name="update" value='Save' class='button'> &nbsp;&nbsp;
                <input type='submit' name="delete" value='Delete' class='button' onclick="return confirm('Are you sure you want to delete?')">
            </form>
        <?php } ?>

    </div>
    <?php
}