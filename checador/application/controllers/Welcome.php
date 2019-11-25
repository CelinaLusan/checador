<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public $usuarios_model;

	public function __construct(){
		parent::__construct();
		//Se cargan los modelos
		$this->load->model('Usuarios');		
	 }

	public function index()
	{
		$this->load->view('login');
	}

	public function insertdata()
	{	
		//recuperamos la información del formulario
		$nombre = $this->input->post('nombreEquipo');	
		
		//insertamos el nombre del nuevo equipo
		$id = $this->Equipo->insert($nombre);

		//validación
		$data['alert'] = 'alert-danger';
		$data['title'] = 'Error';
		$data['mensaje'] = 'Nombre de usuario o contraseña inválidos';
		
		if ( $id ) {
			$data['alert'] = 'alert-success';
			$data['title'] = 'Bien';
			$data['mensaje'] = 'Login correcto';			
		}

		$this->load->view('welcome_message',$data);
	}

	
}
