<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Moto extends CI_Controller {
	
	public $motos_model;
	public $data;

	public function __construct(){
		parent::__construct();
		
			if(!$this->session->userdata('logueado')){
			 	redirect('login');
			}else{
				if($this->session->userdata('nombre') != "admin"){
					redirect('Salida');
				}
			}
		//Se cargan los modelos
		$this->load->model('Motos');		
	 }

	public function index()
	{
		$datos["arrayMotos"]=$this->Motos->getMotosCompleto();
	
		$this->load->view('agregarMotos',$datos);
	}

	public function agregarMoto()
	{	
		//recuperamos la información del formulario
		//echo $_POST['idMoto'];
		$marca = $this->input->post('marca');
		$placas = $this->input->post('placas');
		
		//insertamos datos del usuarrio
		$id = $this->Motos->insert($marca,$placas);

		//validación
		$data['alert'] = 'alert-danger';
		$data['title'] = 'Error';
		$data['mensaje'] = 'Ocurrió un error al intentar agregar su usuario';
		
		if ( $id ) {
			$data['alert'] = 'alert-success';
			$data['title'] = 'Bien';
			$data['mensaje'] = 'Se agrego de manera satisfactoria';	
		}
		//$data["arrayMotos"]=$this->Motos->getMotosCompleto();
		//$this->load->view('agregarMotos',$data);
		$ruta= base_url();
		$ruta= $ruta."index.php/Moto";
		//echo $ruta;
		header("Location:".$ruta);
		
	}
	
	public function eliminarMoto(){
			
	$id = $this->Motos->eliminarMotos($_GET["id"]);
			
			//validación
		$data['alert'] = 'alert-danger';
		$data['title'] = 'Error';
		$data['mensaje'] = 'Ocurrió un error al intentar eliminar su moto';
		
		if ( $id ) {
			$data['alert'] = 'alert-success';
			$data['title'] = 'Bien';
			$data['mensaje'] = 'Se elimino de manera satisfactoria';	
		}
		$data["arrayMotos"]=$this->Motos->getMotosCompleto();
		
		$this->load->view('agregarMotos',$data);
		
			//echo "Exito";
	}
	 
	public function editarMoto(){
	
	if(!empty($_POST)){ 
		$data = array(
			'marca' =>$_POST["marca"],
			'placas' =>$_POST["placas"]
		);
		//echo $data;
		$id = $this->Motos->editarMotos($_POST["id"],$data);
		
		//validación
		$data['alert'] = 'alert-danger';
		$data['title'] = 'Error';
		$data['mensaje'] = 'Ocurrió un error al intentar editar datos';
		
		if ( $id ) {
			$data['alert'] = 'alert-success';
			$data['title'] = 'Bien';
			$data['mensaje'] = 'Se elimino de manera satisfactoria';	
		}
	}
		$data["arrayMotos"]=$this->Motos->getMotosCompleto();
		$this->load->view('agregarMotos',$data);
		
	}
	
		public function getMoto()
		{
			$consulta = $this->Motos->obtener_moto($_GET["id"]);
			echo json_encode($consulta);
		}

		public function buscar(){

			if(!empty($_POST)){
				$consulta = $this->Motos->busqueda($_POST["palabra"]);
				echo json_encode($consulta);
			}
			
		}
	
}
