<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {
	
	public $data;

	public function __construct(){
		parent::__construct();
		//Se cargan los modelos
		$this->load->model('Clientes');	

			if(!$this->session->userdata('logueado')){
			 	redirect('login');
			}else{
				if($this->session->userdata('nombre') != "admin"){
					redirect('Salida');
				}
			}	
	}

	public function index()
	{
		$datos["arrayClientes"]=$this->Clientes->getClientesCompleto();
		$this->load->view('agregarClientes',$datos);
	}
	
	public function getCliente()
		{
			
			$consulta = $this->Clientes->obtenerClientes($_GET["id"]);
			echo json_encode($consulta);
			
		}

	public function agregarCliente()
	{	
		//recuperamos la información del formulario
		//echo $_POST['idMoto'];
		$nombre = $this->input->post('nombre');
		$apellido = $this->input->post('apellido');
		$calle = $this->input->post('calle');
		$colonia = $this->input->post('colonia');
		$notas = $this->input->post('notas');
		
		//insertamos datos del usuarrio
		$id = $this->Clientes->insert($nombre,$apellido,$calle,$colonia,$notas);

		//validación
		$data['alert'] = 'alert-danger';
		$data['title'] = 'Error';
		$data['mensaje'] = 'Ocurrió un error al intentar agregar su usuario';
		
		if ( $id ) {
			$data['alert'] = 'alert-success';
			$data['title'] = 'Bien';
			$data['mensaje'] = 'Se agrego de manera satisfactoria';	
		}
		$data["arrayClientes"]=$this->Clientes->getClientesCompleto();
		

		//$this->load->view('agregarClientes',$data);
		$ruta= base_url();
		$ruta= $ruta."index.php/Cliente";
		//echo $ruta;
		header("Location:".$ruta);
		
	}

		public function buscar(){

			if(!empty($_POST)){
				$consulta = $this->Clientes->busqueda($_POST["palabra"]);
				echo json_encode($consulta);
			}
			
		}	

	public function eliminarCliente(){
			
	$id = $this->Clientes->eliminarClientes($_GET["id"]);
			
			//validación
		$data['alert'] = 'alert-danger';
		$data['title'] = 'Error';
		$data['mensaje'] = 'Ocurrió un error al intentar eliminar su moto';
		
		if ( $id ) {
			$data['alert'] = 'alert-success';
			$data['title'] = 'Bien';
			$data['mensaje'] = 'Se elimino de manera satisfactoria';	
		}
		
		$datos["arrayClientes"]=$this->Clientes->getClientesCompleto();
		$this->load->view('agregarClientes',$datos);
			//echo "Exito";
	}
	
	public function editarCliente(){
	
	if(!empty($_POST)){ 
		
		$data = array(
			'nombre' =>$_POST["nombre"],
			'apellido' =>$_POST["apellido"],
			'calle' =>$_POST["calle"],
			'notas' =>$_POST["notas"],
			'colonia' =>$_POST["colonia"]
		);
		//echo $data;
		$id = $this->Clientes->editarClientes($_POST["id"],$data);
		
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
	
	return;
		
	}
	
}
