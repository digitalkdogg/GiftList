<form name = 'seach_form' id = 'search' method = 'post' action = '<?php echo site_url();?>/search/find_person'>
	<input name = 'name' id = 'name' type = 'text' />
	<input type = 'submit' id = 'search_submit'/>
</form>
<?php
 if (isset($result)){
	foreach ($result as $person) {
		echo "<a href = " . site_url() . "/gift/" . $person['user_name'] . ">" . $person['first_name'] . " " . $person['last_name']. "</a><br />";
	}
} else if (!isset($display)) {
	echo "Person was not found";
}
?>