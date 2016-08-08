<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home  extends MX_Controller {

	private $lang = "";
	private $idAlumno = 0;

	public function __construct()
	{

    parent::__construct();
		$this->lang = 'es';
		//almacenamos el id del usuario
		$this->idAlumno = $this->session->userdata('alumno');
		//almacenamos datos alumno
		$this->alumno = $this->doctrine->default->find("Entities\\Alumnos", $this->idAlumno);
		define("TABLE","Home");
  }

	public function index()
	{

		$data = $this->base(__FUNCTION__);
		//id del alumno
		$data['idAlumno'] = $this->idAlumno;
		//datos del alumno
		$data['alumno'] = $this->alumno;
		//saludo según horario
		$h = date ("H");
		if($h < 12)
		{
			$data['saludo'] = 'Buenos días';

		}elseif($h < 20)
		{
			$data['saludo'] = 'Buenas tardes';

		}else
		{
			$data['saludo'] = 'Buenas noches';
		}
		$this->load->view('layout', $data);

 	}

	public function add()
	{

		$data = $this->base(__FUNCTION__);
		redirect(strtolower (TABLE).'/edit/'.$data['last_id']);
	}

	public function edit($id)
	{
		$data = $this->base(__FUNCTION__);
		$data['id'] = $id;
		$this->load->view('layout', $data);

		if (isset( $_POST['submit_form'] ))
		{

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
