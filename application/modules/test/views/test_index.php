<?php $this->load->view('include/content/sub_banner') ?>

<section id="create-course-section" class="create-course-section">

  <div class="container">

      <div class="row">

        <?php $this->load->view('include/content/nav_left') ?>

        <div class="col-md-9">

          <div class="create-course-content">

              <ul class="nav nav-tabs" role="tablist">

                <li role="presentation" class="active">
                  <a href="#generartest" aria-controls="profile" role="tab" data-toggle="tab">Generar test</a>
                </li>

                <li role="presentation">
                  <a href="#mistest" aria-controls="home" role="tab" data-toggle="tab">Mis tests</a>
                </li>

              </ul>

              <div class="tab-content">

                <?php $this->load->view('include/generar_tab') ?>

              </div>

          </div>

        </div>

      </div>

  </div>

</section>
