<div id='gift_item'>
<?php 
foreach ($lists as $list) {
	echo "<a href = '" . site_url() . "/gift/" . $user_name . "/" . $list->list_id . "'>" . $list->title . "</a><br />";
}
?>
</div>