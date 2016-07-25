<!DOCTYPE html>

<html lang="<?= $lang;?>">

	<head>

		<?php

			$meta = array(
		        array('name' => 'robots', 'content' => $robots),
		        array('name' => 'title', 'content' => $title),
		        array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv')
		    );

		?>

		<?=  meta($meta); ?>

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>

		<title><?= $title; ?></title>

		<?php $this->load->view('css/css') ?>

	</head>

	<body id="page-top" class="home <?php if(isset($reference)) echo $reference ?>">

		<div id="page-wrap">

			<?php $this->load->view('header') ?>

		</div>

		<?php $this->load->view($view) ?>

		<?php $this->load->view('js/js') ?>

	</body>

</html>
