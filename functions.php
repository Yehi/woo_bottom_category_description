<?php

function yc_add_second_cat_description() {
	// this will add the custom meta field to the add new term page
	$settings = array( 'media_buttons' => true, 'textarea_name' => 'second_cat_description' );
	?>
	<div class="form-field">
		<label for="second_cat_description"><?php _e('bottom description'); ?></label>
		<?php wp_editor( '', 'second_cat_description', $settings); ?>
	</div>
<?php
}
add_action( 'product_cat_add_form_fields', 'yc_add_second_cat_description', 10, 2 );

function yc_edit_second_cat_description($term) {

	// put the term ID into a variable
	$t_id = $term->term_id;

	// retrieve the existing value(s) for this meta field. This returns an array
	$second_cat_description = get_option( "taxonomy_$t_id" );
	$settings = array( 'media_buttons' => true, 'textarea_name' => 'second_cat_description' );
	?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="second_cat_description"><?php _e( 'תאור תחתון'); ?></label></th>
		<td>
			<?php wp_editor( $second_cat_description, 'second_cat_description', $settings); ?>
		</td>
	</tr>
<?php
}
add_action( 'product_cat_edit_form_fields', 'yc_edit_second_cat_description', 10, 2 );

function yc_save_second_cat_description( $term_id ) {
	if ( isset( $_POST['second_cat_description'] ) ) {
		$t_id = $term_id;
		$second_cat_description = $_POST['second_cat_description'];
		update_option( "taxonomy_$t_id", stripslashes($second_cat_description));
	}
}
add_action( 'edited_product_cat', 'yc_save_second_cat_description', 10, 2 );
add_action( 'create_product_cat', 'yc_save_second_cat_description', 10, 2 );

function yc_show_second_cat_description() {

	// put the term ID into a variable
	$cate = get_queried_object();
	$cateID = $cate->term_id;

	// retrieve the existing value(s) for this meta field. This returns an array
	$second_cat_description = get_option( "taxonomy_$cateID" );

	?>
	<div class="second_cat_description">
			<?php echo $second_cat_description; ?>
	</div>
<?php
}
add_action( 'woocommerce_after_shop_loop', 'yc_show_second_cat_description');
