<h3 class="md black"><?= utf8_encode($alumno->getAlumnosdatos()->getName()) ?> <?= utf8_encode($alumno->getAlumnosdatos()->getSurname()) ?></h3>
<h4 class="md black">Curso <?= $this->session->userdata('curso') ?></h4>
<?= $this->session->userdata('cursoDes') ?>
