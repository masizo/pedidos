<?php
class Registro_model extends CI_Model{

function registro_usuario($nombre, $contra, $correo, $estado){
		$reg  = array(
		'nombre' => $nombre,
		'contra' => $contra,
		'correo' => $correo,
		'estado' => $estado
		 );
	return $this->db->insert('usuario',$reg);
}

function registro_tipouser($Tipouser1, $Tipouser2, $Tipouser3){
	// pendiente...  me parece ke habra un conflicto

	if($Tipouser1=='acceptar' && $Tipouser2=='acceptar'){
		return $this->db->insert('comprador',$id);
	}else if($Tipouser1=='acceptar'){
		return $this->db->insert('comprador',$id);
	}else if($Tipouser2=='acceptar'){
		return $this->db->insert('vendedor',$id);
	}else if($Tipouser3=='acceptar'){
		return $this->db->insert('colaborador',$id);
	}
}






}
?>