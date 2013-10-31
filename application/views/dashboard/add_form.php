<div class = "modal_window">
	<div class = 'closeme'>X</div>
	<h2><?php echo $form_title; ?> </h2>
<?php
	echo form_open($action);
	foreach ($inputs as $input) {
		switch ($input['type']) {
			case 'text':
				//var_dump($input);
				echo form_label($input['label_value'], $input['name']);
				echo form_input($input). '<br />';
				//echo form_input($input['name'], $input['value']) . '<br />';
			break;
			case 'image':
				echo form_label($input['label_value'], $input['name']);
				echo form_upload($input['name'], '') . '<br />';
			break;
			case 'dropdown':
				echo form_label($input['label_value'], $input['name']);
				echo form_dropdown('num', $input['options'], $input['selected']) . '<br />';
			break;
			case 'textarea':
				echo form_label($input['label_value'], $input['name']);
				echo form_textarea($input). '<br />';
			break;
			case 'hidden':
				echo form_hidden($input['name']);
			break;
		}
	}

	if(isset($link)) {
		echo "<p class = 'links' data-id = '".$id . "'>Gift Links<br />";
		foreach ($link as $key=>$giftlink) {
			echo "<a class = 'edit icon-pencil' data-id = '".$giftlink->link_id . "' href = '#'></a>";
			echo "<a class = 'delete icon-pencil' data-id = '".$giftlink->link_id . "' href = '#'></a>";
			echo "<a class = 'link_".$giftlink->link_id."' href = '" . $giftlink->url . "'>" . $giftlink->title. "</a>";
			echo "<br />";
		}
		echo '<span class = "link_label">Title : </span>';
		echo form_input('gift_title', '');
		echo '<span class = "link_label">URL : </span>';
		echo form_input('gift_url', '');
		echo "<a class = 'add icon-pencil form' href = '#'></a>";
		echo "<br /></p>";
	}


	echo form_hidden('owner', $owner['0']->owner_id);
	echo form_submit('submit', $btn);
	echo form_close();
 ?>
</div>

