<?php

//session_start();

	class LoginUsers extends CI_Controller {
	public $data;
		public function __construct()
		 {
		 parent::__construct();
			$this->load->model('Login');
			//$this->load->library('session');
		 
		 }

		public function index()
		{
			$this->load->view('login');
		}

		public function iniciar_sesion(){
			
			$nombre = $this->input->post('nombre');
			$password = $this->input->post('password');
			
			$logueado = $this->Login->verificaUsuario($nombre,$password);
			
			if($logueado){
				//echo $logueado->idUsuario;
				//echo $logueado->nombreUsuario;
				
				$usuario_data = array(
	               'id' => $logueado->idUsuario,
	               'nombre' => $logueado->nombreUsuario,
	               'logueado' => TRUE
            	);
            	$this->session->set_userdata($usuario_data);
            	
			    //$p=$this->session->userdata('nombre');
			    //header('Location: ' . "logueado");
      			//die();
      			
			    redirect('Salida'); // redirige a la pagina principal para registrar las salidas correspondientes
			    echo "true";
			}else{
				//$p="no";
				//$this->load->helper('url');
				//redirect('login');
				//header('Location:');  
					//validación
		$data['alert'] = 'alert-danger';
		$data['title'] = 'Error';
		$data['mensaje'] = 'Nombre de usuario o contraseña inválidos';
		$this->load->view('login',$data);
				
			}
		
		}

		public function cerrar_sesion(){
			
			/*$usuario_data = array(
				'id' => '',
	            'nombre' => '',
         		'logueado' => FALSE
		    );
		      	$this->session->unset_userdata($usuario_data);*/
		      	$this->session->sess_destroy();
		      	$this->load->view('login');
		}
	}
?>