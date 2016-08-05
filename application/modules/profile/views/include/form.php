<div class="security">
  <?= validation_errors(); ?>
    <div class="tittle-security">
        <h5>Email</h5>
        <input name="email" type="text" value="<?= $alumno->getAlumnosdatos()->getEmail() ?>">
        <h5>Password</h5>
        <input name="pass" type="password" placeholder="Nuevo password">
        <input name="repeatPass" type="password" placeholder="Confirmar password">
    </div>
</div>
