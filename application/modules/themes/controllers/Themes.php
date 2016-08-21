<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Themes  extends MX_Controller {

	private $lang = "";
	private $idTemas = array();

	public function __construct()
	{

    parent::__construct();
		$this->lang = 'es';
		// almacenamos en formato array los temas asociados
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
			//pasamos el menú
			$tree['tree'] = $this->tree($id);
			$data = $this->base(__FUNCTION__,$tree);
			//Obtenemos los datos del tema
			$tema = $this->doctrine->academy->find("Entities\\Temas", $id);
			$data['id'] = $id;
			//pasamos el título para el nav_top, en este caso el título del tema
			$data['titleNavtop'] = $tema->getTitletheme();
			//Obtenemos los capítulos que pertenecen al tema
			$data['capitulos'] = $this->doctrine->academy->getRepository("Entities\\Capitulos")->findBy(array("id_theme" => $id,"join_theme_part" => 0));

			$this->load->view('layout', $data);

		}else{

			show_404();
		}

 	}

	public function chapter($idT = 0,$idC = 0)
	{

		if($idT > 0 AND $idC > 0)
		{
			//pasamos el menú
			$tree['tree'] = $this->tree($id);
			$data = $this->base(__FUNCTION__,$tree);
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

	//dibuja el menu para los temas
	private function tree($id, $join = 0)
	{

		$chap = $this->doctrine->academy->getRepository("Entities\\Capitulos")->findBy(array("id_theme" => $id,"join_theme_part" => $join));
		$tree = "";

		if($chap != null)
		{
			foreach ($chap as $key => $value)
			{
				$tree .= "{";
				$tree .= "text: '".$value->getTitlethemeparts()."',";
				$tree .= "href: '#parent1',";

				if($chap_ = $this->tree($id,$value->getIdthemeparts()) != null)
				{
					$tree .= "tags: ['".count($chap_)."'],";
					$tree .= "nodes: [";
					$tree .= $this->tree($id,$value->getIdthemeparts());
					$tree .= "]";

				}else
				{
					$tree .= "tags: ['0'],";
				}

				$tree .= "},";
			}

			return $tree;

		}else
		{
			return null;
		}

	}

	//Base para los metodos.
	private function base($action = null,$tree = null)
	{

		$model = TABLE.'_model';//Nombre del modelo

		$base = array(
						'lang' => $this->lang,
						'title' => "Panel de control | ",
						'reference' => strtoupper(TABLE.'-'.$action),
						'view' => strtolower (TABLE).'_'.$action,
						'page' => TABLE,
						'robots' => 'noindex, nofollow',
						'js' => $this->load->view('js_module/js_module',$tree,TRUE),
						'css' => $this->load->view('css_module/css_module',TRUE),
					);

		return $base;

	}
}
