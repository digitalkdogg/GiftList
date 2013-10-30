<?php 
switch ($id) {
case '1' :
	$home_url = site_url() . '/' . $url . '/' . $user_name . '/' . $list_id; ?>

	<a class = 'style1' alt = '<?php echo $alt; ?> ' href = '<?php echo $home_url; ?>'> <?php echo $name; ?> </a>
<?php 
	break;
case '2' :
	$admin_url = site_url() . '/' . $url . '/' . $user_name . '/' . $list_id; ?>
	<a class = 'style1' alt = '<?php echo $alt; ?>' href = '<?php echo $admin_url; ?> '> <?php echo $name; ?></a>
<?php
	break;
case '3' :
	$taken_url = site_url() . '/' . $url . '/1/' . $list_id . '/' . $user_name; ?>
	<a class = 'style1' alt = '<?php echo $alt; ?>' href = '<?php echo $taken_url; ?>'><?php echo $name ?></a>
<?php
	break;
case '4' :
	$available_url = site_url() . '/' . $url . '/2/' . $list_id . '/' . $user_name;?>
	<a class = 'style1' alt = '<?php echo $alt; ?>' href = '<?php echo $available_url; ?>'><?php echo $name ?></a>

<?php	
	break;
	
default: ?>
	<a class = 'style1' alt = '<?php echo $alt; ?>' href = '<?php echo site_url() . '/' . $url;?>'><?php echo $name;?></a>
<?php
	break;
}
?>