<?php
class Login extends CI_Model {

	public function __construct(){
		parent::__construct();
		
		//Se cargan los modelos
		$this->load->database();		
	 }
	 
	 public function verificaUsuario($nombreUsuario,$password){
		 
		// echo $nombreUsuario;
		 //echo $password;
		 
		 //$query['nombreUsuario']=$nombreUsuario;
		$pass=md5($password);
		//$query = $this->db->query("SELECT * FROM usuarios WHERE nombreUsuario='".$nombreUsuario."' and password='".$pass."'and idRol=1");
		$query = $this->db->query("SELECT * FROM usuarios WHERE nombreUsuario='".$nombreUsuario."' and password='".$pass."'");
		
		 //$query=$this->db->get_where('usuarios',array('nombreUsuario' => $nombreUsuario,'password' => $password));
		if($query->num_rows()>0){
			return $query->row();
		}else{
			return ;
		}
		
		//
		// return $this->db->get_where('usuarios',$query->row());
		 
	 }
	 
   
    public function insert($nombre,$apellido,$nombreUsuario,$password,$idRol,$idMoto){
        $data = array(
           'nombre' => $nombre,
		   'apellido' => $apellido,
		   'nombreUsuario' => $nombreUsuario,
		   'password' => $password,
		   'idRol' => $idRol,
		   'idMoto' => $idMoto          
        );

        $id = $this->db->insert('usuarios', $data);
        return $id;
    }
	
	public function get_usuario($nombre,$password){
        $data = array(
           'nombre' => $nombre,
		   'apellido' => $apellido,
		   'nombreUsuario' => $nombreUsuario,
		   'password' => $password,
		   'idRol' => $idRol,
		   'idMoto' => $idMoto          
        );

        $id = $this->db->insert('usuarios', $data);
        return $id;
    }
	
}