<?php 
switch ($name) {
case 'Home' :
	$home_url = site_url() . '/' . $url . '/' . $first_name;
	echo "<a class='style1' href='" . $home_url . "'>" . $name . "</a>"; 
	break;
case 'Gift List Admin' :
	$admin_url = site_url() . '/' . $url . '/' . $first_name;
	echo "<a class='style1' href='" . $admin_url . "'>" . $name . "</a>"; 
	break;
case 'What Is Taken' :
	$taken_url = site_url() . '/' . $url . '/1/' . $first_name;
	echo "<a class='style1' href='" . $taken_url . "'>" . $name . "</a>"; 
	break;
case 'What Is Available' :
	$available_url = site_url() . '/' . $url . '/2/' . $first_name;
	echo "<a class='style1' href='" . $available_url . "'>" . $name . "</a>";
	break;
	
default:
	echo "<a class='style1' href='" . $url . "'>" . $name . "</a>"; 
	break;
}
?>