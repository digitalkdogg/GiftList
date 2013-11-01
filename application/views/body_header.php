<body>
  <div id = "wrapper">

    <div id = "header">
       <div id = "header_wrapper">
            <span class = "title_sapn">
            <span class = "merry_xmas">Merry Christmas</span>
            <?php echo "<p class = 'title_desc'> Welcome to the " . $first_name . ' ' . $last_name . ' - ' . $header_title . "</p>"; ?>
            <a href = '<?php echo site_url();?>'><button class='btn'>Search for other members</button></a>
            <?php echo "</span><img align = 'right' src = '" . base_url() . "/public/img/gift.png' alt = 'gift' />"; ?>

       </div><!--end header_wrapper-->
    </div><!--End header -->

