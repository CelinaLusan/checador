<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Llegada extends CI_Controller { 
	
	public $registros_model;
	public $data;

	public function __construct(){
		parent::__construct();
		//Se cargan los modelos
		$this->load->model('Usuarios');
		$this->load->model('Salidas');

			if(!$this->session->userdata('logueado')){
			 	redirect('login');
			}			
	 }

	public function index()
	{
		$idUsuario=$this->session->userdata('id'); //se le manda como parameto el nombre de usuario para que muestre solamente pueda registrar las llegadas que le corresponden a su usuario

		$datos["arrayRegistros"]=$this->Salidas->getRegistrosUsuarios($idUsuario);
		$datos["arrayUsuarios"]=$this->Usuarios->get_usuario();
		
		$this->load->view('agregarLlegada',$datos);
	}

	public function agregarLlegada()
	{	
		//recuperamos la información del formulario
		//echo $_POST['idMoto'];
		$idRegistro = $this->input->post('idRegistro');
		$horaLlegada = $this->input->post('horaLlegada');
		$estatus = 0;
		$idUsuario=$this->session->userdata('id'); 
		
		//insertamos datos del usuario
		$id = $this->Salidas->updateRegistros($estatus,$idRegistro);

		//validación
		$data['alert'] = 'alert-danger';
		$data['title'] = 'Error';
		$data['mensaje'] = 'Ocurrió un error al intentar agregar su usuario';
		
		if ( $id ) {
			$data['alert'] = 'alert-success';
			$data['title'] = 'Bien';
			$data['mensaje'] = 'Se agrego de manera satisfactoria';	
			$data["arrayRegistros"]=$this->Salidas->getRegistrosUsuarios($idUsuario);
			$data["arrayUsuarios"]=$this->Usuarios->get_usuario();
		}
		
		//$this->load->view('agregarLlegada',$data);

		$ruta= base_url();
		$ruta= $ruta."index.php/Llegada";
		//echo $ruta;
		header("Location:".$ruta);
		
	}
	

	
}
