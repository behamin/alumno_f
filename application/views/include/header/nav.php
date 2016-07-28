<?php if(isset($this->session->userdata['logged_in'])): ?>

<nav class="navigation">

	<div class="open-menu">
			<span class="item item-1"></span>
			<span class="item item-2"></span>
			<span class="item item-3"></span>
	</div>

	<ul class="menu">

		<li><a title="Desconectar" href="<?= site_url('login/logout') ?>"><i class="fa fa-power-off" aria-hidden="true"></i> Salir</a></li>

	</ul>

	<ul class="list-account-info">

		<li class="list-item account">

					<div class="account-info item-click">
							<img alt="" src="<?= base_url('assets/alumnos_images/team-13.jpg') ?>">
					</div>

			</li>

	</ul>

</nav>
<?php endif ?>
