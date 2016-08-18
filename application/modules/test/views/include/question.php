<!--
Test unitario a realizar
-->
<h4 style="font-size:18px; margin-bottom:15px;" class="sm black bold"><?= $question ?></h4>

<div class="table-student-submission">

  <?php foreach ($responses as $key => $value): ?>

    <label>
      <input <?php if($responseId == $value->getIdresponse() ) echo 'checked' ?> type="radio" value="<?= $value->getIdresponse() ?>" evalId="<?= $evalId ?>" quId="<?= $quId ?>" class="testType" name="response">
      <?= $abc[$key].'. '.utf8_encode($value->getResponse()) ?>
    </label><br/>

  <?php endforeach ?>

  <?php if($page > 1): ?>

    <a class="mc-btn btn-style-6" href="<?= $page-1 ?>">Pregunta anterior</a>

  <?php endif ?>

  <?php if($page < $numtest): ?>

    <a class="mc-btn btn-style-6" href="<?= $page+1 ?>">Siguiente pregunta</a>

  <?php endif ?>

  <?php if($page == $numtest): ?>

    <a evalId="<?= $evalId ?>" class="submit mc-btn btn-style-1 endTest">Finalizar test</a>

  <?php endif ?>

</div>
