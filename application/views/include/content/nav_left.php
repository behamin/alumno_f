<div class="col-md-3">
    <div class="create-course-sidebar">
        <ul class="list-bar">
            <li <?php if($this->uri->segment(1) == 'home') echo 'class="active"' ?>><a href="<?= site_url('home') ?>"><span class="count">1</span>Inicio</a></li>
            <li <?php if($this->uri->segment(1) == 'profile') echo 'class="active"' ?>><a href="<?= site_url('profile') ?>"><span class="count">2</span>Mi perfil</a></li>
            <li <?php if($this->uri->segment(1) == 'themes') echo 'class="active"' ?>><a href="<?= site_url('themes') ?>"><span class="count">3</span>Temario</a></li>
            <li <?php if($this->uri->segment(1) == 'test') echo 'class="active"' ?>><a href="<?= site_url('test') ?>"><span class="count">4</span>Test</a></li>
        </ul>
        <div class="support">
            <!--<a href="#"><i class="icon md-camera"></i>See how it work short tutorial</a>
            <a href="#"><i class="icon md-flash"></i>Instant Support</a>-->
        </div>
    </div>
</div>
