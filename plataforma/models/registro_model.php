<?php
class Registro_model extends CI_Model{

function registro_usuario($reg){
		$reg  = array(
		'nombre' => $nombre,
		'contra' => $contra,
		'correo' => $correo,
		'estado' => $estado
		 );
	return $this->db->insert('usuario',$reg);
}






}
?>