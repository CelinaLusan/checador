<?php
class Motos extends CI_Model { 
   
    public function insert($marca,$placas){
        $data = array(
           'marca' => $marca,
		   'placas' => $placas       
        );

        $id = $this->db->insert('motos', $data);
        return $id;
    }
	
		public function getMotos(){
		$consulta = $this->db->query('select * from motos');
		
		if($consulta->num_rows()>0){
			foreach ($consulta->result() as $row)
			$arrayMotos[htmlspecialchars($row->idMoto, ENT_QUOTES)]=
			htmlspecialchars($row->marca, ENT_QUOTES);
			$consulta->free_result();
			return $arrayMotos;
		}
	}
		
	public function getMotosCompleto(){
		$consulta = $this->db->query('select * from motos');
		
		if($consulta->num_rows()>0){
			return $consulta->result();
		}
	
	}
	
		public function eliminarMotos($idMoto){
			
			$this->db->where('idMoto',$idMoto);
			return $this->db->delete('motos');
			
			
			//$this->db->where('idMoto',$idMoto);
            //return $this->db->update('motos', $dato);

		}
	
		public function editarMotos($id,$dato){
			$this->db->where('idMoto', $id);
            return $this->db->update('motos', $dato);
		}
		
		public function obtener_moto($data){
			$this->db->select('*');
		    $this->db->where('idMoto', $data);
		    $consulta = $this->db->get('motos');
		    return $consulta->row();
		}

		public function busqueda($palabra){ 

			$consulta = $this->db->query("select * from motos where marca like '%". $palabra. "%' or placas like '%".$palabra."%' ");
		
			if($consulta->num_rows()>0){
				return $consulta->result();
			}
			
		}
	
}