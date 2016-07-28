<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller
{

	private $user_exist = '';
	private $lang = '';

	public function __construct()
	{
		parent::__construct();
		$this->user_exist = FALSE;
		$this->lang = 'es';
		$this->load->helper('MY_encrypt_helper');
		$this->load->library('session');
		define("TABLE","Alumnos");
	}

	public function index()
	{

		$data = array(

						'lang' => $this->lang,
						'title' => "Acceso Alumnos | ",
						'reference' => strtoupper(TABLE),
						'view' => strtolower (TABLE).'_login',
						'robots' => 'noindex, nofollow',
						'js' => $this->load->view('js_module/js_module','',TRUE),
						'css' => $this->load->view('css_module/css_module',TRUE),
						'lang' => $this->lang,
						'errors' => FALSE

					);

		if (isset($_POST['submit-login']))
		{
				$email = $this->input->post('email');
				$password = $this->input->post('password');
			 	$data['errors'] = $this->getAlumno($email,$password);
		 }

		$this->load->view('layout', $data);
	}

	private function getAlumno($email,$password)
	{
		//Validamos los datos
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[8]');
		$this->form_validation->set_error_delimiters('<div style="font-size: 17px;text-align: center;line-height: 1.5em;color:white;">', '</div>');

		if($this->form_validation->run() == TRUE)
		{
			//consultamos en la base de datos si existe el usuario
			$alumno = $this->doctrine->default->getRepository("Entities\\".TABLE."datos")->findOneBy(["email" => $email]);
			//Si existe un usuario con ese email entramos
			if ($alumno != null)
			{
				//comprobamos la contraseña, y si esw correcta lamacenamos el id en @user_exist
				if(password_verify($password, $alumno->getAlumnos()->getPassword()))
					$this->user_exist = $alumno->getAlumnos()->getID();

				if($this->user_exist)
				{
					//Si todo ha ido bien, genermos la sesión
					$session_data = array(
                   'alumno'  => $this->user_exist,
                   'logged_in' => TRUE
               );

					$this->session->set_userdata($session_data);
					redirect('home');

				}else
				{
					//lanzamos un error si el pass no es correcto.
					return '<div style="font-size: 17px;text-align: center;line-height: 1.5em;color:white;">La contraseña que has introducido no es correcta.</div>';
				}

			}else
			{
				//lanzamos un error si el usuario no existe.
				return '<div style="font-size: 17px;text-align: center;line-height: 1.5em;color:white;">El alumno con el que intentas acceder no existe.</div>';
			}

		}else
		{
			return validation_errors();
		}

	}

	public function new_pass()
	{
		if($this->input->is_ajax_request())
		{

			$email = $this->input->post('email');

			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

			if($email != '')
			{
				if(filter_var($email, FILTER_VALIDATE_EMAIL))
				{

					if($id_user = $this->Login_model->exist_email($email))
					{
						$long = 12;
	            		$pass = substr(MD5(rand(5, 100)), 0, $long);
						$pass_encode = encode_string($email,$pass);
						$this->Login_model->update_pass($id_user,$pass_encode[0]);

						$this->load->library('email');

						$config = array(
							'protocol' => 'smtp',
							'smtp_host' => 'smtp.dugage.com',
							'smtp_port' => 578,
							'smtp_user' => 'benjamin.garcia@dugage.com',
							'smtp_pass' => 'Andalucia1978',
							'mailtype' => 'html',
							'charset' => 'utf-8',
							'newline' => "\r\n"
						);

						$this->email->initialize($config);

						$this->email->from('noreply', 'Dugage | CMS');
						$this->email->to($email);

						$this->email->subject('Recuperar acceso al panel de administración');
						$this->email->message('Esta es tu nueva contraseña: '.$pass);

						if (!$this->email->send())
						{
						    echo '<div class="alert alert-danger">Parece que tenemos problemas con el servidor de correo, por favor intentalo más tarde.</div>';
							//echo $pass;
						}else
						{
							echo '<div class="alert alert-success">Se ha enviado una nueva contraseña a tu correo.</div>';
						}

					}else
					{
						echo '<div class="alert alert-danger">La dirección de email no consta en nuestra base de datos.</div>';
					}

				}else
				{
					echo '<div class="alert alert-danger">La dirección de email no es válida.</div>';
				}

			}else
			{
				echo '<div class="alert alert-danger">El campo email no puede estar vacío.</div>';
			}

		}else
		{

			show_404();

		}
	}

	public function logout()
	{
		$this->session->unset_userdata($sesion_data);
		$this->session->sess_destroy();
		redirect(site_url());
	}

}
