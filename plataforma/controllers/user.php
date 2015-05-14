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
			$this->load->helper('form');
			$this->load->library('form_validation');
				$this->form_validation->set_rules('nombre','Nombre','trim|required|min_length[3]|xss_clean');
				$this->form_validation->set_rules('contra','Contraseña','trim|required|min_length[4]|matches[passconf]');
				$this->form_validation->set_rules('ccontra','Confirmar Contraseña','trim|required|min_length[4]');
				$this->form_validation->set_rules('correo','Correo','trim|required|valid_email');
				$this->form_validation->set_rules('estado','Estado','trim|required|min_length[3]');


			if ($this->form_validation->run() == FALSE)
        	{
				$this->load->view('header');
				$this->load->view('registro');
				$this->load->view('footer');
        	} else {	

        		$reg  = array(
        			'nombre' => $nombre,
        			'contra' => $contra,
        			'correo' => $correo,
        			'estado' => $estado
        			 );
        		$this->load->model('registro_model');
        		$this->registro_model->registro_usuario($reg);


            	$this->load->view('panel');
        	}

		}


}
?>