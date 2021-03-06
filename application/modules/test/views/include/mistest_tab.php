<div role="tabpanel" class="tab-pane" id="mistest">

  <table class="table-question">
    
        <thead>
            <tr>
                <th colspan="2"></th>
                <th class="right-answer"></th>
            </tr>
        </thead>
        <tbody>

          <?php if($tests != null): ?>

            <?php foreach ($tests as $key => $value): ?>

              <tr>
                  <td><?= $value->getId() ?></td>
                  <td class="td-quest"><?= $value->getCreatedtest()->format("d/m/Y") ?></td>
                  <td class="td-right-answer">
                    <a href="<?= site_url('test/numtest/'.$value->getId()) ?>"><i style="font-size:27px;" class="fa fa-eye" aria-hidden="true"></i></a>
                  </td>
              </tr>

            <?php endforeach ?>

          <?php else: ?>

            <div class="alert alert-info" role="alert">No tienes Tests realizados</div>

          <?php endif ?>

        </tbody>

    </table>

</div>
