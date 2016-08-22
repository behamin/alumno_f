<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test  extends MX_Controller {

	private $lang = "";
	private $id_alumno = null;
	private $cursoid = null;
	private $maxPreguntas = null;
	private $TiempoTest = null;

	public function __construct()
	{

    parent::__construct();
		$this->lang = 'es';
		//almacenamos el id del alumno
		$this->id_alumno = explode(',',$this->session->userdata('alumno'));
		// almacenamos el id del curso
		$this->cursoid = explode(',',$this->session->userdata('cursoid'));
		//almacenamos max de preguntas del curso
		$this->maxPreguntas = explode(',',$this->session->userdata('maxPreguntas'));
		//almacenamos el tiempo máximo para realizar el test
		$this->TiempoTest = explode(',',$this->session->userdata('TiempoTest'));
		// almacenamos en formato array los temas asociados
		$this->idTemas = explode(',',$this->session->userdata('idThemes'));
		define("TABLE","Test");
  }

	public function index()
	{

		$data = $this->base(__FUNCTION__);
		//Obtenemos el listado de test realizados.
		$data['tests'] = $this->doctrine->default->getRepository("Entities\\Tests")->findBy(array("alumnoid" => $this->id_alumno,"evaluation" => 1));
		//almacenamos los temas del alumno
		$data['temas'] = array();
		foreach ($this->idTemas as $key => $value)
		{
				$data['temas'][$key] = $this->doctrine->academy->find("Entities\\Temas", $value);
		}
		$this->load->view('layout', $data);

 	}

	public function numtest($id)
	{

		$data = $this->base(__FUNCTION__);
		//pasamos el título para el nav_top, en este caso el título del tema
		$data['titleNavtop'] = utf8_decode('Test nº '.$id);
		//obtenemos los datos del test y su resultado desde la tabla evaluación
		$data['test'] = $this->doctrine->default->getRepository("Entities\\Evaluacion")->findOneBy(array("testid" => $id));
		//creamos un array donde almacenamos el número total de preguntas no contestadas, acertadas y no acertadas.
		//preguntas no contestadas
		$noContestadas = $this->doctrine->default->getRepository("Entities\\Evaluacionrespuesta")->findBy(
		array("evaluacionid" => $data['test']->getId(),"response" => -1));
		//preguntas acertadas
		$acertadas = $this->doctrine->default->getRepository("Entities\\Evaluacionrespuesta")->findBy(
		array("evaluacionid" => $data['test']->getId(),"response" => 1));
		//preguntas no acertadas
		$noAcertadas = $this->doctrine->default->getRepository("Entities\\Evaluacionrespuesta")->findBy(
		array("evaluacionid" => $data['test']->getId(),"response" => 0));

		$data['totalres'] = array(
																'noContestadas' => count($noContestadas),
																'acertadas' => count($acertadas),
																'noAcertadas' => count($noAcertadas),
														);
		//print_r ($data['test']->getEvaluacionrespuestas());
		$this->load->view('layout', $data);

 	}

	public function generated()
	{
		if($this->input->is_ajax_request())
		{
			$typeTest = $this->input->post('param1');
			$typeQu = $this->input->post('param2');
			$theme = $this->input->post('param3');

			if($typeTest == 1)
			{

				$questions = $this->doctrine->academy->getRepository("Entities\\PreguntasJoin")->getQuestionByCourses($this->cursoid[0],$this->maxPreguntas[0]);

			}elseif($typeTest == 2)
			{

				if($typeQu == 1)
				{

					echo 'typeq1';

				}elseif($typeQu == 2)
				{
					echo 'typeq2';
				}

			}elseif($typeTest == 3)
			{

			}

			//creamos la variable donde vamos a crear el string separados por una coma con la lista
			//de todas las preguntas que compondrán el test
			$questionsList = "";

			foreach ($questions as $key => $value)
			{
				$questionsList .= $value->getIdquestion().',';
			}
			//eliminamos la última coma del string
			$questionsList = trim($questionsList, ',');

			//creamos una instancia de la entidad Tests
			$test = new Entities\Tests;
			//establecemos las propiedades a través de los setters
			$test->setAlumnoid($this->id_alumno[0]);
			$test->setQuestions($questionsList);
			$test->setMinutes($this->TiempoTest[0]);
			$test->setNumQuestion($this->maxPreguntas[0]);
			$test->setQuestionType($typeTest);
			//y guardamos la entidad en su tabla
			$this->doctrine->default->persist($test);
			$this->doctrine->default->flush();
			//guardamos el test id
			$testId = $test->getId();

			//creamos una instancia de la entidad Evaluacion
			$evaluacion = new Entities\Evaluacion;
			//establecemos las propiedades a través de los setters
			$evaluacion->setTestid($test->getId());
			//y guardamos la entidad en su tabla
			$this->doctrine->default->persist($evaluacion);
			$this->doctrine->default->flush();
			//guardamos el evaluacion id
			$evalId = $evaluacion->getId();

			foreach ($questions as $key => $value)
			{
				//creamos una instancia de la entidad Evaluacionrespuesta
				$evaluacionR = new Entities\Evaluacionrespuesta;
				$evaluacion_ = $this->doctrine->default->find("Entities\\Evaluacion", $evaluacion->getId());
				//establecemos las propiedades a través de los setters
				$evaluacionR->setEvaluacionid($evaluacion_);
				$evaluacionR->setAlumnoid($this->id_alumno[0]);
				$evaluacionR->setQuestionid($value->getIdquestion());
				//y guardamos la entidad en su tabla
				$this->doctrine->default->persist($evaluacionR);
				$this->doctrine->default->flush();
			}

			//redireccionamos al test generado para su realización
			echo 'test/unitary/'.$testId.'/'.$evalId.'/1';

		}
	}

	public function unitary($testId,$evalId,$p)
	{

		$data = $this->base(__FUNCTION__);
		//extraemos los datos del TestActions
		$data['testId'] = $testId;
		$data['evalId'] = $evalId;
		$data['page'] = $p;

		//generamos array con el abecedario
		$abc = array();
		for ($i=65;$i<=90;$i++)
		{
		  $abc[] = chr($i);
		}
		$data['abc'] = $abc;

		$test = $this->doctrine->default->getRepository("Entities\\Tests")->findOneBy(array("id" => $testId));
		$data['testEvaluation'] = $test->getEvaluation();
		//extraemos los datos básicos de la evaluación
		$evaluation = $this->doctrine->default->getRepository("Entities\\Evaluacion")->find($evalId);
		//Creamos dos varialbes, @tStart guardara cuando comenzamos el test y @tNow que almacena la fecha y hora actual
		$tStart = $evaluation->getDateeval()->format("Y-m-d H:i:s");
		$tNow = date("Y-m-d H:i:s");
		//Calculamos cuantos minutos han pasado
		$minuts = ceil((strtotime($tNow) - strtotime($tStart)) / 60);
		//restamos los minutos pasados al total de minutos para la realización del test y obtenemos cuanto tiempo nos queda
		$data['time_now'] = $test->getMinutes() - $minuts;
		//creamos un array con la lista de preguntas y hacemos un count sobre el
		$numtest = explode(',',$test->getQuestions());
		$data['numtest'] = count($numtest);
		//pasamos el título para el nav_top, en este caso el número del test que estámos realizando
		$data['titleNavtop'] = utf8_decode('Test nº '.$testId);
		//extraemos el id de la pregunta que corresponde según su @evalId y su número de página @p
		$questionId = $this->doctrine->default->getRepository("Entities\\Evaluacionrespuesta")->getOneQuestionTest($evalId,$p);
		//almacenamos y pasamos a la vista el id de la respuesta lamacenada en la evaluación. Nota: si es 0 es no contestada
		$data['responseId'] = $questionId->getResponseid();
		//Extraemos el enunciado de la pregunta y lo almacenamos para pasarlo a la vista
		$question = $this->doctrine->academy->getRepository("Entities\\Preguntas")->findOneBy(array("id_question" => $questionId->getQuestionid()));
		//pasamos el question id a la vista
		$data['quId'] = $questionId->getQuestionid();
		$data['question'] =  utf8_encode($question->getQuestion());
		//extraemos las posibles respuestas, almacenamos y pasamos a la vista
		$data['responses'] = $this->doctrine->academy->getRepository("Entities\\Respuestas")->findBy(array("id_question" => $questionId->getQuestionid()));

		$this->load->view('layout', $data);

 	}

	public function get_response()
	{
		if($this->input->is_ajax_request())
		{
			$evaluacionId = $this->input->post('evaluacionId');
			$questionId = $this->input->post('questionId');
			$value = $this->input->post('value');
			//obtenemos el usuario
			$response = $this->doctrine->default->getRepository("Entities\\Evaluacionrespuesta")->findOneBy(array("evaluacionid" => $evaluacionId,"questionid" => $questionId));
			//seteamos y actualizamos
			$response->setResponseid($value);
			$this->doctrine->default->flush();

		}
	}

	public function get_tests()
	{
		if($this->input->is_ajax_request())
		{
			//almacenamos la cadena con los temas seleccionados
			$tList = $this->input->post('checkboxValues');
			$tests = array();
			$options = '<option value="0">Selecciona un test</option>';
			//lo convertimos en un array
			$tList = explode(',',$tList);
			//recorremos el array para consultar y extraer todos los
			foreach ($tList as $key => $value)
			{
				$tests[] = $this->doctrine->academy->getRepository("Entities\\TestsEs")->findBy(array("id_theme_part" => $value));
			}

			foreach ($tests as $key => $test)
			{
				foreach ($test as $key => $value)
				{

					$options .= '<option value="'.$value->getIdtest().'">'.$value->getnametest().'</option>';

				}

			}

			echo utf8_encode($options);

		}
	}

	public function evaluation_test()
	{
		if($this->input->is_ajax_request())
		{
			$evaluacionId = $this->input->post('evaluacionId');
			$testId = $this->input->post('testId');
			$timeR = $this->input->post('timeR');
			$timeT = $this->TiempoTest[0];
			//las respuestas contestadas
			$responses = $this->doctrine->default->getRepository("Entities\\Evaluacionrespuesta")->getResponseByEvaluation($evaluacionId);

			foreach ($responses as $key => $value)
			{

				$response = $this->doctrine->academy->getRepository("Entities\\Respuestas")->findOneBy(array("id_question" => $value->getQuestionid(),"id_response" => $value->getResponseid()));
				$eval = $this->doctrine->default->getRepository("Entities\\Evaluacionrespuesta")->findOneBy(array("evaluacionid" => $evaluacionId,"questionid" => $value->getQuestionid()));
				//seteamos y actualizamos, de esta forma evaluamos si la respuesta es correcta o no
				$eval->setResponse($response->getOkresponse());
				$this->doctrine->default->flush();

			}

			$test = $this->doctrine->default->getRepository("Entities\\Tests")->find($testId);
			//seteamos y actualizamos, ahora este test ya no será posible volver acceder a el para realizarlo.
			$test->setEvaluation(1);
			$this->doctrine->default->flush();

			//almacenamos los tiempos en la entidad Evaluationtime
			//creamos una instancia de la entidad Evaluationtime
    	$evaltime = new Entities\Evaluaciontime;
			//establecemos las propiedades a través de los setters
    	$evaltime->setEvaluacionid($evaluacionId);
    	$evaltime->setTime($timeR);
    	$evaltime->setTotaltime($timeT);
			//guardamos la entidad en su tabla
    	$this->doctrine->default->persist($evaltime);
    	$this->doctrine->default->flush();

			//redireccionamos al test generado para su realización
			echo site_url('test/numtest/'.$testId);

		}
	}
	//Base para los metodos.
	private function base($action = null)
	{

		$model = TABLE.'_model';//Nombre del modelo

		$base = array(
						'lang' => $this->lang,
						'title' => "Panel de control | ",
						'reference' => strtoupper(TABLE.'-'.$action),
						'view' => strtolower (TABLE).'_'.$action,
						'page' => TABLE,
						'robots' => 'noindex, nofollow',
						'js' => $this->load->view('js_module/js_module','',TRUE),
						'css' => $this->load->view('css_module/css_module',TRUE),

					);

		return $base;

	}
}
