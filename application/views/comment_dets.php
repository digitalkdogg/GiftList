<?php 
echo "<div class = 'comments'> <p>" . str_replace("%20", " ", $name) . " - " . date('m/d/Y H:i:s', strtotime($date_time)) . " - " . str_replace("%20", " ", $message) . "</p></div>";
?>