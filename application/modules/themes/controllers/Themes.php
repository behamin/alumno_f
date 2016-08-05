<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Themes  extends MX_Controller {

	private $lang = "";
	private $idTemas = array();

	public function __construct()
	{

    parent::__construct();
		$this->lang = 'es';
		// almacenamos en formato array los cursos asociados
		$this->idTemas = explode(',',$this->session->userdata('idThemes'));
		define("TABLE","Themes");
  }

	public function index()
	{

		$data = $this->base(__FUNCTION__);

		//almacenamos los temas del alumno
		$data['temas'] = array();
		foreach ($this->idTemas as $key => $value)
		{
				$data['temas'][$key] = $this->doctrine->academy->find("Entities\\Temas", $value);
		}

		$this->load->view('layout', $data);

 	}

	public function theme($id = 0)
	{
		//si el id del tema es mayor de 0 cargamos los datos del tema y sus capítulos, si no show 404
		if($id > 0)
		{

			$data = $this->base(__FUNCTION__);
			//Obtenemos los datos del tema
			$tema = $this->doctrine->academy->find("Entities\\Temas", $id);
			$data['id'] = $id;
			//pasamos el título para el nav_top, en este caso el título del tema
			$data['titleNavtop'] = $tema->getTitletheme();
			//Obtenemos los capítulos que pertenecen al tema
			$data['capitulos'] = $this->doctrine->academy->getRepository("Entities\\Capitulos")->findBy(array("id_theme" => $id));

			$this->load->view('layout', $data);

		}else{

			show_404();
		}

 	}

	public function chapter($idT = 0,$idC = 0)
	{

		if($idT > 0 AND $idC > 0)
		{

			$data = $this->base(__FUNCTION__);
			//Obtenemos los datos del tema
			$tema = $this->doctrine->academy->find("Entities\\Temas", $idT);
			//pasamos el título para el nav_top, en este caso el título del tema
			$data['titleNavtop'] = $tema->getTitletheme();
			//Obtenemos los datos del capítulo
			$data['capitulo'] = $this->doctrine->academy->getRepository("Entities\\Capitulos")->findOneBy(array("id_theme" => $idT,"id_theme_parts" => $idC));

			$this->load->view('layout', $data);


		}else{

			show_404();

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
