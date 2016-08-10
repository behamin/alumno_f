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
		$data['titleNavtop'] = 'Test nº '.$id;
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

			//creamos una instancia de la entidad Evaluacion
			$evaluacion = new Entities\Evaluacion;
			//establecemos las propiedades a través de los setters
			$evaluacion->setTestid($test->getId());
			//y guardamos la entidad en su tabla
			$this->doctrine->default->persist($evaluacion);
			$this->doctrine->default->flush();

			//creamos una instancia de la entidad Evaluacionrespuesta
			$evaluacionR = new Entities\Evaluacionrespuesta;

			foreach ($questions as $key => $value)
			{
				//establecemos las propiedades a través de los setters
				$evaluacionR->setEvaluacionid($evaluacion->getId());
				$evaluacionR->setAlumnoid($this->id_alumno[0]);
				$evaluacionR->setQuestionid($value->getIdquestion());
				//y guardamos la entidad en su tabla
				$this->doctrine->default->persist($evaluacionR);
				$this->doctrine->default->flush();
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
