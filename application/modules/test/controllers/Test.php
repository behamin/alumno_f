<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test  extends MX_Controller {

	private $lang = "";
	private $id_alumno = null;

	public function __construct()
	{

    parent::__construct();
		$this->lang = 'es';
		// almacenamos el id del alumno
		$this->id_alumno = explode(',',$this->session->userdata('alumno'));
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
				echo 'hola';
			}elseif($typeTest == 2)
			{

			}elseif($typeTest == 3)
			{

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


		switch ($action)
		{

			case 'index':

				//$base['get_result'] = $this->$model->get_data(strtolower (TABLE));
				//$base['tooltip'] = strtolower (substr(TABLE, 0, -1));
				//$base['param'] = strtolower (TABLE);

				break;

			case 'add':

				$base['last_id'] = $this->$model->set_data(strtolower (TABLE));

				break;

			case 'edit':

				$base['subpage'] = 'Editar '.substr(TABLE, 0, -1);
				$base['param'] = strtolower (TABLE);
				//$base['testerdata'] = $this->Test_model->test_data();

				break;
		}

		return $base;

	}
}
