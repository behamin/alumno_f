<?php $this->load->view('include/content/sub_banner') ?>

<section id="create-course-section" class="create-course-section">

  <div class="container">

      <div class="row">

        <?php $this->load->view('include/content/nav_left') ?>

        <div class="col-md-9">

          <div class="create-course-content">

              <div class="table-student-submission">

                  <table class="mc-table">

                      <tbody>

                        <?php foreach ($temas as $key => $value): ?>

                          <tr class="new">

                              <td class="submissions"><a href="<?= site_url('themes/theme/'.$value->getIdtheme()) ?>"><?= utf8_encode($value->getTitletheme()) ?></a></td>

                          </tr>

                        <?php endforeach ?>

                      </tbody>

                  </table>

              </div>

          </div>

        </div>

      </div>

  </div>

</section>
