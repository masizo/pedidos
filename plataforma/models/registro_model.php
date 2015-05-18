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
/* 	
function registro_tipouser($datid){
	$idmax  = array(
		'id_usuario' => $datid,
		
	return $this->db->insert('comprador',$idmax);
	
}

function registro_tipouser2($datid){
	$idmax  = array(
		'id_usuario' => $datid,
	
	return $this->db->insert('vendedor',$idmax);
	
}

function registro_tipouser3($datid){
	$idmax  = array(
		'id_usuario' => $datid,
	
	return $this->db->insert('colaborador',$idmax);
	
}

/*
ERROR - 2015-05-18 06:42:26 --> Severity: Notice  --> Only variable references should be returned by reference C:\xampp\htdocs\pedidos\general\core\Common.php 257
ERROR - 2015-05-18 06:42:26 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead C:\xampp\htdocs\pedidos\general\database\drivers\mysql\mysql_driver.php 91
*/


}
?>