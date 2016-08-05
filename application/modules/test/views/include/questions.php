<div role="tabpanel" class="tab-pane" id="mistest">

  <table class="table-question">

        <thead>
            <tr>
                <th colspan="2"></th>
                <th class="right-answer"></th>
            </tr>
        </thead>
        <tbody>

          <?php if($test->getEvaluacionrespuestas() != null): ?>

            <?php foreach ($test->getEvaluacionrespuestas() as $key => $value): ?>

              <tr>
                  <td><?= $value->getId() ?></td>
                  <td class="td-quest">sdasdasd</td>
                  <td class="td-right-answer">
                    <a href="<?= site_url('test/numtest/'.$value->getId()) ?>"><i style="font-size:27px;" class="fa fa-eye" aria-hidden="true"></i></a>
                  </td>
              </tr>

            <?php endforeach ?>

          <?php else: ?>

            <div class="alert alert-info" role="alert">Parece que tenemos problemas para mostrar los datos</div>

          <?php endif ?>

        </tbody>

    </table>

</div>
