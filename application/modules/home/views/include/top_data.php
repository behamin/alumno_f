<h3 class="md black"><?= $saludo ?> <?= utf8_encode($alumno->getAlumnosdatos()->getName()) ?></h3>
<hr>

<div class="info-home mr">
  <strong>Última conexión</strong><br/><?= $this->session->userdata('ultcon') ?>
</div>

<div class="info-home">
  <strong>Días desde la última conexión</strong><br/><?= $this->session->userdata('dultcom') ?> días
</div>

<div class="info-home mr">
  <strong>Número total de test realizados</strong><br/><?= $numTest ?> Tests
</div>

<div class="info-home">
  <strong>Medía de test diarios</strong><br/><?= $meAciertos ?> Test diarios
</div>

<div class="info-home mr">
  <strong>Número de preguntas realizadas</strong><br/><?= $numQuestion ?> Preguntas
</div>

<div class="info-home">
  <strong>Preguntas no contestadas</strong><br/><?= $noContestadas ?> Preguntas
</div>

<div class="info-home mr">
  <strong>Preguntas acertadas</strong><br/><?= $acertadas ?> Preguntas
</div>

<div class="info-home">
  <strong>Preguntas no acertadas</strong><br/><?= $noAcertadas ?> Preguntas
</div>

<div class="info-home last">
  <strong>Tu media de aciertos es:</strong><br/><?= $porAciertos ?>%
</div>
