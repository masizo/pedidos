<?php
class Registro_model extends CI_Model{

function registro_usuario($nombre, $contra, $correo, $estado, $Tipouser1, $Tipouser2, $Tipouser3){
		$reg  = array(
		'nombre' => $nombre,
		'contra' => $contra,
		'correo' => $correo,
		'estado' => $estado
		 );

		$this->db->insert('usuario',$reg);
		$datid = $this->db->insert_id();

		$regcom = array('id_usuario' => $datid);
		$regven = array('id_usuario' => $datid);
		$regcol = array('id_usuario' => $datid);

		$tipocom = $Tipouser1;
		$tipoven = $Tipouser2;
		$tipocol = $Tipouser3;

		if ($tipocom == 'acceptar' && $tipoven == 'acceptar'){
			$this->db->insert('comprador',$regcom);
			$this->db->insert('vendedor',$regven);
		}else if($tipocom == 'acceptar'){
			$this->db->insert('comprador',$regcom);
		}else if ($tipoven == 'acceptar') {
			$this->db->insert('comprador',$regcven);
		}else if($tipocol == 'acceptar'){
			$this->db->insert('comprador',$regccol);
		}
		return;


}

/*  COKIE  */

function galleta(){
      $this->load->library('encrypt');
      if(isset($_COOKIE['SIE_SESC'])){
      	$user = $this->encrypt->decode($_COOKIE['SIE_cook'], 'cat');
      	$pass = $this->encrypt->decode($_COOKIE['SIE_SESC'], 'cat');
        $galleta     = $this->ValidarUsuario(md5($user),md5($pass));
      	RETURN $galleta == TRUE ? TRUE : FALSE;
      }
      return FALSE;
}
function ValidarUsuario($userlogin,$password){
		$query = $this->db->where('nombre',$userlogin);	//	La consulta se efectúa mediante Active Record. Una manera alternativa, y en lenguaje más sencillo, de generar las consultas Sql.
		$query = $this->db->where('contra',$password);
		$query = $this->db->get('usuario');
		return $query->row(); 	//	Devolvemos al controlador la fila que coincide con la búsqueda. (FALSE en caso que no existir coincidencias)
}


/*

INSERT INTO factura (id_factura, id_cliente) 

SELECT f.id_factura, c.nombre 
FROM factura f INNER JOIN cliente c ON f.id_cliente = c.id_cliente 


ERROR - 2015-05-18 06:42:26 --> Severity: Notice  --> Only variable references should be returned by reference C:\xampp\htdocs\pedidos\general\core\Common.php 257
ERROR - 2015-05-18 06:42:26 --> Severity: 8192  --> mysql_pconnect(): The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead C:\xampp\htdocs\pedidos\general\database\drivers\mysql\mysql_driver.php 91
*/


}
?>