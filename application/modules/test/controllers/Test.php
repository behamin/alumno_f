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
		define("TABLE","Test");
  }

	public function index()
	{

		$data = $this->base(__FUNCTION__);
		//Obtenemos el listado de test realizados.
		$data['tests'] = $this->doctrine->default->getRepository("Entities\\Tests")->findBy(array("alumnoid" => $this->id_alumno));
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

			if($typeTest == 1)
			{

				$questions = $this->doctrine->academy->getRepository("Entities\\PreguntasJoin")->getQuestionByCourses($this->cursoid[0],$this->maxPreguntas[0]);

			}elseif($typeTest == 2)
			{



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
		for ($i=65;$i<=90;$i++) {
		  $abc[] = chr($i);
		}
		$data['abc'] = $abc;

		$test = $this->doctrine->default->getRepository("Entities\\Tests")->findOneBy(array("id" => $testId));
		$data['testEvaluation'] = $test->getEvaluation();
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

	public function evaluation_test()
	{
		if($this->input->is_ajax_request())
		{
			$evaluacionId = $this->input->post('evaluacionId');
			//obtenemos el usuario
			$responses = $this->doctrine->default->getRepository("Entities\\Evaluacionrespuesta")->getResponseByEvaluation($evaluacionId);

			foreach ($responses as $key => $value)
			{
				echo $value->getResponseid().',';
			}

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
