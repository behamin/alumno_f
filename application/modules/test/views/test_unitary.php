<?php $this->load->view('include/content/sub_banner') ?>

<?php $this->load->view('include/content/nav_top') ?>

<section id="create-course-section" class="create-course-section">

  <div class="container">

      <div class="row">

        <?php if($testEvaluation == 0): ?>

          <div class="col-md-9">

            <div class="create-course-content">

              <?php $this->load->view('include/question') ?>

            </div>

          </div>

          <div class="col-md-3">

            <?php $this->load->view('include/pagination_sidebar') ?>

          </div>

      <?php else: ?>

        <div class="col-md-12">

          <div class="create-course-content">

            <div style="margin-top:20px;" class="alert alert-danger" role="alert"><strong>¡Upss!</strong> Lo sentimos pero no tienes acceso para realizar este test</div>

          </div>

        </div>

      <?php endif ?>

      <div class="modal fade" aria-labelledby="myModalLabel" tabindex="-1" role="dialog" style="background-color: #fff; display: none; opacity: 0.7;">

        <div class="content-preload"></div>

      </div>

      </div>

  </div>

</section>
