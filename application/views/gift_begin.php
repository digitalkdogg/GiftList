<?php switch ($div) {
case 1:
	if ($taken_id == 2) {
	echo "<div id = 'gift_item' class = 'gift" . $num . "'>";
	break;
	} else {
	echo "<div id = 'gift_item_disabled' class = 'gift" . $num . "'>";
	break;
	}

case 2:
echo "<div id = 'dets_" . $num . "' class = 'modal_window'>";
break;
}
?>