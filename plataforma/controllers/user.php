<?php
class User extends CI_Controller {

    function __construct()
	{
	    parent::__construct();
		$this->load->library('grocery_CRUD');
		$this->load->library('encrypt');		
		$this->load->model('usuarios_model');
		$this->load->model('registro_model');
   	}

   	function index()
		{
			$this->load->view('header');
			$this->load->view('header_application');
			//$this->load->view('panel');
			$this->load->view('footer');
		}


		function panel()
		{
			$this->load->view('header');
			$this->load->view('header_application');
			$this->load->view('panel');
			$this->load->view('footer');
		}

		function registro() {
	        $this->load->model('registro_model');
			$this->load->helper('form');
			$this->load->library('form_validation');

			
				$this->form_validation->set_rules('nombre','Nombre','trim|required|min_length[3]|xss_clean');
				$this->form_validation->set_rules('contra','Contraseña','trim|required|min_length[4]|matches[ccontra]');
				$this->form_validation->set_rules('ccontra','Confirmar Contraseña','trim|required|min_length[4]');
				$this->form_validation->set_rules('correo','Correo','trim|required|valid_email');
				$this->form_validation->set_rules('estado','Estado','trim|required|min_length[3]');
				//validacion para checkboxs
				$this->form_validation->set_rules('Tipouser1','Tipo usuario','trim|callback_checkbox_valid');
				
				if($this->form_validation->run() === true){
	    			$nombre = $this->input->post('nombre');
	        		$contra = $this->input->post('contra');
	        		$correo = $this->input->post('correo');
	        		$estado = $this->input->post('estado');
	        		$Tipouser1 = $this->input->post('Tipouser1');
	        		$Tipouser2 = $this->input->post('Tipouser2');
	        		$Tipouser3 = $this->input->post('Tipouser3');

	        		$this->registro_model->registro_usuario($nombre, $contra, $correo, $estado, $Tipouser1, $Tipouser2, $Tipouser3);
	        		
	        		$this->load->view('header');
	        		$this->load->view('header_application');
	        		$this->load->view('panel');
	        		$this->load->view('footer');

	        	} else {	
	        		$this->load->view('header');
	        		$this->load->view('header_application');
					$this->load->view('registro');
					$this->load->view('footer');

	            }

		}

		function checkbox_valid(){
					
					$Tipouser1 = $this->input->post('Tipouser1');
	        		$Tipouser2 = $this->input->post('Tipouser2');
	        		$Tipouser3 = $this->input->post('Tipouser3');
	        //checar validacion en caso de no escoger tipo de usuario-----  es con doble comilla?
	        if($Tipouser1 != 'acceptar' && $Tipouser3 != "acceptar" && $Tipouser2 != "acceptar"){
				$this->form_validation->set_message('checkbox_valid', 'Debes escoger que tipo de usuario seras');
				return false;
	        }else if( $Tipouser1 == 'acceptar' && $Tipouser3 == 'acceptar' && $Tipouser2 == 'acceptar'){
				$this->form_validation->set_message('checkbox_valid', 'solo puedes escoger entre comprador, vendedor y colaborador o comprador/vendedor');
				return false;
			}else if ($Tipouser1 == 'acceptar' && $Tipouser3 == 'acceptar'){
				$this->form_validation->set_message('checkbox_valid', 'solo puedes escoger entre comprador y colaborador');
				return false;
			}else if( $Tipouser3 == 'acceptar' && $Tipouser2 == 'acceptar'){
				$this->form_validation->set_message('checkbox_valid', 'solo puedes escoger entre vendedor y colaborador');
				return false;
			}else if ($Tipouser1 == 'acceptar' && $Tipouser2 == 'acceptar'){
				return true;
			}else if($Tipouser1 == 'acceptar'){
				return true;
			}else if ($Tipouser2 == 'acceptar') {
				return true;
			}else if($Tipouser3 == 'acceptar'){
				return true;
			}

		}


function login(){
	 if($this->registro_model->galleta() == FALSE){
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
				$ExisteUsuarioyPassword = $this->registro_model->ValidarUsuario(md5($userlogin),md5($passwordlogin));
				if($ExisteUsuarioyPassword == TRUE){
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





}
?>