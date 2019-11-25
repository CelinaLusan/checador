<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
	
	public $usuarios_model;
	public $data;

	public function __construct(){
		parent::__construct();
		//Se cargan los modelos
		$this->load->model('Usuarios');
		$this->load->model('Roles');
		$this->load->model('Motos');	
			if(!$this->session->userdata('logueado')){
			 	redirect('login');
			}
			else{
				if($this->session->userdata('nombre') != "admin"){
					redirect('Salida');
				}
			}
	 }

	public function index()
	{
		$datos["arrayRoles"]=$this->Roles->getRoles();
		$datos["arrayMotos"]=$this->Motos->getMotos();
		$datos["arrayUsuarios"]=$this->Usuarios->get_usuarioCompleto();
		$this->load->view('agregarUsuarios',$datos);
	}
	
	public function editarUsuario(){
	
	if(!empty($_POST)){ 
		/*
		$data = array(
			'nombre' =>$_POST["marca"],
			'apellido' =>$_POST["placas"],
			'nombreUsuario' =>$_POST["nombreUsuario"],
			'idMoto' =>$_POST["idMoto"]
		);*/
		//echo $data;
		$id = $this->Usuarios->editarUsuarios($_POST["id"],$_POST["nombre"],$_POST["apellido"],$_POST["nombreUsuario"],$_POST["idMoto"]);
		
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
		/*$datos["arrayRoles"]=$this->Roles->getRoles();
		$datos["arrayMotos"]=$this->Motos->getMotos();
		$datos["arrayUsuarios"]=$this->Usuarios->get_usuarioCompleto();
		$this->load->view('agregarUsuarios',$datos);*/

		$ruta= base_url();
		$ruta= $ruta."index.php/Usuario";
		//echo $ruta;
		header("Location:".$ruta);
		
	}
	

	public function agregarUsuario()
	{	
		//recuperamos la información del formulario
		//echo $_POST['idMoto'];
		$idRol = $this->input->post('idRol');
		$idMoto = $this->input->post('idMoto');
		$apellido = $this->input->post('apellido');
		$nombre = $this->input->post('nombre');
		$nombreUsuario = $this->input->post('nombreUsuario');
		$password = $this->input->post('password');
		
		//insertamos datos del usuarrio
		$id = $this->Usuarios->insert($nombre,$apellido,$nombreUsuario,$password,$idRol,$idMoto);

		//validación
		$data['alert'] = 'alert-danger';
		$data['title'] = 'Error';
		$data['mensaje'] = 'Ocurrió un error al intentar agregar su usuario';
		
		if ( $id ) {
			$data['alert'] = 'alert-success';
			$data['title'] = 'Bien';
			$data['mensaje'] = 'Se agrego de manera satisfactoria';	
			$data["arrayRoles"]=$this->Roles->getRoles();
			$data["arrayMotos"]=$this->Motos->getMotos();
		}
		$data["arrayUsuarios"]=$this->Usuarios->get_usuarioCompleto();
		
		$this->load->view('agregarUsuarios',$data);
		
	}
	
		public function getUsuario()
		{
			$data["arrayMotos"]=$this->Motos->getMotosCompleto();
			$data["arrayGetUsuario"] = $this->Usuarios->obtener_usuario($_GET["id"]);
			echo json_encode( array('arrayMotos' => $data["arrayMotos"],'arrayGetUsuario' => $data["arrayGetUsuario"]));
			
		}
	
	public function eliminarUsuario(){
			
	$id = $this->Usuarios->eliminarUsuarios($_GET["id"]);
			
			//validación
		$data['alert'] = 'alert-danger';
		$data['title'] = 'Error';
		$data['mensaje'] = 'Ocurrió un error al intentar eliminar su moto';
		
		if ( $id ) {
			$data['alert'] = 'alert-success';
			$data['title'] = 'Bien';
			$data['mensaje'] = 'Se elimino de manera satisfactoria';	
		}
		
		$datos["arrayRoles"]=$this->Roles->getRoles();
		$datos["arrayMotos"]=$this->Motos->getMotos();
		$datos["arrayUsuarios"]=$this->Usuarios->get_usuarioCompleto();
		$this->load->view('agregarUsuarios',$datos);
		
			//echo "Exito";
	}
	
	public function buscar(){

			if(!empty($_POST)){
				$consulta = $this->Usuarios->busqueda($_POST["palabra"]);
				echo json_encode($consulta);
			}
			
		}
	
}
