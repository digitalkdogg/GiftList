<link rel='stylesheet' media='screen and (min-width: 1px) and (max-width: 3800px)' href='<?php echo base_url(); ?>public/css/style.css' /> 
<!--<link rel='stylesheet' type='text/css' media='only screen and (min-width: 2px) and (max-device-width: 900px)' href='<?php //echo base_url(); ?>public/css/mobile-style.css' /> !>
<!--[if IE]>
<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>public/css/style.css' />
<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>public/css/dashboard.css' />
<link rel='stylesheet' type='text/css' href='<?php echo base_url(); ?>public/css/fonts.css' />
<![endif]-->
<script type = 'text/javascript' src='<?php echo base_url(); ?>/public/js/jquery.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>/public/js/jquery-ui-min.js'></script>
<script type='text/javascript' src='<?php echo base_url(); ?>/public/js/menu_hover.js'></script>
<script type='text/javascript' src = '<?php echo base_url(); ?>/public/js/btn_hover.js'></script>
<script type = 'text/javascript' src = '<?php echo base_url(); ?>/public/js/status_hover.js'></script>
<script type = 'text/javascript' src = '<?php echo base_url(); ?>/public/js/validate.js'></script>
<script type = 'text/javascript' src = '<?php echo base_url(); ?>/public/js/ajax_js.js'></script>
<script type = 'text/javascript' src = '<?php echo base_url(); ?>/public/js/popup.js'></script>
<script type = 'text/javascript' src = '<?php echo base_url(); ?>/public/js/crypt.js'></script></head>
<?php if (isset($dashboard)) { ?>
	<link rel='stylesheet' media='screen and (min-width: 101px) and (max-width: 3800px)' href='<?php echo base_url(); ?>public/css/dashboard.css' /> 
	<link rel='stylesheet' media='screen and (min-width: 101px) and (max-width: 3800px)' href='<?php echo base_url(); ?>public/css/fonts.css' /> 
	<script type = 'text/javascript' src = '<?php echo base_url(); ?>/public/js/dashboard.js'></script>
	<script type = 'text/javascript' src = '<?php echo base_url(); ?>/public/js/crypt.js'></script>
<?php } ?>