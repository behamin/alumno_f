<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home  extends MX_Controller {

	private $main_lang = "";
	private $lang = "";
	private $fields = array();

	public function __construct()
	{

    parent::__construct();
		$this->lang = $this->uri->segment(1);
		$this->fields = array('ID','Página','fecha');
		define("ICONO","fa fa-file-text-o");
		define("TABLE","Home");
		//$this->load->model(TABLE.'_model');

  }

	public function index()
	{

		//$data = $this->base(__FUNCTION__);
		//$data['fields'] = $this->fields;
		//$this->load->view('layout', $data);
		echo $this->uri->segment(1);

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
						'title' => "Panel de control | ".$this->Main_model->get_project_data()->name,
						'reference' => strtoupper(TABLE.'-'.$action),
						'view' => strtolower (TABLE).'_'.$action,
						'page' => TABLE,
						'icono' => ICONO,
						'robots' => 'noindex, nofollow',
						'languages' => $this->Main_model->get_languages(),
						'js' => $this->load->view('js_module/js_module','',TRUE),
						'css' => $this->load->view('css_module/css_module',TRUE),
						'lang' => $this->lang,
						'main_lang' => $this->main_lang

					);


		switch ($action)
		{

			case 'index':

				$base['get_result'] = $this->$model->get_data(strtolower (TABLE));
				$base['tooltip'] = strtolower (substr(TABLE, 0, -1));
				$base['param'] = strtolower (TABLE);

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
