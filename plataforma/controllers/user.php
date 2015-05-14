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

}
?>