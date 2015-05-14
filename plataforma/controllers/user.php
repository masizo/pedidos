<?php
class User extends CI_Controller {

    function __construct()
	{
	    parent::__construct();
		$this->load->library('grocery_CRUD');
		$this->load->library('encrypt');		
		$this->load->model('usuarios_model');
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
				$this->form_validation->set_rules('contra','Contraseña','trim|required|min_length[4]|matches[passconf]');
				$this->form_validation->set_rules('ccontra','Confirmar Contraseña','trim|required|min_length[4]');
				$this->form_validation->set_rules('correo','Correo','trim|required|valid_email');
				$this->form_validation->set_rules('estado','Estado','trim|required|min_length[3]');

				if($this->form_validation->run() === true){
	    			$nombre = $this->input->post('nombre');
	        		$contra = $this->input->post('contra');
	        		$correo = $this->input->post('correo');
	        		$estado = $this->input->post('estado');
	        		
	        		$this->registro_model->registro_usuario($nombre, $contra, $correo, $estado);
	        	} else {	
	        		$this->load->view('header');
					$this->load->view('registro');
					$this->load->view('footer');
	            }

		}


}
?>