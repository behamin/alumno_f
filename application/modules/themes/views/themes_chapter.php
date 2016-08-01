<?php $this->load->view('include/content/sub_banner') ?>

<?php $this->load->view('include/content/nav_top') ?>

<section id="create-course-section" class="create-course-section">

  <div class="container">

      <div class="row">

        <div class="col-md-9">

          <div class="create-course-content">

              <div class="table-student-submission">

                  <h3 class="title-chapter"><?= $capitulo->getTitlethemeparts() ?></h3>

                  <div class="text-chapter">

                    <?php if($capitulo->getVideothemeparts() != null): ?>

                      <iframe style="margin-bottom:20px;" width="100%" height="315" src="https://www.youtube.com/embed/<?= $capitulo->getVideothemeparts() ?>" frameborder="0" allowfullscreen></iframe>

                    <?php endif ?>

                    <?= utf8_encode($capitulo->getTextthemeparts()) ?>

                  </div>


              </div>

          </div>

        </div>

        <div class="col-md-3">

            <div class="create-course-content">

                <?php $this->load->view('include/tree_theme') ?>

            </div>

        </div>

      </div>

  </div>

</section>
