<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile  extends MX_Controller {

	private $lang = "";
	private $idAlumno = 0;
	private $alumno = null;

	public function __construct()
	{

    parent::__construct();
		//cargamos el helper para encriptar el pass en caso necesario
		$this->load->helper('MY_encrypt_helper');
		$this->lang = 'es';
		//almacenamos el id del usuario
		$this->idAlumno = $this->session->userdata('alumno');
		//almacenamos datos alumno
		$this->alumno = $this->doctrine->default->find("Entities\\Alumnos", $this->idAlumno);
		define("TABLE","Alumno");
  }

	public function index()
	{

		$data = $this->base(__FUNCTION__);
		//datos del alumno
		$data['idAlumno'] = $this->idAlumno;
		//id del alumno
		$data['alumno'] = $this->alumno;
		// si enviamos formulario
		if(isset($_POST['submitData']))
		{

			// validamos el email, este es obligatorio
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			// si cambiamos el pass realizamos unas validaciones
			if($this->input->post('pass'))
			{
				//comprobamos que la contraseña no es menor de 8 caracteres
				$this->form_validation->set_rules('pass', 'Contraseña', 'min_length[8]');
				//comprobamos que confirmar contraseña es igual a contraseña
				$this->form_validation->set_rules('repeatPass', 'Confirmar password', 'matches[pass]');
			}

			$this->form_validation->set_error_delimiters('<div role="alert" class="alert alert-danger">', '</div>');
			//si todo ha ido bien, entramos y actualizamos los datos
			if($this->form_validation->run())
			{
				$alumnoData = $this->doctrine->default->getRepository("Entities\\Alumnosdatos")->findOneBy(array("alumnos" => $this->alumno));
				$alumnoData->setEmail($this->input->post('email'));
    		$this->doctrine->default->flush();
				//si cambiamos el pass lo actualizamos
				if($this->input->post('pass'))
				{
					$alumno = $this->doctrine->default->getRepository("Entities\\Alumnos")->find($this->alumno);
					//encriotamos la contraseña y la almacenamos en una variable
					$pass = encode_string($this->input->post('pass'));
					$alumno->setPassword($pass);
	    		$this->doctrine->default->flush();

				}
			}
		}

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
						'robots' => 'noindex, nofollow',
						'js' => $this->load->view('js_module/js_module','',TRUE),
						'css' => $this->load->view('css_module/css_module',TRUE),

					);

		return $base;

	}
}
