<aside class="question-sidebar" style="height: 700px;">

  <div class="score-sb">

    <h4 class="title-sb sm bold">Preguntas</h4>

    <div class="list-wrap ps-container ps-active-x" style="height: 520px; max-height: none;">

      <?php for ($i = 1; $i <= $numtest ; $i++): ?>

        <div class="btn-group" aria-label="Third group" role="group">

          <a href="<?= site_url('test/unitary/'.$testId.'/'.$evalId.'/'.$i) ?>" style="background:red; color:#fff;" class="btn btn-default"><?= $i ?></a>

        </div>

      <?php endfor ?>

    </div>

  </div>

</aside>
