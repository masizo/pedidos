<?php
class Admin extends CI_Controller {

    function __construct()
	{
	    parent::__construct();
		$this->load->library('grocery_CRUD');
		$this->load->library('encrypt');		
		$this->load->model('usuarios_model');
   	}

	function index()
	{
		$this->usuarios_model->galleta() == TRUE ? $this->sistema() : $this->login();
	}

    function sistema()
    {
		if($this->usuarios_model->galleta() == TRUE){
			$this->load->view("menuprueba");	   
		}else{
		redirect(base_url('/admin'));
		}
	}

	function login()
	{
	 if($this->usuarios_model->galleta() == FALSE){
        setcookie("SIE_cook", "", time() + 0, "/");
		setcookie("SIE_SESC", "", time() + 0, "/"); 		
		if(!isset($_POST['userlogin'])){	
			$this->load->view('login');			
		}else{								
			$this->form_validation->set_rules('userlogin','usuario','required|min_length[6]|max_length[12]');
			$this->form_validation->set_rules('passwordlogin','contraseña','required|min_length[8]|max_length[15]');
			if(($this->form_validation->run()==FALSE)){				
				$this->load->view('login');
			}else{
				$passwordlogin = $_POST['passwordlogin'];
				$userlogin = $_POST['userlogin'];
				$user = $this->encrypt->encode($userlogin, 'cat');
				$pass = $this->encrypt->encode($passwordlogin, 'cat');
				$ExisteUsuarioyPassword = $this->usuarios_model->ValidarUsuario(md5($userlogin),md5($passwordlogin));
				if($ExisteUsuarioyPassword == TRUE){
                    setcookie("SIE_cook", $user, time() + 86400, "/");
        			setcookie("SIE_SESC", $pass, time() + 86400, "/"); 
        			redirect(base_url('/admin'));           				    
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

	function perfil($id = 1)
	{					
		$crud = new grocery_CRUD();
		$crud->set_table('panel');
		$crud->unset_list();
		$crud->unset_add();
		$crud->unset_back_to_list();
		$crud->edit_fields('usuario','password_old','password','cfpass');
		$crud->field_type('password_old', 'password');
		$crud->field_type('password', 'password');
		$crud->field_type('cfpass', 'password');				
		$crud->required_fields('password_old');
		$crud->set_rules('usuario','Usuario','min_length[6]|max_length[12]');
		$crud->set_rules('password_old', 'Password', 'required|min_length[8]|max_length[15]');
		$crud->set_rules('password', 'Nuevo Password', 'min_length[8]|max_length[15]');
		$crud->set_rules('cfpass', 'Confirmar Password', 'min_length[8]|max_length[15]|matches[password]');			
		$crud->display_as('password_old','Password');
		$crud->display_as('password','Nuevo Password');
		$crud->display_as('cfpass', 'Confirmar Password');
		$crud->set_subject('Perfil');
		$crud->callback_edit_field('usuario',array($this,'callback_u'));		
		$crud->callback_edit_field('password',array($this,'callback_p'));		
		$crud->callback_before_update(array($this,'actualiza'));
		$output = $crud->render();
		$this->usuarios_model->galleta() == TRUE ? $this->load->view('panel_view',$output) : $this->usuarios_model->refresh();		
	}

	function callback_u($value,$primary_key)
	{
		$value = $this->encrypt->decode($_COOKIE['SIE_cook'], 'cat');
        return '<input id="field-usuario" type="text" maxlength="50" value="'.$value.'" name="usuario">';		
	}

	function callback_p($value,$primary_key)
	{
		return '<input id="field-password" type="password" maxlength="50" value="" name="password">';			
	}	

	function actualiza($array)
	{
		$user = $array['usuario'];
		$pass = $array['password_old'];
		if($this->usuarios_model->comprobar(md5($pass))){
			if($array['password'] == "")
			{
				$array['password'] = $array['password_old'];
				unset($array['password_old']);
				unset($array['cfpass']);
				$array['usuario']  = md5($array['usuario']);
				$array['password'] = md5($array['password']);
				return $array;
			}else
			{
				unset($array['password_old']);
				unset($array['cfpass']);
				$array['usuario']  = md5($array['usuario']);
				$array['password'] = md5($array['password']);
				return $array;
			}
		}else{
			$this->usuarios_model->devil_error();
		}
	}
            
	function cerrar_sesion(){
        
		setcookie("SIE_cook", " ", time() + 0, "/");
		setcookie("SIE_SESC", " ", time() + 0, "/");
		redirect(base_url());

	}
}