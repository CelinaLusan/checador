<?php
class Usuarios extends CI_Model { 
   
    public function insert($nombre,$apellido,$nombreUsuario,$password,$idRol,$idMoto){
		$pass=md5($password);
        $data = array(
           'nombre' => $nombre,
		   'apellido' => $apellido,
		   'nombreUsuario' => $nombreUsuario,
		   'password' => $pass,
		   'idRol' => $idRol,
		   'idMoto' => $idMoto          
        );

        $id = $this->db->insert('usuarios', $data);
        return $id;
    }
	
	public function get_usuario(){
		
		$consulta = $this->db->query('select * from usuarios where idRol=2');
		
		if($consulta->num_rows()>0){
			foreach ($consulta->result() as $row)
			$arrayUsuarios[htmlspecialchars($row->idUsuario, ENT_QUOTES)]=
			htmlspecialchars($row->nombre, ENT_QUOTES);
			$consulta->free_result();
			return $arrayUsuarios;
		}
        
    }

    public function get_usuarioCompleto(){
		
		$consulta = $this->db->query('select * from usuarios where idRol=2');
		
		if($consulta->num_rows()>0){	
			return $consulta->result();
		}
        
    }
	
	public function obtener_usuario($data){
			$this->db->select('*');
		    $this->db->where('idUsuario', $data);
		    $consulta = $this->db->get('usuarios');
		    return $consulta->row();
		}
		
	public function editarUsuarios($idUser,$nombre,$apellido,$nombreUsuario,$idMoto){
		
			$this->db->where('idUsuario',$idUser);
			$this->db->set('nombre',$nombre);
			$this->db->set('apellido',$apellido);
			$this->db->set('nombreUsuario',$nombreUsuario);
			$this->db->set('idMoto',$idMoto);
			
            return $this->db->update('usuarios');
	}
	
	public function eliminarUsuarios($idUsuario){
			
			$this->db->where('idUsuario',$idUsuario);
			return $this->db->delete('usuarios');
			
			
			//$this->db->where('idMoto',$idMoto);
            //return $this->db->update('motos', $dato);

		}
		
		public function busqueda($palabra){ 

			//$consulta = $this->db->query("select * from usuarios where nombre like '%". $palabra. "%' or apellido like '%".$palabra."%' or nombreUsuario like '%". $palabra. "% or idMoto like'%". $palabra."%'");
		$consulta = $this->db->query("select * from usuarios where nombre like '%". $palabra. "%' or nombreUsuario like '%".$palabra."%' ");

			if($consulta->num_rows()>0){
				return $consulta->result();
			}
			
		}
	
}