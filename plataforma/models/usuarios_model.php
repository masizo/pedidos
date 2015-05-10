<?php
class Usuarios_model extends CI_Model{
	 
	function ValidarUsuario($userlogin,$password)
	{
		$query = $this->db->where('usuario',$userlogin);	//	La consulta se efectúa mediante Active Record. Una manera alternativa, y en lenguaje más sencillo, de generar las consultas Sql.
		$query = $this->db->where('password',$password);
		$query = $this->db->get('usuarios');
		return $query->row(); 	//	Devolvemos al controlador la fila que coincide con la búsqueda. (FALSE en caso que no existir coincidencias)
	}

	function comprobar($password)
	{
		$query = $this->db->where('password',$password);
		$query = $this->db->get('usuarios');
		return $query->row();
	}

    function galleta()
    {
      $this->load->library('encrypt');
      if(isset($_COOKIE['SIE_SESC'])){
      	$user = $this->encrypt->decode($_COOKIE['SIE_cook'], 'cat');
      	$pass = $this->encrypt->decode($_COOKIE['SIE_SESC'], 'cat');
        $galleta     = $this->ValidarUsuario(md5($user),md5($pass));
      	RETURN $galleta == TRUE ? TRUE : FALSE;
      }
      return FALSE;
    }

    function refresh()
    {
    	echo '<script languaje="javascript"> 
				alert("La sesion ha caducado por favor vuelva a logearse.");
				parent.location.reload();
		      </script>';
    } 	

    function devil_error()
    {
    	echo '<script languaje="javascript"> 
				alert("La contraseña introducida es incorrecta.");
		      </script>';    	
    }
}
?>