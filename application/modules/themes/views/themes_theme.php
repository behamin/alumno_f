<?php $this->load->view('include/content/sub_banner') ?>

<?php $this->load->view('include/content/nav_top') ?>

<section id="create-course-section" class="create-course-section">

  <div class="container">

      <div class="row">

        <div class="col-md-9">

          <div class="create-course-content">

              <div class="table-student-submission">

                  <table class="mc-table">

                      <tbody>

                        <?php foreach ($capitulos as $key => $value): ?>

                          <tr class="new">

                              <td class="submissions"><a href="<?= site_url('themes/chapter/'.$id.'/'.$value->getIdthemeparts()) ?>"><?= utf8_encode($value->getTitlethemeparts()) ?></a></td>

                          </tr>

                        <?php endforeach ?>

                      </tbody>

                  </table>

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
