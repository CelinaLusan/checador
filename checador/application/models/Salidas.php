<?php
class Salidas extends CI_Model { 
   
    public function insert($idCliente,$monto,$idChofer,$observaciones){
        $data = array(
           'clienteDestino' => $idCliente,
		   'monto' => $monto,
		   	'chofer' => $idChofer,
		   'observaciones' => $observaciones,
		'estatus' => 1  
        );

        $id = $this->db->insert('registros', $data);
        return $id;
    }

    public function getRegistros(){
		$consulta = $this->db->query('select * from registros where estatus=1');
		
		if($consulta->num_rows()>0){
			foreach ($consulta->result() as $row)
			$arrayRegistros[htmlspecialchars($row->idRegistro, ENT_QUOTES)]=
			htmlspecialchars($row->horaSalida, ENT_QUOTES);
			$consulta->free_result();
			return $arrayRegistros;
		}
	}
	 
	
	public function getRegistrosUsuarios($idUsuario){

		$consulta =  $this->db->select('usuarios.*,registros.*');
		$consulta =  $this->db->from('usuarios');
		$consulta = $this->db->join('registros','registros.chofer=usuarios.idUsuario and estatus=1');
		$consulta = $this->db->where('usuarios.idUsuario',$idUsuario); //solo extrae las salidas que le corresponden al usuario logueado
		$consulta = $this->db->get();
		
		if($consulta->num_rows()>0){
			foreach ($consulta->result() as $row)
			$arrayRegistros[htmlspecialchars($row->idRegistro, ENT_QUOTES)]=$row->nombre."  -  ".$row->horaSalida;
			$consulta->free_result();
			return $arrayRegistros;
		}

	}
	
	public function updateRegistros($estatus,$idRegistro){
	
	$query = $this->db->query("UPDATE registros SET horaLlegada=now(), estatus='".$estatus. "' WHERE idRegistro=".$idRegistro);
		//UPDATE `checador`.`registros` SET `horaLlegada` = '0000-00-00 00:00:03' WHERE `registros`.`idRegistro` = 3;
		return $query;
	
	}
	
	
}