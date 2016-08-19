<!--
En este apartado mostramos el test con todas sus preguntas, mostrando
las preguntas correctas en caso necesario.
-->
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

            <!-- si todo ha ido bien en la consulta, recorremos el objeto con y mostramos todas las preguntas -->
            <?php foreach ($test->getEvaluacionrespuestas() as $key => $value): ?>
              <!-- almacenamos la pregunta consultado la entidad Pregutnas pasandole el id de la pregunta -->
              <?php $question = $this->doctrine->academy->getRepository("Entities\\Preguntas")->findOneBy(array("id_question" => $value->getQuestionid())); ?>

              <tr>

                  <td><?= $key + 1 ?></td>

                  <td class="td-quest">
                    <!-- imprimimos la preguntas -->
                    <?= utf8_encode($question->getQuestion()) ?><br/>

                    <?php if($value->getResponseid() == 0): ?>
                      <!-- si no hemos respondido la pregunta, consultamos la la entidad respuesta e imprimimos la respuesta -->
                      <?php
                        $response = $this->doctrine->academy->getRepository("Entities\\Respuestas")->findOneBy(
                        array("id_question" => $question->getIdquestion(),"ok_response"  => 1));
                        echo '<span style="color: #ffde3a;">R.'.utf8_encode($response->getResponse()).'</span>';
                      ?>

                    <?php else: ?>

                      <?php if($value->getResponse() == 1): ?>
                        <!--
                          en caso que si tengamos una respuesta, comprobamos si esta es correcta o no, si es correcta, imprimimos
                          la respuesta dada consultando en la entidad Respuesta, si esta no es correcta, consultamos la entidad
                          Respuestas e imprimimos la respuesta correcta para mostrarla al alumno.
                        -->
                        <?php
                          $response = $this->doctrine->academy->getRepository("Entities\\Respuestas")->findOneBy(
                          array("id_response" => $value->getResponseid()));
                          echo '<span style="color: #37abf2;">R.'.utf8_encode($response->getResponse()).'</span>';
                        ?>

                      <?php else: ?>

                        <?php
                          $response = $this->doctrine->academy->getRepository("Entities\\Respuestas")->findOneBy(
                          array("id_response" => $value->getResponseid()));
                          echo '<span style="color: #d93425;">R.'.utf8_encode($response->getResponse()).'</span><br/>';
                        ?>

                        <?php
                          $response = $this->doctrine->academy->getRepository("Entities\\Respuestas")->findOneBy(
                          array("id_question" => $question->getIdquestion(),"ok_response"  => 1));
                          echo '<span style="color: #37abf2;">R.'.utf8_encode($response->getResponse()).'</span>';
                        ?>

                      <?php endif ?>

                    <?php endif ?>

                  </td>

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
