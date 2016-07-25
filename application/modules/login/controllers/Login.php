<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login  extends MX_Controller
{

	private $user_exist = '';
	private $lang = "";

	public function __construct()
	{
		parent::__construct();
		$this->user_exist = FALSE;
		$this->lang = 'es';
		$this->load->helper('MY_encrypt_helper');
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
						//'js' => $this->load->view('js_module/js_module','',TRUE),
						//'css' => $this->load->view('css_module/css_module',TRUE),
						'lang' => $this->lang,

					);
		$this->load->view('layout', $data);
	}

	public function login()
	{

		if(isset($_POST['submit']))
		{
			//Validamos los datos
			$this->form_validation->set_rules('login', 'usuario', 'required');
			$this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[8]');
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');


			if($this->form_validation->run() == TRUE)
			{
				//Recuperamos todos los usuarios
				$users = $this->doctrine->em->getRepository("Entities\\Usuarios")->findAll();
				//Almacenamos el pass
				$code = $this->input->post('password');

				//Recorremos todos los usuarios buscando una coincidencia
				foreach ($users as $key => $user)
				{
					//Si el usuario existe entramos y $user_exist almacena el insurancecode
					if(password_verify($code, $user->getInsurancecode()))
						$this->user_exist = $user->getInsurancecode();
				}

				//Si el usuario no existe lanzamos un error
				if($this->user_exist == FALSE)
				{
					$data['error'] = '<div class="alert alert-danger">usuario o contraseña incorrectos.</div>';

				}else
				{
					//Si todo ha ido bien, almacenasmo el insurancecode y genermos la sesión
					$sesion_data['insurance'] = $this->user_exist;
					$this->session->set_userdata($sesion_data);

					$lng = '';//Esta variable almacena el idioma principal de la interfaz

					if(count($this->Main_model->get_languages() > 1))
		   			{
		   				foreach ($this->Main_model->get_languages() as $key => $value)
		   				{
							   if($value->id == 1)
							   {
							   		$lng = $value->iso_language;
							   }
						}
		   			}

					//redireccionamos al panel de control, podemos configurar la ruta y redireccionar
					//al usuario al controlador que necesitemos
					redirect($lng.'/paginas');
				}
			}
		}

		if(isset($data))
		{
			$this->load->view('login',$data);

		}else
		{
			$this->load->view('login');
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
