<div>
    <?php
        wp_nonce_field( "meta_{$prefix}_fields_save_meta_box_data", "meta_{$prefix}fields_meta_box_nonce" );
    ?>
    <div id="<?php echo $prefix; ?>app"></div>
</div>