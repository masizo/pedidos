<?php
class Php extends CI_Controller {

    function __construct()
	{
	    parent::__construct();
		$this->load->library('grocery_CRUD');
		$this->load->library('grocery_CRUD_extended');
		$this->load->model('usuarios_model');
		$this->load->library('encrypt');
		$this->load->library('iquez_lib');
   	}

	function index()
	{
		if($this->usuarios_model->galleta() != FALSE){
			$this->usuarios_model->galleta() == 1 ? $this->sistema() : $this->usuarios(); 
		}else{
			$this->login();
        }
	}

    function sistema(){
	   if($this->usuarios_model->galleta() != FALSE){
	        $this->usuarios_model->galleta() == 1 ? $this->load->view('sistema') : $this->usuarios();
	   }else{
	       	redirect(base_url());
	      }	   
	}

	function usuarios(){
	   if($this->usuarios_model->galleta() != FALSE){
	        $this->usuarios_model->galleta() == 2 ? $this->load->view('sistema_usuario') : $this->sistema();
	   }else{
	       	redirect(base_url());
	      }	   
	}

	function login()
	{
	 if($this->usuarios_model->galleta() == FALSE){
        setcookie("SIE_cook", "", time() + 0, "/");
		setcookie("SIE_SESC", "", time() + 0, "/"); 		
		setcookie("conf_det", '', time() + 0, "/");
		if(!isset($_POST['userlogin'])){	
			$this->load->view('login');			
		}else{								
			$this->form_validation->set_rules('userlogin','usuario','required|min_length[6]|max_length[12]');
			$this->form_validation->set_rules('passwordlogin','contraseña','required|min_length[8]|max_length[15]');
			if(($this->form_validation->run()==FALSE)){				
				$this->load->view('login');
			}
			else{
				$passwordlogin = $_POST['passwordlogin'];
				$userlogin = $_POST['userlogin'];
				$user = $this->encrypt->encode($userlogin, 'hashcat');
				$pass = $this->encrypt->encode($passwordlogin, 'hashcat');
				$ExisteUsuarioyPassword = $this->usuarios_model->ValidarUsuario(md5($userlogin),md5($passwordlogin));
				$ExisteCliente = $this->usuarios_model->ValidarCliente($userlogin,md5($passwordlogin));
				if($ExisteUsuarioyPassword == TRUE){
                    setcookie("SIE_cook", $user, time() + 86400, "/");
        			setcookie("SIE_SESC", $pass, time() + 86400, "/"); 
        			setcookie("conf_det", '1', time() + 86400, "/");
        			redirect(base_url());           				    
				}if($ExisteCliente == TRUE){
                    setcookie("SIE_cook", $user, time() + 86400, "/");
        			setcookie("SIE_SESC", $pass, time() + 86400, "/"); 
        			setcookie("conf_det", '1', time() + 86400, "/");
        			redirect(base_url());
				}else{
					$data['error']="usuario o contraseña incorrecta, vuelva a intentar";					
					$this->load->view('login',$data);					
				}
			}
		}
	 }else{
	  redirect(base_url());
	 }     
    }

	function control_usuarios()
	{		
			$accion = base_url("assets/uploads/general/user_unlock.png");    
			$crud = new grocery_CRUD_extended();
			$crud->set_table('usuarios');
			$crud->columns('username','password','nombre','email');
			$crud->add_fields('username','password','cfpass','nombre','email');
            $crud->add_action('Cambiar password', $accion,'php/cambiar_pass/edit');
			$crud->edit_fields('username','nombre','email');
			$crud->unset_export();
			$crud->unset_print();
			$crud->field_type('password', 'password');
			$crud->field_type('cfpass', 'password');				
			$crud->required_fields('username','password','cfpass','email');
			$crud->unique_fields('username');
			$crud->set_rules('username', 'Usuario', 'required|min_length[6]|max_length[15]');
			$crud->set_rules('password', 'Password', 'required|min_length[8]|max_length[15]');
			$crud->set_rules('cfpass', 'Confirmar Password', 'required|min_length[8]|max_length[15]|matches[password]');			
			$crud->set_rules('nombre', 'Nombre', 'max_length[30]');
			$crud->set_rules('email', 'email', 'required|valid_email');
			$crud->display_as('username','Usuario');
			$crud->display_as('password','Password');
			$crud->display_as('cfpass', 'Confirmar Password');
			$crud->display_as('nombre','Nombre del Usuario');
			$crud->set_subject('usuarios');
			$crud->callback_before_insert(array($this,'encrypt_password'));
			$output = $crud->render();
			if($this->usuarios_model->galleta() != FALSE){
			  $this->usuarios_model->galleta() == 1 ? $this->load->view('panel_view',$output) : redirect(base_url());
			}else{
			  $this->usuarios_model->refresh();
			 }			
	}

	function cambiar_pass($id)
	{					
			$crud = new grocery_CRUD_extended();
			$crud->set_table('usuarios');
			$crud->unset_list();
			$crud->unset_add();
			$crud->unset_back_to_list();
			$crud->edit_fields('username','password_adm','password','cfpass');
			$crud->field_type('password_adm', 'password');
			$crud->field_type('password', 'password');
			$crud->field_type('cfpass', 'password');
			$crud->required_fields('password_adm','password','cfpass');
			$crud->set_rules('password_adm', 'Password', 'required|min_length[8]|max_length[15]');
			$crud->set_rules('password', 'Nuevo Password', 'required|min_length[8]|max_length[15]');
			$crud->set_rules('cfpass', 'Confirmar Password', 'required|min_length[8]|max_length[15]|matches[password]');			
			$crud->display_as('username','Usuario');
			$crud->display_as('password_adm','Password de Administrador');
			$crud->display_as('password','Nuevo Password');
			$crud->display_as('cfpass', 'Confirmar Password');
			$crud->set_subject('Password');
			$crud->callback_edit_field('username',array($this,'edit_field_callback_4'));	
			$crud->callback_edit_field('password',array($this,'edit_field_callback_1'));	
			$crud->callback_before_update(array($this,'edit_password'));
			$output = $crud->render();
			if($this->usuarios_model->galleta() != FALSE){
			   $this->usuarios_model->galleta() == 1 ? $this->load->view('view_fancy',$output) : redirect(base_url());			     
			}else{
			  	$this->usuarios_model->refresh();
			 }			
	}

	function camb_userpass($id){
		if($this->usuarios_model->galleta() != FALSE){
		$crud = new grocery_CRUD_extended();
		$this->usuarios_model->galleta() == 1 ? $crud->set_table('gadu') : $crud->set_table('usuarios');
		$crud->unset_list();
		$crud->unset_add();
		$crud->unset_back_to_list();
		$crud->unset_export();
		$crud->unset_print();
		$crud->edit_fields('username','email','password_old','password','cfpass');
		$crud->field_type('password_old', 'password');
		$crud->field_type('password', 'password');
		$crud->field_type('cfpass', 'password');
		$crud->required_fields('password_old');
		$crud->set_rules('username','Usuario','min_length[6]|max_length[12]');
		$crud->set_rules('email','E-mail','valid_email');
		$crud->set_rules('password_old', 'Password', 'required|min_length[8]|max_length[15]');
		$crud->set_rules('password', 'Nuevo Password', 'min_length[8]|max_length[15]');
		$crud->set_rules('cfpass', 'Confirmar Password', 'min_length[8]|max_length[15]|matches[password]');			
		$crud->display_as('username','Nuevo Usuario');
		$crud->display_as('email','E-mail');
		$crud->display_as('password_old','Password');
		$crud->display_as('password','Nuevo Password');
		$crud->display_as('cfpass', 'Confirmar Password');
		$crud->set_subject('Cambiar Datos');
	    $crud->callback_edit_field('username',array($this,'edit_field_callback_2'));
		$crud->callback_edit_field('password',array($this,'edit_field_callback_1'));	
		$crud->callback_edit_field('email',array($this,'edit_field_callback_3'));	
		$crud->callback_before_update(array($this,'edit_passuser'));
		$output = $crud->render();
		$this->load->view('panel_view',$output);
		}else{
			$this->usuarios_model->refresh();
		}
	}

    function encrypt_password($post_array)
	{	
		unset($post_array['cfpass']);
		$post_array['password'] = md5($post_array['password']);
		return $post_array;				
	}            

	function edit_password($array)
	{
		$password_adm = md5($array['password_adm']);
		$passvalido = $this->usuarios_model->ValidarPassword($password_adm,'gadu');
		unset($array['password_adm']);
		unset($array['cfpass']);
		$array['password'] = md5($array['password']);
		return $passvalido == TRUE ? $array : FALSE;
	}

	function edit_passuser($array)
	{
		$this->usuarios_model->galleta() == 1 ? $tabla = 'gadu' : $tabla = 'usuarios';
		 if($array['username'] != null && $array['password'] != null && $array['email'] != null){
			$password_old = md5($array['password_old']);
			$passvalido = $this->usuarios_model->ValidarPassword($password_old,$tabla);
			if($passvalido == true){
				unset($array['password_old']);
				unset($array['cfpass']);
				$this->usuarios_model->galleta() == 1 ? $array['username'] = md5($array['username']) : $array['username'] = $array['username'];
				$array['password'] = md5($array['password']);
				return $array;
			}else{
				return false;
			}
		}if($array['username'] != null && $array['password'] == null && $array['email'] == null){
			$password_old = md5($array['password_old']);	 
			$passvalido = $this->usuarios_model->ValidarPassword($password_old,$tabla);
			if($passvalido == true){
				$datos = $this->usuarios_model->ObtenerDatos($tabla);
				$this->usuarios_model->galleta() == 1 ? $array['username'] = md5($array['username']) : $array['username'] = $array['username'];
				$array['email'] = $datos->email;
				$array['password'] = $datos->password;
				unset($array['password_old']);
				unset($array['cfpass']);
				return $array;
			}else{
				return false;
			}
		}if($array['username'] == null && $array['password'] != null && $array['email'] == null){
			$password_old = md5($array['password_old']);
			$passvalido = $this->usuarios_model->ValidarPassword($password_old,$tabla);
			if($passvalido == true){				
				unset($array['password_old']);
				unset($array['cfpass']);
				$array['password'] = md5($array['password']);
				$datos = $this->usuarios_model->ObtenerDatos($tabla);
				$array['username'] = $datos->username;
				$array['email'] = $datos->email;
				return $array;				
			}else{
				return false;
			}		
		}if($array['username'] == null && $array['password'] == null && $array['email'] != null){
			$password_old = md5($array['password_old']);
			$passvalido = $this->usuarios_model->ValidarPassword($password_old,$tabla);
			if($passvalido == true){
				$datos = $this->usuarios_model->ObtenerDatos($tabla);
				$array['username'] = $datos->username;
			    $array['password'] = $datos->password;				
				unset($array['password_old']);
				unset($array['cfpass']);
				return $array;				
			}else{
				return false;
			}					
		}if($array['username'] != null && $array['password'] != null && $array['email'] == null){
			$password_old = md5($array['password_old']);
			$passvalido = $this->usuarios_model->ValidarPassword($password_old,$tabla);
			if($passvalido == true){
				$datos = $this->usuarios_model->ObtenerDatos($tabla);
				$this->usuarios_model->galleta() == 1 ? $array['username'] = md5($array['username']) : $array['username'] = $array['username'];
				$array['email']    = $datos->email;
				$array['password'] = md5($array['password']);
				unset($array['password_old']);
				unset($array['cfpass']);
				return $array;				
			}else{
				return false;
			}					
		}if($array['username'] != null && $array['password'] == null && $array['email'] != null){
			$password_old = md5($array['password_old']);
			$passvalido = $this->usuarios_model->ValidarPassword($password_old,$tabla);
			if($passvalido == true){
				$datos = $this->usuarios_model->ObtenerDatos($tabla);
				$this->usuarios_model->galleta() == 1 ? $array['username'] = md5($array['username']) : $array['username'] = $array['username'];
				$array['password'] = $datos->password;
				unset($array['password_old']);
				unset($array['cfpass']);
				return $array;				
			}else{
				return false;
			}					
		}if($array['username'] == null && $array['password'] != null && $array['email'] != null){
			$password_old = md5($array['password_old']);
			$passvalido = $this->usuarios_model->ValidarPassword($password_old,$tabla);
			if($passvalido == true){
				$datos = $this->usuarios_model->ObtenerDatos($tabla);
				$array['username'] = $datos->username;
				$array['password'] = md5($array['password']);
				unset($array['password_old']);
				unset($array['cfpass']);
				return $array;				
			}else{
				return false;
			}					
		}if($array['username'] == null && $array['password'] == null && $array['email'] == null){
			$password_old = md5($array['password_old']);
			$passvalido = $this->usuarios_model->ValidarPassword($password_old,$tabla);
			if($passvalido == true){
				return false;
			}else{
				return false;
			}           
		}
	}

	function edit_field_callback_1($value, $primary_key)
	{
		$value = null;
        return '<input id="field_password_adm" type="password" maxlength="50" value="'.$value.'" name="password">';
	}

	function edit_field_callback_2($value, $primary_key)
	{
		if($this->usuarios_model->galleta() == 1){
		$value = null;
        return '<input id="field-username" type="text" maxlength="50" value="'.$value.'" name="username">';
    	}else{
    		return '<input id="field-username" type="text" maxlength="50" value="'.$value.'" name="username">';
    	}
	}

	function edit_field_callback_3($value, $primary_key)
	{
		if($this->usuarios_model->galleta() == 1){
		$value = null;
        return '<input id="field-email" type="email" maxlength="50" value="'.$value.'" name="email" style="width:500px">';
    	}else{
    		return '<input id="field-email" type="email" maxlength="50" value="'.$value.'" name="email" style="width:500px">';
    	}
	}	

	function edit_field_callback_4($value, $primary_key)
	{
        return '<input id="field-username" type="text" maxlength="50" value="'.$value.'" name="username" disabled>';
	}	

	function cerrar_sesion(){        
		setcookie("SIE_cook", " ", time() + 0, "/");
		setcookie("SIE_SESC", " ", time() + 0, "/");
		setcookie("conf_det", '', time() + 0, "/");
		redirect(base_url());
	}

	
}