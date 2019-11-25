<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salida extends CI_Controller {
	
	public $data;

	public function __construct(){
		parent::__construct();
		//Se cargan los modelos
		$this->load->model('Salidas');
		$this->load->model('Usuarios');
		$this->load->model('Roles');
		$this->load->model('Motos');
		$this->load->model('Clientes');
			if(!$this->session->userdata('logueado')){
			 	redirect('login');
			}	
			
	 }

	public function index()
	{
		$datos["arrayRoles"]=$this->Roles->getRoles();
		$datos["arrayMotos"]=$this->Motos->getMotos();
		$datos["arrayUsuarios"]=$this->Usuarios->get_usuario();
		$datos["arrayClientes"]=$this->Clientes->getClientes();
		$this->load->view('agregarSalida',$datos);
	}

	public function agregarSalida()
	{	
		//recuperamos la información del formulario
		//echo $_POST['idMoto'];
		$horaSalida = $this->input->post('horaSalida');
		$idChofer = $this->input->post('idChofer');
		$idMoto = $this->input->post('idMoto');
		$idCliente = $this->input->post('idCliente');
		$monto = $this->input->post('monto');
		$observaciones = $this->input->post('observaciones');
		
		//insertamos datos del usuarrio
		$id = $this->Salidas->insert($idCliente,$monto,$idChofer,$observaciones);

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
			$data["arrayUsuarios"]=$this->Usuarios->get_usuario();
			$data["arrayClientes"]=$this->Clientes->getClientes();
		}
		
		//$this->load->view('agregarSalida',$data);

		$ruta= base_url();
		$ruta= $ruta."index.php/Salida";
		//echo $ruta;
		header("Location:".$ruta);
		
	}
	

	
}
