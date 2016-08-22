<div style="display:none;" id="themes" class="col-md-4">

  <h4 class="title-box text-uppercase">Selecciona Tema/as</h4>

  <div class="radio">

    <?php foreach ($temas as $key => $value): ?>

      <label>
        <input class="theme" type="checkbox" name="themeBox[]" id="optionsCheckbox" value="<?= $value->getIdtheme() ?>">
        <?= utf8_encode($value->getTitletheme()) ?>
      </label>

    <?php endforeach ?>

  </div>

</div>
