<div>
    <?php
        wp_nonce_field( "meta_{$prefix}_fields_save_meta_box_data", "meta_{$prefix}fields_meta_box_nonce" );
    ?>
	<p>
		<?php echo __('Schedule', 'coquardcyrwparticlescheduler'); ?>
	</p>
	<label>
		<?php echo __('Date', 'coquardcyrwparticlescheduler'); ?>
	</label>
	<input  name="<?php echo $prefix; ?>change_date" type="date" value="<?php echo $date; ?>" min="<?php echo $min_date; ?>" />
	<label>
		<?php echo __('Status', 'coquardcyrwparticlescheduler'); ?>
	</label>
	<select name="<?php echo $prefix; ?>status">
        <?php
        foreach ($statuses as $key => $value):
            ?>
        <option value="<?php echo $key; ?>" <?php $key === $current_status ? 'selected="selected"' : '' ?>><?php echo $value; ?></option>
        <?
        endforeach;
        ?>
	</select>
</div>