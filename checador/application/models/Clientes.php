<?php
class Clientes extends CI_Model { 
   
    public function insert($nombre,$apellido,$calle,$colonia,$notas){
        $data = array(
           'nombre' => $nombre,
		   'apellido' => $apellido,
		   'calle' => $calle,
		   'colonia' =>$colonia,
		   'notas' => $notas        
        );

        $id = $this->db->insert('clientes', $data);
        return $id;
    }
	
	public function getClientes(){
		$consulta = $this->db->query('select * from clientes');
		
		if($consulta->num_rows()>0){
			foreach ($consulta->result() as $row)
			$arrayClientes[htmlspecialchars($row->idCliente, ENT_QUOTES)]=
			htmlspecialchars($row->nombre, ENT_QUOTES);
			$consulta->free_result();
			return $arrayClientes;
		}
	}

	public function getClientesCompleto(){
		$consulta = $this->db->query('select * from clientes');
		
		if($consulta->num_rows()>0){
			return $consulta->result();
		}
	}

	public function eliminarClientes($idCliente){
			
			$this->db->where('idCliente',$idCliente);
			return $this->db->delete('clientes');
			
			//$this->db->where('idCliente',$idCliente);
            //return $this->db->update('clientes', $dato);

	}
	
	
	public function editarClientes($idCliente,$datos){
		
			$this->db->where('idCliente',$idCliente);
            return $this->db->update('clientes', $datos);
		
	}


		public function busqueda($palabra){ 

			$consulta = $this->db->query("select * from clientes where nombre like '%". $palabra. "%' or notas like '%".$palabra."%' ");

			if($consulta->num_rows()>0){
				return $consulta->result();
			}
			
		}
		
		public function obtenerClientes($id){
			$this->db->select('*');
		    $this->db->where('idCliente', $id);
		    $consulta = $this->db->get('clientes');
		    return $consulta->row();
		}
	
}