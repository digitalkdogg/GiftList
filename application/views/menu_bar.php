<?php 
switch ($name) {
case 'Home' :
	$home_url = site_url() . '/' . $url . '/' . $user_name . '/' . $list_id; ?>

	<a class = 'style1' alt = '<?php echo $alt; ?> ' href = '<?php echo $home_url; ?>'> <?php echo $name; ?> </a>
<?php 
	break;
case 'Gift List Admin' :
	$admin_url = site_url() . '/' . $url . '/' . $user_name . '/' . $list_id; ?>
	<a class = 'style1' alt = '<?php echo $alt; ?>' href = '<?php echo $admin_url; ?> '> <?php echo $name; ?></a>
<?php
	break;
case 'What Is Taken' :
	$taken_url = site_url() . '/' . $url . '/1/' . $list_id . '/' . $user_name; ?>
	<a class = 'style1' alt = '<?php echo $alt; ?>' href = '<?php echo $taken_url; ?>'><?php echo $name ?></a>
<?php
	break;
case 'What Is Available' :
	$available_url = site_url() . '/' . $url . '/2/' . $list_id . '/' . $user_name;?>
	<a class = 'style1' alt = '<?php echo $alt; ?>' href = '<?php echo $available_url; ?>'><?php echo $name ?></a>

<?php	
	break;
case 'Search' :
	$search_url = base_url(); ?>
	<a class = 'style1' alt = '<?php echo $alt; ?>' href = '<?php echo $search_url; ?>'><?php echo $name ?></a>
	
<?php	
	break;
	
default: ?>
	<a class = 'style1' alt = '<?php echo $alt; ?>' href = '<?php echo $url;?>'><?php echo $name;?></a>

<?php
	break;
}
?>