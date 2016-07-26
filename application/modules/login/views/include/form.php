<form method="post">

    <?php if($errors): ?>

      <?= $errors ?>

    <?php endif ?>

    <h2 class="text-uppercase">Accede a tu cuenta</h2>

    <div class="form-email">

        <input name="email" type="text" placeholder="Email">

    </div>

    <div class="form-password">

        <input type="password" name="password" placeholder="Password">

    </div>

    <div class="form-check">

        <a href="#">¿No recuerdo mi contraseña?</a>

    </div>

    <div class="form-submit-1">

        <input name="submit-login" type="submit" value="Entrar" class="mc-btn btn-style-1">

    </div>

    <div class="link">

        <a href="register.html">

            <i class="icon md-arrow-right"></i>¿Aún no tienes cuenta?

        </a>

    </div>

</form>
