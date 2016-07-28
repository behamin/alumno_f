<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Themes  extends MX_Controller {

	private $lang = "";

	public function __construct()
	{

    parent::__construct();
		$this->lang = 'es';
		define("ICONO","fa fa-file-text-o");
		define("TABLE","Themes");
  }

	public function index()
	{

		$data = $this->base(__FUNCTION__);
		$this->load->view('layout', $data);

 	}

	public function theme()
	{

		$data = $this->base(__FUNCTION__);
		$this->load->view('layout', $data);

 	}

	public function chapter()
	{

		$data = $this->base(__FUNCTION__);
		$this->load->view('layout', $data);

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
						'icono' => ICONO,
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
