<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">

	<li class="nav-item <?php if($this->uri->segment(2) == "" OR $this->uri->segment(2) == "home" ) echo 'start active' ?>">

		<a class="nav-link nav-toggle" href="<?= site_url($this->config->item('language').'/home') ?>">

			<i class="icon-home"></i>
			<span class="title">Home</span>
			<span class="selected"></span>

		</a>

	</li>

	<?= $this->Main_model->get_menu($join = 0, $main = FALSE) ?>

</ul>
