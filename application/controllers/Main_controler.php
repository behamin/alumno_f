<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_controler extends CI_Controller {

	/**
	 Todas las funciones para que las acciones principales de ajax interactuen con la base de datos
	 */

	public function __construct()
	{

  	parent::__construct();

  }

	public function update_ajax()
	{
		if($this->input->is_ajax_request())
		{
			/*
			*@field campo al que atacamos
			*@table campo al que atacamos
			*@valor para actualizar
			*@id id concreto el cual vamos actualizar
			*@method metodo de la entidad que vamos a utilizar
			*@entitie Entidad que vamos a consultar
			*/
			$field = $this->input->post('field');
			$table = $this->input->post('table');
			$vl = $this->input->post('vl');
			$id = $this->input->post('id');
			$lang = $this->input->post('lang');//idioma, se utiliza si es necesario
			$method = 'set'.ucwords($this->input->post('field'));//

			try{

				$entitie = $this->doctrine->em->find("Entities\\".$table."", $id);
				$entitie->$method($vl);
				$this->doctrine->em->flush();

			}catch(OptimisticLockException $e){

					return FALSE;
			}

		}
		else
		{
			show_404();
		}
	}

	public function upload_attachment()
	{
		$param = $this->input->post('param');
		$param = explode(',',$param);

		$config['upload_path'] = 'assets/'.$param[7];
		$config['allowed_types'] = '*';
		$config['max_size'] = $param[6];
		$config['max_width'] = $param[4];
		$config['max_height'] = $param[5];
		$config['overwrite'] = FALSE;

		$this->load->library('upload');
		$this->upload->initialize($config);

		if($this->upload->do_upload($param[7]))
		{

			$data_image = $this->upload->data();
			$upload_data = array(

								'upload' => 1,
		           	'res' => $data_image['file_name'],
		        );
 			$attachment = $this->doctrine->default->getRepository("Entities\\".$param[1]."")->findOneBy([$param[0] => $param[3]]);
			$method = 'set'.$param[2];
			$attachment->$method($upload_data['res']);
			$this->doctrine->default->flush();

		}else
		{

			$upload_data = array(

							'upload' => 0,
		      		'res' => $this->upload->display_errors('<div class="alert alert-danger" role="alert">', '</div>'),
		        );
		}

		redirect($param[8].'/?upl='.$upload_data['upload']);

	}

}
