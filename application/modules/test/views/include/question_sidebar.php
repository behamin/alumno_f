<aside class="question-sidebar" style="height: 700px;">

  <div class="score-sb">

    <h4 class="title-sb sm bold">Total de preguntas<span><?= count($test->getEvaluacionrespuestas()) ?></span></h4>

    <div class="list-wrap ps-container ps-active-x" style="height: 520px; max-height: none;">

      <ul>

        <li><i class="icon"></i>No contestadas<span><?= $totalres['noContestadas'] ?></span></li>

        <li class="err"><i class="icon"></i>No acertadas<span><?= $totalres['noAcertadas'] ?></span></li>

        <li class="active"><i class="icon"></i>Acertadas<span><?= $totalres['acertadas'] ?></span></li>

      </ul>

    </div>

  </div>

</aside>
