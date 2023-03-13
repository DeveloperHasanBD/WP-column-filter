
function wpdocs_my_search_form($form)
{
	$form = '<form role="search" method="get" id="searchform" class="searchform" action="' . home_url('/') . '" >
	<div><label class="screen-reader-text" for="s">' . __('Search for:') . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" />
	<input type="submit" id="searchsubmit" value="' . esc_attr__('Search') . '" />
	</div>
	</form>';

	return $form;
}
add_filter('get_search_form', 'wpdocs_my_search_form');


function filter_post_with_status()
{
	if (isset($_GET['post_type']) && $_GET['post_type'] != 'post') {
		return;
	}
	$all_status = ['publish', 'draft', 'pending', 'trash'];
	$choose_status = $_GET['choose_status'] ?? '';
	$status_selected = '';
?>
	<select name="choose_status">
		<option value="">Choose status</option>
		<?php
		foreach ($all_status as $item) {

			if ($item == $choose_status) {
				$status_selected = 'selected';
			}
		?>
			<option <?php echo $status_selected; ?> value="<?php echo $item; ?>"><?php echo ucwords($item); ?></option>
		<?php
		}
		?>
	</select>
<?php
}
// add_action('restrict_manage_posts', 'filter_post_with_status');

function get_post_as_status($wpquery)
{
	if (!is_admin()) {
		return;
	}
	$choose_status = $_GET['choose_status'] ?? '';
	if ('publish' == $choose_status) {
		$wpquery->set('post_status', 'publish');
	}
	if ('draft' == $choose_status) {
		$wpquery->set('post_status', 'draft');
	}
	if ('pending' == $choose_status) {
		$wpquery->set('post_status', 'pending');
	}
	if ('trash' == $choose_status) {
		$wpquery->set('post_status', 'trash');
	}
}
// add_action('pre_get_posts', 'get_post_as_status');
