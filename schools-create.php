<?php

function schools_create() {
    $id='';
    $name='';
    $desc='';
    $message='';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST["id"];
    $name = $_POST["name"];
    $desc = $_POST["desc"];
    $target_dir = "localhost/wordpress/wp-content/plugins/schools/uploads/dist/images/";
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    
    $img = $target_file;
  

    //insert
    if (isset($_POST['insert'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . "school";

        $wpdb->insert(
                $table_name,
                array('id' => $id, 'name' => $name,'description'=>$desc,'image'=>$img), 
                array('%s', '%s','%s','%s') ,

        );
        $message.="School inserted";
    }}
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/schools/style-admin.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Add New School</h2>
        <?php if (isset($message)): ?><div class="updated"><p><?php echo $message; ?></p></div><?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data">
            <p>Three capital letters for the ID</p>
            <table class='wp-list-table widefat fixed'>
                <tr>
                    <th class="ss-th-width">ID</th>
                    <td><input type="text" name="id" value="<?php echo $id; ?>" class="ss-field-width" required/></td>
                </tr>
                <tr>
                    <th class="ss-th-width">School</th>
                    <td><input type="text" name="name" value="<?php echo $name; ?>" class="ss-field-width" required/></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Description</th>
                    <td><input type="text" name="desc" value="<?php echo $desc; ?>" class="ss-field-width" required/></td>
                </tr>
                <tr>
                    <th class="ss-th-width">Image</th>
                    <td><input type="file" id="img" name="img" class="ss-field-width" required/></td>
                </tr>
            
            </table>
            <input type='submit' name="insert" value='Save' class='button'>
        </form>
    </div>
    <?php
}