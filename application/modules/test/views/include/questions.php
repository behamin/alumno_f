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

              <?php $question = $this->doctrine->academy->getRepository("Entities\\Preguntas")->findOneBy(array("id_question" => $value->getQuestionid())); ?>

              <tr>

                  <td><?= $key + 1 ?></td>

                  <td class="td-quest"><?= $question->getQuestion() ?></td>

                  <td class="td-right-answer">

                    <?php if($value->getResponseid() == 0): ?>

                      <i style="color: #ffde3a;" class="fa fa-circle" aria-hidden="true"></i>

                    <?php else: ?>

                      <?php if($value->getResponse() == 0): ?>

                        <i class="icon icon-err md-close-2"></i>

                      <?php elseif($value->getResponse() == 1): ?>

                        <i class="icon icon-val md-check-2"></i>

                      <?php endif ?>

                    <?php endif ?>

                  </td>

              </tr>

            <?php endforeach ?>

          <?php else: ?>

            <div class="alert alert-info" role="alert">Parece que tenemos problemas para mostrar los datos</div>

          <?php endif ?>

        </tbody>

    </table>

</div>
