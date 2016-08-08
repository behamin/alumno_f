<?php $this->load->view('include/content/sub_banner') ?>

<section class="profile">

  <div class="container">

      <div class="row">

        <?php $this->load->view('include/content/nav_left') ?>

        <div class="col-md-9">

          <div class="avatar-acount">

            <?php $this->load->view('include/image') ?>

                <div class="info-acount">

                  <?php $this->load->view('include/top_data') ?>

                  <form method="post">

                  <?php $this->load->view('include/form') ?>

                </div>

                <div class="input-save">

                    <input name="submitData" type="submit" class="mc-btn btn-style-1" value="Guardar cambios">

                </div>

                </form>

            </div>

        </div>

      </div>

  </div>

</section>
