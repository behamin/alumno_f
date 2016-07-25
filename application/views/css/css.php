<!-- Google font -->
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:300,400,700,900' rel='stylesheet' type='text/css'>
<!-- Css -->
<?= link_tag('assets/css/library/bootstrap.min.css') ?>
<?= link_tag('assets/css/library/font-awesome.min.css') ?>
<?= link_tag('assets/css/library/owl.carousel.css') ?>
<?= link_tag('assets/css/md-font.css') ?>
<?= link_tag('assets/css/style.css') ?>
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<?php if(isset($css)):  ?><?= $css ?><?php endif ?>
