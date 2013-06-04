<?php 
switch ($name) {
case 'Home' :
	$home_url = site_url() . '/' . $url . '/' . $first_name; ?>

	<a class = 'style1' alt = '<?php echo $alt; ?> ' href = '<?php echo $home_url; ?>'> <?php echo $name; ?> </a>
<?php 
	break;
case 'Gift List Admin' :
	$admin_url = site_url() . '/' . $url . '/' . $first_name; ?>
	<a class = 'style1' alt = '<?php echo $alt; ?>' href = '<?php echo $admin_url; ?> '> <?php echo $name; ?></a>
<?php
	break;
case 'What Is Taken' :
	$taken_url = site_url() . '/' . $url . '/1/' . $first_name; ?>
	<a class = 'style1' alt = '<?php echo $alt; ?>' href = '<?php echo $taken_url; ?>'><?php echo $name ?></a>
<?php
	break;
case 'What Is Available' :
	$available_url = site_url() . '/' . $url . '/2/' . $first_name;?>
	<a class = 'style1' alt = '<?php echo $alt; ?>' href = '<?php echo $available_url; ?>'><?php echo $name ?></a>

<?php	
	break;
	
default: ?>
	<a class = 'style1' alt = '<?php echo $alt; ?>' href = '<?php echo $url;?>'><?php echo $name;?></a>

<?php
	break;
}
?>