<div class = "modal_window">
	<div class = 'closeme'>X</div>
<h2><?php echo $form_title; ?> </h2>
<?php
	 echo form_open('dash_add_gift/' . $id);
	foreach ($inputs as $input) {
		switch ($input['type']) {
			case 'text':
				echo form_label($input['value'], $input['name']);
				echo form_input($input['name'], '') . '<br />';
			break;
			case 'image':
				echo form_label($input['value'], $input['name']);
				echo form_upload($input['name'], '') . '<br />';
			break;
			case 'dropdown':
				echo form_label($input['value'], $input['name']);
				echo form_dropdown('num', $input['options'], '1') . '<br />';
		}
		
	}

	echo form_hidden('owner', $owner['0']->owner_id);
	echo form_submit('submit', 'Add Item!');
	echo form_close();

 ?>
</div>
